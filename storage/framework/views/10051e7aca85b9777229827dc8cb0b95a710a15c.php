<?php echo view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]); ?>


<button type="submit" class="btn btn-lg btn-primary addtocart" <?php echo e($product->type != 'configurable' && ! $product->haveSufficientQuantity(1) ? 'disabled' : ''); ?>>
    <?php echo e(__('shop::app.products.add-to-cart')); ?>

</button>

<?php echo view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]); ?>