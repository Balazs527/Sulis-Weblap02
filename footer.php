<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <div class="bottom-right-corner">
    <a>Made by <b>Strausz Balázs</b> and <b>Munkhárt Levente</b></a>
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

</body>

</html>
