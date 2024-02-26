<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::with('city')->get();
        return AddressResource::collection($addresses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $address = Address::create($request->all());
        return AddressResource::make($address);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = Address::with('city')->findOrFail($id);
        return AddressResource::make($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->all());
        return AddressResource::make($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json(null, 204);
    }
}
