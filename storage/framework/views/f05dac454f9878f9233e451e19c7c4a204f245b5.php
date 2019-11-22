<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.customer.account.profile.index.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

<div class="account-content">

    <?php echo $__env->make('shop::customers.account.partials.sidemenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="account-layout">

        <div class="account-head">

            <span class="back-icon"><a href="<?php echo e(route('customer.account.index')); ?>"><i class="icon icon-menu-back"></i></a></span>

            <span class="account-heading"><?php echo e(__('shop::app.customer.account.profile.index.title')); ?></span>

            <span class="account-action">
                <a href="<?php echo e(route('customer.profile.edit')); ?>"><?php echo e(__('shop::app.customer.account.profile.index.edit')); ?></a>
            </span>

            <div class="horizontal-rule"></div>
        </div>

         <?php echo view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]); ?>


        <div class="account-table-content" style="width: 50%;">
            <table style="color: #5E5E5E;">
                <tbody>
                    <tr>
                        <td><?php echo e(__('shop::app.customer.account.profile.fname')); ?></td>
                        <td><?php echo e($customer->first_name); ?></td>
                    </tr>

                    <tr>
                        <td><?php echo e(__('shop::app.customer.account.profile.lname')); ?></td>
                        <td><?php echo e($customer->last_name); ?></td>
                    </tr>

                    <tr>
                        <td><?php echo e(__('shop::app.customer.account.profile.gender')); ?></td>
                        <td><?php echo e($customer->gender); ?></td>
                    </tr>

                    <tr>
                        <td><?php echo e(__('shop::app.customer.account.profile.dob')); ?></td>
                        <td><?php echo e($customer->date_of_birth); ?></td>
                    </tr>

                    <tr>
                        <td><?php echo e(__('shop::app.customer.account.profile.email')); ?></td>
                        <td><?php echo e($customer->email); ?></td>
                    </tr>

                    
                </tbody>
            </table>
        </div>

        <accordian :title="'<?php echo e(__('shop::app.customer.account.profile.index.title')); ?>'" :active="true">
            <div slot="body">
                <div class="page-action">
                    <form method="POST" action="<?php echo e(route('customer.profile.destroy')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="submit" class="btn btn-lg btn-primary mt-10" value="Delete">
                    </form>
                </div>

            </div>
        </accordian>

         <?php echo view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>