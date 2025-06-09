<!DOCTYPE html>
<html>
<head>
    <title>You're Hired!</title>
</head>
<body>
    <h2>Dear {{ $user->name.' '.$user->lname }},</h2>

    <p>We are excited to inform you that you have been <strong>hired</strong> for the position of <strong>{{ $job->title }}</strong> at <strong>{{ $job->com_name }}</strong>.</p>

    <p>Welcome aboard! Our HR team will contact you shortly with onboarding instructions and next steps.</p>

    <br>
    <p>We look forward to working with you.</p>
    <p>Best regards,</p>
    <p>The CareerNext Team</p>
</body>
</html>
