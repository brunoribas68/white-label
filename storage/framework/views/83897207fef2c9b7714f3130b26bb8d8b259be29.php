<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.users.sessions.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="panel">

        <div class="panel-content">

            <div class="form-container" style="text-align: left">

                <h1><?php echo e(__('admin::app.users.sessions.title')); ?></h1>

                <form method="POST" action="<?php echo e(route('admin.session.store')); ?>" @submit.prevent="onSubmit">
                    <?php echo csrf_field(); ?>

                    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email"><?php echo e(__('admin::app.users.sessions.email')); ?></label>
                        <input type="text" v-validate="'required'" class="control" id="email" name="email" data-vv-as="&quot;<?php echo e(__('admin::app.users.sessions.email')); ?>&quot;"/>
                        <span class="control-error" v-if="errors.has('email')">{{ errors.first('email') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                        <label for="password"><?php echo e(__('admin::app.users.sessions.password')); ?></label>
                        <input type="password" v-validate="'required|min:6'" class="control" id="password" name="password" data-vv-as="&quot;<?php echo e(__('admin::app.users.sessions.password')); ?>&quot;"/>
                        <span class="control-error" v-if="errors.has('password')">{{ errors.first('password') }}</span>
                    </div>

                    <div class="control-group">
                        <a href="<?php echo e(route('admin.forget-password.create')); ?>"><?php echo e(__('admin::app.users.sessions.forget-password-link-title')); ?></a>
                    </div>

                    <div class="button-group">
                        <button class="btn btn-xl btn-primary"><?php echo e(__('admin::app.users.sessions.submit-btn-title')); ?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.anonymous-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>