<?php 
require_once("config.php");
function db_delete(string $table,  $id): mixed
    {
        global $conn;
        $sql = "DELETE FROM " . $table . " WHERE user_id=" . $id;
        $query = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $query;
    }

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        if(db_delete('users',  $_GET['id'])){
            header("location: adminuser.php");
            exit();
        }

    }
}




?>