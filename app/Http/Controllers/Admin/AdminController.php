<?php

namespace App\Http\Controllers\Admin;

use App\Filters\StatusPropertyFilter;
use App\Filters\TypePropertyFilter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::select('id','title','price','city','district', 'status', 'slug', 'final_price')->orderBy('id', 'desc')->take(5)->get();

        $revenue = $properties->whereIn('status', ['sold', 'rented'])->sum('final_price');

        $total_revenue = $revenue * 0.05;

        $properties->load('media');

        $total_properties = Property::count();
        $active_properties = Property::where('status', 'active')->count();
        $pending_properties = Property::where('status', 'pending')->count();
        $sold_properties = Property::where('status', 'sold')->count();
        $rented_properties = Property::where('status', 'rented')->count();
        
        return Inertia::render('Admin/Index', [
            'properties' => $properties,
            'total_properties' => $total_properties,
            'active_properties' => $active_properties,
            'pending_properties' => $pending_properties,
            'revenue' => $total_revenue,
            'sold_properties' => $sold_properties,
            'rented_properties' => $rented_properties,
        ]);
    }


    public function indexProperties(Request $request)
    {
        $filters = QueryBuilder::for(Property::class)
        ->allowedFilters([
            AllowedFilter::custom('type', new TypePropertyFilter),
            AllowedFilter::custom('status', new StatusPropertyFilter),
        ]);

        $properties = $filters->select('id','category_id','title','price','address','city','district', 'status', 'slug', 'final_price')->orderBy('id', 'desc')->paginate(15);

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
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->load(['media', 'user']);

        $users = User::select('id', 'name', 'email', 'nationality', 'tax_number', 'identification_number', 'phone_number', 'date_of_birth')->get();

        $categories = Category::select('id', 'name')->get();

        $downloads = $property->getMedia('downloads');
        
        return Inertia::render('Admin/DetailsProperties', [
            'property' => $property,
            'categories' => $categories,
            'downloads' => $downloads,
            'users' => $users,
        ]);
    }

    public function downloadDocuments(Property $property)
    {
        $downloads = $property->getMedia('documents');

        return MediaStream::create('documents.zip')->addMedia($downloads);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'status' => 'required|string',
            'reason_for_refusal' => 'nullable|string',
            'sold_to_user_id' => 'nullable',
            'final_price' => 'numeric|nullable'
        ]);

        $property->update([
            'status' => $request->status,
            'reason_for_refusal' => $request->reason_for_refusal,
            'sold_to_user_id' => $request->sold_to_user_id,
            'final_price' => $request->final_price
        ]);

        if($request->status === 'sold')
        {
            $property->sold_at = Carbon::now();
        } else {
            $property->sold_at = null;
        }

        $property->save();
                        
        return Inertia::location(route('admin.properties', $property->slug));
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
