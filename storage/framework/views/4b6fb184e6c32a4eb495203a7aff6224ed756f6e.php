<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.tax-categories.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.settings.tax-categories.title')); ?></h1>
            </div>

            <div class="page-action">
                <a href="<?php echo e(route('admin.tax-categories.show')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.settings.tax-categories.add-title')); ?>

                </a>
            </div>
        </div>

        <div class="page-content">
            <?php $taxCategories = app('Webkul\Admin\DataGrids\TaxCategoryDataGrid'); ?>
            <?php echo $taxCategories->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>