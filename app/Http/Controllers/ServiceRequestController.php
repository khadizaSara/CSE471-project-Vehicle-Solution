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

        ServiceRequest::create($data);

        return redirect()->route('customer.dashboard')->with('success', 'Service request submitted successfully.');
    }
    
    // Other methods...
}
