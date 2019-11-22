<accordian :title="'<?php echo e(__('admin::app.catalog.products.images')); ?>'" :active="true">
    <div slot="body">

        <?php echo view_render_event('bagisto.admin.catalog.product.edit_form_accordian.images.controls.before', ['product' => $product]); ?>


        <div class="control-group <?php echo $errors->has('images.*') ? 'has-error' : ''; ?>">
            <label><?php echo e(__('admin::app.catalog.categories.image')); ?>


            <image-wrapper :button-label="'<?php echo e(__('admin::app.catalog.products.add-image-btn-title')); ?>'" input-name="images" :images='<?php echo json_encode($product->images, 15, 512) ?>'></image-wrapper>

            <span class="control-error" v-if="<?php echo $errors->has('images.*'); ?>">
                <?php $count=1 ?>
                <?php $__currentLoopData = $errors->get('images.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo str_replace($key, 'Image'.$count, $message[0]); $count++ ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
        </div>

        <?php echo view_render_event('bagisto.admin.catalog.product.edit_form_accordian.images.controls.after', ['product' => $product]); ?>


    </div>
</accordian>