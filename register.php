<?php
include_once('register_if.php')
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>
    <link href="css/css_bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Please register</h1>

            <div class="account-wall">
                <form class="form-signin" action="" method="POST">
                    <input type="text" class="form-control" name="name" placeholder="Name" required><Br>
                    <input type="text" class="form-control" name="surname" placeholder="Surname" required><br>
                    <input type="password" class="form-control" name="password1" placeholder="Password" required><br>
                    <input type="password" class="form-control" name="password2" placeholder="Repeat password" required><Br>
                    <input type="text" class="form-control" name="email" placeholder="Email" required autofocus><br>
                    <input type="text" class="form-control" name="address" placeholder="Address" required><br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="register">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="src/script.js"></script>
</body>
</html>