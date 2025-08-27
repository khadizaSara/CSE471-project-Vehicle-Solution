<!DOCTYPE html>
<html>
<head>
    <title>Place Service Request</title>
</head>
<body>
    <h2>Place a Service Request</h2>
    @auth('customer')
    <h2>Place a Service Request</h2>
    <p>Welcome, {{ auth()->guard('customer')->user()->name }}</p>

    <form method="POST" action="{{ route('service_requests.store') }}">
        @csrf

        <label>Service Type:</label><br>
        <input type="text" name="service_type" value="{{ old('service_type') }}" required><br><br>

        <label>Duration (minutes):</label><br>
        <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" required><br><br>

        <label>Servicing Instructions / Notes (optional):</label><br>
        <textarea name="instructions" rows="4" cols="50">{{ old('instructions') }}</textarea><br><br>

        <button type="submit">Submit Request</button>
    </form>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@else
    <p>You must <a href="{{ route('customer.login.form') }}">log in</a> as a customer to place a service request.</p>
@endauth

</body>
</html>
