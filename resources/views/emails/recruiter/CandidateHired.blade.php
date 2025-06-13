<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Job Hired</title>
</head>

<body>
    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ title }}'],
            [$candidate->name, $candidate->lname, $AppliedJob->title],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>

</html>