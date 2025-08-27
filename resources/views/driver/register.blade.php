<!DOCTYPE html>
<html>
<head>
    <title>Driver Registration</title>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            color: #333;
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #222;
        }
        form {
            background: white;
            max-width: 400px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            margin-top: 20px;
            background-color: #28a745;
            border: none;
            color: white;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .errors {
            max-width: 400px;
            margin: 10px auto;
            background-color: #ffe6e6;
            border: 1px solid #ff5c5c;
            color: #b30000;
            padding: 10px;
            border-radius: 6px;
        }
        .errors ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <h2>Driver Registration</h2>

    <form method="POST" action="{{ route('driver.register') }}">
        @csrf

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit">Register</button>
    </form>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
