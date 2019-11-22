<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.catalog.products.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content" style="height: 100%;">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.catalog.products.title')); ?></h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span >
                        <?php echo e(__('admin::app.export.export')); ?>

                    </span>
                </div>

                <a href="<?php echo e(route('admin.catalog.products.create')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.catalog.products.add-product-btn-title')); ?>

                </a>
            </div>
        </div>

        <?php echo view_render_event('bagisto.admin.catalog.products.list.before'); ?>


        <div class="page-content">
            <?php $products = app('Webkul\Admin\DataGrids\ProductDataGrid'); ?>
            <?php echo $products->render(); ?>

        </div>

        <?php echo view_render_event('bagisto.admin.catalog.products.list.after'); ?>


    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header"><?php echo e(__('admin::app.export.download')); ?></h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin::export.export', ['gridName' => $products], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>