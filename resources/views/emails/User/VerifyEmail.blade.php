<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify Your Email</title>
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
