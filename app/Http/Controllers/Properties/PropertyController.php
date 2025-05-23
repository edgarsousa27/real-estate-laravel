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
use App\Sorts\SortByDate;
use App\Sorts\SortBySurfaceArea;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedSort;
use Illuminate\Support\Facades\File;

class PropertyController extends Controller
{

    public function welcome()
    {
        $properties_buy = Property::select('id')->where('transaction_id', 1);
        $properties_rent = Property::select('id')->where('transaction_id', 2);

        $properties = Property::select('id','category_id', 'transaction_id','price','square_meters','city', 'district','bathrooms','bedrooms', 'slug')->orderBy('id', 'desc')->take(9)->get();

        $properties->load('media');

        $categories = Category::select('id', 'name')->get();

        return Inertia::render('Welcome/Index', [
            'count_buy' => $properties_buy->count(),
            'count_rent' => $properties_rent->count(),
            'properties' => $properties,
            'categories' => $categories
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


    public function searchBuy(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');
        $meiliSort = $this->meiliSorts($sort);

        if($query){
            $properties = Property::search($query, function ($meilisearch, $query, $options) use ($meiliSort){
                $options['filter'] = 'transaction_id = 1';

                if($meiliSort){
                    $options['sort'] = $meiliSort;
                }

                return $meilisearch->search($query, $options);
            })->paginate(15);
        } 

        if($properties->isEmpty()){
            return Inertia::render('Properties/NoResults', [
                'count' => $properties->total(),
                'query' => $query
            ]);
        }

        $properties->load('media');

        $categories = Category::select('id', 'name')->get();

            return Inertia::render('Properties/Search', [
                'properties' => $properties,
                'categories' => $categories,
                'count' => $properties->total(),
                'query' => $query
            ]);
    }

    public function searchRent(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');
        $meiliSort = $this->meiliSorts($sort);

        if($query){
            $properties = Property::search($query, function ($meilisearch, $query, $options) use ($meiliSort) {
                $options['filter'] = 'transaction_id = 2';

                if($meiliSort){
                    $options['sort'] = $meiliSort;
                }

                return $meilisearch->search($query, $options);
            })->paginate(15);
        } 

        if($properties->isEmpty()){
            return Inertia::render('Properties/NoResults', [
                'count' => $properties->total(),
                'query' => $query
            ]);
        }

        $properties->load('media');

        $categories = Category::select('id', 'name')->get();

            return Inertia::render('Properties/Search', [
                'properties' => $properties,
                'categories' => $categories,
                'count' => $properties->total(),
                'query' => $query
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
            AllowedSort::custom('date', new SortByDate(), 'created_at'),
            AllowedSort::custom('surface', new SortBySurfaceArea(), 'square_meters')
        ])
        ->with('media');
        
        $properties = $query->select('id','category_id', 'transaction_id','price','square_meters','city', 'district','bathrooms','bedrooms', 'slug')->paginate(15)->appends(request()->query());

        $categories = Category::select('id', 'name')->get();

        return Inertia::render('Properties/Index', [
            'properties' => $properties,
            'categories' => $categories,
            'count' => $properties->count()
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

        $cities = collect($data['distritos'])->map(function($citiesinDistrict){
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'category_id' => ['required', 'integer'],
            'transaction_id' => ['required', 'integer'],
            'title' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
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
            'electricity' => ['boolean']
          ]);

        $properties = Auth::user()->property()->create($validator);

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
        $properties = Auth::user()->property()->select('id','category_id', 'transaction_id','price', 'description', 'address', 'parking_spaces', 'square_meters','city','district','country','bathrooms','bedrooms','postal_code', 'slug')->paginate(15);

        $categories = Category::select('id', 'name')->get();

        $properties->load('media');

        $json = File::get(resource_path('data/districts.json'));
        $data = json_decode($json, true);
    
        $districts = collect($data['distritos'])
            ->keys()        
            ->sort()
            ->values();

        $cities = collect($data['distritos'])->map(function($citiesinDistrict){
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

    public function show($slug, Property $property)
    {
        $properties = $property->with('user')->where('slug', $slug)->firstOrFail();

        $contact = Contact::select('property_id','name', 'lastname', 'email', 'phone_number', 'message')->get();

        $properties->load('media');

        return Inertia::render('Properties/Show', [
            'properties' => $properties,
            'contact' => $contact
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'price' => 'required|numeric',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'square_meters' => 'required|numeric',
            'city' => 'required',
            'district' => 'required',
            'postal_code' => 'required',
        ]);

        $proper = Property::find($request->id);

        if($proper){
            $proper->update([
                'price' => $request->price,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'square_meters' => $request->square_meters,
                'city' => $request->city,
                'district' => $request->district,
                'postal_code' => $request->postal_code
            ]);
        }
                
        return Inertia::location(route('properties.userProperties'));
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

        return Inertia::location(route('properties.userProperties'));
    }
}
