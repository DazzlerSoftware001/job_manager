<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Posted Confirmation</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ recruiterName }}', '{{ title }}'],
            [$recruiterName, $jobPost->title],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
