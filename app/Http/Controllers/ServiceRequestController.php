<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    // Show the form to create a new service request
    public function create()
    {
        return view('service_requests.create');
    }

    // Store the new service request
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_type' => 'required|in:center,place',
            'instructions' => 'nullable|string|max:1000',
        ]);

        $data['customer_id'] = auth()->id();
        $data['status'] = 'pending';
        $data['duration_minutes'] = 30;

        // Create the service request and get the instance
        $serviceRequest = ServiceRequest::create($data);

        // Redirect to the wait time page for the created request
        return redirect()->route('service_requests.wait_time', $serviceRequest->id)
                         ->with('success', 'Service request submitted successfully. Estimated wait time shown.');
    }

    // Show estimated wait time and countdown screen
    public function showWaitTime($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        // Calculate estimated wait time in seconds
        $waitInSeconds = $serviceRequest->duration_minutes * 60;

        return view('service_requests.wait_time', [
            'serviceRequest' => $serviceRequest,
            'waitInSeconds' => $waitInSeconds,
        ]);
    }

    // Other methods...
}
