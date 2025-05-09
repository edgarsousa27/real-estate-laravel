<?php

namespace App\Http\Controllers\Properties;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Filters\ApartmentFilter;
use App\Filters\HouseFilter;
use App\Filters\HouseApartmentFilter;
use App\Filters\LandsFilter;
use App\Sorts\SortByPrice;
use App\Filters\TransactionFilter;
use App\Models\Category;
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

        $properties = Property::select('id','category_id', 'transaction_id','price','square_meters','city', 'district','bathrooms','bedrooms')->orderBy('id', 'desc')->take(9)->get();

        $properties->load('media');

        $categories = Category::select('id', 'name')->get();

        return Inertia::render('Welcome/Index', [
            'count_buy' => $properties_buy->count(),
            'count_rent' => $properties_rent->count(),
            'properties' => $properties,
            'categories' => $categories
        ]);
    }

    public function searchBuy(Request $request)
    {
        $query = $request->input('query');

        if($query){
            $properties = Property::search($query, function ($meilisearch, $query, $options) {
                $options['filter'] = 'transaction_id = 1';
                return $meilisearch->search($query, $options);
            })->paginate(15);
        } else {
            $properties = Property::select('id','category_id', 'transaction_id','price','square_meters','city', 'district','bathrooms','bedrooms')->where('transaction_id', 1)->paginate(15);
        }

        if($properties->isEmpty()){
            return Inertia::render('Properties/NoResults', [
                'count' => $properties->total(),
                'query' => $query
            ]);
        }

        if($query == 0){
            redirect(to_route('search.buy'));
        }
        
        $properties->load('media');

        $categories = Category::select('id', 'name')->get();

            return Inertia::render('Properties/Search', [
                'properties' => $properties,
                'categories' => $categories,
                'count' => $properties->total(),
            ]);
    }

    public function searchRent(Request $request)
    {
        $query = $request->input('query');

        if($query){
            $properties = Property::search($query, function ($meilisearch, $query, $options) {
                $options['filter'] = 'transaction_id = 2';
                return $meilisearch->search($query, $options);
            })->paginate(15);
        } else {
            $properties = Property::select('id','category_id', 'transaction_id','price','square_meters','city', 'district','bathrooms','bedrooms')->where('transaction_id', 2)->paginate(15);
        }

        if($properties->isEmpty()){
            return Inertia::render('Properties/NoResults', [
                'count' => $properties->total(),
                'query' => $query
            ]);
        }

        if($query == 0){
            redirect(to_route('search.buy'));
        }

        $properties->load('media');

        $categories = Category::select('id', 'name')->get();

            return Inertia::render('Properties/Search', [
                'properties' => $properties,
                'categories' => $categories,
                'count' => $properties->total(),
            ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $query = QueryBuilder::for(Property::class)
        ->allowedFilters([
            AllowedFilter::custom('houses', new HouseFilter),
            AllowedFilter::custom('apartments', new ApartmentFilter),
            AllowedFilter::custom('houses-apartments', new HouseApartmentFilter),
            AllowedFilter::custom('lands', new LandsFilter),
            AllowedFilter::custom('transaction', new TransactionFilter)
        ])
        ->allowedSorts([
            AllowedSort::custom('price', new SortbyPrice(), 'price'),
            AllowedSort::custom('date', new SortByDate(), 'created_at'),
            AllowedSort::custom('surface', new SortBySurfaceArea(), 'square_meters')
        ])
        ->with('media');
        
        $properties = $query->select('id','category_id', 'transaction_id','price','square_meters','city', 'district','bathrooms','bedrooms')->paginate(15)->appends(request()->query());

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
    public function create()
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
    
        $properties = Property::select('category_id', 'transaction_id','price', 'description', 'address', 'parking_spaces', 'square_meters','city','district','country','bathrooms','bedrooms', 'floors', 'postal_code')->get();

        return Inertia::render('Properties/Create', [
            'properties' => $properties,
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
            'description' => ['required'],
            'address' => ['required'],
            'price' => ['required', 'integer'],
            'square_meters' => ['required', 'integer'],
            'city' => ['required'],
            'district' => ['required'],
            'bathrooms' => ['integer', 'nullable'],
            'bedrooms' => ['integer', 'nullable'],
            'parking_spaces' => ['integer', 'nullable'],
            'floors' => ['integer', 'nullable'],
            'images.*' => ['image', 'nullable', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'postal_code' => ['required', 'integer']
          ]);

        $properties = Auth::user()->property()->create($validator);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as  $image) {
                $properties->addMedia($image)
                ->withResponsiveImages()
                ->toMediaCollection('images');
            }
        }
  
        return to_route('dashboard');
      }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
