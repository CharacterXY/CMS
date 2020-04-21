<?php 

if(isset($_GET['edit_user'])){
   $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }



    if(isset($_POST['edit_user'])){
  
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    /*  $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name']; */
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

   /*  $query = "SELECT randSalt FROM users ";
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query){
        die("QUERY FAILD " . mysqli_error($connection));
    }

    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password, $salt); */

    if(!empty($user_password)) {

        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
        $get_user = mysqli_query($connection, $query_password);
        confirmQuery($get_user);

        $row = mysqli_fetch_array($get_user);

        $db_user_password = $row['user_password'];

        // if password in field is not same like password in databse then we need to bycrypt password
        if($db_user_password != $user_password){
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        } 

        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="username = '{$username}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$hashed_password}' ";
        $query .="WHERE user_id = {$the_user_id} ";
     
        $update_user = mysqli_query($connection, $query);
        confirmQuery($update_user); 


    }
   
   //move_uploaded_file($user_image_temp, "../images/$user_image" ); 

} 

} else {
    header("Loaction: index.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>

    <div class=post_status">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
        <?php echo "<br />"; ?>
    </div>


    <div class="form-group">
    
        <select name="user_role" id="">

    
           <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
           <?php
           if($user_role == 'admin'){
               echo "<option value='subscriber'>Subscriber</option>";
           } else {
               echo "<option value='admin'>Admin</option>";
           }

           ?>
       
        </select>
    </div>
    
  <!--   <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" class="form-control" name="user_image">
    </div>
 -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email"value="<?php echo $user_email; ?>"">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Add user">
    </div>
</form>
    