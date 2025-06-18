<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\RentsContract;
use App\Models\SalesContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Property $property)
    {

        $monthlyListings = $property
            ->selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy($property->raw('EXTRACT(MONTH FROM created_at)'))
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                $monthNumber = (int) $item->month;
                $monthName = Carbon::create()->month($monthNumber)->format('F');
                return [$monthName => $item->total];
            });

        $statusListings = $property
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->status => $item->total];
            });

        $categoryListings = $property
            ->selectRaw('category_id, COUNT(*) as total')
            ->groupBy('category_id')
            ->get()
            ->mapWithKeys(function ($item) {
                $category = Category::findOrFail($item->category_id);
                return [$category->name => $item->total];
            });

        $revenueOverTime = $property
            ->whereYear('created_at', now()->year)
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('F');
            })
            ->mapWithKeys(function ($items, $monthName) {
                $total = 0;
                foreach ($items as $item) {
                    if ($item->transaction_id == 1) {
                        $total += SalesContract::where('property_id', $item->id)->first()?->total_revenue ?? 0;
                    } else {
                        $total += RentsContract::where('property_id', $item->id)->first()?->total_revenue ?? 0;
                    }
                }

                return [$monthName => $total];
            });

        //dd($revenueOverTime);

        return Inertia::render('Admin/Charts', [
            'monthlyListings' => $monthlyListings,
            'statusListings' => $statusListings,
            'categoryListings' => $categoryListings,
            'revenueOverTime' => $revenueOverTime,
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
