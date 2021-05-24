<?php include "includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Post - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/blog-post.css" rel="stylesheet">

</head>

<body>

<?php include "includes/navigations.php"; ?>
  

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">



          <?php 
        
            $query = "SELECT * FROM posts ";
            $select_all_posts_query = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = substr($row['post_content'],0,150);
              $post_status = $row['post_status'];


              if($post_status == 'published') {
?>

              
        <!-- Title -->
        <h1 class="mt-4"> <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title ?>  </h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>">  <?php echo $post_author ?> </a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><?php echo $post_date ?> </p>

        <hr>

        <!-- Preview Image -->
        <a href="post.php?p_id=<?php echo $post_id; ?>">
        <img class="img-fluid rounded" src="images/<?php echo $post_image ?>" alt="">
                </a>
        <hr>

        <!-- Post Content -->
              <?php echo $post_content ?>
                <br>
        <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary">Read More > </a>

        <hr>

        <?php

            }   }          
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