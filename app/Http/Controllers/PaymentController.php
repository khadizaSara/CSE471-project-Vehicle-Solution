<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    // Store a payment record
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_request_id' => 'required|integer|exists:service_requests,id',
            'payment_method' => 'required|in:credit_card,debit_card,wallet,cash',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,completed,failed',
            'invoice_path' => 'nullable|string',
        ]);

        $data['customer_id'] = auth()->id();

        $payment = Payment::create($data);

        return response()->json($payment, 201);
    }

    // List payments for logged in customer
    public function index()
    {
        $payments = Payment::where('customer_id', auth()->id())->get();
        return response()->json($payments);
    }
}
