<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            margin: 0;
            color: #333;
        }
        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2f89fc;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        strong {
            color: #555;
        }
        .reservation-details {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>New Reservation</h1>
    <div class="reservation-details">
        <p><strong>Name:</strong> {{ $reservation->name }}</p>
        <p><strong>Email:</strong> {{ $reservation->email }}</p>
        <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
        <p><strong>Service:</strong> {{ $reservation->service->name }}</p>
        <p><strong>Date:</strong> {{ $reservation->date }}</p>
        <p><strong>Time:</strong> {{ $reservation->time }}</p>
    </div>
</div>
</body>
</html>
