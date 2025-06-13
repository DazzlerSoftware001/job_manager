<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Job Application</title>
</head>

<body>
    @php
        $parsedBody = str_replace(
            ['{{ recruiter_name }}', '{{ recruiter_lname }}', '{{ user_name }}', '{{ user_lname }}'],
            [$Recruiter->name, $Recruiter->lname, $user->name, $user->lname],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>

</html>
