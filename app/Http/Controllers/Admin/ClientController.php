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
}
