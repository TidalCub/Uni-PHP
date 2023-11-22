<!-- A new category form, This form allows for a staff member to add a new category. Forms are placed outside of the html where they will be used to isolate
them and make maintaining and debugging easier. The form is submitted to its self by using  echo htmlspecialchars($_SERVER["PHP_SELF"]); -->

<?php require_once("action/new-category_action.php") ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <div class="form-group">
    <label>Category Name:</label>
    <input type="text" class="form-control" id="CategoryName" name="CategoryName" >
  </div>
  <input type="hidden" name="table" value="category">
  <button class="btn btn-primary" type="submit">Add Category</button>
</form>