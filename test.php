




<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {



            image_added = false
         if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] ) {
           // file is uploaded


            $folder = 'uploads';
          if (!file_exists($folder)) {
            mkdir($folder, 0777, true).
          }

          $destination = $folder.$_FILES['image']['tmp_name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $destination)
          image_Added= true;
         }
    
        $username = addslashes($_POST['username']);
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);
        $id = $_SESSION['user_info']['id'];


        if($image_added = true) {

          $query = "UPDATE users SET username =  '$username','$username', 'email =$email', 'password =$password', 'image =$image' WHERE id = '$id' ";
        }else {
          $query = "UPDATE users SET username =  '$username','$username', 'email =$email', 'password =$password', WHERE id = '$id' ";
        }
  

        $result = mysqli_query($con , $query);


          $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1 "
          $result = mysqli_query($con , $query);

        if (mysqli_num_rows($result)) {
          $_SESSION['user_info'] = mysqli_fetch_assoc($result)
        }

        header("Location:profile.php");
        die;
  }

 ?>