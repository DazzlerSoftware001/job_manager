<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Job Post</title>
</head>

<body>
    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ title }}'],
            [$recuiter->name ?? '', $recuiter->lname ?? '', $JobPost->title ?? ''],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>

</html>
