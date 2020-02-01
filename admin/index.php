<?php  include "includes/admin_header.php"; ?>

    <div id="wrapper">

<?php

?>


        <!-- Navigation -->
  

<?php  include "includes/admin_navigation.php"; ?>



        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
welcome to admin                            <small><?php  echo $_SESSION['username']; ?></small>
                        </h1>
               
                    </div>
                </div>
                <!-- /.row -->




       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">


 <div class='huge'><?php echo $post_count = recordCount('posts'); ?></div>




                 
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">



 <div class='huge'><?php echo $comment_count= recordCount('comments'); ?></div>



                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
 <div class='huge'><?php echo $user_count=recordCount('users'); ?></div>


                
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
 <div class='huge'><?php echo $category_count=recordCount('categories'); ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

<?php




// $query = " SELECT * FROM posts WHERE post_status = 'published' ";
// $select_published_posts = mysqli_query($connection,$query);
// $post_published_count = mysqli_num_rows($select_published_posts);
$post_published_count = checkStatus('posts', 'post_status'  , 'published');

// $query = " SELECT * FROM posts WHERE post_status = 'draft' ";
// $select_draft_posts = mysqli_query($connection,$query);
// $post_draft_count = mysqli_num_rows($select_draft_posts);
 
$post_draft_count = checkStatus('posts', 'post_status'  , 'draft');

// $query = " SELECT * FROM comments WHERE  comment_status = 'unapprove' ";
// $select_unapprove_comments = mysqli_query($connection,$query);
// $comment_unapprove_count = mysqli_num_rows($select_unapprove_comments);

$comment_unapprove_count = checkStatus('comments', 'comment_status'  , 'unapproved');

// $query = " SELECT * FROM users WHERE    user_role = 'subscriber' ";
// $select_subscriber_users = mysqli_query($connection,$query);
// $user_subscriber_count = mysqli_num_rows($select_subscriber_users);
$user_subscriber_count =  checkUserRole('users' , 'user_role' ,'subscriber');

?>


                <div class="row">
                    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'count'],

<?php
$element_text =['all posts','active posts' ,'draft posts', 'comments' ,'unapprove comments', 'users' ,'subscriber users',            'categorys']; 
$element_count = [$post_count,$post_published_count,$post_draft_count ,$comment_count,                 $comment_unapprove_count, $user_count ,  $user_subscriber_count, $category_count];
for ( $i = 0; $i < 7; $i++) {
    echo "['{$element_text[$i]}' " . " ," . "{$element_count[$i]} ] ,";
}
?>






        
        
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
     <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php  include "includes/admin_footer.php"; ?>