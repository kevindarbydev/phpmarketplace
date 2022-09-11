<?php require_once './config/db.php'; ?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Marketplace with PHP & Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sticky-footer-navbar/">
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
    </style>


    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 text-center bodyGray">

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="homepage.php">Marketplace with PHP & Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listItems.php">Items for Sale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="postItem.php">Post an Item</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userStore.php">My Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    </ul>
                    <!--  <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                </div>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main class="w-100 m-auto formBackGround topHeader">
        <?php

        

        function displayForm()
        {

            $form = <<< END
            <div  >
    <form method="POST" id="sellerForm" enctype='multipart/form-data'>
        
     <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Used Bicycle" name="itemName">
                <label for="floatingInput">Item name</label>
            </div>
             <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="24.99" name="startBid">
                <label for="floatingInput">Starting bid (ex. 24.99)</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Used Bicycle"  name="itemDesc">
                <label for="floatingInput">Item description</label>
            </div>
           
            <div class="form-floating">
                <input type="file" class="form-control" id="floatingInput" name="itemImage">
                <label for="floatingInput">Item image: </label>
            </div>
   
        <input type="submit" id="submitBtn" value="Submit">
    </form>
    </div>
END;
            echo $form;
        }
        displayForm();
        function testInput($data)
        {
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = addslashes($data);
            return $data;
        }

        if (isset($_POST['itemName'])) { // receving a submission
            $itemName = $_POST['itemName'];           
            $itemDesc = $_POST['itemDesc'];
            $startBid = $_POST['startBid'];
            $itemImage = $_POST['itemImage'];

            $itemDesc = strip_tags($itemDesc, "<p><ul><li><em><strong><i><b><ol><hr><br><span>");

            // verify inputs
            $errorList = array();
            if (
                strlen($itemName) < 2 || strlen($itemName) > 100
            ) {
                $errorList[] = "Name must be between 2 and 100 characters.";
            }
            if (strlen($itemDesc) < 2 || strlen($itemDesc) > 1000) {
                $errorList[] = "Please keep your description between 2 and 1000 characters.";
            }            
            //cant get to work || !preg_match("/^\$?(?!0.00)(([0-9]{1,3},([0-9]{3},)*)[0-9]{3}|[0-9]{1,3})(\.[0-9]{2})?$/", $startBid)
            if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $startBid) != 1) {
                $errorList[] = "Please enter a numeric value, 2 decimal places ex. 24.99.";
            }
            $photoFilePath = null;
          
            $val = verifyUploadedPhoto($photoFilePath);
            if ($val !== TRUE) {
                $errorList[] = $val;
            }

            if ($errorList) { // STATE 2: errors in submission - failed
                echo "<div class='h4 mb-3 fw-normal errorCard'> There were problems with your submission:\n<ul>\n";
                foreach ($errorList as $error) {
                    echo "<li class=\"errorMessage\">$error</li>\n";
                }
                echo "</ul>\n</div>";
            } else { // STATE 3: submission successful

                // insert the record and inform user

                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoFilePath)) {
                    die("Error moving the uploaded file. Action aborted.");
                }

                $sql = sprintf(
                    "INSERT INTO auctions VALUES (NULL)",
                    mysqli_real_escape_string($link, $itemName),    
                    mysqli_real_escape_string($link, $itemDesc),
                    mysqli_real_escape_string($link, $photoFilePath),                                    
                    mysqli_real_escape_string($link, $startBid)
                );
                if (!mysqli_query($link, $sql)) {
                    die("Fatal error: failed to execute SQL query: " . mysqli_error($link));
                }
                echo "<p>Item posted succesfully.</p>";
                echo '<p><a href="index.html">Click to continue</a></p>';
            }
        }

        function verifyUploadedPhoto(&$newFilePath)
        {           

            if ($_FILES != null){
                $photo = $_FILES['photo'];
            if ($photo['error'] != UPLOAD_ERR_OK) {
                return "Error uploading photo " . $photo['error'];
            }
            if ($photo['size'] > 2 * 1024 * 1024) { // 2MB
                return "File too big. 2MB max is allowed.";
            }
            $info = getimagesize($photo['tmp_name']);

            if ($info[0] < 100 || $info[0] > 1000 || $info[1] < 100 || $info[1] > 1000) {
                return "Width and height must be within 200-1000 pixels range";
            }
            $ext = "";
            switch ($info['mime']) {
                case 'image/jpeg':
                    $ext = "jpg";
                    break;
                case 'image/gif':
                    $ext = "gif";
                    break;
                case 'image/png':
                    $ext = "png";
                    break;
                default:
                    return "Only JPG, GIF, and PNG file types are accepted";
            }
            $target_path = basename($_FILES["photo"]["name"]);
            $underscore_path = str_replace(' ', '_', $target_path);
            $newFilePath = "uploads/" . $underscore_path;
            return TRUE;
        }
        }


        ?>
        </main>

        <footer class="footer mt-auto py-3">
            <div class="container">
                <span class="text-muted">Kevin Darby - Bootstrap & PHP Project</span>
            </div>
        </footer>


        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>