<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
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
        $sender = Auth::user();

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:255'],
            'receiver_id' => ['required', 'exists:users,id'],
        ]);

        Message::create([
            'property_id' => $property->id,
            'sender_id' => $sender->id,
            'receiver_id' => $validated['receiver_id'],
            'body' => $validated['body'],
        ]);

        return redirect()->back();
    }



    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $user = Auth::user();

        $messages = Message::with(['sender', 'receiver', 'property'])
            ->where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();


        return Inertia::render('Properties/Messages', [
            'messages' => $messages,
            'property' => $property
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
