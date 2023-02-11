<?php
session_start();

$page = explode('/', $_SERVER['REQUEST_URI']);
$url = end($page);
// die($url);
if ($url == "login.php" || $url == "register.php") {
    $redirect_to_login = "login.php";
    $redirect_to = "../Controllers/validateController.php";
} else {
    $redirect_to = "Controllers/validateController.php";
    $redirect_to_login = "../Views/login.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .gradient-custom-3 {
            background: #84fab0;
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
            background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
        }

        .gradient-custom-4 {
            background: #84fab0;
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
            background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
        }
    </style>
</head>

<body>
    <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                <form action="<?= $redirect_to ?>" method="post">
                                    <!-- display error -->
                                    <?php if (isset($_SESSION['errors'])) {
                                        foreach ($_SESSION['errors'] as $error) {
                                    ?>
                                            <div class="alert alert-danger" role="alert">
                                                <p><?= $_SESSION['errors'][0] ?></p>
                                            </div>
                                    <?php }
                                    }
                                    unset($_SESSION["errors"]) ?>
                                    <!-- end display error -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                        <input type="text" id="form3Example3cg" class="form-control form-control-lg" name="email" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password" />
                                    </div>
                                    <div class="form-outline mb-4">
                                    <input type="hidden" name="validationType" value="login">
                                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                        <input type="password" id="form3Example4cdg" class="form-control form-control-lg" / name="confirm_password">
                                    </div>
                                    <!--  -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Expiration Date</label>
                                        <input type="month" id="form3Example4cdg" class="form-control form-control-lg" / name="date_expiration">
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cge">Cridit Card Number</label>
                                        <input type="password" id="form3Example4cge" class="form-control form-control-lg" name="credit_card" />
                                    </div>
                                    <!--  -->
                                    <div class="d-flex justify-content-center">
                                        <input type="hidden" name="validationType" value="register">
                                        <input type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Register" />
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Have already an account?
                                        <a href="<?= $redirect_to_login ?>" class="fw-bold text-body"><u>Login here</u></a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>