<?php include "includes/admin_header.php" ?>


    <div id="wrapper">

        <!-- Navigation -->


        <?php include "includes/admin_navigations.php" ?>




            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">                   
                    <h1 class="page-header">
                            Welcome to Comments
                            <small>Author</small>
                        </h1>


                        <?php 

if(isset($_POST['checkboxArray'])) {

    foreach($_POST['checkboxArray'] as $postValueId){

        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connection, $query);

                confirmQuery($update_to_published_status);
                break;


            case 'draft':
                $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_draft_status = mysqli_query($connection, $query);

                confirmQuery($update_to_draft_status);
                break;


            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $update_to_delete_status = mysqli_query($connection, $query);

                confirmQuery($update_to_delete_status);
                break;

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_post_query)) {

                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .="VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                $copy_query = mysqli_query($connection, $query);

                confirmQuery($copy_query);
                break;
                
        }
    }

}

?>



<form action="" method='post'>

<table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer" style="padding: 0px; margin-bottom: 10px;" class="col-xs-4">
        
            <select class="form-control" name="bulk_options" id="">
            
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
            
            </select>
        
        </div>

        <div class="col-xs-4">
        
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="users.php?source=add_user" class="btn btn-primary">Add New</a>
        
        </div>
        

<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody >
                         
<?php 
$query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($_GET['id']). " ";
$select_comments = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_comments)) {
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = $row['comment_content'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";

    echo "<td>$comment_id</td>";
    echo "<td>$comment_author</td>";
    echo "<td>$comment_content</td>";

    // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
    // $select_categories_id = mysqli_query($connection, $query);

    // while($row = mysqli_fetch_assoc($select_categories_id)) {
    //     $cat_id = $row['cat_id'];
    //     $cat_title = $row['cat_title'];

    
    //     echo "<td>{$cat_title}</td>";


    // }

    // echo "<td>$post_category_id</td>";
    
    echo "<td>$comment_email</td>";
    echo "<td>$comment_status</td>";

$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
$select_post_id_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<td> <a href='../post.php?p_id=$post_id'>  $post_title  </a> </td>";
        }


    echo "<td>$comment_date</td>";
    echo "<td><a href='comments.php?approve= $comment_id'> Approve </a></td>";
    
    if(isset($_GET['approve'])){
        $the_comment_id = $_GET['approve'];
    
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id ";
        $approve_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    echo "<td><a href='comments.php?unapprove= $comment_id'> Unapprove </a></td>";

        if(isset($_GET['unapprove'])){
            $the_comment_id = $_GET['unapprove'];
        
            $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id ";
            $unapprove_comment_query = mysqli_query($connection, $query);
            header("Location: comments.php");
        }

    echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

        if(isset($_GET['delete'])){
            $the_comment_id = $_GET['delete'];
        
            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
            $delete_query = mysqli_query($connection, $query);
        
            confirmQuery($delete_query);

            header("Location: comments.php");
        }
     

    echo "</tr>";
}
?>

<!-- 
                                <td>10</td>
                                <td>Admin</td>
                                <td>Bootstrap Framework</td>
                                <td>Bootstrap</td>
                                <td>Status</td>
                                <td>Image</td>
                                <td>Tags</td>
                                <td>Comments</td>
                                <td>Date</td> -->
                         
                        </tbody>
                        </table>

<?php  

if(isset($_GET['delete'])){
   $the_post_id = $_GET['delete'];

$query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
$delete_query = mysqli_query($connection, $query);

confirmQuery($delete_query);
}

?>

                        
</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php include "includes/admin_footer.php"; ?>