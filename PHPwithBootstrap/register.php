<?php require_once './config/db.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Marketplace Registration Page</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css">

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
        function showForm($fName = "", $lName = "", $email = "")
        {
            $form = <<< END
            <div class="w-100 m-auto formBackGround">
             <form method="POST">
            <h1 class="h3 mb-3 fw-normal">Registration Form</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Kevin"  name="fName" value="$fName">
                <label for="floatingInput">First Name</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Darby"  name="lName" value="$lName">
                <label for="floatingInput">Last Name</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"  name="email" value="$email">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"   name="pw">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword2" placeholder="Please repeat password"  name="pwRepeat">
                <label for="floatingPassword2">Please repeat password</label>
            </div>          

            <button class="w-50 btn btn-lg btn-primary" type="submit">Register</button>

        </form>
        </div>
        END;
            echo $form;
        }
        showForm();
        function testInput($data)
        {
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = addslashes($data);
            return $data;
        }

        if (isset($_POST['fName'])) { // user has pressed register

            $fName = $_POST['fName'];
            $lName = $_POST['lName'];

            $email = $_POST['email'];
            $pw = $_POST['pw'];
            $pwRepeat = $_POST['pwRepeat'];

            $errorList = array(); // initialize errorList var to collect errors and show them later
            if ($pw != $pwRepeat) {
                $errorList[] = "Please make sure your passwords match.";
            } else {
                if (
                    strlen($pw) < 6 || strlen($pw) > 40
                    || (preg_match("/[A-Z]/", $pw) !== 1)
                    || (preg_match("/[a-z]/", $pw) !== 1)
                    || (preg_match("/[0-9]/", $pw) !== 1)
                ) {
                    $errorList[] = "Password must be 6-40 characters long and contain at least one "
                        . "uppercase letter, one lowercase, and one digit.";
                }
            }
            if (testInput($fName) ==  null || testInput($fName) == "") {
                $errorList[] = "Please enter a valid first name.";
                $fName = "";
            }
            if (testInput($lName) ==  null || testInput($lName) == "") {
                $errorList[] = "Please enter a valid last name.";
                $lName = "";
            }
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = "Email does not look valid";
                $email = "";
            } else { // validate that email is not already registerd in the database
                if ($stmt = mysqli_prepare($link, "SELECT id FROM users WHERE email=?")) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    if (!mysqli_stmt_execute($stmt)) {
                        die("SQL Query failed: " . mysqli_error($link));
                    }
                    mysqli_stmt_bind_result($stmt, $id); // technically we don't need it since we don't care about id value
                    if (mysqli_stmt_fetch($stmt)) { // true if record was fetched / found
                        $errorList[] = "This email is already registered";
                        $email = "";
                    }
                } else {
                    die("SQL query preparation failed");
                }
                $result = mysqli_query($link, sprintf(
                    "SELECT id FROM users WHERE email='%s'",
                    mysqli_real_escape_string($link, $email)
                ));
                if (!$result) {
                    die("SQL Query failed: " . mysqli_error($link));
                }
                $userRecord = mysqli_fetch_assoc($result);
                if ($userRecord) {
                    $errorList[] = "This email is already registered";
                    $email = "";
                }
            }

            if ($errorList) { // STATE 2: errors in submission - failed
                echo "<div class='h4 mb-3 fw-normal errorCard'> There were problems with your submission:\n<ul>\n";
                foreach ($errorList as $error) {
                    echo "<li class=\"errorMessage\">$error</li>\n";
                }
                echo "</ul>\n</div>";
            } else { // STATE 3: success

                //  $hashedPW = password_hash($pw, PASSWORD_DEFAULT);
                $sql = sprintf(
                    "INSERT INTO users VALUES (NULL, '%s', '%s', '%s', '%s')",
                    mysqli_real_escape_string($link, $fName),
                    mysqli_real_escape_string($link, $lName),
                    mysqli_real_escape_string($link, $email),
                    mysqli_real_escape_string($link, $pw)
                );
                if (!mysqli_query($link, $sql)) {
                    die("Fatal error: failed to execute SQL query: " . mysqli_error($link));
                }
                echo "<p class='h4 mb-3 fw-normal'>Registration successful</p>";
                echo '<p><a href="index.php">Click to sign in</a></p>';
            }
        }


        ?>

    </main>




</body>

</html>