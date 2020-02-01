<?php


// function users_online(){
// if (isset($_GET['onlineusers'])) {
//     global $connection;
// if (!$connection) {
// session_start();
// include '../includes/db.php';
// $session = session_id();
// $time = time();
// $time_out_in_seconds =  05;
// $time_out = $time - $time_out_in_seconds;
// $query = "SELECT * FROM  users_online WHERE session ='$session'";
// $sendQuery = mysqli_query($connection,$query);
// $count = mysqli_num_rows($sendQuery);
// if ($count == null) {
//     mysqli_query($connection , "INSERT INTO users_online(session,time) VALUES('$session','$time')");
// }else{
//     mysqli_query($connection ,"UPDATE users_online SET time='$time' WHERE session ='$session' ");
// }
// $user_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time> '$time_out'");
// echo $count_user = mysqli_num_rows($user_online_query);

// }
//  }
//  }
// users_online();


function redirect($location){


    header("Location:" . $location);
    exit;

}


function users_online(){ 
  global $connection;
  
$session = session_id();
$time = time();
$time_out_in_seconds =  30;
$time_out = $time - $time_out_in_seconds;
$query = "SELECT * FROM  users_online WHERE session ='$session'";
$sendQuery = mysqli_query($connection,$query);
$count = mysqli_num_rows($sendQuery);
if ($count == null) {
    mysqli_query($connection , "INSERT INTO users_online(session,time) VALUES('$session','$time')");
}else{
    mysqli_query($connection ,"UPDATE users_online SET time='$time' WHERE session ='$session' ");
}
$user_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time> '$time_out'");
return $count_user = mysqli_num_rows($user_online_query);
}



function comfirmQuery($result){
    global $connection;

    if (!$result) {
    # code...
    echo("query failed ." . mysqli_error($connection));
    //alert("query failed ." . mysqli_error($connection));
}
}

function insert_categories(){

global $connection;
if (isset($_POST['submit'])) {
    # code...
    // echo "hello";
    $cat_title = $_POST['cat_title'];
    if ($cat_title == "" || empty($cat_title)) {
        # code...
        echo "fill this field";
    } else {
        # code...
        $query = "INSERT INTO categories(cat_title)";
        $query .= "VALUE('{$cat_title}')";
        $create_category_query = mysqli_query($connection,$query);
        if (!$create_category_query) {
            # code...
            echo('query failed'. mysqli_error($connection));
        }
    }
    
}

}


function findAllCategories(){
	global $connection;
	$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection,$query);
while ($row = mysqli_fetch_assoc($select_categories)) {
    # code...
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";

// echo "<td><input class='btn btn-danger' value='delete' type='submit' name='delete'> </td>"; 

             echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

}
}

function deleteCategories(){
		global $connection;
	if (isset($_GET['delete'])) {
    # code...
    $the_cat_id = $_GET['delete'];
    
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
 // $query="DELETE categories , posts FROM categories  INNER JOIN posts ON categories.cat_id = posts.post_category_id WHERE categories.cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    header('location:categories.php');
}
}



function recordCount($table){
    global $connection;
$query = " SELECT * FROM " . $table;
$select_all_query = mysqli_query($connection,$query);
$result = mysqli_num_rows($select_all_query);

return ($result<1)?0:$result;

}


function checkStatus($table , $condition  , $valueOfCondition){
    global $connection;
    $query = " SELECT * FROM $table WHERE $condition = '$valueOfCondition' ";
$select_query = mysqli_query($connection,$query);
$result = mysqli_num_rows($select_query);
comfirmQuery($select_query);
return $result;
}


function is_admin($username){
        global $connection;
        $query ="SELECT user_role FROM users WHERE username = '$username'";
        $result = mysqli_query($connection ,$query);
     comfirmQuery($result);
     $row  = mysqli_fetch_array($result);
     if ($row['user_role'] == 'admin') {
         return true;
     } else {
     return false;
     }
     
}
function username_exists($username){
          global $connection;
        $query ="SELECT username FROM users WHERE username = '$username'";
        $result = mysqli_query($connection ,$query);
     comfirmQuery($result);
     if (mysqli_num_rows($result) > 0) {
        return true;
     }else{
        return false;
     }

}
function email_exists($email){
          global $connection;
        $query ="SELECT user_email FROM users WHERE user_email = '$email'";
        $result = mysqli_query($connection ,$query);
     comfirmQuery($result);
     if (mysqli_num_rows($result) > 0) {
        return true;
     }else{
        return false;
     }

}
function register_user($username,$user_firstname,$user_lastname,$email,$password){
  global $connection;
        $username = mysqli_real_escape_string($connection ,$username);
         $user_firstname = mysqli_real_escape_string($connection ,$user_firstname);
          $user_lastname = mysqli_real_escape_string($connection ,$user_lastname);
        $email = mysqli_real_escape_string($connection ,$email);
       $password = mysqli_real_escape_string($connection,$password);
$password = password_hash($password, PASSWORD_BCRYPT,array('cost' =>12));
       $query = " INSERT INTO users(username,user_firstname,user_lastname,user_email,user_password,user_role)";
       $query .= "VALUES('{$username}','{$user_firstname}','{$user_lastname}','{$email}' , '{$password}','subscriber')";
       $insert_user_query = mysqli_query($connection,$query);
       header("location:index.php");
comfirmQuery($insert_user_query);    
}
function login_user($username,$password){
    global $connection;
   $username = trim($username);
    $password = trim($password);
     $username = mysqli_real_escape_string($connection ,$username);
     $password = mysqli_real_escape_string($connection ,$password);
     $query = "SELECT * FROM users WHERE username = '{$username}' ";
     $selectUserQuery = mysqli_query($connection,$query);
  
    comfirmQuery($selectUserQuery);
    $db_Password= "";
     while ($row = mysqli_fetch_array($selectUserQuery)) {
    
         $db_UserId = $row['user_id'];
        $db_Usename = $row['username'];
        $db_Password = $row['user_password'];
        $db_UserFirstname = $row['user_firstname'];
        $db_UserLastname = $row['user_lastname'];
        $db_UserRole = $row['user_role'];

     }

     if (password_verify($password,$db_Password)) {
     $_SESSION['username'] = $db_Usename;
$_SESSION['firstname'] = $db_UserFirstname;
$_SESSION['lastname'] = $db_UserLastname;
$_SESSION['userrole'] =     $db_UserRole ;

        if ($db_UserRole ==  'admin') {       
  
// header("location: ../admin");
redirect("/cms/admin");
        }
        else
     {
        // header("location: ../index.php");
        redirect("../index.php");
     }

}
}
function checkUserRole($table , $condition ,$valueOfCondition){
global $connection;
$query = " SELECT * FROM $table WHERE    $condition = '$valueOfCondition' ";
$checkQuery = mysqli_query($connection ,$query);
    comfirmQuery($checkQuery);
    $result =  mysqli_num_rows($checkQuery);
    return $result;
}


?>