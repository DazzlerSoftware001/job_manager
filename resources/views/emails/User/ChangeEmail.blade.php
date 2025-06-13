<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ otp }}'],
            [$otp],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
