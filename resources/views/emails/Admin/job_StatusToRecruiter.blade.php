<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Status Change</title>
</head>
<body>
    <h2>Hello {{ $recruiter->name.' '.$recruiter->lname}},</h2>

    <p>Your job titled <strong>{{ $JobPost->title }}</strong> has been {{ $JobPost->status == 1 ? 'Activated and made live' : 'Inactived' }}. by <strong>Admin</strong></p>

    <p>Thanks for choosing our platform!</p>
    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
</body>
</html>
