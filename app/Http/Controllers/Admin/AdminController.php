<?php

namespace App\Http\Controllers\Admin;

use App\Filters\StatusPropertyFilter;
use App\Filters\TypePropertyFilter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorites;
use App\Models\Property;
use App\Models\RentsContract;
use App\Models\SalesContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $properties = Property::orderBy('id', 'desc')->take(5)->get();

        $revenueSales = SalesContract::sum('total_revenue');
        $revenueRents = RentsContract::sum('total_revenue');
        $total_revenue = $revenueRents + $revenueSales;

        $categories = Category::select('id', 'name')->get();

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
            'categories' => $categories
        ]);
    }


    public function indexProperties(Request $request)
    {
        $filters = QueryBuilder::for(Property::class)
            ->allowedFilters([
                AllowedFilter::custom('type', new TypePropertyFilter),
                AllowedFilter::custom('status', new StatusPropertyFilter),
            ]);

        $properties = $filters->orderBy('id', 'desc')->paginate(15);

        $categories = Category::select('id', 'name')->get();

        $query = $request->input('query');

        if ($query) {
            $properties = Property::search($query)->paginate(10);
        }

        return Inertia::render('Admin/Properties', [
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
        $property->load(['user']);

        $property->load(['media' => function ($query) {
            $query->where('collection_name', 'images');
        }]);

        $categories = Category::select('id', 'name')->get();

        $sales_contract = SalesContract::with(['owner', 'buyer'])->get();

        $rents_contract = RentsContract::with(['tenant', 'landlord'])->get();

        $downloads = $property->getMedia('downloads');

        $favorites = Auth::check() ? Favorites::where('user_id', Auth::user()->id)->pluck('property_id') : collect();

        return Inertia::render('Admin/DetailsProperties', [
            'property' => $property,
            'categories' => $categories,
            'downloads' => $downloads,
            'sales_contract' => $sales_contract,
            'rents_contract' => $rents_contract,
            'favorites' => $favorites
        ]);
    }

    public function downloadDocuments(Property $property)
    {
        $downloads = $property->getMedia('documents');


        if ($downloads->isEmpty()) {
            abort(404, 'Nenhum documento encontrado para este imóvel.');
        }

        return MediaStream::create("property-{$property->id}-documents.zip")->addMedia($downloads);
    }


    public function update(Request $request, Property $property)
    {
        $request->validate([
            'status' => 'required|string',
            'reason_for_refusal' => 'nullable|string',
        ]);

        $property->update([
            'status' => $request->status,
            'reason_for_refusal' => $request->reason_for_refusal,
        ]);

        $property->save();

        return redirect()->route('admin.properties');
    }
}
