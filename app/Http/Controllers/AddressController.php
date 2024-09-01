<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    public function index()
    {
        return Address::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address_line1' => 'required|string',
            'address_line2' => 'nullable|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'country' => 'required|string',
        ]);

        $address = Address::create($validatedData);

        return response()->json($address, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $address = Address::findOrFail($id);
        return response()->json($address);
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $validatedData = $request->validate([
            'address_line1' => 'required|string',
            'address_line2' => 'nullable|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'country' => 'required|string',
        ]);

        $address->update($validatedData);

        return response()->json($address);
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
