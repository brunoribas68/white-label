<?php $__env->startComponent('shop::emails.layouts.master'); ?>

    <div>
        <div style="text-align: center;">
            <a href="<?php echo e(config('app.url')); ?>">
                <img src="<?php echo e(bagisto_asset('images/logo.svg')); ?>">
            </a>
        </div>


        <div style="padding: 30px;">
            <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
                <p style="font-weight: bold;font-size: 20px;color: #242424;line-height: 24px;">
                    <?php echo e(__('shop::app.mail.customer.registration.dear', ['customer_name' => $data['first_name']. ' ' .$data['last_name']])); ?>,
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    <?php echo __('shop::app.mail.customer.registration.greeting'); ?>

                </p>
            </div>

            <div style="font-size: 16px;color: #5E5E5E;line-height: 30px;margin-bottom: 20px !important;">
                <?php echo e(__('shop::app.mail.customer.registration.summary')); ?>

            </div>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo e(__('shop::app.mail.customer.registration.thanks')); ?>

            </p>
        </div>
    </div>

<?php echo $__env->renderComponent(); ?>