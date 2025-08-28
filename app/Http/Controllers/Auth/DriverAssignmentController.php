<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DriverAssignment;
use App\Notifications\AssignmentAcceptedNotification;

class DriverAssignmentController extends Controller
{
    // List driver assignments for service requests of logged in customer
    public function index()
    {
        $assignments = DriverAssignment::whereHas('serviceRequest', function($query) {
            $query->where('customer_id', auth('customer')->user()->id);
        })->get();

        return response()->json($assignments);
    }

    // Show form to request driver (optional)
    public function create()
    {
        // Get all service requests for the logged-in customer
        $serviceRequests = \App\Models\ServiceRequest::where('customer_id', auth('customer')->user()->id)->get();
        return view('driver_assignments.create', compact('serviceRequests'));
    }

    // Store driver assignments for all drivers
    public function store(Request $request)
    {
        $serviceRequestId = $request->input('service_request_id');
        $drivers = \App\Models\Driver::where('role', 'driver')->get();

        foreach ($drivers as $driver) {
            \App\Models\DriverAssignment::create([
                'service_request_id' => $serviceRequestId,
                'driver_id' => $driver->id,
                'assignment_status' => 'pending',
            ]);
            $driver->notify(new \App\Notifications\AssignmentAcceptedNotification([
                'message' => 'A new service request is available for you to accept.',
                'driver_id' => $driver->id,
                'service_request_id' => $serviceRequestId,
            ]));
        }

        return redirect()->route('customer.dashboard')->with('status', 'Request sent to all drivers!');
    }

    // Driver accepts assignment
    public function accept($assignmentId)
    {
        $assignment = \App\Models\DriverAssignment::findOrFail($assignmentId);
        $assignment->assignment_status = 'accepted';
        $assignment->save();

        // Notify customer and all drivers
        $this->notifyAssignmentAccepted($assignment);

        return redirect()->back()->with('status', 'You have accepted the request.');
    }

    // Driver declines assignment
    public function decline($assignmentId)
    {
        $assignment = \App\Models\DriverAssignment::findOrFail($assignmentId);
        $assignment->assignment_status = 'declined';
        $assignment->save();

        return redirect()->back()->with('status', 'You have declined the request.');
    }

    // Notify customer and drivers when assignment is accepted
    protected function notifyAssignmentAccepted($assignment)
    {
        $customer = $assignment->serviceRequest->customer;
        $drivers = \App\Models\Driver::where('role', 'driver')->get();

        $notificationData = [
            'message' => 'Driver ' . $assignment->driver->name . ' accepted request #' . $assignment->service_request_id,
            'driver_id' => $assignment->driver_id,
            'service_request_id' => $assignment->service_request_id,
        ];

        $customer->notify(new \App\Notifications\AssignmentAcceptedNotification($notificationData));
        foreach ($drivers as $driver) {
            $driver->notify(new \App\Notifications\AssignmentAcceptedNotification($notificationData));
        }
    }
}
