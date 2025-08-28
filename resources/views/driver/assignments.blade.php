<!DOCTYPE html>
<html>
<head>
    <title>Driver Assignments</title>
</head>
<body>
    <h2>Pending Service Requests</h2>
    @foreach($assignments as $assignment)
        <div>
            <p>Request #{{ $assignment->service_request_id }}</p>
            <form action="{{ route('driver-assignments.accept', $assignment->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Accept</button>
            </form>
            <form action="{{ route('driver-assignments.decline', $assignment->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Decline</button>
            </form>
        </div>
    @endforeach
</body>
</html>