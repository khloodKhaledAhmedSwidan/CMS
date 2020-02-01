
            <div class="col-md-4">


                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <!-- form for search -->
                    <form method="post" action="search.php">
                    <div class="input-group">
                        <input  name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                </form> 
                    <!-- /.input-group -->
                </div>
  


  

       <div class="well">
   <?php 
        if(isset($_SESSION['username'])){
          echo "<h4>logged in as {$_SESSION['username']}</h4>"; 
          echo "<a href='includes/logout.php' class='btn btn-primary'> logout </a>";  
        }else {
 

         ?> 
 
            

    
            <h4>login</h4>
                     <form method="post" action="includes/login.php">
                    <div class="form-group">
                        <input  name="username"  placeholder="enter your name" type="text" class="form-control"
  autocomplete="on" 
      value="<?php echo isset($username) ? $username : '' ;?>"  
                        >
                   
                    </div>
                       <div class="form-group">
                        <input  name="password"  placeholder="enter your password" type="password" class="form-control">
                   <span class="input-group-btn">
                       <button class="btn btn-primary" name="login" type="submit">
                           login
                       </button>
                   </span>
                    </div>
                  
                </form> 
                <?php } ?> 

                    

                    <!-- /.input-group -->
                </div>
                <!-- Blog Categories Well -->
                <div class="well">

<?php  
$query = "SELECT * FROM categories";
$select_categories_sidebar = mysqli_query($connection,$query);
?>

                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

<?php
while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
    # code...
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
}  
?>

                            </ul>
                        </div>
                   
                    </div>
                    <!-- /.row -->
                </div>

<!--               <?php  //include "includes/widget.php"; ?> -->

            </div>