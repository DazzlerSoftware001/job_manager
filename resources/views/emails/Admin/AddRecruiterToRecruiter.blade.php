<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Created</title>
</head>
<body>
    <h2>Hello {{ $Recruiter->name.' '.$Recruiter->lname}},</h2>

    <p>Your profile has been {{ $Recruiter->status == 1 ? 'Activated' : 'Inactived' }}. by <strong>Admin</strong></p>
    <p>Thanks for choosing our platform!</p>
    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
</body>
</html>