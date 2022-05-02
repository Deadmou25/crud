<?php

include_once 'UserRepository.php';
include_once 'Controller.php';

$connector = new DataBaseConnection();
$connector->connect();
$userRepository = new UserRepository($connector);
$controller = new Controller($userRepository);

$error = '';

if (($_SERVER['REQUEST_METHOD'] == 'GET')) {
    $result = $controller->singIn();
    $error = $result['message'];
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        header('Content-Type: application/json');
        $res = ['error' =>['message'=>$error]];
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
    <form class="my-5" method="get" action="singIn.php">
        <div class="mb-3">
            <label>email</label>
            <input type="text" class="form-control" name="email" autocomplete="off">
        </div>
        <div class="mb-3">
            <label>password</label>
            <input type="password" class="form-control" name="password" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

</body>
</html>