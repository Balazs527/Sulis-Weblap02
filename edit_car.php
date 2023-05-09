<?php
include('config.php');
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    $_SESSION['error'] = 'Please log in to edit your car.';
    header('Location: index.php');
    exit;
}

$car_id = $_GET['id'];
$sql_car = "SELECT * FROM cars WHERE id = ?";
$stmt_car = $conn->prepare($sql_car);
$stmt_car->bind_param("i", $car_id);
$stmt_car->execute();
$result_car = $stmt_car->get_result();
$car = $result_car->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $made_by = $_POST['made_by'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $engine_size = $_POST['engine_size'];
    $fuel_type = $_POST['fuel_type'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE cars SET made_by = ?, model = ?, year = ?, color = ?, engine_size = ?, fuel_type = ?, description = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssdii", $made_by, $model, $year, $color, $engine_size, $fuel_type, $description, $price, $car_id);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit;
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

include('header.php');
?>

<div class="container mt-5">
    <h2>Edit Car</h2>
    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="made_by" class="form-label">Manufacturer</label>
            <input type="text" class="form-control dark-input" id="made_by" placeholder=" Enter Manufacturer " name="made_by" value="<?php echo $car['made_by']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control dark-input" id="model" placeholder=" Enter Model " name="model" value="<?php echo $car['model']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" class="form-control dark-input" id="year" placeholder=" Enter Year " name="year" value="<?php echo $car['year']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control dark-input" id="color" placeholder=" Enter Color" name="color" value="<?php echo $car['color']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="engine_size" class="form-label">Engine Size (L)</label>
            <input type="number" step="0.1" class="form-control dark-input" id="engine_size" placeholder=" Enter Engine Size " name="engine_size" value="<?php echo $car['engine_size']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="fuel_type" class="form-label">Fuel Type</label>
            <select class="form-control dark-input" id="fuel_type" name="fuel_type" required>
                <option value="gasoline" <?php echo $car['fuel_type'] == 'gasoline' ? 'selected' : ''; ?>>Gasoline</option>
                <option value="diesel" <?php echo $car['fuel_type'] == 'diesel' ? 'selected' : ''; ?>>Diesel</option>
                <option value="electric" <?php echo $car['fuel_type'] == 'electric' ? 'selected' : ''; ?>>Electric</option>
                <option value="hybrid" <?php echo $car['fuel_type'] == 'hybrid' ? 'selected' : ''; ?>>Hybrid</option>
                <option value="LPG" <?php echo $car['fuel_type'] == 'LPG' ? 'selected' : ''; ?>>LPG</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control dark-input" id="description" placeholder=" Enter Description " name="description" required><?php echo $car['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control dark-input" id="price" placeholder=" Enter Price " name="price" value="<?php echo $car['price']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<?php include('footer.php'); ?>

