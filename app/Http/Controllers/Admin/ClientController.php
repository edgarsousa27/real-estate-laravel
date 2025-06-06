<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = User::where('id', '!=', 1)->paginate(15);

        $query = $request->input('query');

        if ($query) {
            $clients = User::search($query)->paginate(15);
        }

        return Inertia::render('Admin/Clients', [
            'clients' => $clients,
            'query' => $query
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $client)
    {
        $client->load('property');

        $categories = Category::select('id', 'name')->get();

        return Inertia::render('Admin/DetailsClients', [
            'client' => $client,
            'categories' => $categories,
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
