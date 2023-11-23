<?php require "helpers/product.php";
      require "forms/action/update-item_action.php"
?>
<div class="d-flex col-12 ">
  
</div>

   
    <div class="col-12 d-flex flex-row justify-content-around">
      <div class="col-1">Id</div>
      <div class="col-1">Name</div>
      <div class="col-3">Description</div>
      <div class="col-1">Price</div>
      <div class="col-2">Category</div>
      <div class="col-1">Image</div>
      <div class="col-2">Actions</div>
    </div>
    <hr/>
    <?php foreach(get_all_items() as $item) : ?>
      <form id="form-<?=$item['id'] ?>" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="col-12 d-flex flex-row justify-content-around pb-2">
        <input name="action" value="update_product" type="hidden" class="col-0">
        <div class="col-1"><input name="product_id" type="number" step="1" value='<?=$item["id"] ?>' class="form-control-plaintext col-12" readonly></div>
        <div class="col-1"><input name="name" type="text" value='<?=$item["name"] ?>' class="form-control-plaintext col-12" readonly></div>
        <div class="col-3"><input name="description" type="text"  value='<?=$item["description"] ?>' class="form-control-plaintext col-12" readonly></td></div>
        <div class="col-1"><input name="price"  type="number" step="0.01" value='<?=$item["price"] ?>' class="form-control-plaintext col-12" readonly></div>
        <div class="col-2">
          <select name="categoryid" class="form-control-plaintext" readonly disabled class="col-12">
            <?php
              require_once("database/query.php");
              $results = query_table("categories");
              while($row = $results->fetch_assoc()): ?> 
                <option value="<?= $row["id"] ?>" <?php if($row["id"] == $item["category_id"]):?>selected<?php endif;?>><?= $row["name"] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-1"><input class="form-control-plaintext col-12" readonly value="image"></div>
        <div class="col-2">
          <button class="btn btn-info" onclick="enableForm(<?=$item['id'] ?>)" type="button" id="update-<?= $item['id']?>" >
            <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="btn btn-success" type="submit" disabled>
            <i class="fa-solid fa-floppy-disk"></i>
          </button>
          <button class="btn btn-danger" type="button">
            <i class="fa-solid fa-trash"></i>
          </button>
        </div>
        
      </form>
    <?php endforeach ?>

  

<script>
  function enableForm(form_id) {
    var form = document.getElementById("form-"+form_id)
    var update_button = document.getElementById("update-"+form_id);
    form.querySelectorAll('input').forEach(function (input) {
      if(!input.readOnly){
        input.setAttribute("readonly","");
        input.classList.add("form-control-plaintext"); 
        update_button.innerHTML = "<i class='fa-solid fa-pen-to-square'></i>"
        update_button.classList.remove("btn-danger")
        update_button.classList.add("btn-info")
        form.querySelector(".btn-success").setAttribute("disabled", "")
        var select = form.querySelector("select")
        select.setAttribute("readonly", "")
        select.setAttribute("disabled", "")
        select.classList.add("form-control-plaintext"); 
      } else {
        input.removeAttribute("readonly");
        input.classList.remove("form-control-plaintext");
        update_button.innerHTML = "<i class='fa-solid fa-x'></i>"
        update_button.classList.remove("btn-info")
        update_button.classList.add("btn-danger")
        form.querySelector(".btn-success").removeAttribute("disabled")
        var select = form.querySelector("select")
        select.removeAttribute("readonly", "")
        select.removeAttribute("disabled", "")
        select.classList.remove("form-control-plaintext"); 
      }
        
    });
    

    
    
  }
</script>
