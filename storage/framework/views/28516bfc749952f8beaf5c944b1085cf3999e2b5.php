<?php $__env->startSection('page_title'); ?>
    <?php echo e(trim($product->meta_title) != "" ? $product->meta_title : $product->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('seo'); ?>
    <meta name="description" content="<?php echo e(trim($product->meta_description) != "" ? $product->meta_description : str_limit(strip_tags($product->description), 120, '')); ?>"/>
    <meta name="keywords" content="<?php echo e($product->meta_keywords); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <?php echo view_render_event('bagisto.shop.products.view.before', ['product' => $product]); ?>


    <section class="product-detail">

        <div class="layouter">
            <product-view>
                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="product" value="<?php echo e($product->product_id); ?>">

                    <?php echo $__env->make('shop::products.view.gallery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="details">

                        <div class="product-heading">
                            <span><?php echo e($product->name); ?></span>
                        </div>

                        <?php echo $__env->make('shop::products.review', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo $__env->make('shop::products.price', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo $__env->make('shop::products.view.stock', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo view_render_event('bagisto.shop.products.view.short_description.before', ['product' => $product]); ?>


                        <div class="description">
                            <?php echo $product->short_description; ?>

                        </div>

                        <?php echo view_render_event('bagisto.shop.products.view.short_description.after', ['product' => $product]); ?>



                        <?php echo view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]); ?>


                        <div class="quantity control-group" :class="[errors.has('quantity') ? 'has-error' : '']">

                            <label class="required"><?php echo e(__('shop::app.products.quantity')); ?></label>

                            <input class="control quantity-change" value="-" style="width: 35px; border-radius: 3px 0px 0px 3px;" onclick="updateQunatity('remove')" readonly>

                            <input name="quantity" id="quantity" class="control quantity-change" value="1" v-validate="'required|numeric|min_value:1'" style="width: 60px; position: relative; margin-left: -4px; margin-right: -4px; border-right: none;border-left: none; border-radius: 0px;" data-vv-as="&quot;<?php echo e(__('shop::app.products.quantity')); ?>&quot;" readonly>

                            <input class="control quantity-change" value="+" style="width: 35px; padding: 0 12px; border-radius: 0px 3px 3px 0px;" onclick=updateQunatity('add') readonly>

                            <span class="control-error" v-if="errors.has('quantity')">{{ errors.first('quantity') }}</span>
                        </div>

                        <?php echo view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]); ?>


                        <?php if($product->type == 'configurable'): ?>
                            <input type="hidden" value="true" name="is_configurable">
                        <?php else: ?>
                            <input type="hidden" value="false" name="is_configurable">
                        <?php endif; ?>

                        <?php echo $__env->make('shop::products.view.configurable-options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]); ?>


                        <accordian :title="'<?php echo e(__('shop::app.products.description')); ?>'" :active="true">
                            <div slot="header">
                                <?php echo e(__('shop::app.products.description')); ?>

                                <i class="icon expand-icon right"></i>
                            </div>

                            <div slot="body">
                                <div class="full-description">
                                    <?php echo $product->description; ?>

                                </div>
                            </div>
                        </accordian>

                        <?php echo view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]); ?>


                        <?php echo $__env->make('shop::products.view.attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo $__env->make('shop::products.view.reviews', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </product-view>
        </div>

        <?php echo $__env->make('shop::products.view.related-products', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('shop::products.view.up-sells', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </section>

    <?php echo view_render_event('bagisto.shop.products.view.after', ['product' => $product]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script type="text/x-template" id="product-view-template">
        <form method="POST" id="product-form" action="<?php echo e(route('cart.add', $product->product_id)); ?>" @click="onSubmit($event)">

            <slot></slot>

        </form>
    </script>

    <script>

        Vue.component('product-view', {

            template: '#product-view-template',

            inject: ['$validator'],

            methods: {
                onSubmit: function(e) {
                    if (e.target.getAttribute('type') != 'submit')
                        return;

                    e.preventDefault();

                    this.$validator.validateAll().then(function (result) {
                        if (result) {
                          if (e.target.getAttribute('data-href')) {
                            window.location.href = e.target.getAttribute('data-href');
                          } else {
                            document.getElementById('product-form').submit();
                          }
                        }
                    });
                }
            }
        });

        $(document).ready(function() {
            var addTOButton = document.getElementsByClassName('add-to-buttons')[0];
            document.getElementById('loader').style.display="none";
            addTOButton.style.display="flex";
        });

        window.onload = function() {
            var thumbList = document.getElementsByClassName('thumb-list')[0];
            var thumbFrame = document.getElementsByClassName('thumb-frame');
            var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

            if (thumbList && productHeroImage) {

                for(let i=0; i < thumbFrame.length ; i++) {
                    thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                    thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                }

                if (screen.width > 720) {
                    thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.height = productHeroImage.offsetHeight + "px";
                }
            }

            window.onresize = function() {
                if (thumbList && productHeroImage) {

                    for(let i=0; i < thumbFrame.length; i++) {
                        thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                        thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                    }

                    if (screen.width > 720) {
                        thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.height = productHeroImage.offsetHeight + "px";
                    }
                }
            }
        };

        function updateQunatity(operation) {
            var quantity = document.getElementById('quantity').value;

            if (operation == 'add') {
                quantity = parseInt(quantity) + 1;
            } else if (operation == 'remove') {
                if (quantity > 1) {
                    quantity = parseInt(quantity) - 1;
                } else {
                    alert('<?php echo e(__('shop::app.products.less-quantity')); ?>');
                }
            }
            document.getElementById("quantity").value = quantity;

            event.preventDefault();
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>