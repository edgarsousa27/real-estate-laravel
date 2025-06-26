<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\SalesContract;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;
use Spatie\Browsershot\Browsershot;

class SaleController extends Controller
{
    public function index(Property $property)
    {
        $property->load('user');

        $buyers = User::where('id', '!=', $property->user_id)->where('name', '!=', 'Admin')->get();

        return Inertia::render('Admin/PropertyRegisterSaleForm', [
            'property' => $property,
            'buyers' => $buyers,
            'owner' => $property->user
        ]);
    }

    public function store(Request $request, Property $property)
    {
        $request->validate([
            'property_id' => 'required',
            'status' => 'required|string',
            'buyer_id' => 'required',
            'payment_method' => 'required|string',
            'final_price' => 'required|numeric',
            'commission' => 'required|numeric|max:100'
        ]);

        $finalPriceTaxes = $request->final_price * $request->commission / 100;
        $finalPriceForSeller = $request->final_price - $finalPriceTaxes;

        $contract = SalesContract::create([
            'property_id' => $request->property_id,
            'buyer_id' => $request->buyer_id,
            'owner_id' => $property->user_id,
            'payment_method' => $request->payment_method,
            'final_price' => $request->final_price,
            'offer_date' => Carbon::now(),
            'commission' => $request->commission,
            'final_price_for_seller' => $finalPriceForSeller,
            'total_revenue' => $finalPriceTaxes
        ]);

        $property->update([
            'status' => $request->status,
            'final_price' => $request->final_price
        ]);

        if ($request->status === 'sold') {
            if ($request->buyer_id) {
                $property->user_id = $request->buyer_id;
            }
        }

        $property->save();
        $contract->load(['property', 'owner', 'buyer']);

        if ($contract) {
            $html = view('contracts.sale', ['sales_contract' => $contract])->render();

            $pdf = Browsershot::html($html)
                ->format('A4')
                ->pdf();

            $property->addMediaFromString($pdf)
                ->usingFileName("property-sale-{$contract->id}-contract.pdf")
                ->toMediaCollection('documents');

            return redirect()->route('admin.properties', $property->slug);
        }

        return Inertia::location(route('admin.properties', $property->slug));
    }
}
