<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceItemRequest;
use App\Http\Resources\InvoiceItemResource;
use App\Models\InvoiceItem;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceItemController extends Controller
{
    public function index()
    {
        return InvoiceItem::all();
    }

    public function store(StoreInvoiceItemRequest $request)
    {
        try {
            $validated = $request->validated();
            $invoiceItem = InvoiceItem::create($validated);
            return (new InvoiceItemResource($invoiceItem))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create invoice item. Please check your data.',
                'error' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show($id)
    {
        $invoice = InvoiceItem::findOrFail($id);
        return new InvoiceItemResource($invoice);
    }

    public function update(Request $request, $id)
    {
        $invoiceItem = InvoiceItem::findOrFail($id);

        $validatedData = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'date' => 'required|date',
            'item_name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric',
            'total_price' => 'required|numeric',
        ]);

        $invoiceItem->update($validatedData);

        return response()->json($invoiceItem);
    }

    public function destroy($id)
    {
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
