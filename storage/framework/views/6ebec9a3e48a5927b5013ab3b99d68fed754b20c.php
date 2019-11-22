<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.checkout.success.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="order-success-content" style="min-height: 300px;">
        <h1><?php echo e(__('shop::app.checkout.success.thanks')); ?></h1>

        <p><?php echo e(__('shop::app.checkout.success.order-id-info', ['order_id' => $order->increment_id])); ?></p>

        <p><?php echo e(__('shop::app.checkout.success.info')); ?></p>

        <?php echo e(view_render_event('bagisto.shop.checkout.continue-shopping.before', ['order' => $order])); ?>


        <div class="misc-controls">
            <a style="display: inline-block" href="<?php echo e(route('shop.home.index')); ?>" class="btn btn-lg btn-primary">
                <?php echo e(__('shop::app.checkout.cart.continue-shopping')); ?>

            </a>
        </div>
        
        <?php echo e(view_render_event('bagisto.shop.checkout.continue-shopping.after', ['order' => $order])); ?>

        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>