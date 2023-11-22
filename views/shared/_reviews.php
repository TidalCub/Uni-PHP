<div class="col-12 d-flex flex-column gap-3 default-font">
  <?php 
    require "helpers/reviews.php";
    foreach(get_all_reviews($product["id"]) as $review): ?>

    <div class="col-12 d-flex flex-row">
      <div class="flex-grow-1 d-flex flex-column bg-light rd-normal">
        <div class="m-2 d-flex flex-row border-bottom">
          <div>Username</div>
          <div class="ps-3">
            <?php 
              for($i = 0; $i < $review["star_rating"]; $i++):
            ?>
              <i class="fa fa-star text-warning"></i>
            <?php endfor; ?>
            <?php 
              for($i = 0; $i < 5 - $review["star_rating"]; $i++):
            ?>
              <i class="fa fa-star"></i>
            <?php endfor; ?>
            (<?= $review["star_rating"] ?>)
          </div>
        </div>
        <div class="p-3"><?= $review["comment"]?></div> 
      </div>
      
    </div>
    <?php endforeach; ?>
</div>