<?php include "includes/db.php"; ?>

<?php include "includes/header.php"; ?>

<?php include "includes/navigations.php"; ?>
  

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">



          <?php 


            $per_page = 2;

          if(isset($_GET['page'])) {


            $page = $_GET['page'];

          } else {
            $page = "";
          }

          if($page == "" || $page == 1) {
            $page_1 = 0;
          } else {
            $page_1 = ($page * $per_page) - $per_page;
          }

          $post_query_count = "SELECT * FROM posts";
          $find_count = mysqli_query($connection, $post_query_count);
          $count = mysqli_num_rows($find_count);

          $count = ceil($count /$per_page);
        
            $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
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
              
          
      <ul class="pagination justify-content-center">

            <?php  

              for($i = 1; $i <= $count; $i++) {

                if($i == $page) {
                echo "<li class='page-item'><a class='page-link active_link' href='index.php?page={$i}'>{$i}</a></li>";

                } else {

                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                }
              }

            ?>

      </ul>


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