<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.sales.shipments.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>
    <div class="content full-page">
        <form method="POST" action="<?php echo e(route('admin.sales.shipments.store', $order->id)); ?>" @submit.prevent="onSubmit">
            <?php echo csrf_field(); ?>

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '<?php echo e(url('/admin/dashboard')); ?>';"></i>

                        <?php echo e(__('admin::app.sales.shipments.add-title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.sales.shipments.save-btn-title')); ?>

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
                                            <?php echo e(__('admin::app.sales.shipments.order-id')); ?>

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

                                    <div class="control-group" :class="[errors.has('shipment[carrier_title]') ? 'has-error' : '']" style="margin-top: 40px">
                                        <label for="shipment[carrier_title]" class="required"><?php echo e(__('admin::app.sales.shipments.carrier-title')); ?></label>
                                        <input type="text" v-validate="'required'" class="control" id="shipment[carrier_title]" name="shipment[carrier_title]" data-vv-as="&quot;<?php echo e(__('admin::app.sales.shipments.carrier-title')); ?>&quot;"/>
                                        <span class="control-error" v-if="errors.has('shipment[carrier_title]')">
                                            {{ errors.first('shipment[carrier_title]') }}
                                        </span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('shipment[track_number]') ? 'has-error' : '']">
                                        <label for="shipment[track_number]" class="required"><?php echo e(__('admin::app.sales.shipments.tracking-number')); ?></label>
                                        <input type="text" v-validate="'required'" class="control" id="shipment[track_number]" name="shipment[track_number]" data-vv-as="&quot;<?php echo e(__('admin::app.sales.shipments.tracking-number')); ?>&quot;"/>
                                        <span class="control-error" v-if="errors.has('shipment[track_number]')">
                                            {{ errors.first('shipment[track_number]') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.sales.orders.products-ordered')); ?>'" :active="true">
                        <div slot="body">

                            <order-item-list></order-item-list>

                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script type="text/x-template" id="order-item-list-template">

        <div>
        <div class="control-group" :class="[errors.has('shipment[source]') ? 'has-error' : '']">
            <label for="shipment[source]" class="required"><?php echo e(__('admin::app.sales.shipments.source')); ?></label>

            <select v-validate="'required'" class="control" name="shipment[source]" id="shipment[source]" data-vv-as="&quot;<?php echo e(__('admin::app.sales.shipments.source')); ?>&quot;" v-model="source">
                <option value=""><?php echo e(__('admin::app.sales.shipments.select-source')); ?></option>

                <?php $__currentLoopData = $order->channel->inventory_sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inventorySource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($inventorySource->id); ?>"><?php echo e($inventorySource->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <span class="control-error" v-if="errors.has('shipment[source]')">
                {{ errors.first('shipment[source]') }}
            </span>
        </div>

        <div class="table">

            <table>
                <thead>
                    <tr>
                        <th><?php echo e(__('admin::app.sales.orders.SKU')); ?></th>
                        <th><?php echo e(__('admin::app.sales.orders.product-name')); ?></th>
                        <th><?php echo e(__('admin::app.sales.shipments.qty-ordered')); ?></th>
                        <th><?php echo e(__('admin::app.sales.shipments.qty-to-ship')); ?></th>
                        <th><?php echo e(__('admin::app.sales.shipments.available-sources')); ?></th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->qty_to_ship > 0 && $item->product): ?>
                            <tr>
                                <td><?php echo e($item->type == 'configurable' ? $item->child->sku : $item->sku); ?></td>
                                <td>
                                    <?php echo e($item->name); ?>


                                    <?php if($html = $item->getOptionDetailHtml()): ?>
                                        <p><?php echo e($html); ?></p>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->qty_ordered); ?></td>
                                <td><?php echo e($item->qty_to_ship); ?></td>
                                <td>

                                    <table>
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('admin::app.sales.shipments.source')); ?></th>
                                                <th><?php echo e(__('admin::app.sales.shipments.qty-available')); ?></th>
                                                <th><?php echo e(__('admin::app.sales.shipments.qty-to-ship')); ?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $order->channel->inventory_sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inventorySource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($inventorySource->name); ?>

                                                    </td>

                                                    <td>
                                                        <?php
                                                            if ($item->type == 'configurable') {
                                                                $sourceQty = $item->child->product->inventory_source_qty($inventorySource);
                                                            } else {
                                                                $sourceQty = $item->product->inventory_source_qty($inventorySource);
                                                            }
                                                        ?>

                                                        <?php
                                                            $sourceQty = 0;

                                                            $product = $item->type == 'configurable' ? $item->child->product : $item->product;

                                                            foreach ($product->inventories as $inventory) {
                                                                if ($inventory->inventory_source_id == $inventorySource->id) {
                                                                    $sourceQty += $inventory->qty;
                                                                }
                                                            }
                                                        ?>

                                                        <?php echo e($sourceQty); ?>

                                                    </td>

                                                    <td>
                                                        <?php $inputName = "shipment[items][$item->id][$inventorySource->id]"; ?>

                                                        <div class="control-group" :class="[errors.has('<?php echo e($inputName); ?>') ? 'has-error' : '']">

                                                            <input type="text" v-validate="'required|numeric|min_value:0|max_value:<?php echo e($sourceQty); ?>'" class="control" id="<?php echo e($inputName); ?>" name="<?php echo e($inputName); ?>" value="0" data-vv-as="&quot;<?php echo e(__('admin::app.sales.shipments.qty-to-ship')); ?>&quot;" :disabled="source != '<?php echo e($inventorySource->id); ?>'"/>

                                                            <span class="control-error" v-if="errors.has('<?php echo e($inputName); ?>')">
                                                                
                                                                    {{ errors.first('<?php echo $inputName; ?>') }}
                                                                
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
        </div>

    </script>

    <script>
        Vue.component('order-item-list', {

            template: '#order-item-list-template',

            inject: ['$validator'],

            data: function() {
                return {
                    source: ""
                }
            }
        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>