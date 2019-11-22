
    <?php if($product->type == "configurable"): ?>
        <div class="cart-wish-wrap">
            <a href="<?php echo e(route('cart.add.configurable', $product->url_key)); ?>" class="btn btn-lg btn-primary addtocart">
                <?php echo e(__('shop::app.products.add-to-cart')); ?>

            </a>

            <?php echo $__env->make('shop::products.wishlist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    <?php else: ?>
        <div class="cart-wish-wrap">
            <form action="<?php echo e(route('cart.add', $product->product_id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product" value="<?php echo e($product->product_id); ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" value="false" name="is_configurable">
                <button class="btn btn-lg btn-primary addtocart" <?php echo e($product->haveSufficientQuantity(1) ? '' : 'disabled'); ?>><?php echo e(__('shop::app.products.add-to-cart')); ?></button>
            </form>

            <?php echo $__env->make('shop::products.wishlist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    <?php endif; ?>