<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card h2 {
            font-size: 20px;
            margin: 10px 0;
        }
        .card a {
            display: block;
            margin: 15px 0;
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .card a:hover {
            background: #0056b3;
        }
        .card p {
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="card">
    <h2>{{ $product['title'] }}</h2>
    <a href="{{ $product['url'] }}" target="_blank">Mở link</a>
    <p>{{ parse_url($product['url'], PHP_URL_HOST) }}</p>
</div>
</body>
</html>
