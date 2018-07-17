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
    <h2>Welcome to my application!</h2>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <li> <?php echo $error ?> </li>
            <?php endforeach;?>
        </div>
    <?php endif; ?>


    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger">
            <strong>Danger!</strong> <?php echo $errorMessage ?>
        </div>
    <?php endif; ?>

    <form method="post" action="/login/login">
        <div class="form-group">
            <label for="email">Username:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter username" name="username"
                value=<?php echo !empty($oldRequest['username']) ? $oldRequest['username'] : '' ?>>

            <?php if (!empty($errors['username'])): ?>
                <div class="alert alert-danger">
                    <?php echo $errors['username'] ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">

            <?php if (!empty($errors['password'])): ?>
                <div class="alert alert-danger">
                    <?php echo $errors['password'] ?>
                </div>
            <?php endif; ?>

        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary"> Login </button>
        <br> <br>
        <p> I don't have an account <a href="/login/register"> Register </a> </p>
    </form>
</div>

</body>
</html>
