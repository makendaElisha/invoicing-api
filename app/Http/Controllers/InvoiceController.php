<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();

        return response()->json([
            'status' => 'success',
            'data' => InvoiceResource::collection($invoices),
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        try {
            $validated = $request->validated();
            $invoiceNumber = $this->generateInvoiceNumber($request->invoiced_on);
            $invoice = Invoice::create([...$validated, 'invoice_number' => $invoiceNumber]);

            return (new InvoiceResource($invoice))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
        } catch (QueryException $e ) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create invoice. Please try again.',
                'error' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            return (new InvoiceResource($invoice))
                    ->response()
                    ->setStatusCode(Response::HTTP_OK);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invoice not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function update(UpdateInvoiceRequest $request, $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invoice not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $invoice->update($request->validated());
            return new InvoiceResource($invoice);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the invoice.',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_MODIFIED);
        }
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            $invoice->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Invoice deleted successfully.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invoice not found.'
        ], Response::HTTP_NOT_FOUND);
    }
}
