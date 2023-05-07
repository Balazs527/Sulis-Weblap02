<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        if ($remember) {
            setcookie("user_id", $user['id'], time() + (86400 * 30), "/");
            setcookie("username", $user['username'], time() + (86400 * 30), "/");
        }

        header("Location: index.php");
    } else {
        $error = "Invalid username or password.";
    }
}

include('header.php');
?>

<div class="container mt-5">
    <h2>Login</h2>
    <?php
    if (isset($error)) {
        echo '<div class="alert error-message">' . $error . '</div>';
    }
    ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control dark-input" id="username" placeholder=" Enter Username " name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control dark-input" id="password" placeholder=" Enter Password " name="password" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <p class="mt-3">Don't have an account? <a href="register.php"><b>Register here</b></a></p>
    </form>
</div>

<?php include('footer.php'); ?>
