<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Job Post</title>
</head>
<body>
   <h2>Hello {{ $recuiter->name.' '.$recuiter->lname}},</h2>

   <p>Job titled <strong>{{ $JobPost->title }}</strong> is {{ $JobPost->admin_verify == 1 ? 'Verified' : 'Inactived' }} by <strong> Admin </strong>.</p>

   <p>It is currently under review by our admin team. You will be notified once it goes live.</p>

    <br>
    <p>Thanks,</p>

    <p><strong>Your Job Portal</strong></p>

    @php
        $parsedBody = str_replace(
            ['{{ name }}', '{{ lname }}', '{{ title }}', '{{ admin_verify }}'],
            [$recuiter->name, $recuiter->lname, $JobPost->title, $JobPost->admin_verify == 1 ? 'Verified' : 'Inactived'],
            $body,
        );
    @endphp

    {!! $parsedBody !!}
</body>
</html>
