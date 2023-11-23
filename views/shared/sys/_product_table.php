<?php require "helpers/product.php" ?>
<table class="col-12 table">
  <thead>
    <th>Id</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Image</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php foreach(get_all_items() as $item) : ?>
      <tr>
        <td><?=$item["id"] ?></td>
        <td><?=$item["name"] ?></td>
        <td><?=$item["description"] ?></td>
        <td><?=$item["price"] ?></td>
        <td>..</td>
        <td class="d-flex gap-2">
          <button class="btn btn-info" onclick="open_dialog()">Update</button>
          <a class="btn btn-danger">Delete</a>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<dialog class="bg-light rd-normal">
<button autofocus class="btn btn-light bt-no-hover"><i class="fa-regular fa-circle-xmark"></i></button>
  <?php include "forms/_update-items.php" ?>
</dialog>

<script>
const dialog = document.querySelector("dialog");
const showButton = document.querySelector("dialog + button");
const closeButton = document.querySelector("dialog button");

function open_dialog(){
  dialog.showModal();
}

// "Close" button closes the dialog
closeButton.addEventListener("click", () => {
  dialog.close();
});
</script>