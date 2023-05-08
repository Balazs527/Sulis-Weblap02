<?php
include('config.php');
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    $_SESSION['error'] = 'Please log in to upload a car.';
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $madeBy = $_POST['madeBy'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $engineSize = $_POST['engineSize'];
    $fuelType = $_POST['fuelType'];
    $description = $_POST['description'];

    $image = $_FILES['image'];
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageError = $_FILES['image']['error'];
    $imageType = $_FILES['image']['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($imageActualExt, $allowed)) {
        if ($imageError === 0) {
            if ($imageSize < 1000000) {
                $imageNameNew = uniqid('', true) . "." . $imageActualExt;
                $imageDestination = 'uploads/' . $imageNameNew;
                move_uploaded_file($imageTmpName, $imageDestination);

                $sql = "INSERT INTO cars (users_username, made_by, model, year, color, engine_size, fuel_type, description, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssisssss", $_SESSION['username'], $madeBy, $model, $year, $color, $engineSize, $fuelType, $description, $imageDestination);

                if ($stmt->execute()) {
                    header("Location: index.php");
                } else {
                    $error = "Something went wrong. Please try again.";
                }
            } else {
                $error = "Your image is too big!";
            }
        } else {
            $error = "There was an error uploading your image!";
        }
    } else {
        $error = "You cannot upload images of this type!";
    }
}

include('header.php');
?>

<div class="container mt-5">
    <h2>Upload Car</h2>
    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="madeBy" class="form-label">Made By</label>
            <input type="text" class="form-control dark-input" id="madeBy" placeholder="Enter Made By" name="madeBy" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control dark-input" id="model" placeholder="Enter Model" name="model" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" class="form-control dark-input" id="year" placeholder="Enter Year" name="year" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control dark-input" id="color" placeholder="Enter Color" name="color" required>
        </div>
        <div class="mb-3">
            <label for="engineSize" class="form-label">Engine Size (in liters)</label>
            <input type="number" step="0.1" class="form-control dark-input" id="engineSize" placeholder="Enter Engine Size" name="engineSize" required>
        </div>
        <div class="mb-3">
            <label for="fuelType" class="form-label dropdown11">Fuel Type</label>
            <select class="form-select dark-input" id="fuelType" name="fuelType" required>
                <option value="gasoline">Gasoline</option>
                <option value="diesel">Diesel</option>
                <option value="electric">Electric</option>
                <option value="hybrid">Hybrid</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control dark-input textarea01 textarea02" id="description" rows="10" placeholder="Enter Description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control dark-input" type="file" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload Car</button>
    </form>
</div>

<?php include('footer.php'); ?>

