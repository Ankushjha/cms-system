<?php include "includes/db.php"; ?>

<?php include "includes/header.php"; ?>

<?php include "includes/navigations.php"; ?>
  

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">



          <?php 
        
        if(isset($_GET['category'])) {
            $post_category_id = $_GET['category'];
        }


            $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id ";
            $select_all_posts_query = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = substr($row['post_content'],0,150);


?>

              
        <!-- Title -->
        <h1 class="mt-4"> <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title ?>  </h1>

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
              <br>
        <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary">Read More > </a>
        <hr>

        <?php

            }
          
          ?>


</div>
            <!-- Sidebar Widgets Column -->
      <?php include "includes/sidebar.php"; ?>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; CMS Website 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>