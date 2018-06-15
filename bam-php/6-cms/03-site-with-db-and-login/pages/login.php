<?php
$title = 'Log in';
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
// Process form submissions.
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    
    case 'logout':
      session_destroy();
      session_start();
      notice('You have been logged out');
      break;
    
    case 'login':

      $mysqli = db_connect();

      $query = "SELECT * FROM users " .
        "WHERE username = '" . mysqli_real_escape_string($mysqli,$_POST['username']).  "' " .
        "AND password = '" . mysqli_real_escape_string($mysqli,$_POST['password']). "'";
      $mysqli->real_query($query);
      $res = $mysqli->use_result();

      if ($row = $res->fetch_assoc()) {
        // Store session user info without password
        unset($row['password']);
        $_SESSION['user'] = $row;
        notice('You have been logged in.');
        break;
      }
      // Check if logged in
      if (isset($_SESSION['user'])) {
        notice('You have been logged in');
      }
      else {
        notice('Ah, sorry, either the username or password was incorrect.');
      }
      break;
  }
}

if (isset($_SESSION['user'])) {
  $content = '
    <h1>Welcome, ' . $_SESSION['user']['username'] . '</h1>
    <p>You are logged in, enjoy!</p>';
} else {
  $content = '
  <h1>'. $title . '</h1>
  <form action="login.php" method="post">
    <p>Username: <input type="text" name="username" /></p>
    <p>Password: <input type="password" name="password" /></p>
    <p><input type="submit" value="Log in" />
    <input type="hidden" name="action" value="login" />
  </form>';
}
