

<?php 

require "connection.php";



function check_login()

{

    if (empty($_SESSION['user_info'])) {
        
        header("Location:login.php");
    }
}

 ?>