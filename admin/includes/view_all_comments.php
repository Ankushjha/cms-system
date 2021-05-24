
<?php 

if(isset($_POST['checkboxArray'])) {

    foreach($_POST['checkboxArray'] as $commentValueId){

        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options) {
            case 'Approved':
                $query = "UPDATE comments SET comment_status ='{$bulk_options}' WHERE comment_id = {$commentValueId} ";
                $update_to_approved_status = mysqli_query($connection, $query);

                confirmQuery($update_to_approved_status);
                break;


            case 'Unapproved':
                $query = "UPDATE comments SET comment_status ='{$bulk_options}' WHERE comment_id = {$commentValueId} ";
                $update_to_unapproved_status = mysqli_query($connection, $query);

                confirmQuery($update_to_unapproved_status);
                break;


            case 'delete':
                $query = "DELETE FROM comments WHERE comment_id = {$commentValueId} ";
                $update_to_delete_status = mysqli_query($connection, $query);

                confirmQuery($update_to_delete_status);
                break;

            case 'clone':
                $query = "SELECT * FROM comments WHERE comment_id = '{$commentValueId}' ";
                $select_comment_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_comment_query)) {

                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];

                }

                $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .="VALUES('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now())";

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
            <option value="Approved">Approved</option>
            <option value="Unapproved">Unapproved</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
            
            </select>
        
        </div>

        <div class="col-xs-4">
        
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        
        </div>
        



<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
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
$query = "SELECT * FROM comments";
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
?>

<td> <input type='checkbox' class='checkBoxes' name='checkboxArray[]' value='<?php echo $comment_id; ?>'> </td>

<?php
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