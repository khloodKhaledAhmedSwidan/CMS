<?php  include "includes/admin_header.php"; ?>
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
<!-- add category form -->
<div class="col-xs-6">
<?php  insert_categories(); ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Add Category</label>
            <input type="text" name="cat_title" class="form-control">
        </div>
        <div class="form-group">
            
        <input class="btn btn-primary" type="submit" name="submit" value="add Category">
        </div>
    </form>
<?php
// update&include query
if (isset($_GET['edit'])) {
    $cat_id =$_GET['edit'];
    include "includes/update_categories.php";
}
?>
</div>
<div class="col-xs-6 container">
    <table class="table table-striped table-bordered table-hover" >
        <thead>
            <tr>
                <td>Id</td>
                <td>category title</td>
                <td>Delete</td>
                <td>Edit</td>
            </tr>
        </thead>
        <tbody>
<?php
//find all categories query
findAllCategories();
?>
<!-- <form method="post">
    <input type="hidden" name="cat_id" value="<?php //echo $cat_id; ?>">
</form> -->

    <?php
deleteCategories();
?>

        </tbody>
    </table>

</div>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php  include "includes/admin_footer.php"; ?>