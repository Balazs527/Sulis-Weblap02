<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    $sql_check_email = "SELECT * FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();

    $sql_check_username = "SELECT * FROM users WHERE username = ?";
    $stmt_check_username = $conn->prepare($sql_check_username);
    $stmt_check_username->bind_param("s", $username);
    $stmt_check_username->execute();
    $result_check_username = $stmt_check_username->get_result();

    if ($result_check_email->num_rows == 0) {
        if ($result_check_username->num_rows == 0) {
            if ($password === $passwordConfirm) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?)";
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
        } else {
            $error = "Username is already in use.";
        }
    } else {
        $error = "Email address is already in use.";
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
        <p class="mt-3">Already have an account? <a href="login.php"><b>Login here</b></a></p>
    </form>
</div>

<?php include('footer.php'); ?>
