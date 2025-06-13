<!DOCTYPE html>
<html>
<head>
    <title>Shortlisted Notification</title>
</head>
<body>
   @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ title }}', '{{ com_name }}', '{{ location }}'],
            [$user->name, $user->lname, $job->title, $job->com_name, $job->location],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
