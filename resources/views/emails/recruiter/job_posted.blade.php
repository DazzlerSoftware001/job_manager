<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Posted Confirmation</title>
</head>
<body>
    <h2>Hello {{ $jobPost->com_name }},</h2>

    <p>Your job titled <strong>{{ $jobPost->title }}</strong> has been successfully posted.</p>

    <p>It is currently under review by our admin team. You will be notified once it goes live.</p>

    <p>Thanks for choosing our platform!</p>

    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
</body>
</html>
