    <?php
if (isset($_GET['p_id'])) {
	# code...
	$the_user_id = $_GET['p_id'];
}
    $query = " SELECT * FROM  users WHERE user_id = $the_user_id";
$select_user_by_id = mysqli_query($connection,$query);
while ($row = mysqli_fetch_assoc($select_user_by_id)) {
    # code...
         $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password =$row['user_password'];
    $user_firstname =$row['user_firstname'];
     $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];

        $user_role = $row['user_role'];
}
 
if (isset($_POST['update_user'])) {
	# code...
    $user_firstname = $_POST['user_firstname'];
     $user_lastname = $_POST['user_lastname'];
      $user_role = $_POST['user_role'];
       $username = $_POST['username'];
        $user_email = $_POST['user_email'];
         $user_password = $_POST['user_password'];



   // $query = "SELECT randsalt FROM users";
   //     $select_randsalt_query = mysqli_query($connection ,$query);
   //     if (!$select_randsalt_query) {
   //         # code...
   //      die("query failed :". mysqli_error($connection));
   //     }
   //     $row = mysqli_fetch_array($select_randsalt_query);
   //     $randsalt = $row['randsalt'];
   //     $password = crypt($user_password,$randsalt);


$password = password_hash($user_password, PASSWORD_BCRYPT,array('cost' =>12));

$query = " UPDATE users SET ";
$query .=  " user_firstname = '{$user_firstname}' , ";
$query .= "user_lastname = '{$user_lastname}' , ";
$query .= "user_role = '{$user_role}' , ";
$query .= "username = '{$username}' , ";
$query.= "user_email = '{$user_email}' , ";
$query .= "user_password = '{$password}' ";

$query  .=  " WHERE user_id = {$the_user_id} ";

$update_query = mysqli_query($connection ,$query);
comfirmQuery($update_query);
}

?>

    <form action="" method="post" enctype="multipart/form-data">




<div class="form-group">
	<label for="user_firstname"> firstname</label>
	<input  value="<?php echo $user_firstname; ?>" type="text" name="user_firstname" class="form-control">
</div>
<div class="form-group">
	<label for="user_lastname"> lastname</label>
	<input value="<?php echo $user_lastname;?>" type="text" name="user_lastname" class="form-control">
</div>

<div class="form-group">
    <select name="user_role" id="">
 
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>


        <?php 
if ($user_role == 'admin') {
    # code...
    echo "<option value='subscriber'>subscriber</option>";  
} else {
    # code...

    echo "<option value='admin'>admin</option>";
}


        ?>

    </select>
</div>

<div class="form-group">
	<label for="username"> username</label>
	<input type="text"  value="<?php echo $username;?>"  name="username" class="form-control">
</div>

<div class="form-group">
	<label for="user_email"> email</label>
	<input type="email" value="<?php echo $user_email; ?>" name="user_email" class="form-control">
</div>


<div class="form-group">
    <label for="user_password"> password</label>
    <input autocomplete="off" type="password"  name="user_password" class="form-control">
</div>


<div class="form-group">

	<input type="submit"  value="update user" name="update_user" class="btn btn-primary">
</div>

</form>