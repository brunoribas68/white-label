<?php echo view_render_event('bagisto.shop.products.view.stock.before', ['product' => $product]); ?>


<?php if($product->type == 'simple'): ?>
    <div class="stock-status <?php echo e(! $product->haveSufficientQuantity(1) ? '' : 'active'); ?>">
        <?php echo e($product->haveSufficientQuantity(1) ? __('shop::app.products.in-stock') : __('shop::app.products.out-of-stock')); ?>

    </div>
<?php else: ?>
    <div class="stock-status in-stock active" id="in-stock" style="display: none;">
        <?php echo e(__('shop::app.products.in-stock')); ?>

    </div>
<?php endif; ?>

<?php echo view_render_event('bagisto.shop.products.view.stock.after', ['product' => $product]); ?>