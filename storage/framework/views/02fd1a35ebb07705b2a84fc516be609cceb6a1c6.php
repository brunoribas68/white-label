<?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $product = $item->product;

        if ($product->cross_sells()->count()) {
            $products[] = $product;
            $products = array_unique($products);
        }
    ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(isset($products)): ?>

    <div class="attached-products-wrapper mt-50">

        <div class="title">
            <?php echo e(__('shop::app.products.cross-sell-title')); ?>

             <span class="border-bottom"></span>
        </div>

        <div class="product-grid-4">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $product->cross_sells()->paginate(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cross_sell_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php echo $__env->make('shop::products.list.card', ['product' => $cross_sell_product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

<?php endif; ?>