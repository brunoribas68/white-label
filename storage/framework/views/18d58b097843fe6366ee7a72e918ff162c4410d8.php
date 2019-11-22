<form data-vv-scope="shipping-form">
    <div class="form-container">
        <div class="form-header mb-30">
            <span class="checkout-step-heading"><?php echo e(__('shop::app.checkout.onepage.shipping-method')); ?></span>
        </div>

        <div class="shipping-methods">

            <div class="control-group" :class="[errors.has('shipping-form.shipping_method') ? 'has-error' : '']">

                <?php $__currentLoopData = $shippingRateGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rateGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo view_render_event('bagisto.shop.checkout.shipping-method.before', ['rateGroup' => $rateGroup]); ?>


                    <span class="carrier-title" id="carrier-title" style="font-size:18px; font-weight: bold;">
                        <?php echo e($rateGroup['carrier_title']); ?>

                    </span>

                    <?php $__currentLoopData = $rateGroup['rates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="checkout-method-group mb-20">
                            <div class="line-one">
                                <label class="radio-container">
                                    <input v-validate="'required'" type="radio" id="<?php echo e($rate->method); ?>" name="shipping_method" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.shipping-method')); ?>&quot;" value="<?php echo e($rate->method); ?>" v-model="selected_shipping_method" @change="methodSelected()">
                                    <span class="checkmark"></span>
                                </label>
                                
                                <b class="ship-rate method-label"><?php echo e(core()->currency($rate->base_price)); ?></b>
                            </div>

                            <div class="line-two mt-5">
                                <div class="method-summary">
                                    <b><?php echo e($rate->method_title); ?></b> - <?php echo e(__($rate->method_description)); ?>

                                </div>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php echo view_render_event('bagisto.shop.checkout.shipping-method.after', ['rateGroup' => $rateGroup]); ?>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <span class="control-error" v-if="errors.has('shipping-form.shipping_method')">
                    {{ errors.first('shipping-form.shipping_method') }}
                </span>
            </div>
        </div>
    </div>
</form>