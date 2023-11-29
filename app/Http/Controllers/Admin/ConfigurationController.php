<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reference;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];

        $data['end_keyword'] = Reference::where('code', 'end')->get()->first()->value;
        $data['rate_keyword'] = Reference::where('code', 'rate')->get()->first()->value;
        $data['list_category'] = Reference::where('code', 'category')->get();
        $data['list_rating'] = Reference::where('code', 'rating')->get();
        $data['list_pic'] = Reference::where('code', 'pic')->get();
        // \Log::info($data);
        return view('admin.configuration.index', compact('data'));
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
