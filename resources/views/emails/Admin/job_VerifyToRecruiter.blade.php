<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Job Post</title>
</head>
<body>
    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ title }}', '{{ admin_verify }}'],
            [$recuiter->name, $recuiter->lname, $JobPost->title, $JobPost->admin_verify == 1 ? 'Verified' : 'Rejected'],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
