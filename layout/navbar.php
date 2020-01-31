<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <!-- Links -->
  <ul class="navbar-nav">
    
    
  <?php if (isset($_SESSION['user_id'])): ?> 
      
      <!-- Logged in -menu -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="show_users.php">Show users</a>
      </li>

      <li class="nav-item">
        <a href="show_topics.php" class="nav-link">Show topics</a>      
      </li>

  <?php else: ?>

      <!-- Logged out -menu -->
      <li>
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      
  <?php endif; ?>

    
  </ul>

</nav>