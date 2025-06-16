<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Status Change</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ title }}', '{{ status }}', '{{ recruiterName }}'],
            [$JobPost->title, $JobPost->status == 1 ? 'Activated and made live' : 'Inactivated', $recruiterName],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
