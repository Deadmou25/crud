<?php
/**
 * @var PDO $pdo
 */

require('UserRepository.php');


try {
    if (($_SERVER['REQUEST_METHOD']=='POST')) {
        $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $mobile = filter_input(INPUT_POST,'mobile',FILTER_SANITIZE_NUMBER_INT);
        $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
        $connector = new DataBaseConnection();
        $connector->connect();
        $userRepository = new UserRepository($connector);
        $userRepository->signUp($name,$email,$mobile,$password);

    }
} catch (PDOException $e) {
    die($e->getMessage());
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

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

</body>
</html>