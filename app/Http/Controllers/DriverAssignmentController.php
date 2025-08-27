<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriverAssignment;

class DriverAssignmentController extends Controller
{
    // List driver assignments for service requests of logged in customer
    public function index()
    {
        $assignments = DriverAssignment::whereHas('serviceRequest', function($query) {
            $query->where('customer_id', auth()->id());
        })->get();

        return response()->json($assignments);
    }
}
