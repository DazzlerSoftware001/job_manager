<!DOCTYPE html>
<html>
<head>
    <title>Application Update</title>
</head>
<body>
    <h2>Hello {{ $user->name.' '.$user->lname }},</h2>

    <p>Thank you for applying to the job <strong>{{ $job->title }}</strong> at <strong>{{ $job->com_name }}</strong>.</p>

    <p>After careful consideration, we regret to inform you that you have not been selected for this position.</p>

    <p>We appreciate your interest and encourage you to apply for future opportunities that match your profile.</p>

    <br>
    <p>Best wishes,</p>
    <p>CareerNext Team</p>
</body>
</html>
