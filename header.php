<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sulis Weblap 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dark-theme.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand nav-link" href="index.php">Fostalicska Eladó</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="upload_car.php">Upload Car</a>
                </li>
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="register.php">Registration</a></li>';
                    }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Dropdown </a>
                    <ul class="dropdown-menu dark-input">
                        <li><a class="dropdown-item dark-input" href="profile.php">Your Account</a></li>
                        <li><a class="dropdown-item dark-input" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider dark-input"></li>
                        <li><a class="dropdown-item dark-input" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex ms-auto" action="index.php" method="GET" role="search">
                <input class="form-control me-2 dark-input" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        let alertElement = document.querySelector(".alert");
        if (alertElement) {
            alertElement.style.transition = "opacity 1s";
            setTimeout(function() {
                alertElement.style.opacity = "0";
            }, 10000);
        }
    }, 1000);
});
</script>