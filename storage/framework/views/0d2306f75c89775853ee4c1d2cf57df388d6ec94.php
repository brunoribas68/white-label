<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.sales.invoices.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.sales.invoices.title')); ?></h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        <?php echo e(__('admin::app.export.export')); ?>

                    </span>
                </div>
            </div>
        </div>

        <div class="page-content">
            <?php $orderInvoicesGrid = app('Webkul\Admin\DataGrids\OrderInvoicesDataGrid'); ?>
            <?php echo $orderInvoicesGrid->render(); ?>

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
    <?php echo $__env->make('admin::export.export', ['gridName' => $orderInvoicesGrid], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>