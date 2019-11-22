<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.customer.login-form.page-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="auth-content">
        <div class="sign-up-text">
            <?php echo e(__('shop::app.customer.login-text.no_account')); ?> - <a href="<?php echo e(route('customer.register.index')); ?>"><?php echo e(__('shop::app.customer.login-text.title')); ?></a>
        </div>

        <?php echo view_render_event('bagisto.shop.customers.login.before'); ?>


        <form method="POST" action="<?php echo e(route('customer.session.create')); ?>" @submit.prevent="onSubmit">
            <?php echo e(csrf_field()); ?>

            <div class="login-form">
                <div class="login-text"><?php echo e(__('shop::app.customer.login-form.title')); ?></div>

                <?php echo view_render_event('bagisto.shop.customers.login_form_controls.before'); ?>


                <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                    <label for="email" class="required"><?php echo e(__('shop::app.customer.login-form.email')); ?></label>
                    <input type="text" class="control" name="email" v-validate="'required|email'" value="<?php echo e(old('email')); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customer.login-form.email')); ?>&quot;">
                    <span class="control-error" v-if="errors.has('email')">{{ errors.first('email') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                    <label for="password" class="required"><?php echo e(__('shop::app.customer.login-form.password')); ?></label>
                    <input type="password" class="control" name="password" v-validate="'required'" value="<?php echo e(old('password')); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customer.login-form.password')); ?>&quot;">
                    <span class="control-error" v-if="errors.has('password')">{{ errors.first('password') }}</span>
                </div>

                <?php echo view_render_event('bagisto.shop.customers.login_form_controls.after'); ?>


                <div class="forgot-password-link">
                    <a href="<?php echo e(route('customer.forgot-password.create')); ?>"><?php echo e(__('shop::app.customer.login-form.forgot_pass')); ?></a>

                    <div class="mt-10">
                        <?php if(Cookie::has('enable-resend')): ?>
                            <?php if(Cookie::get('enable-resend') == true): ?>
                                <a href="<?php echo e(route('customer.resend.verification-email', Cookie::get('email-for-resend'))); ?>"><?php echo e(__('shop::app.customer.login-form.resend-verification')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <input class="btn btn-primary btn-lg" type="submit" value="<?php echo e(__('shop::app.customer.login-form.button_title')); ?>">
            </div>
        </form>

        <?php echo view_render_event('bagisto.shop.customers.login.after'); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>