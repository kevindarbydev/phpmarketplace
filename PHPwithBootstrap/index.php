<?php require_once './config/db.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Marketplace Sign-in</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link rel="stylesheet" href="css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">



    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        form button {
            margin-bottom: .5rem;
        }

        form button a {
            color: white;
            text-decoration: none;
        }

        .form-floating input {
            margin: .5rem 0;
        }

        .errorMessage {
            color: red;
            font-size: 1.2rem;
        }

        .errorCard {
            margin-top: .5rem;
            background-color: lightblue;

        }
    </style>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">


        <?php

        function showForm($email = "", $pw = "")
        {
            $form = <<< END
        <form method="POST">
            <img class="mb-4" src="images/PHP-logo.svg.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pw">
                <label for="floatingPassword">Password</label>
            </div>           
            <button class="w-50 btn btn-lg btn-primary" type="submit">Sign in</button> <br />
            <button class="w-50 btn btn-lg btn-secondary">
                <a href="register.php"> Register</a>
            </button>

        </form>
      END;
            echo $form;
        }
        showForm();
        if (isset($_POST['email'])) { // we're receving a submission
            $email = $_POST['email'];
            $pw = $_POST['pw'];
            // verify inputs
            $result = mysqli_query($link, sprintf(
                "SELECT * FROM users WHERE email='%s'",
                mysqli_real_escape_string($link, $email)
            ));

            if (!$result) {
                die("SQL Query failed: " . mysqli_error($link));
            }
            $userRecord = mysqli_fetch_assoc($result);
            $loginSuccessful = ($userRecord != null) && ($pw==$userRecord['password']);
            if (!$loginSuccessful) { // STATE 2: login failed
                echo "<div class='h4 mb-3 fw-normal errorCard'>Invalid email or password</p>";
                            
            } else { // STATE 3: login successful
                unset($userRecord['password']); // for safety reasons remove the password
                $_SESSION['user'] = $userRecord;
                echo "<p>login successful</p>";
                echo '<p><a href="homepage.php">Click here to continue</a></p>';
            }
        }
        ?>

    </main>

</body>

</html>