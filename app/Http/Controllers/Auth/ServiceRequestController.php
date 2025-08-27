<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    // List service requests for logged in customer
    public function index()
    {
        $requests = ServiceRequest::where('customer_id', auth()->id())->get();
        return response()->json($requests);
    }

    // Place a new service request with optional instructions
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_type' => 'required|string',
            'duration_minutes' => 'required|integer',
            'instructions' => 'nullable|string',  // allow instructions here
        ]);

        $data['customer_id'] = auth()->id();
        $data['status'] = 'pending';

        $serviceRequest = ServiceRequest::create($data);

        return view('service_requests.create');    }

    // Cancel request with reason
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        $serviceRequest = ServiceRequest::where('id', $id)
            ->where('customer_id', auth()->id())
            ->firstOrFail();

        if (!in_array($serviceRequest->status, ['pending', 'accepted'])) {
            return response()->json(['message' => 'Cannot cancel this request'], 400);
        }

        $serviceRequest->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        return response()->json(['message' => 'Service request cancelled.']);
    }
}
