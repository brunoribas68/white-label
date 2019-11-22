<?php $reviewHelper = app('Webkul\Product\Helpers\Review'); ?>

<?php echo view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]); ?>


<?php if($total = $reviewHelper->getTotalReviews($product)): ?>
    <div class="rating-reviews">
        <div class="rating-header">
            <?php echo e(__('shop::app.products.reviews-title')); ?>

        </div>

        <div class="overall">
            <div class="review-info">

                <span class="number">
                    <?php echo e($reviewHelper->getAverageRating($product)); ?>

                </span>

                <span class="stars">
                    <?php for($i = 1; $i <= round($reviewHelper->getAverageRating($product)); $i++): ?>

                        <span class="icon star-icon"></span>

                    <?php endfor; ?>
                </span>

                <div class="total-reviews">
                    <?php echo e(__('shop::app.products.total-reviews', ['total' => $total])); ?>

                </div>

            </div>

            <?php if(core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check()): ?>
                <a href="<?php echo e(route('shop.reviews.create', $product->url_key)); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('shop::app.products.write-review-btn')); ?>

                </a>
            <?php endif; ?>

        </div>

        <div class="reviews">

            <?php $__currentLoopData = $reviewHelper->getReviews($product)->paginate(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="review">
                    <div class="title">
                        <?php echo e($review->title); ?>

                    </div>

                    <span class="stars">
                        <?php for($i = 1; $i <= $review->rating; $i++): ?>

                            <span class="icon star-icon"></span>

                        <?php endfor; ?>
                    </span>

                    <div class="message">
                        <?php echo e($review->comment); ?>

                    </div>

                    <div class="reviewer-details">
                        <span class="by">
                            <?php echo e(__('shop::app.products.by', ['name' => $review->name])); ?>,
                        </span>

                        <span class="when">
                            <?php echo e(core()->formatDate($review->created_at, 'F d, Y')); ?>

                        </span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <a href="<?php echo e(route('shop.reviews.index', $product->url_key)); ?>" class="view-all">
                <?php echo e(__('shop::app.products.view-all')); ?>

            </a>

        </div>
    </div>
<?php else: ?>
    <?php if(core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check()): ?>
        <div class="rating-reviews">
            <div class="rating-header">
                <a href="<?php echo e(route('shop.reviews.create', $product->url_key)); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('shop::app.products.write-review-btn')); ?>

                </a>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php echo view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]); ?>