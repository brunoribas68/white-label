<date>
    <input type="text" name="<?php echo e($attribute->code); ?>" class="control" <?php echo e($attribute->is_required ? "v-validate='required'" : ''); ?> value="<?php echo e(old($attribute->code) ?: $product[$attribute->code]); ?>" data-vv-as="&quot;<?php echo e($attribute->admin_name); ?>&quot;" <?php echo e($disabled ? 'disabled' : ''); ?>/>
</date>