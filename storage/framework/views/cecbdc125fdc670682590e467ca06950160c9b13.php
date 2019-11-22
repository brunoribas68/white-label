<?php $__env->startSection('content-wrapper'); ?>
    <div class="inner-section">
    
        <?php echo $__env->make('admin::layouts.nav-aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="content-wrapper">

            <?php echo $__env->make('admin::layouts.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>

        </div>
        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>