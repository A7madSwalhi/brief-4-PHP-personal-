<?php 
require_once("config.php");
function db_delete(string $table,  $id): mixed
    {
        global $conn;
        $sql = "DELETE FROM " . $table . " WHERE category_id=" . $id;
        $query = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $query;
    }

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        if(db_delete('categories',  $_GET['id'])){
            header("location: Admincategories.php");
            exit();
        }

    }
}




?>