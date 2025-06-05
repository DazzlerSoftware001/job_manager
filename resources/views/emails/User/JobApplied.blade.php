<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Application</title>
</head>
<body>
    <h2>Hello {{ $Recruiter->name . ' ' . $Recruiter->lname }}</h2>

    <p><strong>{{ $user->name . ' ' . $user->lname }}</strong> Applied to your job </p>

    <p>Thanks for choosing our platform!</p>
    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
</body>
</html>

