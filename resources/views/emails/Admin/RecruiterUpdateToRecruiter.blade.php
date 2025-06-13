<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Updated</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}'],
            [$Recruiter->name, $Recruiter->lname],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>