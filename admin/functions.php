<?php

function users_online(){

    if(isset($_GET['onlineusers'])){

        global $connection;
 
            if(!$connection){

            session_start();
            include ("../includes/db.php"); 

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;
    
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_qurey = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_qurey);
    
            if($count == NULL){
    
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
            } else {
    
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }
    
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    }
}

users_online();


function confirmQuery($result){
    
    global $connection;
    if(!$result){
        die("<b>QUERY FAILD</b> " . mysqli_error($connection));
    }
}



function insert_categories(){
    if(isset($_POST['submit'])){

        global $connection;
        echo "jea";
                           
        $category_name = $_POST['category_name'];

        if($category_name === "" || empty($category_name)){
            echo "<h4>This field should not be empty</h4>";
        } else {

            $query = "INSERT INTO categories(category_name) VALUE('{$category_name}')";
        
            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){
                die('QUERY FAILD' . mysqli_error($connection));
            } else {
                echo "<small>Data Recorded !</small>";
            }
        }
    
    }  
}


function findAllCategories(){

    global $connection;

    
    $query = "SELECT * FROM categories";

    $search_query = mysqli_query($connection, $query);



while($row = mysqli_fetch_assoc($search_query)){
     $cat_id = $row['category_id'];
     $cat_title = $row['category_name'];
    
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>DELETE  ?</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>EDIT ?</a></td>";
    
    echo "</tr>";
    
}

}


function deleteCategories(){

    global $connection;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];

    $query = "DELETE FROM categories WHERE category_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: categories.php");
    }
}

?>