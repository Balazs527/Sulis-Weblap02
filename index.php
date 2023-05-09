<?php
include('config.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM cars WHERE made_by LIKE ? OR model LIKE ? OR description LIKE ?";
$search_term = '%' . $search . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $search_term, $search_term, $search_term);
$stmt->execute();
$result = $stmt->get_result();

session_start();
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

include('header.php');
?>

<?php
if (isset($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
?>

<div class="container mt-5">
    <h2>Cars for Sale</h2>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['made_by'] . ' ' . $row['model']; ?>" class="card-img-top car-image" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body dark-input">
                            <h5 class="card-title"><?php echo $row['made_by'] . ' ' . $row['model']; ?></h5>
                            <h6 class="card-subtitle mb-2"><?php echo $row['year']; ?></h6>
                            <p class="card-text">
                            Price: <?php echo $row['price']; ?> Ft <br>
                                Color: <?php echo $row['color']; ?><br>
                                Engine Size: <?php echo $row['engine_size']; ?> L<br>
                                Fuel Type: <?php echo ucfirst($row['fuel_type']); ?><br>
                                Description: <?php echo $row['description']; ?>
                            </p>
                            <p class="card-text"><small class="">Posted by <?php echo $row['users_username']; ?></small></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="alert alert-info">No cars found.</div>';
        }
        ?>
    </div>
</div>


<!-- Modal -->
<div class="modal" tabindex="-1" id="imageModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content dark-input">
      <div class="modal-header dark-input">
        <h5 class="modal-title">Car Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="modalImage" class="img-fluid">
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

<?php include('footer.php'); ?>
