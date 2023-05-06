<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if ($password === $passwordConfirm) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: login.php");
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } else {
        $error = "Passwords do not match.";
    }
}

include('header.php');
?>

<div class="container mt-5">
    <h2>Register</h2>
    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control dark-input" id="firstName" placeholder=" Enter First Name " name="firstName" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control dark-input" id="lastName" placeholder=" Enter Last Name " name="lastName" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control dark-input" id="email" placeholder=" Enter Email Address " name="email" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control dark-input" id="username" placeholder=" Enter Username " name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control dark-input" id="password" placeholder=" Enter Password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="passwordConfirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control dark-input" id="passwordConfirm" placeholder=" Confirm Password " name="passwordConfirm" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>

<?php include('footer.php'); ?>
