



      <div class="col-md-4">


        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">


          <form action="search.php" method="post">
            <div class="input-group">
              <input name="search" type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-secondary" name="submit" type="submit">Go!</button>
              </span>
            </div>
            </form>
          </div>
        </div>




        <!-- login  -->

        <div class="card my-4">
          <h5 class="card-header">Login</h5>
          <div class="card-body">


          <form action="includes/login.php" method="post">
            <div class="form-group">
              <input name="username" type="text" class="form-control" placeholder="Enter Username">
              </div>

            <div class="input-group">
              <input name="password" type="password" class="form-control" placeholder="Enter Password">

              <span class="input-group-append">
                <button class="btn btn-primary" name="login" type="submit">Login!</button>
              </span>
            </div>
            </form>
          </div>
        </div>






        <!-- Categories Widget -->
        <div class="card my-4">

          <?php  

          $query = "SELECT * FROM categories";
          $select_categories_sidebar = mysqli_query($connection, $query);

          ?>

          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">

                    <?php 
                    while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                      $cat_title = $row['cat_title'];
                      $cat_id = $row['cat_id'];

                      echo "<li class='nav-item'> <a  href='category.php?category=$cat_id'> {$cat_title} </a> </li>";
                      }

                    ?>


                  <!-- <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li> -->

                  
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
                      <?php include "widget.php"; ?>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->