<div class="order-summary">
    <h3><?php echo e(__('shop::app.checkout.total.order-summary')); ?></h3>

    <div class="item-detail">
        <label>
            <?php echo e(intval($cart->items_qty)); ?>

            <?php echo e(__('shop::app.checkout.total.sub-total')); ?>

            <?php echo e(__('shop::app.checkout.total.price')); ?>

        </label>
        <label class="right"><?php echo e(core()->currency($cart->base_sub_total)); ?></label>
    </div>

    <?php if($cart->selected_shipping_rate): ?>
        <div class="item-detail">
            <label><?php echo e(__('shop::app.checkout.total.delivery-charges')); ?></label>
            <label class="right"><?php echo e(core()->currency($cart->selected_shipping_rate->base_price)); ?></label>
        </div>
    <?php endif; ?>

    <?php if($cart->base_tax_total): ?>
        <div class="item-detail">
            <label><?php echo e(__('shop::app.checkout.total.tax')); ?></label>
            <label class="right"><?php echo e(core()->currency($cart->base_tax_total)); ?></label>
        </div>
    <?php endif; ?>


    <div class="item-detail" id="discount-detail" <?php if($cart->base_discount_amount && $cart->base_discount_amount > 0): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
        <label>
            <b><?php echo e(__('shop::app.checkout.total.disc-amount')); ?></b>
        </label>
        <label class="right">
            <b id="discount-detail-discount-amount">
                <?php echo e(core()->currency($cart->base_discount_amount)); ?>

            </b>
        </label>
    </div>


    <div class="payable-amount" id="grand-total-detail">
        <label><?php echo e(__('shop::app.checkout.total.grand-total')); ?></label>
        <label class="right" id="grand-total-amount-detail">
            <?php echo e(core()->currency($cart->base_grand_total)); ?>

        </label>
    </div>

    <div <?php if(! request()->is('checkout/cart')): ?> v-if="parseInt(discount)" <?php endif; ?>>
        <?php if(! request()->is('checkout/cart')): ?>
            <?php if(! $cart->coupon_code): ?>
                <div class="discount">
                    <div class="discount-group">
                        <form class="coupon-form" method="post" @submit.prevent="onSubmit">
                            <div class="control-group mt-20" :class="[errors.has('code') ? 'has-error' : '']" style="margin-bottom: 10px">
                                <input type="text" class="control" value="" v-model="coupon_code" name="code" placeholder="Enter Coupon Code" v-validate="'required'" style="width: 100%" @change="changeCoupon">
                            </div>

                            <div class="control-error mb-10" v-if="error_message != null" style="color: #FF6472">* {{ error_message }}</div>

                            <button class="btn btn-lg btn-black" :disabled="couponChanged"><?php echo e(__('shop::app.checkout.onepage.apply-coupon')); ?></button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="discount-details-group">
                    <div class="item-detail">
                        <label><?php echo e(__('shop::app.checkout.total.coupon-applied')); ?></label>

                        <label class="right" style="display: inline-flex; align-items: center;">
                            <b><?php echo e($cart->coupon_code); ?></b>

                            <span class="icon cross-icon" title="<?php echo e(__('shop::app.checkout.total.remove-coupon')); ?>" v-on:click="removeCoupon"></span>
                        </label>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>