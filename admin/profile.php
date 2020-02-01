<?php  include "includes/admin_header.php"; ?>



<?php
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '{$username}'";
$select_user_profile = mysqli_query($connection ,$query);
if (!$select_user_profile) {
    # code...
    die("query failed :". mysqli_error($connection));
}
while ($row = mysqli_fetch_array($select_user_profile)) {
    # code...
        $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password =$row['user_password'];
    $user_firstname =$row['user_firstname'];
     $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
        $user_role = $row['user_role'];
}


}
?>
<?php
if (isset($_POST['update_user'])) {
    # code...
    $user_firstname = $_POST['user_firstname'];
     $user_lastname = $_POST['user_lastname'];
      $user_role = $_POST['user_role'];
       $username = $_POST['username'];
        $user_email = $_POST['user_email'];
         $user_password = $_POST['user_password'];
$password = password_hash($user_password, PASSWORD_BCRYPT,array('cost' =>12));
echo $password;
$query = " UPDATE users SET ";
$query .=  " user_firstname = '{$user_firstname}' , ";
$query .= "user_lastname = '{$user_lastname}' , ";
$query .= "user_role = '{$user_role}' , ";
$query .= "username = '{$username}' , ";
$query.= "user_email = '{$user_email}' , ";
$query .= "user_password = '{$password}' ";
$query .= "WHERE username = '{$username}' ";
 $update_user_profile_query = mysqli_query($connection ,$query);
}
?>

    <div id="wrapper">




        <!-- Navigation -->
  

<?php  include "includes/admin_navigation.php"; ?>



        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
     <h1 class="page-header">
                 welcome to admin  
                    <small>author</small>
                        </h1>




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
 
        <option value="user_role"><?php echo $user_role; ?></option>


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
    <input type="password" autocomplete="off"  name="user_password" class="form-control">
</div>


<div class="form-group">

    <input type="submit"  value="update profile" name="update_user" class="btn btn-primary">
</div>

</form>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php  include "includes/admin_footer.php"; ?>