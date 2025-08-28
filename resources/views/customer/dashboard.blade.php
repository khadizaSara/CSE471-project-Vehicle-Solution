<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            padding: 40px;
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 480px;
            margin: auto;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
        }
        h1 {
            margin-bottom: 24px;
        }
        a.servicing-request {
            display: inline-block;
            margin-top: 20px;
            font-size: 20px;
            padding: 14px 28px;
            background-color: #1d72b8;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        a.servicing-request:hover {
            background-color: #155d8b;
        }
        a.driver-request {
            display: inline-block;
            margin-top: 20px;
            font-size: 20px;
            padding: 14px 28px;
            background-color: #1d72b8;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        a.driver-request:hover {
            background-color: #155d8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, {{ auth()->guard('customer')->user()->name }}!</h1>
        <p>Manage your account and requests below.</p>
        <a href="{{ route('service_requests.create') }}" class="servicing-request">Servicing Request</a>
        <a href="{{ route('driver-assignments.create') }}" class="driver-request">Request a Driver</a>
    </div>
</body>
</html>
