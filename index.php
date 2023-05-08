<?php
include('config.php');

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

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
  <div class="modal-dialog modal-dialog-centered modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Car Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="modalImage" class="img-fluid">
      </div>
      <div class="modal-footer">
        <a href="index.php" class="btn btn-primary">Back to Home page</a>
      </div>
    </div>
  </div>
  </div>

<button onclick="scrollToTop()" class="scroll-top" id="scrollToTop">Back to Top</button>

<script>
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  var imageModal = document.getElementById('imageModal');

  var modalImage = document.getElementById("modalImage");
  var carImages = document.getElementsByClassName("car-image");
  for (let i = 0; i < carImages.length; i++) {
    carImages[i].onclick = function () {
      modalImage.src = carImages[i].src;
      imageModal.style.display = "block";
      new bootstrap.Modal(imageModal).show();
    };
  }

  var closeButton = document.getElementsByClassName("btn-close")[0];

  closeButton.onclick = function () {
    imageModal.style.display = "none";
  };
</script>

<?php include('footer.php'); ?>

