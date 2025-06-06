<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Job Post</title>
</head>
<body>
   <h2>Hello {{ $recuiter->name.' '.$recuiter->lname}},</h2>

    <p>New job titled <strong>{{ $JobPost->title }}</strong> has been successfully posted by <strong>Admin</strong></p>

   <p>It is currently under review by our admin team. You will be notified once it goes live.</p>

    <br>
    <p>Thanks,</p>

    <p><strong>Your Job Portal</strong></p>
</body>
</html>
