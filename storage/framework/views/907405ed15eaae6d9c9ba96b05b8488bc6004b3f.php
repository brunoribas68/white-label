<input type="text" v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($attribute->code); ?>" name="<?php echo e($attribute->code); ?>" value="<?php echo e(old($attribute->code) ?: $product[$attribute->code]); ?>" data-vv-as="&quot;<?php echo e($attribute->admin_name); ?>&quot;" <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo e(in_array($attribute->code, ['sku', 'url_key']) ? 'v-slugify' : ''); ?>/>