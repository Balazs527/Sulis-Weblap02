<?php
include('config.php');
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    $_SESSION['error'] = 'Please log in to edit your profile.';
    header('Location: index.php');
    exit;
}

$username = $_SESSION['username'];
$sql_user = "SELECT * FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if ($password === $passwordConfirm) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $username);

        if ($stmt->execute()) {
            header("Location: profile.php");
            exit;
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
    <h2>Edit Profile</h2>
    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control dark-input" id="firstName" placeholder=" Enter First Name " name="firstName" value="<?php echo $user['firstname']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control dark-input" id="lastName" placeholder=" Enter Last Name " name="lastName" value="<?php echo $user['lastname']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control dark-input" id="email" placeholder=" Enter Email Address " name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control dark-input" id="password" placeholder=" Enter Password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="passwordConfirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control dark-input" id="passwordConfirm" name="passwordConfirm" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<?php include('footer.php'); ?>

