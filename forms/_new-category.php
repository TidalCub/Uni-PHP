<?php require_once("action/new-category_action.php") ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <div class="form-group">
    <label>Category Name:</label>
    <input type="text" class="form-control" id="CategoryName" name="CategoryName" >
  </div>
  <input type="hidden" name="table" value="category">
  <button class="btn btn-primary" type="submit">Add Category</button>
</form>