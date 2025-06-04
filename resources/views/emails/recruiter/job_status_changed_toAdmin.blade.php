<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Status Change</title>
</head>
<body>

    <p>Job titled <strong>{{ $JobPost->title }}</strong> has been {{ $JobPost->status == 1 ? 'Activated and made live' : 'Inactived' }} by <strong>{{$recruiterName}} </strong>.</p>
   
    <p>Please review the job in the admin panel.</p>

    <br>
    <p>Thanks,</p>

    <p><strong>Your Job Portal</strong></p>
</body>
</html>
