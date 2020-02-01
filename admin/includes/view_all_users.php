
<table class="table table-bordered table-hover">
    <thead>
        <tr>

        <th>Id</th>
        <th>username</th>
        <th>first name</th>
        <th>last name</th>
        <th>email </th>
        <th>role</th>
     <th>Admin</th>
     <th>Subscriber</th>
     <th>Edit</th>
     <th>Delete</th>
        </tr>
    </thead>
    <tbody>
<?php
    $query = " SELECT * FROM users ";
$select_users = mysqli_query($connection,$query);
while ($row = mysqli_fetch_assoc($select_users)) {
    # code...
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname =$row['user_firstname'];
     $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];

        $user_role = $row['user_role'];
     
          echo "<tr>";
          echo "<td>{$user_id}</td>";
          echo "<td>{$username}</td>";

//     $query = " SELECT * FROM categories WHERE cat_id =  {$post_category_id} ";
//     $select_categories_id = mysqli_query($connection,$query);
//     while ($row = mysqli_fetch_assoc($select_categories_id)) {
//         # code...
//         $cat_id = $row['cat_id'];
//         $cat_title =$row['cat_title'];
// }
           echo "<td>{$user_firstname}</td>";
          echo "<td>{$user_lastname}</td>";
          echo "<td>{$user_email}</td>";
         // echo "<td><img width='100' src='../images/$user_image' ></td>";
        echo "<td>{$user_role}</td>";
     echo "<td><a class='btn btn-default' href='users.php?change_to_admin=$user_id'>Admin</a></td>";
        echo "<td><a class='btn btn-default' href='users.php?change_to_subscriber=$user_id'>subscriber</a></td>";
        echo "<td><a class='btn btn-info' href='users.php?source=edit_user&p_id={$user_id}'>edit</a></td>";
        echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure want to delete?');\" href='users.php?delete={$user_id}'>Delete</a></td>";
          echo "</tr>";

}


?>

    
    </tbody>
</table>

<?php

if (isset($_GET['change_to_admin'])) {
   # code...
  $the_user_id = $_GET['change_to_admin'];
  $query ="UPDATE users SET  user_role ='admin' WHERE user_id =                     $the_user_id";
  $change_to_admin_query = mysqli_query($connection ,$query);
  header("location:users.php");
 } 

if (isset($_GET['change_to_subscriber'])) {
  # code...
  $the_user_id = $_GET['change_to_subscriber'];
  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
  $change_to_subscriber_query = mysqli_query($connection ,$query);
  header("location:users.php");
}



if (isset($_GET['delete'])) {

    if (isset($_SESSION['userrole'])) {
      if ($_SESSION['userrole'] == 'admin') {
       $the_user_id = $_GET['delete'];
  $query =" DELETE FROM users WHERE user_id = {$the_user_id}";
  $delete_query = mysqli_query($connection ,$query);
  header("location:users.php");
      }

  }

 } 
?>