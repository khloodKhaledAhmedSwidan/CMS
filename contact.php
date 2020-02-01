<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php
if (isset($_POST['submit'])) {
    # code...
    $to = "khloodkhaledswidan420@gmail.com";
    $subject =wordwrap($_POST['subject'],70);
    $body =$_POST['body'];
 
$header = "from :" .$_POST['email'];
mail($to, $subject ,$body ,$header);


     

  
   
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
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                      
                   
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                             <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="enter your subject">
                        </div>
                         <div class="form-group">
                         <textarea class="form-control" id="body" name="body" cols="50" rows="10"> </textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
