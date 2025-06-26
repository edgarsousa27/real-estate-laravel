<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\RentsContract;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Spatie\Browsershot\Browsershot;

class RentController extends Controller
{
    public function index(Property $property)
    {
        $property->load('user');

        $tenants = User::where('id', '!=', $property->user_id)->where('name', '!=', 'Admin')->get();

        return Inertia::render('Admin/PropertyRegisterRentForm', [
            'property' => $property,
            'tenants' => $tenants,
            'landlord' => $property->user
        ]);
    }

    public function store(Request $request, Property $property)
    {
        $request->validate([
            'tenant_id' => 'required',
            'property_id' => 'required',
            'landlord_id' => 'required',
            'price' => 'required|numeric',
            'payment_method' => 'required|string',
            'start_contract' => 'required|date',
            'end_contract' => 'required|date',
            'status' => 'required|string',
            'commission' => 'required|numeric|max:100'
        ]);

        $start_contract = Carbon::parse($request->start_contract);
        $end_contract = Carbon::parse($request->end_contract);
        $months = $start_contract->diffInMonths($end_contract);

        $totalPriceContract = $request->price * $months;
        $totalContractTaxes = $totalPriceContract * $request->commission / 100;
        $totalLandlordRevenue = $totalPriceContract - $totalContractTaxes;
        $totalRevenuePerMonth = $totalContractTaxes / $months;

        $contract = RentsContract::create([
            'tenant_id' => $request->tenant_id,
            'property_id' => $request->property_id,
            'landlord_id' => $request->landlord_id,
            'price' => $request->price,
            'payment_method' => $request->payment_method,
            'start_contract' => $start_contract,
            'end_contract' => $end_contract,
            'months_contract' => $months,
            'total_price_contract' => $totalPriceContract,
            'total_landlord_revenue' => $totalLandlordRevenue,
            'total_revenue' => $totalContractTaxes,
            'total_revenue_per_month' => $totalRevenuePerMonth,
            'commission' => $request->commission
        ]);

        $property->update([
            'status' => $request->status,
            'final_price' => $request->price
        ]);

        if ($request->status === 'rented') {
            if ($request->tenant_id) {
                $property->user_id = $request->tenant_id;
            }
        }

        $property->save();
        $contract->load(['property', 'tenant', 'landlord']);

        if ($contract) {
            $html = view('contracts.rent', ['rental_contract' => $contract])->render();

            $pdf = Browsershot::html($html)
                ->format('A4')
                ->pdf();

            $property->addMediaFromString($pdf)
                ->usingFileName("property-rent-{$contract->id}-contract.pdf")
                ->toMediaCollection('documents');

            return redirect()->route('admin.properties', $property->slug);
        }

        return Inertia::location(route('admin.properties', $property->slug));
    }
}
