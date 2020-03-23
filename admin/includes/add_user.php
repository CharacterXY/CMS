
<?php 
   if(isset($_POST['add_user'])){
  
   $user_firstname = $_POST['user_firstname'];
   $user_lastname = $_POST['user_lastname'];
   $user_role = $_POST['user_role'];
  /*  $user_image = $_FILES['user_image']['name'];
   $user_image_temp = $_FILES['user_image']['tmp_name']; */
   $username = $_POST['username'];
   $user_email = $_POST['user_email'];
   $user_password = $_POST['user_password'];
   
   

   /* move_uploaded_file($user_image_temp, "../images/$user_image" ); */

   $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}') ";

   $create_user_query = mysqli_query($connection, $query);

   confirmQuery($create_user_query);
  
}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class=post_status">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
        <?php echo "<br />"; ?>
    </div>


    <div class="form-group">
    
        <select name="user_role" id="">
           <option value="subsriber">Select Options</option>
           <option value="admin">Admin</option>
           <option value="subsriber">Subscriber</option>

        </select>

    </div>


  <!--   <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" class="form-control" name="user_image">
    </div>
 -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add user">
    </div>
</form>
    