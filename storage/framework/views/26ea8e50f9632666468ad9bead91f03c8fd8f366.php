<?php $reviewHelper = app('Webkul\Product\Helpers\Review'); ?>

<?php echo view_render_event('bagisto.shop.products.review.before', ['product' => $product]); ?>


<?php if($total = $reviewHelper->getTotalReviews($product)): ?>
    <div class="product-ratings mb-10">
        <span class="stars">
            <?php for($i = 1; $i <= round($reviewHelper->getAverageRating($product)); $i++): ?>
                <span class="icon star-icon"></span>
            <?php endfor; ?>
        </span>

        <div class="total-reviews">
            <?php echo e(__('shop::app.products.total-rating', [
                        'total_rating' => $reviewHelper->getTotalRating($product),
                        'total_reviews' => $total,
                    ])); ?>

        </div>
    </div>
<?php endif; ?>

<?php echo view_render_event('bagisto.shop.products.review.after', ['product' => $product]); ?>