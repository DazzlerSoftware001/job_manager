<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Created</title>
</head>

<body>
    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ status }}'],
            [$Recruiter->name, $Recruiter->lname, $Recruiter->status == 1 ? 'Activated' : 'Inactivated'],
            $body,
        );
    @endphp

    {!! $parsedBody !!}

</body>

</html>
