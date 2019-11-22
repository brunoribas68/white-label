<?php echo view_render_event('bagisto.shop.products.view.product-add.after', ['product' => $product]); ?>


<div class="add-to-buttons">
    <?php echo $__env->make('shop::products.add-to-cart', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('shop::products.buy-now', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<?php echo view_render_event('bagisto.shop.products.view.product-add.after', ['product' => $product]); ?>