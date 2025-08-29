<!DOCTYPE html>
<html>
<head>
    <title>Estimated Wait Time</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
    <style>
        /* Simple styling for center text */
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
        #countdown { font-size: 48px; color: #dd3333; }
    </style>
</head>
<body>

<h1>Estimated Wait Time</h1>

<p>Service Request ID: {{ $serviceRequest->id }}</p>

<p>Estimated wait: <strong>{{ $serviceRequest->duration_minutes }} minutes</strong></p>
<a href="{{ route('service_requests.centre', $serviceRequest->id) }}">See Details In Centre</a>
<p>Countdown:</p>
<div id="countdown"></div>

<div style="margin-top: 30px;">
    <form method="POST" action="{{ route('service_requests.cancel', $serviceRequest->id) }}">
        @csrf
        <textarea name="cancellation_reason" placeholder="Reason for cancellation" required></textarea>
        @if ($errors->has('cancellation_reason'))
            <div style="color:red;">{{ $errors->first('cancellation_reason') }}</div>
        @endif
        <button type="submit" style="padding: 10px 20px; background-color: #ff4444; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Cancel Service Request
        </button>

<script>
// Initialize countdown timer
let totalSeconds = {{ $waitInSeconds }};

function updateCountdown() {
    if (totalSeconds <= 0) {
        document.getElementById('countdown').innerHTML = "Time's up!";
        clearInterval(timerInterval);
        return;
    }

    let minutes = Math.floor(totalSeconds / 60);
    let seconds = totalSeconds % 60;

    document.getElementById('countdown').innerHTML = minutes + "m " + (seconds < 10 ? "0" : "") + seconds + "s";

    totalSeconds--;
}

// Update countdown every second
updateCountdown();
let timerInterval = setInterval(updateCountdown, 1000);
</script>

</body>
</html>
