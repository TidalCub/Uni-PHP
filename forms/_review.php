<?php require "forms/action/review_action.php" ?>
<form method="POST" class="col-12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

  <div class="form-check d-flex justify-content-center">
    <div>
     <input type="radio" id="star-1" name="star_rating" oninput="starreview(1)" value="1" hidden> 
     <label for="star-1"><h3 class="fa fa-star"></h3></label>
    </div>
    <div>
      <input type="radio" id="star-2" name="star_rating" oninput="starreview(2)" value="2" hidden>
      <label for="star-2"><h3 class="fa fa-star"></h3></label>
    </div>
    <div>
      <input type="radio" id="star-3" name="star_rating" oninput="starreview(3)" value="3" hidden>
      <label for="star-3"><h3 class="fa fa-star"></h3></label>
    </div>
    <div>
     <input type="radio" id="star-4" name="star_rating" oninput="starreview(4)" value="4" hidden> 
     <label for="star-4"><h3 class="fa fa-star"></h3></label>
    </div>
    <div>
     <input type="radio" id="star-5" name="star_rating" oninput="starreview(5)" value="5"hidden> 
     <label for="star-5"><h3 class="fa fa-star"></h3></label>
    </div>
    
  </div>
  </div>
  <div class="form-group">
    <label>Your Comments</label>
    <textarea name="product_review" class="form-control default-font" placeholder="Leave a comment here" rows=5></textarea>
  </div>
  <input type="number" name="product_id" value="<?= $product["id"]?>" hidden>
  <p class="default-font"><i class='fas fa-exclamation-triangle' ></i> Your reviews will be public, but it will only show your first name</p>
  <button type="submit" class="btn btn-dark">Post A Review</button>
</form>

<script>
  // JavaScript function to handle star rating
function starreview(selectedStar) {
    for (let i = 1; i <= 5; i++) {
        const label = document.querySelector('label[for="star-' + i + '"]');
        
        if (i <= selectedStar) {
            label.classList.add("text-warning");
        } else {
            label.classList.remove("text-warning");
        }
    }
}

</script>