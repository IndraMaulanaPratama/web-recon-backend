<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3>VSI Auto Recon</h3>
        <p>You are receiving this email because we received a password reset request for your account. </p>
        <br>
        <a href="{{ $params['url'] }}"><button type="button" class="btn btn-primary">reset password</button></a>
        <a href="If you did not request a password reset, no further action is required."></a>
        <hr>
        <small>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web
            browser: </small>
        <small><a href="{{ $params['url'] }}">{{ $params['url'] }}</a></small>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
