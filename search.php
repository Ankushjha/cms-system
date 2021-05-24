<?php include "includes/db.php"; ?>


<?php include "includes/header.php"; ?>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">


        <?php  

          $query = "SELECT * FROM categories";
          $select_all_categories_query = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($select_all_categories_query)) {
            $cat_title = $row['cat_title'];

            echo "<li class='nav-item'> <a class='nav-link' href='#'> {$cat_title} </a> </li>";
          }

        ?>


          <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">


<?php 
    if(isset($_POST['submit'])){

    $search = $_POST['search'];

    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
    $search_query = mysqli_query($connection, $query);

    if(!$search_query) {
    die("QUERY FAILED" . mysqli_error($connection));
    }

    $count = mysqli_num_rows($search_query);

    if($count == 0) {
    echo "<h1> NO RESULT </h1>";
    } else {


    while ($row = mysqli_fetch_assoc($search_query)) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];


?>

      
<!-- Title -->
<h1 class="mt-4">  <?php echo $post_title ?>  </h1>

<!-- Author -->
<p class="lead">
  by
  <a href="#">  <?php echo $post_author ?> </a>
</p>

<hr>

<!-- Date/Time -->
<p><?php echo $post_date ?> </p>

<hr>

<!-- Preview Image -->
<img class="img-fluid rounded" src="images/<?php echo $post_image ?>" alt="">

<hr>

<!-- Post Content -->
      <?php echo $post_content ?>

<hr>

<?php

    }


}
}
  
?> 
</div>

<?php include "includes/sidebar.php"; ?>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>