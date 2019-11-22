<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.sales.refunds.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>
    <div class="content full-page">
        <form method="POST" action="<?php echo e(route('admin.sales.refunds.store', $order->id)); ?>" @submit.prevent="onSubmit">
            <?php echo csrf_field(); ?>

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '<?php echo e(url('/admin/dashboard')); ?>';"></i>

                        <?php echo e(__('admin::app.sales.refunds.add-title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.sales.refunds.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="sale-container">

                    <accordian :title="'<?php echo e(__('admin::app.sales.orders.order-and-account')); ?>'" :active="true">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.order-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.refunds.order-id')); ?>

                                        </span>

                                        <span class="value">
                                            <a href="<?php echo e(route('admin.sales.orders.view', $order->id)); ?>">#<?php echo e($order->increment_id); ?></a>
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.order-date')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->created_at); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.order-status')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->status_label); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.channel')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->channel_name); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.account-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.customer-name')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->customer_full_name); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.email')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->customer_email); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.sales.orders.address')); ?>'" :active="true">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.billing-address')); ?></span>
                                </div>

                                <div class="section-content">

                                    <?php echo $__env->make('admin::sales.address', ['address' => $order->billing_address], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                </div>
                            </div>

                            <?php if($order->shipping_address): ?>
                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span><?php echo e(__('admin::app.sales.orders.shipping-address')); ?></span>
                                    </div>

                                    <div class="section-content">

                                        <?php echo $__env->make('admin::sales.address', ['address' => $order->shipping_address], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.sales.orders.payment-and-shipping')); ?>'" :active="true">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.payment-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.payment-method')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e(core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title')); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.currency')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->order_currency_code); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.shipping-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.shipping-method')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->shipping_title); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.shipping-price')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e(core()->formatBasePrice($order->base_shipping_amount)); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.sales.orders.products-ordered')); ?>'" :active="true">
                        <div slot="body">

                            <refund-items></refund-items>

                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/x-template" id="refund-items-template">
        <div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th><?php echo e(__('admin::app.sales.orders.SKU')); ?></th>
                            <th><?php echo e(__('admin::app.sales.orders.product-name')); ?></th>
                            <th><?php echo e(__('admin::app.sales.orders.item-status')); ?></th>
                            <th><?php echo e(__('admin::app.sales.orders.subtotal')); ?></th>
                            <th><?php echo e(__('admin::app.sales.orders.tax-amount')); ?></th>
                            <?php if($order->base_discount_amount > 0): ?>
                                <th><?php echo e(__('admin::app.sales.orders.discount-amount')); ?></th>
                            <?php endif; ?>
                            <th><?php echo e(__('admin::app.sales.orders.grand-total')); ?></th>
                            <th><?php echo e(__('admin::app.sales.refunds.qty-ordered')); ?></th>
                            <th><?php echo e(__('admin::app.sales.refunds.qty-to-refund')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->type == 'configurable' ? $item->child->sku : $item->sku); ?></td>

                                <td>
                                    <?php echo e($item->name); ?>


                                    <?php if($html = $item->getOptionDetailHtml()): ?>
                                        <p><?php echo e($html); ?></p>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <span class="qty-row">
                                        <?php echo e($item->qty_ordered ? __('admin::app.sales.orders.item-ordered', ['qty_ordered' => $item->qty_ordered]) : ''); ?>

                                    </span>

                                    <span class="qty-row">
                                        <?php echo e($item->qty_invoiced ? __('admin::app.sales.orders.item-invoice', ['qty_invoiced' => $item->qty_invoiced]) : ''); ?>

                                    </span>

                                    <span class="qty-row">
                                        <?php echo e($item->qty_shipped ? __('admin::app.sales.orders.item-shipped', ['qty_shipped' => $item->qty_shipped]) : ''); ?>

                                    </span>

                                    <span class="qty-row">
                                        <?php echo e($item->qty_refunded ? __('admin::app.sales.orders.item-refunded', ['qty_refunded' => $item->qty_refunded]) : ''); ?>

                                    </span>

                                    <span class="qty-row">
                                        <?php echo e($item->qty_canceled ? __('admin::app.sales.orders.item-canceled', ['qty_canceled' => $item->qty_canceled]) : ''); ?>

                                    </span>
                                </td>

                                <td><?php echo e(core()->formatBasePrice($item->base_price)); ?></td>

                                <td><?php echo e(core()->formatBasePrice($item->base_tax_amount)); ?></td>

                                <?php if($order->base_discount_amount > 0): ?>
                                    <td><?php echo e(core()->formatBasePrice($item->base_discount_amount)); ?></td>
                                <?php endif; ?>

                                <td><?php echo e(core()->formatBasePrice($item->base_total + $item->base_tax_amount - $item->base_discount_amount)); ?></td>

                                <td><?php echo e($item->qty_ordered); ?></td>

                                <td>
                                    <div class="control-group" :class="[errors.has('refund[items][<?php echo e($item->id); ?>]') ? 'has-error' : '']">
                                        <input type="text" v-validate="'required|numeric|min:0'" class="control" id="refund[items][<?php echo e($item->id); ?>]" name="refund[items][<?php echo e($item->id); ?>]" v-model="refund.items[<?php echo e($item->id); ?>]" data-vv-as="&quot;<?php echo e(__('admin::app.sales.refunds.qty-to-refund')); ?>&quot;"/>

                                        <span class="control-error" v-if="errors.has('refund[items][<?php echo e($item->id); ?>]')">
                                            
                                                {{ errors.first('refund[items][<?php echo $item->id ?>]') }}
                                            
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div style="width: 100%; display: inline-block">
                <button type="button" class="btn btn-lg btn-primary" style="float: right" @click="updateQty">
                    <?php echo e(__('admin::app.sales.refunds.update-qty')); ?>

                </button>
            </div>

            <table v-if="refund.summary" class="sale-summary">
                <tr>
                    <td><?php echo e(__('admin::app.sales.orders.subtotal')); ?></td>
                    <td>-</td>
                    <td>{{ refund.summary.subtotal.formated_price }}</td>
                </tr>

                <tr>
                    <td><?php echo e(__('admin::app.sales.orders.discount')); ?></td>
                    <td>-</td>
                    <td>-{{ refund.summary.discount.formated_price }}</td>
                </tr>

                <tr>
                    <td><?php echo e(__('admin::app.sales.refunds.refund-shipping')); ?></td>
                    <td>-</td>
                    <td>
                        <div class="control-group" :class="[errors.has('refund[shipping]') ? 'has-error' : '']" style="width: 100px; margin-bottom: 0;">
                            <input type="text" v-validate="'required|min_value:0|max_value:<?php echo e($order->base_shipping_invoiced - $order->base_shipping_refunded); ?>'" class="control" id="refund[shipping]" name="refund[shipping]" v-model="refund.summary.shipping.price" data-vv-as="&quot;<?php echo e(__('admin::app.sales.refunds.refund-shipping')); ?>&quot;" style="width: 100%; margin: 0"/>

                            <span class="control-error" v-if="errors.has('refund[shipping]')">
                                {{ errors.first('refund[shipping]') }}
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><?php echo e(__('admin::app.sales.refunds.adjustment-refund')); ?></td>
                    <td>-</td>
                    <td>
                        <div class="control-group" :class="[errors.has('refund[adjustment_refund]') ? 'has-error' : '']" style="width: 100px; margin-bottom: 0;">
                            <input type="text" v-validate="'required|min_value:0'" class="control" id="refund[adjustment_refund]" name="refund[adjustment_refund]" value="0" data-vv-as="&quot;<?php echo e(__('admin::app.sales.refunds.adjustment-refund')); ?>&quot;" style="width: 100%; margin: 0"/>

                            <span class="control-error" v-if="errors.has('refund[adjustment_refund]')">
                                {{ errors.first('refund[adjustment_refund]') }}
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><?php echo e(__('admin::app.sales.refunds.adjustment-fee')); ?></td>
                    <td>-</td>
                    <td>
                        <div class="control-group" :class="[errors.has('refund[adjustment_fee]') ? 'has-error' : '']" style="width: 100px; margin-bottom: 0;">
                            <input type="text" v-validate="'required|min_value:0'" class="control" id="refund[adjustment_fee]" name="refund[adjustment_fee]" value="0" data-vv-as="&quot;<?php echo e(__('admin::app.sales.refunds.adjustment-fee')); ?>&quot;" style="width: 100%; margin: 0"/>

                            <span class="control-error" v-if="errors.has('refund[adjustment_fee]')">
                                {{ errors.first('refund[adjustment_fee]') }}
                            </span>
                        </div>
                    </td>
                </tr>

                <tr class="border">
                    <td><?php echo e(__('admin::app.sales.orders.tax')); ?></td>
                    <td>-</td>
                    <td>{{ refund.summary.tax.formated_price }}</td>
                </tr>

                <tr class="bold">
                    <td><?php echo e(__('admin::app.sales.orders.grand-total')); ?></td>
                    <td>-</td>
                    <td>{{ refund.summary.grand_total.formated_price }}</td>
                </tr>
            </table>
        </div>
    </script>

    <script>
        Vue.component('refund-items', {
            template: '#refund-items-template',

            inject: ['$validator'],

            data: function() {
                return {
                    refund: {
                        items: {},

                        summary: null
                    }
                }
            },

            mounted: function() {
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    this.refund.items[<?php echo e($item->id); ?>] = <?php echo e($item->qty_to_refund); ?>;
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                this.updateQty();
            },

            methods: {
                updateQty: function() {
                    var this_this = this;

                    this.$http.post("<?php echo e(route('admin.sales.refunds.update_qty', $order->id)); ?>", this.refund.items)
                        .then(function(response) {
                            if (! response.data) {
                                window.flashMessages = [{
                                    'type': 'alert-error',
                                    'message': "<?php echo e(__('admin::app.sales.refunds.invalid-qty')); ?>" 
                                }];

                                this_this.$root.addFlashMessages()
                            } else {
                                this_this.refund.summary = response.data;
                            }
                        })
                        .catch(function (error) {})
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>