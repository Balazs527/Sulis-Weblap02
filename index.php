<?php include('header.php'); ?>

<div class="container mt-5">
    <h1>Welcome to My Website</h1>
    <p>This is the home page.</p>
</div>

<button onclick="scrollToTop()" class="scroll-top" id="scrollToTop">Vissza a tetejére</button>

<script>
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

<?php include('footer.php'); ?>
