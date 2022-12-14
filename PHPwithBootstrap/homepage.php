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

        .topHeader {
            margin-top: 3rem;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

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
                            <a class="nav-link" href="index.php">Log In Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register Page</a>
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
    <main class="flex-shrink-0">
        <div class="container">
            <div class="container px-4 py-5" id="featured-3">
                <h2 class="pb-2 border-bottom topHeader">Welcome to my Marketplace Website</h2>
                <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                    <div class="feature col">

                        <h3 class="fs-2">Browse the catalogue</h3>
                        <p>Click below to see all the items currently posted by our user base.</p>
                        <a href="listItems.php" class="icon-link d-inline-flex align-items-center">
                            View items
                            <svg class="bi" width="1em" height="1em">
                                <use xlink:href="listItems.php" />
                            </svg>
                        </a>
                    </div>
                    <div class="feature col">

                        <h3 class="fs-2">Post an item</h3>
                        <p>Have something you'd like to sell? Post it here along with some details and it's sure to sell soon!</p>
                        <a href="postItem.php" class="icon-link d-inline-flex align-items-center">
                            Post item
                            <svg class="bi" width="1em" height="1em">
                                <use xlink:href="postItem.php" />
                            </svg>
                        </a>
                    </div>
                    <div class="feature col">

                        <h3 class="fs-2">View your items</h3>
                        <p>See all current bids on your items and any other related information to your account.</p>
                        <a href="#" class="icon-link d-inline-flex align-items-center">
                            My storefront
                            <svg class="bi" width="1em" height="1em">
                                <use xlink:href="#chevron-right" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Kevin Darby - Bootstrap & PHP Project</span>
        </div>
    </footer>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>