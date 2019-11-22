<div class="form-container">
    <div class="form-header mb-30">
        <span class="checkout-step-heading"><?php echo e(__('shop::app.checkout.onepage.summary')); ?></span>
    </div>

    <div class="address-summary">
        <?php if($billingAddress = $cart->billing_address): ?>
            <div class="billing-address">
                <div class="card-title mb-20">
                    <b><?php echo e(__('shop::app.checkout.onepage.billing-address')); ?></b>
                </div>

                <div class="card-content">
                    <ul>
                        <li class="mb-10">
                            <?php echo e($billingAddress->name); ?>

                        </li>
                        <li class="mb-10">
                            <?php echo e($billingAddress->address1); ?>,<br/> <?php echo e($billingAddress->state); ?>

                        </li>
                        <li class="mb-10">
                            <?php echo e(core()->country_name($billingAddress->country)); ?> <?php echo e($billingAddress->postcode); ?>

                        </li>

                        <span class="horizontal-rule mb-15 mt-15"></span>

                        <li class="mb-10">
                            <?php echo e(__('shop::app.checkout.onepage.contact')); ?> : <?php echo e($billingAddress->phone); ?>

                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <?php if($shippingAddress = $cart->shipping_address): ?>
            <div class="shipping-address">
                <div class="card-title mb-20">
                    <b><?php echo e(__('shop::app.checkout.onepage.shipping-address')); ?></b>
                </div>

                <div class="card-content">
                    <ul>
                        <li class="mb-10">
                            <?php echo e($shippingAddress->name); ?>

                        </li>
                        <li class="mb-10">
                            <?php echo e($shippingAddress->address1); ?>,<br/> <?php echo e($shippingAddress->state); ?>

                        </li>
                        <li class="mb-10">
                            <?php echo e(core()->country_name($shippingAddress->country)); ?> <?php echo e($shippingAddress->postcode); ?>

                        </li>

                        <span class="horizontal-rule mb-15 mt-15"></span>

                        <li class="mb-10">
                            <?php echo e(__('shop::app.checkout.onepage.contact')); ?> : <?php echo e($shippingAddress->phone); ?>

                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <?php $productImageHelper = app('Webkul\Product\Helpers\ProductImage'); ?>

    <div class="cart-item-list mt-20">
        <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                $product = $item->product;

                if ($product->type == "configurable")
                    $productBaseImage = $productImageHelper->getProductBaseImage($item->child->product);
                else
                    $productBaseImage = $productImageHelper->getProductBaseImage($item->product);
            ?>

            <div class="item mb-5" style="margin-bottom: 5px;">
                <div class="item-image">
                    <img src="<?php echo e($productBaseImage['medium_image_url']); ?>" />
                </div>

                <div class="item-details">

                    <?php echo view_render_event('bagisto.shop.checkout.name.before', ['item' => $item]); ?>


                    <div class="item-title">
                        <?php echo e($product->name); ?>

                    </div>

                    <?php echo view_render_event('bagisto.shop.checkout.name.after', ['item' => $item]); ?>

                    <?php echo view_render_event('bagisto.shop.checkout.price.before', ['item' => $item]); ?>


                    <div class="row">
                        <span class="title">
                            <?php echo e(__('shop::app.checkout.onepage.price')); ?>

                        </span>
                        <span class="value">
                            <?php echo e(core()->currency($item->base_price)); ?>

                        </span>
                    </div>

                    <?php echo view_render_event('bagisto.shop.checkout.price.after', ['item' => $item]); ?>

                    <?php echo view_render_event('bagisto.shop.checkout.quantity.before', ['item' => $item]); ?>


                    <div class="row">
                        <span class="title">
                            <?php echo e(__('shop::app.checkout.onepage.quantity')); ?>

                        </span>
                        <span class="value">
                            <?php echo e($item->quantity); ?>

                        </span>
                    </div>

                    <?php echo view_render_event('bagisto.shop.checkout.quantity.after', ['item' => $item]); ?>


                    <?php if($product->type == 'configurable'): ?>
                        <?php echo view_render_event('bagisto.shop.checkout.options.after', ['item' => $item]); ?>


                        <div class="summary" >
                            <?php echo e(Cart::getProductAttributeOptionDetails($item->child->product)['html']); ?>

                        </div>

                        <?php echo view_render_event('bagisto.shop.checkout.options.after', ['item' => $item]); ?>

                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="order-description mt-20">
        <div class="pull-left" style="width: 60%; float: left;">
            <div class="shipping">
                <div class="decorator">
                    <i class="icon shipping-icon"></i>
                </div>

                <div class="text">
                    <?php echo e(core()->currency($cart->selected_shipping_rate->base_price)); ?>


                    <div class="info">
                        <?php echo e($cart->selected_shipping_rate->method_title); ?>

                    </div>
                </div>
            </div>

            <div class="payment">
                <div class="decorator">
                    <i class="icon payment-icon"></i>
                </div>

                <div class="text">
                    <?php echo e(core()->getConfigData('sales.paymentmethods.' . $cart->payment->method . '.title')); ?>

                </div>
            </div>

        </div>

        <div class="pull-right" style="width: 40%; float: left;">
            <slot name="summary-section"></slot>
        </div>
    </div>
</div>