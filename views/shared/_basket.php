<?php 
        $results = $basket->get_basket();
        foreach ($results as $basket_items){
          echo "
          <hr/>
            <div class='d-flex justify-content-between basket-item'>
              <div class='p-2 pt-1 pb-1'>
                <h4>". $basket_items["product_name"] ."</h4>
                  £"  . $basket_items["price"] .     
             "</div>
             <div class='d-flex flex-direction-rows'>
              <h2 class=' basket-qty d-flex align-items-center justify-content-center p-3'>x". $basket_items["item_count"] ."</h2>
              <div class='remove-basket-item d-flex align-items-center justify-content-center'>
                <div class='plus-minus'>
                  <i class='fa-solid fa-plus-minus' style='color: #D8D8D8;' class='m-1'></i>
                </div>
                <div class='minus'>
                  <a href='" . $_SERVER['PHP_SELF']."?option=add&value=" . $basket_items["product_id"] . "'>
                    <i class='fa-solid fa-plus' style='color: #D8D8D8;' class='m-1'></i>
                  </a>
                  <a href='".$_SERVER['PHP_SELF']."?option=remove&value=".$basket_items["product_id"]."'>
                    <i class='fa-solid fa-minus' style='color: #D8D8D8;' class='m-1'></i> 
                  </a>
                  
                </div>
              </div>
            </div>
             
            </div>
            
          ";
        }
      ?>