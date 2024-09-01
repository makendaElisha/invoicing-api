<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BusinessSettingController extends Controller
{
    public function index()
    {
        return BusinessSetting::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'branding_id' => 'nullable|exists:branding,id',
            'business_name' => 'required|string',
            'description' => 'nullable|string',
            'industry' => 'nullable|string',
            'contact_person_name' => 'nullable|string',
            'contact_person_role' => 'nullable|string',
            'reference_prefix' => 'nullable|string',
            'company_registration' => 'nullable|string',
            'rendering_service' => 'nullable|string',
            'vat_number' => 'nullable|string',
            'cell_number' => 'nullable|string',
            'telephone_number' => 'nullable|string',
            'email' => 'nullable|email',
            'website_url' => 'nullable|url',
            'notes' => 'nullable|string',
            'banking_details_id' => 'nullable|exists:banking_details,id',
            'custom_fields' => 'nullable|array',
        ]);

        $businessSetting = BusinessSetting::create($validatedData);

        return response()->json($businessSetting, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $businessSetting = BusinessSetting::findOrFail($id);
        return response()->json($businessSetting);
    }

    public function update(Request $request, $id)
    {
        $businessSetting = BusinessSetting::findOrFail($id);

        $validatedData = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'branding_id' => 'nullable|exists:branding,id',
            'business_name' => 'required|string',
            'description' => 'nullable|string',
            'industry' => 'nullable|string',
            'contact_person_name' => 'nullable|string',
            'contact_person_role' => 'nullable|string',
            'reference_prefix' => 'nullable|string',
            'company_registration' => 'nullable|string',
            'rendering_service' => 'nullable|string',
            'vat_number' => 'nullable|string',
            'cell_number' => 'nullable|string',
            'telephone_number' => 'nullable|string',
            'email' => 'nullable|email',
            'website_url' => 'nullable|url',
            'notes' => 'nullable|string',
            'banking_details_id' => 'nullable|exists:banking_details,id',
            'custom_fields' => 'nullable|array',
        ]);

        $businessSetting->update($validatedData);

        return response()->json($businessSetting);
    }

    public function destroy($id)
    {
        $businessSetting = BusinessSetting::findOrFail($id);
        $businessSetting->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
