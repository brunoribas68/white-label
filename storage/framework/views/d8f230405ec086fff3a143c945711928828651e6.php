<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.customer.account.order.view.page-tile', ['order_id' => $order->increment_id])); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="account-content">
        <?php echo $__env->make('shop::customers.account.partials.sidemenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="account-layout">

            <div class="account-head">
                <span class="back-icon"><a href="<?php echo e(route('customer.account.index')); ?>"><i class="icon icon-menu-back"></i></a></span>
                <span class="account-heading">
                    <?php echo e(__('shop::app.customer.account.order.view.page-tile', ['order_id' => $order->increment_id])); ?>

                </span>
                <span></span>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.orders.view.before', ['order' => $order]); ?>


            <div class="sale-container">

                <tabs>
                    <tab name="<?php echo e(__('shop::app.customer.account.order.view.info')); ?>" :selected="true">

                        <div class="sale-section">
                            <div class="section-content">
                                <div class="row">
                                    <span class="title">
                                        <?php echo e(__('shop::app.customer.account.order.view.placed-on')); ?>

                                    </span>

                                    <span class="value">
                                        <?php echo e(core()->formatDate($order->created_at, 'd M Y')); ?>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="sale-section">
                            <div class="secton-title">
                                <span><?php echo e(__('shop::app.customer.account.order.view.products-ordered')); ?></span>
                            </div>

                            <div class="section-content">
                                <div class="table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.SKU')); ?></th>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.product-name')); ?></th>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.price')); ?></th>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.item-status')); ?></th>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?></th>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.tax-percent')); ?></th>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.tax-amount')); ?></th>
                                                <th><?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.SKU')); ?>">
                                                        <?php echo e($item->type == 'configurable' ? $item->child->sku : $item->sku); ?>

                                                    </td>
                                                    
                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.product-name')); ?>">
                                                        <?php echo e($item->name); ?> <br>
                                                        <?php if(isset($item['additional']['attributes'])): ?>
                                                            <?php $__currentLoopData = $item['additional']['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <b><?php echo e($attribute['attribute_name']); ?></b> : <?php echo e($attribute['option_label']); ?> <br>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.price')); ?>">
                                                        <?php echo e(core()->formatPrice($item->price, $order->order_currency_code)); ?>

                                                    </td>

                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.item-status')); ?>">
                                                        <span class="qty-row">
                                                            <?php echo e(__('shop::app.customer.account.order.view.item-ordered', ['qty_ordered' => $item->qty_ordered])); ?>

                                                        </span>

                                                        <span class="qty-row">
                                                            <?php echo e($item->qty_invoiced ? __('shop::app.customer.account.order.view.item-invoice', ['qty_invoiced' => $item->qty_invoiced]) : ''); ?>

                                                        </span>

                                                        <span class="qty-row">
                                                            <?php echo e($item->qty_shipped ? __('shop::app.customer.account.order.view.item-shipped', ['qty_shipped' => $item->qty_shipped]) : ''); ?>

                                                        </span>

                                                        <span class="qty-row">
                                                            <?php echo e($item->qty_refunded ? __('shop::app.customer.account.order.view.item-refunded', ['qty_refunded' => $item->qty_refunded]) : ''); ?>

                                                        </span>

                                                        <span class="qty-row">
                                                            <?php echo e($item->qty_canceled ? __('shop::app.customer.account.order.view.item-canceled', ['qty_canceled' => $item->qty_canceled]) : ''); ?>

                                                        </span>
                                                    </td>

                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?>">
                                                        <?php echo e(core()->formatPrice($item->total, $order->order_currency_code)); ?>

                                                    </td>

                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.tax-percent')); ?>">
                                                        <?php echo e(number_format($item->tax_percent, 2)); ?>%
                                                    </td>

                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.tax-amount')); ?>">
                                                        <?php echo e(core()->formatPrice($item->tax_amount, $order->order_currency_code)); ?>

                                                    </td>

                                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?>">
                                                        <?php echo e(core()->formatPrice($item->total + $item->tax_amount - $item->discount_amount, $order->order_currency_code)); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>

                                    </table>
                                </div>

                                <div class="totals">
                                    <table class="sale-summary">
                                        <tbody>
                                            <tr>
                                                <td><?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?></td>
                                                <td>-</td>
                                                <td><?php echo e(core()->formatPrice($order->sub_total, $order->order_currency_code)); ?></td>
                                            </tr>

                                            <tr>
                                                <td><?php echo e(__('shop::app.customer.account.order.view.shipping-handling')); ?></td>
                                                <td>-</td>
                                                <td><?php echo e(core()->formatPrice($order->shipping_amount, $order->order_currency_code)); ?></td>
                                            </tr>

                                            <?php if($order->base_discount_amount > 0): ?>
                                                <tr>
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.discount')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($order->discount_amount, $order->order_currency_code)); ?></td>
                                                </tr>
                                            <?php endif; ?>

                                            <tr class="border">
                                                <td><?php echo e(__('shop::app.customer.account.order.view.tax')); ?></td>
                                                <td>-</td>
                                                <td><?php echo e(core()->formatPrice($order->tax_amount, $order->order_currency_code)); ?></td>
                                            </tr>

                                            <tr class="bold">
                                                <td><?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?></td>
                                                <td>-</td>
                                                <td><?php echo e(core()->formatPrice($order->grand_total, $order->order_currency_code)); ?></td>
                                            </tr>

                                            <tr class="bold">
                                                <td><?php echo e(__('shop::app.customer.account.order.view.total-paid')); ?></td>
                                                <td>-</td>
                                                <td><?php echo e(core()->formatPrice($order->grand_total_invoiced, $order->order_currency_code)); ?></td>
                                            </tr>

                                            <tr class="bold">
                                                <td><?php echo e(__('shop::app.customer.account.order.view.total-refunded')); ?></td>
                                                <td>-</td>
                                                <td><?php echo e(core()->formatPrice($order->grand_total_refunded, $order->order_currency_code)); ?></td>
                                            </tr>

                                            <tr class="bold">
                                                <td><?php echo e(__('shop::app.customer.account.order.view.total-due')); ?></td>
                                                <td>-</td>
                                                <td><?php echo e(core()->formatPrice($order->total_due, $order->order_currency_code)); ?></td>
                                            </tr>
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </tab>

                    <?php if($order->invoices->count()): ?>
                        <tab name="<?php echo e(__('shop::app.customer.account.order.view.invoices')); ?>">

                            <?php $__currentLoopData = $order->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span><?php echo e(__('shop::app.customer.account.order.view.individual-invoice', ['invoice_id' => $invoice->id])); ?></span>

                                        <a href="<?php echo e(route('customer.orders.print', $invoice->id)); ?>" class="pull-right">
                                            <?php echo e(__('shop::app.customer.account.order.view.print')); ?>

                                        </a>
                                    </div>

                                    <div class="section-content">
                                        <div class="table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.SKU')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.product-name')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.price')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.qty')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.tax-amount')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.SKU')); ?>"><?php echo e($item->child ? $item->child->sku : $item->sku); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.product-name')); ?>"><?php echo e($item->name); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.price')); ?>"><?php echo e(core()->formatPrice($item->price, $order->order_currency_code)); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.qty')); ?>"><?php echo e($item->qty); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?>"><?php echo e(core()->formatPrice($item->total, $order->order_currency_code)); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.tax-amount')); ?>"><?php echo e(core()->formatPrice($item->tax_amount, $order->order_currency_code)); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?>"><?php echo e(core()->formatPrice($item->total + $item->tax_amount, $order->order_currency_code)); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="totals">
                                            <table class="sale-summary">
                                                <tr>
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($invoice->sub_total, $order->order_currency_code)); ?></td>
                                                </tr>

                                                <tr>
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.shipping-handling')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($invoice->shipping_amount, $order->order_currency_code)); ?></td>
                                                </tr>

                                                <?php if($order->base_discount_amount > 0): ?>
                                                    <tr>
                                                        <td><?php echo e(__('shop::app.customer.account.order.view.discount')); ?></td>
                                                        <td>-</td>
                                                        <td><?php echo e(core()->formatPrice($order->discount_amount, $order->order_currency_code)); ?></td>
                                                    </tr>
                                                <?php endif; ?>

                                                <tr>
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.tax')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($invoice->tax_amount, $order->order_currency_code)); ?></td>
                                                </tr>

                                                <tr class="bold">
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($invoice->grand_total, $order->order_currency_code)); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tab>
                    <?php endif; ?>

                    <?php if($order->shipments->count()): ?>
                        <tab name="<?php echo e(__('shop::app.customer.account.order.view.shipments')); ?>">

                            <?php $__currentLoopData = $order->shipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span><?php echo e(__('shop::app.customer.account.order.view.individual-shipment', ['shipment_id' => $shipment->id])); ?></span>
                                    </div>

                                    <div class="section-content">

                                        <div class="table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.SKU')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.product-name')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.qty')); ?></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php $__currentLoopData = $shipment->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <tr>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.SKU')); ?>"><?php echo e($item->sku); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.product-name')); ?>"><?php echo e($item->name); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.qty')); ?>"><?php echo e($item->qty); ?></td>
                                                        </tr>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tab>
                    <?php endif; ?>

                    <?php if($order->refunds->count()): ?>
                        <tab name="<?php echo e(__('shop::app.customer.account.order.view.refunds')); ?>">

                            <?php $__currentLoopData = $order->refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span><?php echo e(__('shop::app.customer.account.order.view.individual-refund', ['refund_id' => $refund->id])); ?></span>
                                    </div>

                                    <div class="section-content">
                                        <div class="table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.SKU')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.product-name')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.price')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.qty')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.tax-amount')); ?></th>
                                                        <th><?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php $__currentLoopData = $refund->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.SKU')); ?>"><?php echo e($item->child ? $item->child->sku : $item->sku); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.product-name')); ?>"><?php echo e($item->name); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.price')); ?>"><?php echo e(core()->formatPrice($item->price, $order->order_currency_code)); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.qty')); ?>"><?php echo e($item->qty); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?>"><?php echo e(core()->formatPrice($item->total, $order->order_currency_code)); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.tax-amount')); ?>"><?php echo e(core()->formatPrice($item->tax_amount, $order->order_currency_code)); ?></td>
                                                            <td data-value="<?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?>"><?php echo e(core()->formatPrice($item->total + $item->tax_amount, $order->order_currency_code)); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if(! $refund->items->count()): ?>
                                                        <tr>
                                                            <td class="empty" colspan="7"><?php echo e(__('admin::app.common.no-result-found')); ?></td>
                                                        <tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="totals">
                                            <table class="sale-summary">
                                                <tr>
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($refund->sub_total, $order->order_currency_code)); ?></td>
                                                </tr>

                                                <?php if($refund->shipping_amount > 0): ?>
                                                    <tr>
                                                        <td><?php echo e(__('shop::app.customer.account.order.view.shipping-handling')); ?></td>
                                                        <td>-</td>
                                                        <td><?php echo e(core()->formatPrice($refund->shipping_amount, $order->order_currency_code)); ?></td>
                                                    </tr>
                                                <?php endif; ?>

                                                <?php if($refund->discount_amount > 0): ?>
                                                    <tr>
                                                        <td><?php echo e(__('shop::app.customer.account.order.view.discount')); ?></td>
                                                        <td>-</td>
                                                        <td><?php echo e(core()->formatPrice($order->discount_amount, $order->order_currency_code)); ?></td>
                                                    </tr>
                                                <?php endif; ?>

                                                <?php if($refund->tax_amount > 0): ?>
                                                    <tr>
                                                        <td><?php echo e(__('shop::app.customer.account.order.view.tax')); ?></td>
                                                        <td>-</td>
                                                        <td><?php echo e(core()->formatPrice($refund->tax_amount, $order->order_currency_code)); ?></td>
                                                    </tr>
                                                <?php endif; ?>

                                                <tr>
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.adjustment-refund')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($refund->adjustment_refund, $order->order_currency_code)); ?></td>
                                                </tr>

                                                <tr>
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.adjustment-fee')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($refund->adjustment_fee, $order->order_currency_code)); ?></td>
                                                </tr>

                                                <tr class="bold">
                                                    <td><?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?></td>
                                                    <td>-</td>
                                                    <td><?php echo e(core()->formatPrice($refund->grand_total, $order->order_currency_code)); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tab>
                    <?php endif; ?>
                </tabs>

                <div class="sale-section">
                    <div class="section-content" style="border-bottom: 0">
                        <div class="order-box-container">
                            <div class="box">
                                <div class="box-title">
                                    <?php echo e(__('shop::app.customer.account.order.view.shipping-address')); ?>

                                </div>

                                <div class="box-content">

                                    <?php echo $__env->make('admin::sales.address', ['address' => $order->billing_address], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                </div>
                            </div>

                            <div class="box">
                                <div class="box-title">
                                    <?php echo e(__('shop::app.customer.account.order.view.billing-address')); ?>

                                </div>

                                <div class="box-content">

                                    <?php echo $__env->make('admin::sales.address', ['address' => $order->shipping_address], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                </div>
                            </div>

                            <div class="box">
                                <div class="box-title">
                                    <?php echo e(__('shop::app.customer.account.order.view.shipping-method')); ?>

                                </div>

                                <div class="box-content">

                                    <?php echo e($order->shipping_title); ?>


                                </div>
                            </div>

                            <div class="box">
                                <div class="box-title">
                                    <?php echo e(__('shop::app.customer.account.order.view.payment-method')); ?>

                                </div>

                                <div class="box-content">
                                    <?php echo e(core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.orders.view.after', ['order' => $order]); ?>


        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>