<!--This is the basket parial used to display the current contents of a users basket -->
<?php 
if(isset($_SESSION["user"])):
    $results = $basket->get_basket();
    if(empty($results)):?>
    <div class="col-12 text-center p-3">
        <h3>There are no items in your basket</h3>
        <p>Add an item to start</p>   
    </div>

    <?php 
    endif; 
    foreach ($results as $basket_items): ?>
        <hr/>
        <div class='d-flex justify-content-between basket-item'>
            <div class='p-2 pt-1 pb-1'>
                <h4><?= $basket_items["product_name"] ?></h4>
                £<?= $basket_items["price"] ?>
            </div>
            <div class='d-flex flex-direction-rows'>
                <h2 class=' basket-qty d-flex align-items-center justify-content-center p-3'>x<?= $basket_items["item_count"] ?></h2>
                <div class='remove-basket-item d-flex align-items-center justify-content-center'>
                    <div class='plus-minus'>
                        <i class='fa-solid fa-plus-minus' style='color: #D8D8D8;' class='m-1'></i>
                    </div>
                    <div class='minus'>
                        <a href='<?= $_SERVER['PHP_SELF'] ?>?option=add&value=<?= $basket_items["product_id"] ?>'>
                            <i class='fa-solid fa-plus' style='color: #D8D8D8;' class='m-1'></i>
                        </a>
                        <a href='<?= $_SERVER['PHP_SELF'] ?>?option=remove&value=<?= $basket_items["product_id"] ?>'>
                            <i class='fa-solid fa-minus' style='color: #D8D8D8;' class='m-1'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach; 
else:?>
<div class="col-12 text-center p-3">
        <h3>You need to be signed in to manage your basket</h3>
        <a class="btn btn-dark" href="/login.php?redirect=menu.php&requier_signin=true">Sign in now</a>  
    </div>
<?php endif; ?>
        