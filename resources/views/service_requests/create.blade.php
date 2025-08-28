<!DOCTYPE html>
<html>
<head>
    <title>Place Service Request</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>
<body>
    <h2>Place a Service Request</h2>
    @auth('customer')
    <p>Welcome, {{ auth()->guard('customer')->user()->name }}</p>

    <form method="POST" action="{{ route('service_requests.store') }}">
        @csrf

        <label for="service_type">Servicing Type:</label><br>
        <select name="service_type" id="service_type" required>
            <option value="">-- Select --</option>
            <option value="center" {{ old('service_type') == 'center' ? 'selected' : '' }}>At Servicing Center</option>
            <option value="place" {{ old('service_type') == 'place' ? 'selected' : '' }}>At My Place</option>
        </select><br><br>

        <label for="instructions">Servicing Instructions / Notes (optional):</label><br>
        <textarea name="instructions" id="instructions" rows="4" cols="50">{{ old('instructions') }}</textarea><br><br>

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
