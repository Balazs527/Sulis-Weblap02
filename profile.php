<?php
include('config.php');
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    $_SESSION['error'] = 'Please log in to view your profile.';
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

$sql_cars = "SELECT * FROM cars WHERE users_username = ?";
$stmt_cars = $conn->prepare($sql_cars);
$stmt_cars->bind_param("s", $username);
$stmt_cars->execute();
$result_cars = $stmt_cars->get_result();

include('header.php');
?>

<div class="container mt-5">
    <h2><?php echo $user['firstname'] . ' ' . $user['lastname']; ?>'s Profile</h2>
    <h4>Username: <?php echo $user['username']; ?></h4>
    <h4>Email: <?php echo $user['email']; ?></h4>
    <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>

    <h3 class="mt-5">Uploaded Cars</h3>
    <div class="row">
        <?php
        if ($result_cars->num_rows > 0) {
            while ($row = $result_cars->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['made_by'] . ' ' . $row['model']; ?>" class="card-img-top car-image" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body dark-input">
                            <h5 class="card-title"><?php echo $row['made_by'] . ' ' . $row['model']; ?></h5>
                            <h6 class="card-subtitle mb-2"><?php echo $row['year']; ?></h6>
                            <p class="card-text">
                                Price: <?php echo $row['price']; ?> Ft<br>
                                Color: <?php echo $row['color']; ?><br>
                                Engine Size: <?php echo $row['engine_size']; ?> L<br>
                                Fuel Type: <?php echo ucfirst($row['fuel_type']); ?><br>
                                Description: <?php echo $row['description']; ?>
                            </p>
                            <a href="edit_car.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit Car</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="alert alert-info">You have not uploaded any cars yet.</div>';
        }
        ?>
    </div>
</div>

<div class="modal" tabindex="-1" id="imageModal">
  <div class="modal-dialog">
    <div class="modal-content dark-input">
      <div class="modal-header dark-input">
        <h5 class="modal-title dark-input">Car Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" alt="Car Image" class="img-fluid" id="modalImage">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var carImages = document.querySelectorAll(".car-image");
    var imageModal = new bootstrap.Modal(document.getElementById("imageModal"), {});
    var modalImage = document.getElementById("modalImage");

    carImages.forEach(function(carImage) {
        carImage.addEventListener("click", function(event) {
            modalImage.src = event.target.src;
            imageModal.show();
        });
    });
});
</script>

<?php
include('footer.php');
?>

