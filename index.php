<?php
require 'includes.php';
$user_data = loginCheck($con);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title></title>
  </head>
  <body>
    <div class="nav">
      <nav>
        <h1>Hello  <?=htmlspecialchars($user_data->email)?></h1>
        <ul>
          <li><a href="logout.php">Log out</a></li>
        </ul>
      </nav>
  </div>
    <div class="booking">
      <!-- Calendly inline widget begin -->
      <div class="calendly-inline-widget" data-url="https://calendly.com/vaidas_pocius/video-call" style="min-width:320px;height:630px;"></div>
      <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
      <!-- Calendly inline widget end -->
    </div>
  </body>
</html>
