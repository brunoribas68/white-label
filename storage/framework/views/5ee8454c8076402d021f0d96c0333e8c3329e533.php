<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.customer.account.order.index.page-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="account-content">
        <?php echo $__env->make('shop::customers.account.partials.sidemenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="account-layout">

            <div class="account-head mb-10">
                <span class="back-icon"><a href="<?php echo e(route('customer.account.index')); ?>"><i class="icon icon-menu-back"></i></a></span>
                <span class="account-heading">
                    <?php echo e(__('shop::app.customer.account.order.index.title')); ?>

                </span>

                <div class="horizontal-rule"></div>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.orders.list.before', ['orders' => $orders]); ?>


            <div class="account-items-list">
                <div class="account-table-content">
                    <?php $order = app('Webkul\Shop\DataGrids\OrderDataGrid'); ?>
                    <?php echo $order->render(); ?>

                </div>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.orders.list.after', ['orders' => $orders]); ?>


        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>