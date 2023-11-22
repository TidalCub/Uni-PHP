<?php 
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