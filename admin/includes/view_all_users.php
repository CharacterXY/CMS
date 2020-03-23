
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>DELETE</th>    
               
        </tr>
    </thead>
    <tbody>

<?php
$query = "SELECT * FROM users";
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

    echo "<tr>";

    echo "<td>{$user_id}</td>";
    echo "<td>{$username}</td>";
    echo "<td>{$user_firstname}</td>";
    echo "<td>{$user_lastname}</td>";
    echo "<td>{$user_email}</td>";
    echo "<td>{$user_role}</td>";
    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
    echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>EDIT</a></td>";
    echo "<td><a href='users.php?delete={$user_id}'>DELETE</a></td>";


    echo "</tr>";

}
    
    /* $query_comments = "SELECT * FROM categories WHERE category_id = {$post_category_id} ";
    $post_category_id = mysqli_query($connection, $query_category);
                                        
    while($row = mysqli_fetch_assoc($post_category_id)){
    $cat_id = $row['category_id'];
    $cat_title = $row['category_name'];
    } */
    
 

?>                                 
    </tbody>
</table>

<?php

if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");

}

if(isset($_GET['change_to_subscriber'])){
    $the_user_id = $_GET['change_to_subscriber'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $change_to_subscriber_query = mysqli_query($connection, $query);
    header("Location: users.php");

}


if(isset($_GET['delete'])){
    $user_id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = {$user_id}";
    $delete_user = mysqli_query($connection, $query);

    if(!$delete_user){
        die("MYSQL ERROR " .mysqli_error($connection));
    } else {   
        header("Location: users.php");
        
    } 
}
?>