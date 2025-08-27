<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // Store a review after service completion
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_request_id' => 'required|integer|exists:service_requests,id',
            'driver_id' => 'nullable|integer|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ]);

        $data['customer_id'] = auth()->id();

        $review = Review::create($data);

        return response()->json($review, 201);
    }

    // List reviews from logged in customer
    public function index()
    {
        $reviews = Review::where('customer_id', auth()->id())->get();
        return response()->json($reviews);
    }
}
