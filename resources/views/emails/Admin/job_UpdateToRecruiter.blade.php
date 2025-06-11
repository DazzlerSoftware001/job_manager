<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Updated Confirmation</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ title }}'],
            [$recruiter->name, $recruiter->lname, $JobPost->title],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
