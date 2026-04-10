<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Server Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #222;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .box {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
            max-width: 500px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #111827;
            color: #fff;
            padding: 12px 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>500</h1>
        <h2>Server Error</h2>
        <p>Something went wrong on our side. Please try again later.</p>
        <a href="{{ url('/') }}">Go Home</a>
    </div>
</body>
</html>