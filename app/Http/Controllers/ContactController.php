<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Property $property)
    {
        $validator = $request->validate([
            'name' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'integer'],
            'message' => ['required', 'string']
        ]);

        $validator['property_id'] = $property->id;

        Contact::create($validator);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $contacts = Contact::whereHas('property', function ($query) {
        $query->where('user_id', Auth::id());
        })->get();

        $properties = Property::select('id', 'title')->get();

        return Inertia::render('Dashboard/Notifications', [
            'contacts' => $contacts,
            'properties' => $properties
        ]);
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
