<?php
require_once PAGE_PATH . "/templates/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/public/css/home.css" />
    <link rel="stylesheet" href="/public/css/shared.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="layout">
    <?php
      echo Navbar();
    ?>
    <div id="test">
        test
    </div>
  </div>
    <script src="/public/js/post.js"></script>
</body>
</html>