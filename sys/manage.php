<!DOCTYPE html>
<html>
<head>
  <title>My Website</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href=".././node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Koulen">
</head>
<body>
  <?php include '../views/shared/_header.php'; ?>
  <?php 
      require "../database/query.php";

      $results = query_table("categories");

    ?>
  <div class="card w-25">
    <div class="card-body">
      <form method="post" action="../database/insert.php" class="form">
          <div class="form-group"> 
            <label for="name" class="h3">Category Name:</label>
            <input class="form-control" type="text" id="name" name="name" required>
            <input type="hidden" name="table" value="categories">
          </div>
          <button class="btn btn-primary" type="submit">Add Category</button>
        </form>
    </div>
  </div>
  
  <div class="card w-25">
    <div class="card-body">
      <form method="post" action="../database/insert.php" class="form">
          <div class="form-group"> 
            <label for="name" class="h3">Product Name:</label>
            <input class="form-control" type="text" id="name" name="name" required>
            
          </div>
          <div class="form-group">
              <label for="description" class="h3">Product Description:</label>
              <input class="form-control" type="text" id="description" name="description">
          </div>  
          <div class="form-group">
            <label for="price" class="h3"> Product Price:</label>
            <input class="form-control" type="number" step=".01" id="price" name="price">
          </div>
          <div class="form-group">
            <label for="category" class="h3"> Category: </label>
            <select name="category_id" id="category_id" class="form-control">
              <?php
                $results = query_table("categories");
                while($row = $results->fetch_assoc()) {
                  echo "<option value='" . $row["id"] . "'>". $row["name"] . "</option>";
                }
              ?>
            </select>
          </div>
          <input type="hidden" name="table" value="products">
          <button class="btn btn-primary" type="submit">Add Product</button>
        </form>
    </div>
  </div>

    <?php
      $results = query_table("categories");
      while($row = $results->fetch_assoc()) {
        echo $row["name"] . "<br>";
      }
      $results = query_table("products");
      while($row = $results->fetch_assoc()) {
        echo $row["name"] . "<br>";
      }
    ?>
  
  
</body>
</html>
