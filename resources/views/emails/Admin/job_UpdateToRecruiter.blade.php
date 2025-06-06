<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Updated Confirmation</title>
</head>
<body>
    <h2>Hello {{ $recruiter->name.' '.$recruiter->lname }},</h2>

    <p>Your job titled <strong>{{ $JobPost->title }}</strong> has been successfully Updated by <strong>Admin</strong>

    <p>It is currently under review. You will be notified once it goes live.</p>

    <p>Thanks for choosing our platform!</p>

    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
</body>
</html>
