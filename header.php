
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        
        <span class="brand-text font-weight-light">SocialMeet</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav" style="padding-left: 280px;">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link">Profile</a>
          </li>
                  
                  <?php if(empty($_SESSION['user_info'])): ?>
              <li class="nav-item">
            <a href="login.php" class="nav-link">Login</a>
          </li>

              <?php else: ?>
              

            <li class="nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
          </li>

        <?php endif; ?>

            
        
        </ul>

 
      </div>


    
    </div>
  </nav>
  <!-- /.navbar -->
