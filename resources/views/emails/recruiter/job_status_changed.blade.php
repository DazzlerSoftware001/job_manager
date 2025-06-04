<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Status Change</title>
</head>
<body>
    <h2>Hello {{ $recruiterName}},</h2>

    <p>Your job titled <strong>{{ $jobPost->title }}</strong> has been {{ $jobPost->status == 1 ? 'Activated and made live' : 'Inactived' }}.</p>

    <p>Thanks for choosing our platform!</p>
    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
</body>
</html>
