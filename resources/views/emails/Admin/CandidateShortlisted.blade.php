<!DOCTYPE html>
<html>
<head>
    <title>Shortlisted Notification</title>
</head>
<body>
    <h2>Hello {{ $user->name.' '.$user->lname }},</h2>

    <p>Congratulations! You have been <strong>shortlisted</strong> for the job:</p>

    <h3>{{ $job->title }}</h3>
    <p><strong>Company:</strong> {{ $job->com_name }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>

    <p>Our team will contact you soon with further details.</p>

    <br>
    <p>Best regards,</p>
    <p>CareerNext Team</p>
</body>
</html>
