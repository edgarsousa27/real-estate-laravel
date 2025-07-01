<?php

namespace App\Http\Controllers\Properties;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Sorts\SortByPrice;
use App\Filters\TransactionFilter;
use App\Filters\TypePropertyFilter;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Favorites;
use App\Services\OpenCageService;
use App\Sorts\SortByDate;
use App\Sorts\SortBySurfaceArea;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedSort;
use Illuminate\Support\Facades\File;

class PropertyController extends Controller
{

    public function welcome()
    {
        $properties_buy = Property::select('id')->where('transaction_id', 1)->where('status', 'active');
        $properties_rent = Property::select('id')->where('transaction_id', 2)->where('status', 'active');

        $properties = Property::orderBy('id', 'desc')->where('status', 'active')->take(9)->get();

        $properties->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);

        $categories = Category::select('id', 'name')->get();

        $favorites = Auth::check() ? Favorites::where('user_id', Auth::user()->id)->pluck('property_id') : collect();

        return Inertia::render('Welcome/Index', [
            'count_buy' => $properties_buy->count(),
            'count_rent' => $properties_rent->count(),
            'properties' => $properties,
            'categories' => $categories,
            'favorites' => $favorites
        ]);
    }

    private function meiliSorts(?string $sort): ?array
    {
        if (!$sort) {
            return null;
        }

        if (str_starts_with($sort, '-')) {
            return [substr($sort, 1) . ':desc'];
        }

        return [$sort . ':asc'];
    }


    public function searchBuy(Request $request, Property $properties)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');
        $meiliSort = $this->meiliSorts($sort);

        if ($query) {
            $properties = Property::search($query, function ($meilisearch, $query, $options) use ($meiliSort) {
                $options['filter'] = 'transaction_id = 1';

                if ($meiliSort) {
                    $options['sort'] = $meiliSort;
                }

                return $meilisearch->search($query, $options);
            })->paginate(15);
        }

        if ($properties->isEmpty()) {
            return Inertia::render('Properties/NoResults', [
                'count' => $properties->total(),
                'query' => $query
            ]);
        }

        $properties->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);


        $categories = Category::select('id', 'name')->get();

        $favorites = Auth::check() ? Favorites::where('user_id', Auth::user()->id)->pluck('property_id') : collect();

        return Inertia::render('Properties/Search', [
            'properties' => $properties,
            'categories' => $categories,
            'count' => $properties->total(),
            'query' => $query,
            'favorites' => $favorites
        ]);
    }

    public function searchRent(Request $request, Property $properties)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');
        $meiliSort = $this->meiliSorts($sort);

        if ($query) {
            $properties = Property::search($query, function ($meilisearch, $query, $options) use ($meiliSort) {
                $options['filter'] = 'transaction_id = 2';

                if ($meiliSort) {
                    $options['sort'] = $meiliSort;
                }

                return $meilisearch->search($query, $options);
            })->paginate(15);
        }

        if ($properties->isEmpty()) {
            return Inertia::render('Properties/NoResults', [
                'count' => $properties->total(),
                'query' => $query
            ]);
        }

        $properties->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);


        $categories = Category::select('id', 'name')->get();

        $favorites = Auth::check() ? Favorites::where('user_id', Auth::user()->id)->pluck('property_id') : collect();

        return Inertia::render('Properties/Search', [
            'properties' => $properties,
            'categories' => $categories,
            'count' => $properties->total(),
            'query' => $query,
            'favorites' => $favorites
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $query = QueryBuilder::for(Property::class)
            ->allowedFilters([
                AllowedFilter::custom('type', new TypePropertyFilter),
                AllowedFilter::custom('transaction', new TransactionFilter)
            ])
            ->allowedSorts([
                AllowedSort::custom('price', new SortbyPrice(), 'price'),
                AllowedSort::custom('created_at', new SortByDate(), 'created_at'),
                AllowedSort::custom('surface', new SortBySurfaceArea(), 'square_meters')
            ])
            ->with('media');

        $properties = $query->where('status', 'active')->paginate(15)->appends(request()->query());

        if ($properties->isEmpty()) {
            return Inertia::render('Properties/NoResults', [
                'count' => $properties->total(),
                'query' => $query
            ]);
        }

        $favorites = Auth::check() ? Favorites::where('user_id', Auth::user()->id)->pluck('property_id') : collect();

        $categories = Category::select('id', 'name')->get();

        return Inertia::render('Properties/Index', [
            'properties' => $properties,
            'categories' => $categories,
            'count' => $properties->count(),
            'favorites' => $favorites
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Property $property)
    {
        $json = File::get(resource_path('data/districts.json'));
        $data = json_decode($json, true);

        $districts = collect($data['distritos'])
            ->keys()
            ->sort()
            ->values();

        $cities = collect($data['distritos'])->map(function ($citiesinDistrict) {
            return collect($citiesinDistrict)->pluck('name');
        });

        $postalcode = collect($data['distritos'])->mapWithKeys(function ($cities, $districtName) {
            return collect($cities)->mapWithKeys(function ($city) use ($districtName) {
                return ["{$districtName}|{$city['name']}" => $city['postal_code']];
            });
        });

        return Inertia::render('Properties/Create', [
            'properties' => $property,
            'district' => $districts,
            'cities' => $cities,
            'postal_code' => $postalcode
        ]);
    }

    /**<
     * Store a newly created resource in storage.
     */
    public function store(Request $request, OpenCageService $geo)
    {
        $bedrooms = $request->bedrooms;
        $square_meters = $request->square_meters;

        $titleParams = [
            'bedrooms' => $bedrooms,
            'square_meters' => $square_meters
        ];

        if ($request->category_id == 1 && $request->transaction_id == 1) {
            $title = "properties.house_buy";
        } else if ($request->category_id == 2 && $request->transaction_id == 1) {
            $title = "properties.apartment_buy";
        } elseif ($request->category_id == 3 && $request->transaction_id == 1) {
            $title = "properties.land_buy";
        } else if ($request->category_id == 1 && $request->transaction_id == 2) {
            $title = "properties.house_rent";
        } else if ($request->category_id == 2 && $request->transaction_id == 2) {
            $title = "properties.apartment_rent";
        } else if ($request->category_id == 3 && $request->transaction_id == 2) {
            $title = "properties.land_rent";
        } else {
            $title = $request->title;
        }

        $request->merge([
            'title' => $title,
            'title_params' => $titleParams
        ]);

        $validator = $request->validate([
            'category_id' => ['required', 'integer'],
            'transaction_id' => ['required', 'integer'],
            'title' => ['required'],
            'description' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'square_meters' => ['required', 'numeric'],
            'city' => ['required'],
            'district' => ['required'],
            'bathrooms' => ['integer', 'nullable'],
            'bedrooms' => ['integer', 'nullable'],
            'parking_spaces' => ['integer', 'nullable'],
            'images.*' => ['image', 'nullable', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'documents.*' => ['file', 'nullable', 'mimes:pdf,doc,docx,txt', 'max:5120'],
            'postal_code' => ['required', 'integer'],
            'heating' => ['boolean'],
            'cooling' => ['boolean'],
            'kitchen_equipped' => ['boolean'],
            'double_glazing' => ['boolean'],
            'security_alarm_system' => ['boolean'],
            'fire_alarm_system' => ['boolean'],
            'garden' => ['boolean'],
            'balcony' => ['boolean'],
            'terrace' => ['boolean'],
            'solar_panels' => ['boolean'],
            'thermal_insulation' => ['boolean'],
            'fireplace' => ['boolean'],
            'storage' => ['boolean'],
            'swimming_pool' => ['boolean'],
            'sea_view' => ['boolean'],
            'mountain_view' => ['boolean'],
            'open_plan_kitchen' => ['boolean'],
            'smart_home' => ['boolean'],
            'furnished' => ['boolean'],
            'building_pool' => ['boolean'],
            'building_gym' => ['boolean'],
            'wheelchair_access' => ['boolean'],
            'elevator' => ['boolean'],
            'garage' => ['boolean'],
            'kitchen' => ['boolean'],
            'well_water' => ['boolean'],
            'electricity' => ['boolean'],
            'energy_consumption' => ['integer', 'nullable'],
            'gas_emission' => ['integer', 'nullable'],
            'title_params' => ['required'],
        ]);

        $coords = $geo->forwardGeoLocation($request->input('address'));

        $data = $validator;

        $data['latitude'] = $coords['latitude'];
        $data['longitude'] = $coords['longitude'];

        $properties = Auth::user()->property()->create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as  $image) {
                $properties->addMedia($image)
                    ->withResponsiveImages()
                    ->toMediaCollection('images');
            }
        }

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as  $documents) {
                $properties->addMedia($documents)
                    ->toMediaCollection('documents');
            }
        }

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function userProperties()
    {
        $properties = Auth::user()->property()->paginate(15);

        $categories = Category::select('id', 'name')->get();

        $properties->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);

        $json = File::get(resource_path('data/districts.json'));
        $data = json_decode($json, true);

        $districts = collect($data['distritos'])
            ->keys()
            ->sort()
            ->values();

        $cities = collect($data['distritos'])->map(function ($citiesinDistrict) {
            return collect($citiesinDistrict)->pluck('name');
        });

        $postalcode = collect($data['distritos'])->mapWithKeys(function ($cities, $districtName) {
            return collect($cities)->mapWithKeys(function ($city) use ($districtName) {
                return ["{$districtName}|{$city['name']}" => $city['postal_code']];
            });
        });

        return Inertia::render('Properties/UserProperties', [
            'properties' => $properties,
            'categories' => $categories,
            'district' => $districts,
            'cities' => $cities,
            'postal_code' => $postalcode
        ]);
    }

    public function show($slug)
    {
        $property = Property::with('user')->where('slug', $slug)->firstOrFail();

        $property->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);

        $favorites = Auth::check() ? Favorites::where('user_id', Auth::user()->id)->pluck('property_id') : collect();

        $propertyCurrentPrice = $property->price;
        $propertyPriceRange = $propertyCurrentPrice * 0.3;

        $propertyMinPrice = $propertyCurrentPrice - $propertyPriceRange;
        $propertyMaxPrice = $propertyCurrentPrice + $propertyPriceRange;


        $similarProperties = Property::where('category_id', $property->category->id)
            ->where('transaction_id',  $property->transaction->id)
            ->where('id', '!=', $property->id)
            ->where('district', $property->district)
            ->where('status', 'active')
            ->whereBetween('price', [$propertyMinPrice, $propertyMaxPrice])
            ->take(9)
            ->get();

        $similarProperties->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);

        return Inertia::render('Properties/Show', [
            'properties' => $property,
            'authUser' => Auth::id(),
            'favorites' => $favorites,
            'similarProperties' => $similarProperties
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'price' => 'required',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'square_meters' => 'required|numeric',
            'city' => 'required',
            'district' => 'required',
            'postal_code' => 'required',
        ]);

        $property->update([
            'price' => $request->price,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'square_meters' => $request->square_meters,
            'city' => $request->city,
            'district' => $request->district,
            'postal_code' => $request->postal_code
        ]);

        return redirect()->route('properties.userProperties');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $properties = Property::find($request->id);

        if ($properties) {
            $properties->delete();
        }

        return redirect()->route('properties.userProperties');
    }

    public function storeFavorites(Request $request)
    {
        $request->validate([
            'property_id' => 'required'
        ]);

        if (!Auth::user()) {
            return Inertia::location(route('register'));
        }

        Favorites::firstOrCreate([
            'user_id' => Auth::user()->id,
            'property_id' => $request->property_id
        ]);

        return redirect()->back();
    }

    public function destroyFavorites($id)
    {
        Favorites::where('user_id', Auth::user()->id)
            ->where('property_id', $id)
            ->delete();

        return redirect()->back();
    }

    public function showFavorites()

    {
        $properties = Property::whereHas('favorites', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->with(['media' => function ($query) {
                $query->where('collection_name', 'images');
            }])
            ->paginate(15);

        $properties->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);

        $favorites = Auth::check() ? Favorites::where('user_id', Auth::user()->id)->pluck('property_id') : collect();

        $categories = Category::select('id', 'name')->get();

        return Inertia::render('Properties/Favorites', [
            'properties' => $properties,
            'categories' => $categories,
            'favorites' => $favorites
        ]);
    }
}
