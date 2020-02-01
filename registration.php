<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = trim($_POST['username']);
    $user_firstname = trim($_POST['user_firstname']);
    $user_lastname = trim($_POST['user_lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = ['username'=>'',
    'user_firstname'=>'',
    'user_lastname'=>'',
    'email'=>'',
    'password' => ''
  ];
    if (strlen($username) < 4) {
      $error['Username'] = 'username needs to be longer ';
    }
    if ($username == '') {
      $error['username'] = 'username can not be empty';
    }
    if (username_exists($username)) {
$error['username'] = 'username already exist';
}
   if ($user_firstname == '') {
      $error['user_firstname'] = 'firstname can not be empty';
    }

if ($user_lastname == '') {
      $error['user_lastname'] = 'lastname can not be empty';
    }

  
    if ($email == '') {
      $error['email'] = 'email can not be empty , <a href="index.php">please login</a>';
    }
    if (email_exists($email)) {
$error['email'] = 'email already exist ';
}
  if ($password == '') {
      $error['password'] = 'password can not be empty';
    }

foreach ($error as $key => $value) {
  if (empty($value)) {
    unset($error[$key]);
 
  login_user($username ,$password);
  }
}

if (empty($error)) {
 register_user($username,$user_firstname,$user_lastname,$email,$password);
}

}
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                      <!--   <h6 class="text-center"><?php //echo $message;?></h6> -->
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" 
      value="<?php echo isset($username) ? $username : '' ;?>"  >
      <p><?php echo isset($error['username'])? $error['username']:''; ?></p>
                        </div>
                          <div class="form-group">
                            <label for="user_firstname" class="sr-only">firstname</label>
                            <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="Enter your firstname"
autocomplete="on" 
      value="<?php echo isset($user_firstname) ? $user_firstname : '' ;?>" >
        <p><?php echo isset($error['user_firstname'])? $error['user_firstname']:''; ?></p>
                          
                        </div>
                          <div class="form-group">
                            <label for="user_lastname" class="sr-only">lastname</label>
                            <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="Enter your lastname"

autocomplete="on" 
      value="<?php echo isset($user_lastname) ? $user_lastname : '' ?>" >
    <p><?php echo isset($error['user_lastname'])? $error['user_lastname']:''; ?></p>

                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"

autocomplete="on" 
      value="<?php echo isset($email) ? $email : '' ?>"

                            >
      <p><?php echo isset($error['email'])? $error['email']:''; ?></p>

                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                              <p><?php echo isset($error['password'])? $error['password']:''; ?></p>
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
