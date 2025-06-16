<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Updated Confirmation</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ title }}', '{{ recruiterName }}'],
            [$jobPost->title, $recruiterName],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
