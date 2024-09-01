<?php

namespace App\Http\Controllers;

use App\Models\BankingDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BankingDetailsController extends Controller
{
    public function index()
    {
        return BankingDetails::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bank_name' => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|string',
            'branch_code' => 'required|string',
            'currency' => 'required|string',
        ]);

        $bankingDetails = BankingDetails::create($validatedData);

        return response()->json($bankingDetails, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $bankingDetails = BankingDetails::findOrFail($id);
        return response()->json($bankingDetails);
    }

    public function update(Request $request, $id)
    {
        $bankingDetails = BankingDetails::findOrFail($id);

        $validatedData = $request->validate([
            'bank_name' => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|string',
            'branch_code' => 'required|string',
            'currency' => 'required|string',
        ]);

        $bankingDetails->update($validatedData);

        return response()->json($bankingDetails);
    }

    public function destroy($id)
    {
        $bankingDetails = BankingDetails::findOrFail($id);
        $bankingDetails->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
