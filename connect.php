<?php

include_once 'UserRepository.php';
include_once 'Controller.php';

$connector = new DataBaseConnection();
$connector->connect();
$userRepository = new UserRepository($connector);
$controller = new Controller($userRepository);

$error = '';

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $result = $controller->signUp();
    $error = $result['message'];
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        header('Content-Type: application/json');
        $res = ['error' => ['message' => $error]];
        http_response_code($result['status']);
        die(json_encode($res));
    }

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <p><?= $error ?></p>
    <form class="my-5" method="post" action="connect.php">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" name="name" autocomplete="off">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" autocomplete="off">
        </div>
        <div class="mb-3">
            <label>Mobile</label>
            <input type="number" class="form-control" name="mobile" autocomplete="off">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" class="form-control" name="password" autocomplete="off">
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Зарегестрироваться</button>
        <button type="submit" class="btn btn-primary" name="submit"><a href="singIn.php"
                                                                       style="color:white;text-decoration: none">Войти</a>
        </button>
    </form>
</div>

</body>
</html>