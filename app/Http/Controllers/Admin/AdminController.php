<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Sorts\SortByHouseType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::select('id','title','price','city','district', 'status')->orderBy('id', 'desc')->take(5)->get();

        $revenue = $properties->where('status', 'active')->sum('price');

        $total_revenue = $revenue * 0.015;

        $properties->load('media');

        $total_properties = Property::count();
        $active_properties = Property::where('status', 'active')->count();
        $pending_properties = Property::where('status', 'pending')->count();
        
        return Inertia::render('Admin/Index', [
            'properties' => $properties,
            'total_properties' => $total_properties,
            'active_properties' => $active_properties,
            'pending_properties' => $pending_properties,
            'revenue' => $total_revenue
        ]);
    }


    public function indexProperties(Request $request)
    {
        $properties = Property::select('id','category_id','title','price','address','city','district', 'status')->orderBy('id', 'desc')->get();

        $categories = Category::select('id', 'name')->get();

        $query = $request->input('query'); 

        if($query){
            $properties = Property::search($query)->get();
        }

        $properties->load('media');

        return Inertia::render('Admin/Properties',[
            'properties' => $properties,
            'categories' => $categories,
            'query' => $query,
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
