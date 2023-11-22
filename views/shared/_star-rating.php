<?php 
// Usage: <?= $this->render('_star-rating', ['star_rating' => $model->star_rating])
// Here we have a partial that displays the product rating and review ratings. It takes a variable called $star_rating and displays the star rating based on it. 
// it does this by using for loops, it loops through the star rating and displays a star for each one, it then loops through the remaining stars and displays a star without the text-warning class to make it grey.

  for($i = 0; $i < $star_rating; $i++):
?>
  <i class="fa fa-star text-warning"></i>
<?php endfor; ?>
<?php 
  for($i = 0; $i < 5 - $star_rating; $i++):
?>
  <i class="fa fa-star"></i>
<?php endfor; ?>
(<?= $star_rating ?>)