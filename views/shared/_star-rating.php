<?php 
// Here we have a partial that displays the product rating and review ratings. It takes a variable called $star_rating and displays the star rating based on it. 
// it does this by using for loops, it loops through the star rating and displays a star for each one, it then loops through the remaining stars and displays a star without the text-warning class to make it grey.
?>
<?php
// Display full stars
for ($i = 0; $i < floor($star_rating); $i++):
?>
  <i class="fa fa-star text-warning "></i>
<?php endfor;

// Display half-star if applicable
if ($star_rating - floor($star_rating) > 0):
?>
  <i class="fa-solid fa-star-half-alt text-warning "></i>
<?php endif;

// Display remaining empty stars
for ($i = 0; $i < 5 - ceil($star_rating); $i++):
?>
  <i class="fa-regular fa-star text-warning "></i>
<?php endfor;
?>

(<?= $star_rating ?>)
