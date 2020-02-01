  
<?php  include 'delete_model.php'; ?>
  <?php
if (isset($_POST['checkBoxArray'])) {
  $idForAllPostInArray = $_POST['checkBoxArray'];
  foreach ($idForAllPostInArray as $postValueId) {
    $bulk_options = $_POST['bulk_options'];
    switch ($bulk_options) {
      case 'published':
      $query = " UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
      $update_status_to_publish = mysqli_query($connection ,$query);
        break;
          case 'draft':
      $query = " UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
      $update_status_to_draft = mysqli_query($connection ,$query);
        break;
          case 'delete':
      $query = " DELETE  FROM posts WHERE post_id = {$postValueId} ";
      $delete_query = mysqli_query($connection ,$query);
        break;
     case 'clone':
      $query = " SELECT * FROM posts WHERE  post_id = {$postValueId}";
      $select_query = mysqli_query($connection ,$query);
      while ($row = mysqli_fetch_assoc($select_query)) {
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_date = $row['post_date'];
        $post_user = $row['post_user'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];

      }
      $query  = "INSERT INTO posts(post_category_id,post_title,post_date,post_user,post_status,post_image,post_tags,post_content)";
      $query .= "VALUES({$post_category_id},'{$post_title}',now(),'{$post_user}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
      $copyQuery = mysqli_query($connection ,$query);
      if (!$copyQuery) {

        die("query failed :" . mysqli_error($connection));
      }

        break;
    }
  }
}
  ?>                  
   
<form action="" method="post">


   <table class="table table-bordered table-hover">

<div id="bulkOptionsContainer" class="col-xs-4">
  <select name="bulk_options" id="" class="form-control">
    <option value="">select options</option>
    <option value="published">publish</option>
    <option value="draft">draft</option>
    <option value="delete">delete</option>
     <option value="clone">clone</option>

  </select>
</div>

<div class="col-xs-4">
  <input type="submit" name="submit" class="btn btn-success" value="Apply">
  <a  class="btn btn-primary" href="posts.php?source=add_post">Add now</a>
</div>


    <thead>
        <tr>
          <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Users</th>
        <th>Category</th>
        <th>Title</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>view post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>views</th>
        </tr>
    </thead>
    <tbody>
<?php
    // $query = " SELECT * FROM posts";
$query = " SELECT posts.post_id  , posts.post_user , posts.post_category_id,posts.post_title , posts.post_status , posts.post_image ,posts.post_tags , posts.post_comment_count ,posts.post_date ,posts.post_views_count,categories.cat_id,categories.cat_title";

$query .= " FROM posts ";
$query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
$select_posts = mysqli_query($connection,$query);
while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
 
    $post_user = $row['post_user'];
    $post_category_id = $row['post_category_id'];
     $post_title = $row['post_title'];
    $post_status = $row['post_status'];
      $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
          $post_date = $row['post_date'];
           $post_views_count = $row['post_views_count'];
            $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
          echo "<tr>";
          ?>
          <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="
            <?php echo $post_id; ?>"></td>
          <?php
          echo "<td>{$post_id}</td>";

   echo "<td>{$post_user}</td>";

           echo "<td>{$cat_title}</td>";
          echo "<td>{$post_title}</td>";
          echo "<td>{$post_status}</td>";
         echo "<td><img width='100' src='../images/$post_image' alt='مش هتشتغل تمام'></td>";
        echo "<td>{$post_tags}</td>";

$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
$send_comment_query = mysqli_query($connection,$query);
$row =  mysqli_fetch_array($send_comment_query);
$comment_id = $row['comment_id'];
$count_comment = mysqli_num_rows($send_comment_query);

        echo "<td><a href ='post_comments.php?id=$post_id'>{$count_comment}</a></td>";
        echo "<td>{$post_date}</td>";
         echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>view post </a></td>";
        echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>edit</a></td>";
        // echo "<td><a class='delete_link' href='javascript:void(0)' rel='$post_id'>Delete</a></td>";
?>
<form method="post">
  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
<?php  echo "<td><input class='btn btn-danger' value='delete' type='submit' name='delete'> </td>"; ?>
</form>
<?php
        // echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure want to delete?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
   echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
          echo "</tr>";

}

?>
    </tbody>
</table>
</form>
<?php
if (isset($_POST['delete'])) {
  $the_post_id = $_POST['post_id'];
  // $query =" DELETE FROM posts WHERE post_id = {$the_post_id}";
  $query=" DELETE posts , comments FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE posts.post_id = {$the_post_id} ";
  $delete_query = mysqli_query($connection ,$query);
  header("location:posts.php");
 } 


 if (isset($_GET['reset'])) {
   # code...
  $the_post_id = $_GET['reset'];
  $query =" UPDATE   posts SET post_views_count = 0  WHERE post_id= " .mysqli_real_escape_string($connection,$_GET['reset']) ." ";
  $delete_query = mysqli_query($connection ,$query);
  header("location:posts.php");
 } 
?>
<!-- <script type="text/javascript">
  $(document).ready(function(){
    $(".delete_link").on('click',function(){
      var id = $(this).alert("rel");
      var delete_url = "posts.php?delete="+ id + "";
      $(".modal_delete_link").attr("href",delete_url);
      $("#myModal").modal('show');

    });
  });
</script> -->

<script type="text/javascript">

$(document).ready(function(){
    $(".selectAllBoxes").on('click',function(){
      alert("fedgfh");

    });
  });

</script>