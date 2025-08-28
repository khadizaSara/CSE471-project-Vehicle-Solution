
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Driver</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px #e0e0e0;
            padding: 32px 24px;
        }
        h2 {
            margin-bottom: 24px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Request a Driver</h2>
        <form action="{{ route('driver-assignments.store') }}" method="POST">
            @csrf
            <div>
                <label for="service_request_id">Service Request</label>
                <select name="service_request_id" id="service_request_id" >
                    @foreach($serviceRequests as $request)
                        <option value="{{ $request->id }}">Request #{{ $request->id }} - {{ $request->description ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Send Request to All Drivers</button>
        </form>
    </div>
</body>
</html>
