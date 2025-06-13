<!DOCTYPE html>
<html>
<head>
    <title>You're Hired!</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ title }}', '{{ com_name }}'],
            [$user->name, $user->lname, $job->title, $job->com_name],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
