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
use Spatie\QueryBuilder\AllowedSort;

class PropertyController extends Controller
{
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
        ]);

        $properties = $query->select('category_id', 'transaction_id','price','square_meters','city','bathrooms','bedrooms', 'image_path')->get();

        $count = $properties->count();

        $categories = Category::select('id', 'name')->get();

        return Inertia::render('Properties/Index', [
            'properties' => $properties,
            'categories' => $categories,
            'count' => $count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
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
