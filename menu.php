<!DOCTYPE html>
<html>
<head>
  <title>My Website</title>
  <?php include 'views/shared/_head.php'; ?>
</head>
<body>
<?php include 'views/shared/_header.php'; ?>
<div class="items">
  <?php
    require "database/query.php";
    $results = query_table("categories");
    while($row = $results->fetch_assoc()) {
      echo "<h1>".$row["name"] . "</h1>";
      $items = get_child($row["id"]);
      echo "<div class='cat'>";
      while($item = $items->fetch_assoc()){
        echo "<div class='item'><h3>" . $item["name"] . "</h1><p>". $item["description"]."<br>£". $item["price"] ."</p></div>";
      }
      echo "</div>";
    }
  ?>
</div>

  <?php include 'views/shared/_footer.php'; ?>
</body>
</html>