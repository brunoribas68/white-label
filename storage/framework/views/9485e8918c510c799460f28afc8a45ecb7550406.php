<?php $__env->startSection('page_title'); ?>
    <?php echo e($category->meta_title ?? $category->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('seo'); ?>
    <meta name="description" content="<?php echo e($category->meta_description); ?>"/>
    <meta name="keywords" content="<?php echo e($category->meta_keywords); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>
    <?php $productRepository = app('Webkul\Product\Repositories\ProductRepository'); ?>

    <div class="main">
        <?php echo view_render_event('bagisto.shop.products.index.before', ['category' => $category]); ?>


        <div class="category-container">

            <?php if(in_array($category->display_mode, [null, 'products_only', 'products_and_description'])): ?>
                <?php echo $__env->make('shop::products.list.layered-navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

            <div class="category-block" <?php if($category->display_mode == 'description_only'): ?> style="width: 100%" <?php endif; ?>>
                <div class="hero-image mb-35">
                    <?php if(!is_null($category->image)): ?>
                        <img class="logo" src="<?php echo e($category->image_url); ?>" />
                    <?php endif; ?>
                </div>

                <?php if(in_array($category->display_mode, [null, 'description_only', 'products_and_description'])): ?>
                    <?php if($category->description): ?>
                        <div class="category-description">
                            <?php echo $category->description; ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(in_array($category->display_mode, [null, 'products_only', 'products_and_description'])): ?>
                    <?php $products = $productRepository->getAll($category->id); ?>

                    <?php if($products->count()): ?>

                        <?php echo $__env->make('shop::products.list.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php $toolbarHelper = app('Webkul\Product\Helpers\Toolbar'); ?>

                        <?php if($toolbarHelper->getCurrentMode() == 'grid'): ?>
                            <div class="product-grid-3">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productFlat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php echo $__env->make('shop::products.list.card', ['product' => $productFlat], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="product-list">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productFlat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php echo $__env->make('shop::products.list.card', ['product' => $productFlat], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <?php echo view_render_event('bagisto.shop.products.index.pagination.before', ['category' => $category]); ?>


                        <div class="bottom-toolbar">
                            <?php echo e($products->appends(request()->input())->links()); ?>

                        </div>

                        <?php echo view_render_event('bagisto.shop.products.index.pagination.after', ['category' => $category]); ?>


                    <?php else: ?>

                        <div class="product-list empty">
                            <h2><?php echo e(__('shop::app.products.whoops')); ?></h2>

                            <p>
                                <?php echo e(__('shop::app.products.empty')); ?>

                            </p>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php echo view_render_event('bagisto.shop.products.index.after', ['category' => $category]); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('.responsive-layred-filter').css('display','none');
            $(".sort-icon, .filter-icon").on('click', function(e){
                var currentElement = $(e.currentTarget);
                if (currentElement.hasClass('sort-icon')) {
                    currentElement.removeClass('sort-icon');
                    currentElement.addClass('icon-menu-close-adj');
                    currentElement.next().removeClass();
                    currentElement.next().addClass('icon filter-icon');
                    $('.responsive-layred-filter').css('display','none');
                    $('.pager').css('display','flex');
                    $('.pager').css('justify-content','space-between');
                } else if (currentElement.hasClass('filter-icon')) {
                    currentElement.removeClass('filter-icon');
                    currentElement.addClass('icon-menu-close-adj');
                    currentElement.prev().removeClass();
                    currentElement.prev().addClass('icon sort-icon');
                    $('.pager').css('display','none');
                    $('.responsive-layred-filter').css('display','block');
                    $('.responsive-layred-filter').css('margin-top','10px');
                } else {
                    currentElement.removeClass('icon-menu-close-adj');
                    $('.responsive-layred-filter').css('display','none');
                    $('.pager').css('display','none');
                    if ($(this).index() == 0) {
                        currentElement.addClass('sort-icon');
                    } else {
                        currentElement.addClass('filter-icon');
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>