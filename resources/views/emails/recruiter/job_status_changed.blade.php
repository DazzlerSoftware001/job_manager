<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Status Change</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ recruiterName }}', '{{ title }}', '{{ status }}'],
            [$recruiterName, $jobPost->title, $jobPost->status == 1 ? 'Activated and made live' : 'Inactivated'],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
