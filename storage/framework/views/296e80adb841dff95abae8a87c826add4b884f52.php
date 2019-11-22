<?php echo view_render_event('bagisto.shop.products.price.before', ['product' => $product]); ?>


<div class="product-price">
    <?php $priceHelper = app('Webkul\Product\Helpers\Price'); ?>

    <?php if($product->type == 'configurable'): ?>
        <span class="price-label"><?php echo e(__('shop::app.products.price-label')); ?></span>

        <span class="final-price"><?php echo e(core()->currency($priceHelper->getMinimalPrice($product))); ?></span>
    <?php else: ?>
        <?php if($priceHelper->haveSpecialPrice($product)): ?>
            <div class="sticker sale">
                <?php echo e(__('shop::app.products.sale')); ?>

            </div>

            <span class="regular-price"><?php echo e(core()->currency($product->price)); ?></span>

            <span class="special-price"><?php echo e(core()->currency($priceHelper->getSpecialPrice($product))); ?></span>
        <?php else: ?>
            <span><?php echo e(core()->currency($product->price)); ?></span>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php echo view_render_event('bagisto.shop.products.price.after', ['product' => $product]); ?>