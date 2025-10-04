<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            font-size: 3rem;
            color: #dc3545;
            margin-bottom: 0.5rem;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        a {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.2s;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>🚫 403</h1>
        <p>Access to this page is forbidden.</p>
        <a href="{{ url('/') }}">Back to Home</a>
    </div>
</body>
</html>
