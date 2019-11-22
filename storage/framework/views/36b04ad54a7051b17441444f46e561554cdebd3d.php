<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.catalog.products.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .table td .label {
            margin-right: 10px;
        }
        .table td .label:last-child {
            margin-right: 0;
        }
        .table td .label .icon {
            vertical-align: middle;
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <form method="POST" action="" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '<?php echo e(url('/admin/dashboard')); ?>';"></i>

                        <?php echo e(__('admin::app.catalog.products.add-title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.catalog.products.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <?php echo csrf_field(); ?>

                <?php $familyId = app('request')->input('family') ?>
                <?php $sku = app('request')->input('sku') ?>
                <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.before'); ?>


                <accordian :title="'<?php echo e(__('admin::app.catalog.products.general')); ?>'" :active="true">
                    <div slot="body">

                        <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.controls.before'); ?>


                        <div class="control-group" :class="[errors.has('type') ? 'has-error' : '']">
                            <label for="type" class="required"><?php echo e(__('admin::app.catalog.products.product-type')); ?></label>
                            <select class="control" v-validate="'required'" id="type" name="type" <?php echo e($familyId ? 'disabled' : ''); ?> data-vv-as="&quot;<?php echo e(__('admin::app.catalog.products.product-type')); ?>&quot;">
                                <?php $__currentLoopData = $productTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $productType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e($key == $productType['key'] ? 'selected' : ''); ?>><?php echo e($productType['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <?php if($familyId): ?>
                                <input type="hidden" name="type" value="configurable"/>
                            <?php endif; ?>
                            <span class="control-error" v-if="errors.has('type')">{{ errors.first('type') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('attribute_family_id') ? 'has-error' : '']">
                            <label for="attribute_family_id" class="required"><?php echo e(__('admin::app.catalog.products.familiy')); ?></label>
                            <select class="control" v-validate="'required'" id="attribute_family_id" name="attribute_family_id" <?php echo e($familyId ? 'disabled' : ''); ?> data-vv-as="&quot;<?php echo e(__('admin::app.catalog.products.familiy')); ?>&quot;">
                                <option value=""></option>
                                <?php $__currentLoopData = $families; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $family): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($family->id); ?>" <?php echo e(($familyId == $family->id || old('attribute_family_id') == $family->id) ? 'selected' : ''); ?>><?php echo e($family->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <?php if($familyId): ?>
                                <input type="hidden" name="attribute_family_id" value="<?php echo e($familyId); ?>"/>
                            <?php endif; ?>
                            <span class="control-error" v-if="errors.has('attribute_family_id')">{{ errors.first('attribute_family_id') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('sku') ? 'has-error' : '']">
                            <label for="sku" class="required"><?php echo e(__('admin::app.catalog.products.sku')); ?></label>
                            <input type="text" v-validate="{ required: true, regex: /^[a-z0-9]+(?:-[a-z0-9]+)*$/ }" class="control" id="sku" name="sku" value="<?php echo e($sku ?: old('sku')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.products.sku')); ?>&quot;"/>
                            <span class="control-error" v-if="errors.has('sku')">{{ errors.first('sku') }}</span>
                        </div>

                        <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.controls.after'); ?>


                    </div>
                </accordian>

                <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.after'); ?>


                <?php if($familyId): ?>

                    <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.before'); ?>


                    <accordian :title="'<?php echo e(__('admin::app.catalog.products.configurable-attributes')); ?>'" :active="true">
                        <div slot="body">

                            <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.controls.before'); ?>


                            <div class="table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('admin::app.catalog.products.attribute-header')); ?></th>
                                            <th><?php echo e(__('admin::app.catalog.products.attribute-option-header')); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $configurableFamily->configurable_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($attribute->admin_name); ?>

                                                </td>
                                                <td>
                                                    <?php $__currentLoopData = $attribute->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="label">
                                                            <input type="hidden" name="super_attributes[<?php echo e($attribute->code); ?>][]" value="<?php echo e($option->id); ?>"/>
                                                            <?php echo e($option->admin_name); ?>


                                                            <i class="icon cross-icon"></i>
                                                        </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td class="actions">
                                                    <i class="icon trash-icon"></i>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>
                            </div>

                            <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.controls.after'); ?>


                        </div>
                    </accordian>

                    <?php echo view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.after'); ?>

                <?php endif; ?>

            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('.label .cross-icon').on('click', function(e) {
                $(e.target).parent().remove();
            })

            $('.actions .trash-icon').on('click', function(e) {
                $(e.target).parents('tr').remove();
            })
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>