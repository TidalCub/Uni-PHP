<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
<div class="form-group">
    <label>Product Name:</label>
    <input type="text" class="form-control" id="ProductName" name="ProductName" >
  </div>
  <div class="form-group">
    <label>Product Description:</label>
    <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" >
  </div>
  <div class="from-group">
    <label>Product Price:</label>
    <input type="number" step="0.01" id="ProductPrice" name="ProductPrice" class="form-control">
  </div>
  <div class="form-group">
    <label > Category: </label>
    <select name="CategoryId" id="CategoryId" class="form-control">
      <?php
        require_once("database/query.php");
        $results = query_table("categories");
        while($row = $results->fetch_assoc()): ?>
          <option value="<?= $row["id"] ?>"><?= $row["name"] ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="formFile" class="form-label">product image</label>
    <input class="form-control" type="file" name="product_image" id="product_image" accept="image/*">
  </div>
  <input type="hidden" name="table" value="update_products">
  <button class="btn btn-primary" type="submit">Update Product</button>
</form>
</form>