<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Shortlisted</title>
</head>
<body>
    <h2>Hello {{ $candidate->name . ' ' . $candidate->lname }}, Congratulations,</h2>

    <p>You are shortlisted for the job <strong>{{ $AppliedJob->title }}</strong>.</p>

    <p>Thanks for choosing our platform!</p>
    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
</body>
</html>

