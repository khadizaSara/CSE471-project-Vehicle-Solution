<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Driver Review</title>
    
 <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #374151;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #111827;
        }
        select, textarea, input[type="radio"] {
            font-size: 15px;
        }
        select, textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            outline: none;
            transition: border 0.3s ease;
        }
        select:focus, textarea:focus {
            border-color: #2563eb;
        }
        textarea {
            resize: none;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .btn.primary {
            background: #2563eb;
            color: #fff;
        }
        .btn.primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-start;
            gap: 5px;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 28px;
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #fbbf24;
        }
        /* Error message */
        .error-box {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Post a Review for Your Driver</h2>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="service_request_id">Service Request</label>
                <select name="service_request_id" id="service_request_id" required>
                    @foreach($serviceRequests as $request)
                        <option value="{{ $request->id }}">Request #{{ $request->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="driver_id">Driver</label>
                <select name="driver_id" id="driver_id" required>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">Driver #{{ $driver->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Rating</label>
                <div class="star-rating">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                        <label for="star{{ $i }}">&#9733;</label>
                    @endfor
                </div>
            </div>
            <div class="form-group">
                <label for="review_text">Your Review</label>
                <textarea name="review_text" id="review_text" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn primary">Submit Review</button>
        </form>
    </div>
</body>
</html>