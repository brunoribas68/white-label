<select v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($attribute->code); ?>" name="<?php echo e($attribute->code); ?>" <?php echo e($disabled ? 'disabled' : ''); ?> data-vv-as="&quot;<?php echo e($attribute->admin_name); ?>&quot;">

    <?php $selectedOption = old($attribute->code) ?: $product[$attribute->code] ?>

    <option value="0" <?php echo e($selectedOption ? '' : 'selected'); ?>>
        <?php echo e($attribute->code == 'status' ? __('admin::app.catalog.products.disabled') : __('admin::app.catalog.products.no')); ?>

    </option>
    <option value="1" <?php echo e($selectedOption ? 'selected' : ''); ?>>
        <?php echo e($attribute->code == 'status' ? __('admin::app.catalog.products.enabled') : __('admin::app.catalog.products.yes')); ?>

    </option>
    
</select>