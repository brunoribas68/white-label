<?php echo e($address->name); ?></br>
<?php echo e($address->address1); ?></br>
<?php echo e($address->city); ?></br>
 <?php echo e($address->state); ?></br>
<?php echo e(core()->country_name($address->country)); ?> <?php echo e($address->postcode); ?></br></br>
<?php echo e(__('shop::app.checkout.onepage.contact')); ?> : <?php echo e($address->phone); ?> 