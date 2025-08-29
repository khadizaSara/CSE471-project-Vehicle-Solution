<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Driver;

class ReviewController extends Controller
{
    /**
     * Store a review after service completion.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_request_id' => 'required|integer|exists:service_requests,id',
            'driver_id' => 'integer|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ]);

    // Use user_id from customers table if available, otherwise fallback to Auth::id()
    $data['customer_id'] = Auth::user()->user_id ?? Auth::id();

        Review::create($data);

        return redirect()->route('customer.dashboard')->with('status', 'Review submitted successfully!');
    }

    /**
     * List reviews from logged in customer.
     */
    public function index()
    {
        $drivers = Driver::all();
        $serviceRequests = \App\Models\ServiceRequest::where('customer_id', Auth::id())->get();
        return view('customer.review', compact('drivers', 'serviceRequests'));
    }
}
