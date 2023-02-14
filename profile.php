
<?php 

require "functions.php";

check_login();
 ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile | SocialMeet</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">

<?php 
  require "header.php";

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) &&  $_POST['action'] ==  'delete') {
    $_SESSION['user_info']['id'];
    $query = "DELETE from users WHERE id  = '$id' LIMIT 1 ";
    $result = mysqli_query($con , $query);

    
    header('Location:logout.php');
    die;


   }

     elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username'])) {


          $image_added = false;
          if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] ==0) {
            // file is uplaoded

            $folder = 'uploads/';

            if (!file_exists( $folder)) {
              mkdir( $folder ,0777, true);
            }

            $image = $folder.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
            if (file_exists($_SESSION['user_info']['image'])) {
              unlink($_SESSION['user_info']['image']);
            }
            $image_added = true;
          }


        $username = addslashes($_POST['username']);
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);
        $id = $_SESSION['user_info']['id'];


        if ($image_added == true) {
          $query = "UPDATE users SET username = '$username',
                                  email = '$email', 
                                  password = '$password', 
                                  image = '$image' WHERE id = '$id'";
        }else {
          $query = "UPDATE users SET username = '$username',
                                  email = '$email', 
                                  password = '$password'
                                  WHERE id = '$id'";
        }

        $result = mysqli_query($con , $query);
        header("Location:profile.php");
        die;
  }

 ?>


            <?php if(!empty($_GET['action']) && $_GET['action'] == 'edit'): ?>

             
    <form method="post" enctype="multipart/form-data" >
      
        <div class="commentBox">
                        <div class="form-group"> 
                        <label>Edit Profile</label><br>
                          <div class="widget-user-image" style="margin-bottom:50px">
                           <img class="img-circle elevation-2"  name = "image" src="<?php echo $_SESSION['user_info']["image"]; ?>" alt="User Avatar"  style = "height: 100px; width: 100px;">
                           </div>
                          <input type="file" name="image"><br><br>
                            <input type="text" value="<?php echo $_SESSION['user_info']['username']?>" class="form-control" name="username" placeholder="Username" style="margin-bottom:10px"> 
                             <input type="email" value="<?php echo $_SESSION['user_info']['email']?>"class="form-control" name="email" placeholder="Email" style="margin-bottom:10px"> 
                              <input type="password" value="<?php echo $_SESSION['user_info']['password']?>"class="form-control" name="password" placeholder="Password" style="margin-bottom:10px">                   
                         </div>

                         <button type="submit" class="btn btn-default btn-sm"> Save</button>
                        <a href="profile.php">
                           <button type="button" class="btn btn-default btn-sm"> Cancel</button>
                        </a>
                         <br><br>
        
       
      </div>
    </form>


            <?php elseif(!empty($_GET['action']) && $_GET['action'] == 'delete'): ?>

             
    <form method="post" enctype="multipart/form-data" >
      
        <div class="commentBox">
                        <div class="form-group"> 
                        <label>Are you sure you want to delete your Profile</label><br>
                          <div class="widget-user-image" style="margin-bottom:50px">
                           <img class="img-circle elevation-2"  name = "image" src="<?php echo $_SESSION['user_info']["image"]; ?>" alt="User Avatar"  style = "height: 100px; width: 100px;">
                           </div>
                          
                            <div><?php echo $_SESSION['user_info']['username']?></div> 
                             <div><?php echo $_SESSION['user_info']['email']?> </div>
                                              
                         </div>

                         <button type="submit" class="btn btn-default btn-sm">Delete<button>
                          <input type="hidden" name="action" value="delete">
                        <a href="profile.php">
                           <button type="button" class="btn btn-default btn-sm"> Cancel</button>
                        </a>
                         <br><br>
        
       
      </div>
    </form>
            <?php else : ?>
      <div class="NewsFeedProfile">


        <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"> <?php echo $_SESSION['user_info']['username']; ?></h3>
               
              </div>
              <div class="widget-user-image" style="margin-bottom:50px">
                <img class="img-circle elevation-2" src="<?php echo $_SESSION["user_info"]['image']; ?>"alt="User Avatar">
              </div>
          
                 
            </div>
                <div class="profileActionButton" >
                <a href="profile.php?action=edit" >
                   <button type="button" class="btn btn-block btn-dark ">Edit Profile</button>
                </a>
         

           <a href="profile.php?action=delete" style="margin-top:40px">
                   <button type="button" class="btn btn-block btn-dark ">Delete Profile</button>
                </a>
                </div>
      </div>


      <div class="commentBox">
         <div class="form-group">
                        <label>Create Post</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                      </div>

                         <button type="button" class="btn btn-default btn-sm"> Browse</button>
                         <button type="button" class="btn btn-default btn-sm"> Post</button>
                         <br><br>
        
           <div class="card card-widget">
           
              <!-- /.card-header -->
              <div class="card-body">
                <img class="img-fluid pad" src="dist/img/photo2.png" alt="Photo">

                <p>I took this photo this morning. What do you guys think?</p>
             
                <span class="float-right text-muted">127 likes - 3 comments</span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="dist/img/user3-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="dist/img/user4-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Luna Stark
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
          
              <!-- /.card-footer -->
            </div>
      </div>

    <?php endif; ?>


<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

</body>
</html>
