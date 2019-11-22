<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.tax-rates.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <form method="POST" action="<?php echo e(route('admin.tax-rates.create')); ?>" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '<?php echo e(url('/admin/dashboard')); ?>';"></i>

                        <?php echo e(__('admin::app.settings.tax-rates.add-title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.settings.tax-rates.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <tax-rate-form></tax-rate-form>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script type="text/x-template" id="tax-rate-form-template">
        <div>
            <div class="control-group" :class="[errors.has('identifier') ? 'has-error' : '']">
                <label for="identifier" class="required"><?php echo e(__('admin::app.configuration.tax-rates.identifier')); ?></label>
                <input v-validate="'required'" class="control" id="identifier" name="identifier" data-vv-as="&quot;<?php echo e(__('admin::app.configuration.tax-rates.identifier')); ?>&quot;" value="<?php echo e(old('identifier')); ?>"/>
                <span class="control-error" v-if="errors.has('identifier')">{{ errors.first('identifier') }}</span>
            </div>

            <?php echo $__env->make('admin::customers.country-state', ['countryCode' => old('country'), 'stateCode' => old('state')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="control-group">
                <span class="checkbox">
                    <input type="checkbox" id="is_zip" name="is_zip" v-model="is_zip">
                    <label class="checkbox-view" for="is_zip"></label>
                    <?php echo e(__('admin::app.settings.tax-rates.is_zip')); ?>

                </span>
            </div>

            <div v-if="!is_zip" class="control-group" :class="[errors.has('zip_code') ? 'has-error' : '']" id="zip_code">
                <label for="zip_code" class="required"><?php echo e(__('admin::app.configuration.tax-rates.zip_code')); ?></label>
                <input v-validate="'required'" class="control" id="zip_code" name="zip_code" data-vv-as="&quot;<?php echo e(__('admin::app.configuration.tax-rates.zip_code')); ?>&quot;" value="<?php echo e(old('zip_code')); ?>"/>
                <span class="control-error" v-if="errors.has('zip_code')">{{ errors.first('zip_code') }}</span>
            </div>

            <span v-if="is_zip">
                <div class="control-group" :class="[errors.has('zip_from') ? 'has-error' : '']" id="zip_from">
                    <label for="zip_from" class="required"><?php echo e(__('admin::app.configuration.tax-rates.zip_from')); ?></label>
                    <input v-validate="'required'" class="control" name="zip_from" data-vv-as="&quot;<?php echo e(__('admin::app.configuration.tax-rates.zip_from')); ?>&quot;" value="<?php echo e(old('zip_from')); ?>"/>
                    <span class="control-error" v-if="errors.has('zip_from')">{{ errors.first('zip_from') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('zip_to') ? 'has-error' : '']" id="zip_to">
                    <label for="zip_to" class="required"><?php echo e(__('admin::app.configuration.tax-rates.zip_to')); ?></label>
                    <input v-validate="'required'" class="control" name="zip_to" data-vv-as="&quot;<?php echo e(__('admin::app.configuration.tax-rates.zip_to')); ?>&quot;" value="<?php echo e(old('zip_to')); ?>"/>
                    <span class="control-error" v-if="errors.has('zip_to')">{{ errors.first('zip_to') }}</span>
                </div>
            </span>

            <div class="control-group" :class="[errors.has('tax_rate') ? 'has-error' : '']">
                <label for="tax_rate" class="required"><?php echo e(__('admin::app.configuration.tax-rates.tax_rate')); ?></label>
                <input v-validate="'required|min_value:0.0001'" class="control" id="tax_rate" name="tax_rate" data-vv-as="&quot;<?php echo e(__('admin::app.configuration.tax-rates.tax_rate')); ?>&quot;" value="<?php echo e(old('tax_rate')); ?>"/>
                <span class="control-error" v-if="errors.has('tax_rate')">{{ errors.first('tax_rate') }}</span>
            </div>
        </div>
    </script>

    <script>
        Vue.component('tax-rate-form', {

            template: '#tax-rate-form-template',

            inject: ['$validator'],

            data: function () {
                return {
                    is_zip: false
                }
            },
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>