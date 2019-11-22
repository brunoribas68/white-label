<?php
    $relatedProducts = $product->related_products()->get();
?>

<?php if($relatedProducts->count()): ?>
    <div class="attached-products-wrapper">

        <div class="title">
            <?php echo e(__('shop::app.products.related-product-title')); ?>

            <span class="border-bottom"></span>
        </div>

        <div class="product-grid-4">

            <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php echo $__env->make('shop::products.list.card', ['product' => $related_product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>
<?php endif; ?>