<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2> Register </h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <li> <?php echo $error ?> </li>
            <?php endforeach;?>
        </div>
    <?php endif; ?>

    <?php if (!empty(Session::get_flash('errorMessage'))): ?>
        <div class="alert alert-danger">
            <strong>Danger!</strong> <?php echo Session::get_flash('errorMessage') ?>
        </div>
    <?php endif; ?>

    <form method="post" action="/register/register">
        <?php echo \Form::csrf(); ?>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
                   value=<?php echo !empty($oldRequest['username']) ? $oldRequest['username'] : '' ?>>
        </div>
        <div class="form-group">
            <label for="pwd">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                   value=<?php echo !empty($oldRequest['email']) ? $oldRequest['email'] : '' ?>>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
        </div>
        <div class="form-group">
            <label for="pwd">Retype Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="confirmed_password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <br> <br>
        <p> I have an account! <a href="/login/login"> Login </a> </p>
    </form>
</div>

</body>
</html>