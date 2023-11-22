<?php require "helpers/expand_order.php"?>
<h1>Previous Order</h1>
<hr>
<ul class="list-unstyled">
  <?php if($user->is_user()) :?>
    <?php foreach(expand_order_last() as $items) : ?>
    <p><?= $items["product_name"] ?></p>
    <?php endforeach ?>
  <?php else : ?>
    <li class="text-muted">You must be signed in to re-order</li>
    <a class="btn btn-dark" href="login.php">Signin or Create an Account</a>
  <?php endif ?>
</ul>
<hr>
<a class="link btn m-auto disabled" style="background-color: #D8D8D8; width:50%;">Re-Order</a>