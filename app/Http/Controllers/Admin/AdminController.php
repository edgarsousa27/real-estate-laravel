<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::select('id','title','price','city','district', 'status')->orderBy('id', 'desc')->get();

        $revenue = $properties->where('status', 'active')->sum('price');

        $total_revenue = $revenue * 0.015;

        $properties->load('media');

        $total_properties = $properties->count();
        $active_properties = $properties->where('status', 'active')->count();
        $pending_properties = $properties->where('status', 'pending')->count();
        
        return Inertia::render('Admin/Index', [
            'properties' => $properties,
            'total_properties' => $total_properties,
            'active_properties' => $active_properties,
            'pending_properties' => $pending_properties,
            'revenue' => $total_revenue
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
