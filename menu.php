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
        echo "
        <div class='item col-lg-6 col-sm-11 col-11'><img src='uploads/".$item["image_path"]."' height='150px' width='auto''>
        <div class='flex-grow-1 pt-3 pr-4'>
          <h3>" . $item["name"] . "</h1>
          <p>". $item["description"]."</p>
          <a href='/view/".$item["id"]."'class='link btn btn-primary  '>View</a>
          <a href='/add/".$item["id"]."'class='link btn btn-primary'>Add to basket (£".$item["price"].")</a>
        </div>
        </div>";
      }
      echo "</div>";
    }
  ?>
</div>

  <?php include 'views/shared/_footer.php'; ?>
</body>
</html>