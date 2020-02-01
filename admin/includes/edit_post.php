    <?php
if (isset($_GET['p_id'])) {
	# code...
	$the_post_id = $_GET['p_id'];
}
    $query = " SELECT * FROM posts ";
$select_post_by_id = mysqli_query($connection,$query);
while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_id =  $row['post_id'];
     $post_user  = $row['post_user'];
    $post_category_id  = $row['post_category_id'];
     $post_title = $row['post_title'];
    $post_status = $row['post_status'];
      $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_comment_count = $row['post_comment_count'];
          $post_date = $row['post_date'];

}

if (isset($_POST['update_post'])) {
	# code...
 	$post_title = $_POST['post_title'];
  	$post_category_id = $_POST['post_category'];

      $post_user = $_POST['post_user'];
  	$post_status = $_POST['post_status'];
$post_image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];
$post_tags = $_POST['post_tags'];
$post_content = $_POST['post_content'];
move_uploaded_file($post_image_temp , "../images/$post_image");
if (empty($post_image)) {
	# code...
	$query = " SELECT post_image FROM posts WHERE post_id = $the_post_id ";
	$select_query = mysqli_query($connection , $query);
	while ($row = mysqli_fetch_array($select_query)) {
		# code...
		$post_image = $row['post_image'];
	}
}

$query  = " UPDATE posts SET";
$query  .=  " post_user =  '{$post_user}', ";
$query  .=  " post_title =  '{$post_title}', ";
$query  .=  " post_category_id = '{$post_category_id}', ";
$query  .=  " post_date = now(), ";
$query  .=  " post_status = '{$post_status}', ";
$query  .=  " post_image = '{$post_image}', ";
$query  .=  " post_tags = '{$post_tags}', ";
$query  .=  " post_content = '{$post_content}'  ";
$query  .=  " WHERE post_id = {$the_post_id} ";

$update_query = mysqli_query($connection ,$query);
comfirmQuery($update_query);
echo "<p class='bg-success'>updated post<a href='../post.php?p_id=$the_post_id'>view post</a> or <a href='posts.php'>edit more posts</a></p>";
}



?>


    <form action="" method="post" enctype="multipart/form-data">
	
<div class="form-group">
	<label for="title"> Post Title</label>
	<input  value ="<?php echo $post_title; ?>" type="text" name="post_title" class="form-control">
</div>

<div class="form-group">
  <label for="post_category"> category</label>
	<select name="post_category" id="">

		<?php
		    $query = " SELECT * FROM categories ";
    $select_categories = mysqli_query($connection,$query);
    comfirmQuery($select_categories);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        # code...
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title']; 
      
        if ($cat_id == $the_post_id) {
        
              echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
        } else {
          
              echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
        
    }

		?>
		
	</select>
</div>



<div class="form-group">
  <label for="post_user"> users</label>
 
  <select name="post_user" id="">
 <?php  echo "<option  value='{$post_user}'>{$post_user}</option>"; ?>
    <?php
        $query = " SELECT * FROM users ";
    $select_user = mysqli_query($connection,$query);
    comfirmQuery($select_user);
    while ($row = mysqli_fetch_assoc($select_user)) {
    
        $user_id = $row['user_id'];
        $username = $row['username']; 
      
        
              echo "<option  value='{$username}'>{$username}</option>";
       
    }

    ?>
    
  </select>
</div>

<div class="form-group">
    <label for="post_status"> Post Status</label>
    <select name="post_status" id="">
 
        <option value='<?php echo $post_status; ?>'> <?php echo $post_status; ?></option>


        <?php 
if ($post_status == 'published') {
    # code...
    echo "<option value='draft'>draft</option>";  
} else {
    # code...

    echo "<option value='published'>publish</option>";
}


        ?>
   
    </select>
</div>

<div class="form-group">
	<img  width="100" src="../images/<?php echo $post_image; ?> " > 
	<input type="file" name="image" >
</div>


<div class="form-group">
	<label for="post_tags"> Post Tags</label>
	<input value="<?php echo $post_tags;?>" type="text" name="post_tags" class="form-control">
</div>

<div class="form-group">
	<label for="post_content"> Post Content</label>
	<textarea class="form-control" name="post_content" id="" rows="10" cols="30"> 
	<?php echo $post_content;?> 
	  </textarea>
</div>
<div class="form-group">

	<input type="submit"  value="update post" name="update_post" class="btn btn-primary">
</div>

</form>