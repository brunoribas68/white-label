<form data-vv-scope="payment-form">
    <div class="form-container">
        <div class="form-header mb-30">
            <span class="checkout-step-heading"><?php echo e(__('shop::app.checkout.onepage.payment-methods')); ?></span>
        </div>

        <div class="payment-methods">

            <div class="control-group" :class="[errors.has('payment-form.payment[method]') ? 'has-error' : '']">

                <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php echo view_render_event('bagisto.shop.checkout.payment-method.before', ['payment' => $payment]); ?>


                    <div class="checkout-method-group mb-20">
                        <div class="line-one">
                            <label class="radio-container">
                                <input v-validate="'required'" type="radio" id="<?php echo e($payment['method']); ?>" name="payment[method]" value="<?php echo e($payment['method']); ?>" v-model="payment.method" @change="methodSelected()" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.payment-method')); ?>&quot;">

                                <span class="checkmark"></span>

                                
                            </label>

                            <span class="payment-method method-label">
                                <b><?php echo e($payment['method_title']); ?></b>
                            </span>
                        </div>

                        <div class="line-two mt-5">
                            <span class="method-summary"><?php echo e(__($payment['description'])); ?></span>
                        </div>
                    </div>

                    <?php echo view_render_event('bagisto.shop.checkout.payment-method.after', ['payment' => $payment]); ?>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <span class="control-error" v-if="errors.has('payment-form.payment[method]')">
                    {{ errors.first('payment-form.payment[method]') }}
                </span>

            </div>
        </div>
    </div>
</form>