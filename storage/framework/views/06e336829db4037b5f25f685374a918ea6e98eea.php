<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.customers.customers.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.customers.customers.title')); ?></h1>
            </div>
            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span >
                        <?php echo e(__('admin::app.export.export')); ?>

                    </span>
                </div>

                <a href="<?php echo e(route('admin.customer.create')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.customers.customers.add-title')); ?>

                </a>
            </div>
        </div>

        <div class="page-content">
            <?php $customerGrid = app('Webkul\Admin\DataGrids\CustomerDataGrid'); ?>

            <?php echo $customerGrid->render(); ?>

        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header"><?php echo e(__('admin::app.export.download')); ?></h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin::export.export', ['gridName' => $customerGrid], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>