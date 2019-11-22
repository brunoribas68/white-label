<?php $toolbarHelper = app('Webkul\Product\Helpers\Toolbar'); ?>

<?php echo view_render_event('bagisto.shop.products.list.toolbar.before'); ?>


<div class="top-toolbar mb-35">

    <div class="page-info">
        <span>
            <?php echo e(__('shop::app.products.pager-info', ['showing' => $products->firstItem() . '-' . $products->lastItem(), 'total' => $products->total()])); ?>

        </span>

        <span class="sort-filter">
            <i class="icon sort-icon" id="sort" ></i>
            <i class="icon filter-icon" id="filter"></i>
        </span>
    </div>

    <div class="pager">

        <div class="view-mode">
            <?php if($toolbarHelper->isModeActive('grid')): ?>
                <span class="grid-view">
                    <i class="icon grid-view-icon"></i>
                </span>
            <?php else: ?>
                <a href="<?php echo e($toolbarHelper->getModeUrl('grid')); ?>" class="grid-view">
                    <i class="icon grid-view-icon"></i>
                </a>
            <?php endif; ?>

            <?php if($toolbarHelper->isModeActive('list')): ?>
                <span class="list-view">
                    <i class="icon list-view-icon"></i>
                </span>
            <?php else: ?>
                <a href="<?php echo e($toolbarHelper->getModeUrl('list')); ?>" class="list-view">
                    <i class="icon list-view-icon"></i>
                </a>
            <?php endif; ?>
        </div>

        <div class="sorter">
            <label><?php echo e(__('shop::app.products.sort-by')); ?></label>

            <select onchange="window.location.href = this.value">

                <?php $__currentLoopData = $toolbarHelper->getAvailableOrders(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($toolbarHelper->getOrderUrl($key)); ?>" <?php echo e($toolbarHelper->isOrderCurrent($key) ? 'selected' : ''); ?>>
                        <?php echo e(__('shop::app.products.' . $order)); ?>

                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
        </div>

        <div class="limiter">
            <label><?php echo e(__('shop::app.products.show')); ?></label>

            <select onchange="window.location.href = this.value">

                <?php $__currentLoopData = $toolbarHelper->getAvailableLimits(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $limit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($toolbarHelper->getLimitUrl($limit)); ?>" <?php echo e($toolbarHelper->isLimitCurrent($limit) ? 'selected' : ''); ?>>
                        <?php echo e($limit); ?>

                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
        </div>

    </div>

</div>

<?php echo view_render_event('bagisto.shop.products.list.toolbar.after'); ?>



<div class="responsive-layred-filter mb-20">
    <layered-navigation></layered-navigation>
</div>