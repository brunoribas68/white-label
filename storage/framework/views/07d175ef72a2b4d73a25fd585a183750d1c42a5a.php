<?php echo view_render_event('bagisto.shop.products.buy_now.before', ['product' => $product]); ?>


<button type="submit" data-href="<?php echo e(route('shop.product.buynow', $product->product_id)); ?>" class="btn btn-lg btn-primary buynow" <?php echo e($product->type != 'configurable' && ! $product->haveSufficientQuantity(1) ? 'disabled' : ''); ?>>
    <?php echo e(__('shop::app.products.buy-now')); ?>

</button>

<?php echo view_render_event('bagisto.shop.products.buy_now.after', ['product' => $product]); ?>