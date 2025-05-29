<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>We'll Be Back Soon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .maintenance-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            backdrop-filter: blur(10px);
        }

        .maintenance-box h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .maintenance-box p {
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .maintenance-box img {
            width: 150px;
            margin-bottom: 20px;
        }

        .logo {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="maintenance-box">
        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/565/565547.png" alt="Under Maintenance" />
        </div>
        @if ($maintenance !== null && $maintenance->title)
          <h1>{{$maintenance->title}}</h1>
        @else
          <h1>We're Under Maintenance</h1>
        @endif
        <p>Sorry for the inconvenience. We're performing some maintenance at the moment.<br>
            We'll be back online shortly!</p>
        <p class="mt-4">Thank you for your patience. 😊</p>
    </div>
</body>

</html>
