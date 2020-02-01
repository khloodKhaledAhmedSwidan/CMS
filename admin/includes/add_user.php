  <?php

  if (isset($_POST['create_user'])) {
  	# code...
  	 $user_firstname =$_POST['user_firstname'];
  	$user_lastname =$_POST['user_lastname'];
  	$user_role = $_POST['user_role'];
  	$username =$_POST['username'];
// $post_image =$_FILES['image']['name'];
// $post_image_temp =$_FILES['image']['tmp_name'];
$user_email =$_POST['user_email'];
$user_password =$_POST['user_password'];
// $post_date =date('d-m-y');
// $post_comment_count = 4;
// move_uploaded_file($post_image_temp, "../images/$post_image");
// $query =" INSERT INTO posts(post_category_id,post_title,post_author,post_image,post_date,post_content,post_tags,post_comment_count,post_status)";
// $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}','{$post_image}',now(),'{$post_content}','{$post_tags}','{$post_status}')";
// $create_post_query = mysqli_query($connection,$query);
// comfirmQuery($create_post_query);
$password = password_hash($user_password, PASSWORD_BCRYPT,array('cost' =>12));
   $query ="  INSERT INTO users(user_firstname , user_lastname ,user_role ,username , user_email , user_password )";
   $query .= "VALUES('{$user_firstname}' , '{$user_lastname}' , '{$user_role}' , '{$username}' , '{$user_email}' ,'{$password}')";
   $create_user_query = mysqli_query($connection ,$query);
   comfirmQuery($create_user_query);

   echo "user created " . " " ."<a href='users.php'>view user</a>";
  }
  ?>



  <form action="" method="post" enctype="multipart/form-data">
	
<div class="form-group">
	<label for="firstname"> firstname</label>
	<input type="text" name="user_firstname" class="form-control">
</div>

<div class="form-group">
	<label for="lastname"> lastname</label>
	<input type="text" name="user_lastname" class="form-control">
</div>

<div class="form-group">
	<select name="user_role" id="">
<option value="selectoption">select option</option>
		<option value="admin">Admin</option>
		<option value="subscriber">subscriber</option>
	</select>
</div>
<div class="form-group">
	<label for="username"> username</label>
	<input type="text" name="username" class="form-control">
</div>
<div class="form-group">
	<label for="user_email"> email</label>
	<input type="email" name="user_email" class="form-control">
</div>
<!-- <div class="form-group">
	<label for="post_image"> Post Image</label>
	<input type="file" name="image" >
</div> -->


<div class="form-group">
	<label for="user_password"> password</label>
	<input type="password" name="user_password" class="form-control">
</div>



<div class="form-group">

	<input type="submit"  value="add user" name="create_user" class="btn btn-primary">
</div>

</form>