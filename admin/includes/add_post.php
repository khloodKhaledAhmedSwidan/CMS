  <?php
  if (isset($_POST['create_post'])) {
  	# code...
  	$post_title = $_POST['title'];
  	$post_category_id = $_POST['post_category'];
  	$post_user = $_POST['users'];
  	$post_status = $_POST['post_status'];
$post_image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];
$post_tags = $_POST['post_tags'];
$post_content = $_POST['post_content'];
$post_date = date('d-m-y');
// $post_comment_count = 4;
move_uploaded_file($post_image_temp, "../images/$post_image");
$query =" INSERT INTO posts(post_category_id,post_title,post_user,post_image,post_date,post_content,post_tags,post_status)";
$query .= " VALUES({$post_category_id},'{$post_title}','{$post_user}','{$post_image}',now(),'{$post_content}','{$post_tags}','{$post_status}')";
$create_post_query = mysqli_query($connection,$query);
comfirmQuery($create_post_query);
$the_post_id = mysqli_insert_id($connection);
echo "<p class='bg-success'>created post<a href='../post.php?p_id=$the_post_id'>view post</a> or <a href='posts.php'>edit more posts</a></p>";


  }
  ?>



  <form action="" method="post" enctype="multipart/form-data">
	
<div class="form-group">
	<label for="title"> Post Title</label>
	<input type="text" name="title" class="form-control">
</div>

<div class="form-group">
		<label for="category"> category</label>

	<select name="post_category" id="">

		<?php
		    $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection,$query);
    comfirmQuery($select_categories);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        # code...
        $cat_id = $row['cat_id'];
        $cat_title =$row['cat_title']; 
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }

		?>
		
	</select>
</div>

<div class="form-group">



<div class="form-group">
		<label for="author"> users</label>

	<select name="users" id="">

		<?php
		    $users_query = "SELECT * FROM users ";
    $select_users = mysqli_query($connection,$users_query);
    comfirmQuery($select_users);
    while ($row = mysqli_fetch_assoc($select_users)) {
        # code...
        $user_id = $row['user_id'];
        $username =$row['username']; 
        echo "<option value='{$username}'>{$username}</option>";
    }

		?>
		
	</select>
</div>




	<select name="post_status" id="">
		<option value="draft">post status</option>
		<option value="published">publish</option>
		<option value="draft">draft</option>
	</select>

</div>
<div class="form-group">
	<label for="post_image"> Post Image</label>
	<input type="file" name="image" >
</div>


<div class="form-group">
	<label for="post_tags"> Post Tags</label>
	<input type="text" name="post_tags" class="form-control">
</div>



<div class="form-group">
	<label for="post_content"> Post Content</label>
	<textarea class="form-control" name="post_content" id="body" rows="10" cols="30">    </textarea>
</div>
<div class="form-group">

	<input type="submit"  value="Publish Post" name="create_post" class="btn btn-primary">
</div>

</form>