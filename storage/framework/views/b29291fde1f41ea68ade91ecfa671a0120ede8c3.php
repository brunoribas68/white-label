<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.catalog.categories.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">

        <form method="POST" action="<?php echo e(route('admin.catalog.categories.store')); ?>" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '<?php echo e(url('/admin/dashboard')); ?>';"></i>

                        <?php echo e(__('admin::app.catalog.categories.add-title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.save')); ?> <?php echo e(__('admin::app.category')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="locale" value="all"/>

                    <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.before'); ?>


                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.general')); ?>'" :active="true">
                        <div slot="body">

                            <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.controls.before'); ?>


                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required"><?php echo e(__('admin::app.catalog.categories.name')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" value="<?php echo e(old('name')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.name')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                                <label for="status" class="required"><?php echo e(__('admin::app.catalog.categories.visible-in-menu')); ?></label>
                                <select class="control" v-validate="'required'" id="status" name="status" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.visible-in-menu')); ?>&quot;">
                                    <option value="1">
                                        <?php echo e(__('admin::app.catalog.categories.yes')); ?>

                                    </option>
                                    <option value="0">
                                        <?php echo e(__('admin::app.catalog.categories.no')); ?>

                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('status')">{{ errors.first('status') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('position') ? 'has-error' : '']">
                                <label for="position" class="required"><?php echo e(__('admin::app.catalog.categories.position')); ?></label>
                                <input type="text" v-validate="'required|numeric'" class="control" id="position" name="position" value="<?php echo e(old('position')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.position')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('position')">{{ errors.first('position') }}</span>
                            </div>

                            <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.controls.after'); ?>


                        </div>
                    </accordian>

                    <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.after'); ?>



                    <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.description_images.before'); ?>


                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.description-and-images')); ?>'" :active="true">
                        <div slot="body">

                            <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.description_images.controls.before'); ?>


                            <div class="control-group" :class="[errors.has('display_mode') ? 'has-error' : '']">
                                <label for="display_mode" class="required"><?php echo e(__('admin::app.catalog.categories.display-mode')); ?></label>
                                <select class="control" v-validate="'required'" id="display_mode" name="display_mode" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.display-mode')); ?>&quot;">
                                    <option value="products_and_description">
                                        <?php echo e(__('admin::app.catalog.categories.products-and-description')); ?>

                                    </option>
                                    <option value="products_only">
                                        <?php echo e(__('admin::app.catalog.categories.products-only')); ?>

                                    </option>
                                    <option value="description_only">
                                        <?php echo e(__('admin::app.catalog.categories.description-only')); ?>

                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('display_mode')">{{ errors.first('display_mode') }}</span>
                            </div>

                            <description></description>

                            <div class="control-group <?php echo $errors->has('image.*') ? 'has-error' : ''; ?>">
                                <label><?php echo e(__('admin::app.catalog.categories.image')); ?>


                                <image-wrapper :button-label="'<?php echo e(__('admin::app.catalog.products.add-image-btn-title')); ?>'" input-name="image" :multiple="false"></image-wrapper>

                                <span class="control-error" v-if="<?php echo $errors->has('image.*'); ?>">
                                    <?php $__currentLoopData = $errors->get('image.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo str_replace($key, 'Image', $message[0]); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </span>

                            </div>

                            <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.description_images.controls.after'); ?>


                        </div>
                    </accordian>

                    <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.description_images.after'); ?>



                    <?php if($categories->count()): ?>

                        <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.parent_category.before'); ?>


                        <accordian :title="'<?php echo e(__('admin::app.catalog.categories.parent-category')); ?>'" :active="true">
                            <div slot="body">

                                <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.parent_category.controls.before'); ?>


                                <tree-view value-field="id" name-field="parent_id" input-type="radio" items='<?php echo json_encode($categories, 15, 512) ?>'></tree-view>

                                <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.parent_category.controls.after'); ?>


                            </div>
                        </accordian>

                        <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.parent_category.after'); ?>


                    <?php endif; ?>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.filterable-attributes')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('attributes[]') ? 'has-error' : '']">
                                <label for="attributes" class="required"><?php echo e(__('admin::app.catalog.categories.attributes')); ?></label>
                                <select class="control" name="attributes[]" v-validate="'required'" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.attributes')); ?>&quot;" multiple>
                                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($attribute->id); ?>">
                                            <?php echo e($attribute->name ? $attribute->name : $attribute->admin_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="control-error" v-if="errors.has('attributes[]')">
                                    {{ errors.first('attributes[]') }}
                                </span>
                            </div>
                        </div>
                    </accordian>

                    <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.before'); ?>


                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.seo')); ?>'" :active="true">
                        <div slot="body">

                            <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.before'); ?>


                            <div class="control-group">
                                <label for="meta_title"><?php echo e(__('admin::app.catalog.categories.meta_title')); ?></label>
                                <input type="text" class="control" id="meta_title" name="meta_title" value="<?php echo e(old('meta_title')); ?>"/>
                            </div>

                            <div class="control-group" :class="[errors.has('slug') ? 'has-error' : '']">
                                <label for="slug" class="required"><?php echo e(__('admin::app.catalog.categories.slug')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="slug" name="slug" value="<?php echo e(old('slug')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.slug')); ?>&quot;" v-slugify/>
                                <span class="control-error" v-if="errors.has('slug')">{{ errors.first('slug') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="meta_description"><?php echo e(__('admin::app.catalog.categories.meta_description')); ?></label>
                                <textarea class="control" id="meta_description" name="meta_description"><?php echo e(old('meta_description')); ?></textarea>
                            </div>

                            <div class="control-group">
                                <label for="meta_keywords"><?php echo e(__('admin::app.catalog.categories.meta_keywords')); ?></label>
                                <textarea class="control" id="meta_keywords" name="meta_keywords"><?php echo e(old('meta_keywords')); ?></textarea>
                            </div>

                            <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.after'); ?>


                        </div>
                    </accordian>

                    <?php echo view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.after'); ?>


                </div>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js')); ?>"></script>

    <script type="text/x-template" id="description-template">

        <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
            <label for="description" :class="isRequired ? 'required' : ''"><?php echo e(__('admin::app.catalog.categories.description')); ?></label>
            <textarea v-validate="isRequired ? 'required' : ''"  class="control" id="description" name="description" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.description')); ?>&quot;"><?php echo e(old('description')); ?></textarea>
            <span class="control-error" v-if="errors.has('description')">{{ errors.first('description') }}</span>
        </div>

    </script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#description',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true
            });
        });

        Vue.component('description', {

            template: '#description-template',

            inject: ['$validator'],

            data: function() {
                return {
                    isRequired: true,
                }
            },

            created: function () {
                var this_this = this;

                $(document).ready(function () {
                    $('#display_mode').on('change', function (e) {
                        if ($('#display_mode').val() != 'products_only') {
                            this_this.isRequired = true;
                        } else {
                            this_this.isRequired = false;
                        }
                    })
                });
            }
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>