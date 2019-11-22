<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.dashboard.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="content full-page dashboard">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.dashboard.title')); ?></h1>
            </div>

            <div class="page-action">
                <date-filter></date-filter>
            </div>
        </div>

        <div class="page-content">

            <div class="dashboard-stats">

                <div class="dashboard-card">
                    <div class="title">
                        <?php echo e(__('admin::app.dashboard.total-customers')); ?>

                    </div>

                    <div class="data">
                        <?php echo e($statistics['total_customers']['current']); ?>


                        <span class="progress">
                            <?php if($statistics['total_customers']['progress'] < 0): ?>
                                <span class="icon graph-down-icon"></span>
                                <?php echo e(__('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['total_customers']['progress'], 1)
                                    ])); ?>

                            <?php else: ?>
                                <span class="icon graph-up-icon"></span>
                                <?php echo e(__('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['total_customers']['progress'], 1)
                                    ])); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="title">
                        <?php echo e(__('admin::app.dashboard.total-orders')); ?>

                    </div>

                    <div class="data">
                        <?php echo e($statistics['total_orders']['current']); ?>


                        <span class="progress">
                            <?php if($statistics['total_orders']['progress'] < 0): ?>
                                <span class="icon graph-down-icon"></span>
                                <?php echo e(__('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['total_orders']['progress'], 1)
                                    ])); ?>

                            <?php else: ?>
                                <span class="icon graph-up-icon"></span>
                                <?php echo e(__('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['total_orders']['progress'], 1)
                                    ])); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="title">
                        <?php echo e(__('admin::app.dashboard.total-sale')); ?>

                    </div>

                    <div class="data">
                        <?php echo e(core()->formatBasePrice($statistics['total_sales']['current'])); ?>


                        <span class="progress">
                            <?php if($statistics['total_sales']['progress'] < 0): ?>
                                <span class="icon graph-down-icon"></span>
                                <?php echo e(__('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['total_sales']['progress'], 1)
                                    ])); ?>

                            <?php else: ?>
                                <span class="icon graph-up-icon"></span>
                                <?php echo e(__('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['total_sales']['progress'], 1)
                                    ])); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="title">
                        <?php echo e(__('admin::app.dashboard.average-sale')); ?>

                    </div>

                    <div class="data">
                        <?php echo e(core()->formatBasePrice($statistics['avg_sales']['current'])); ?>


                        <span class="progress">
                            <?php if($statistics['avg_sales']['progress'] < 0): ?>
                                <span class="icon graph-down-icon"></span>
                                <?php echo e(__('admin::app.dashboard.decreased', [
                                        'progress' => -number_format($statistics['avg_sales']['progress'], 1)
                                    ])); ?>

                            <?php else: ?>
                                <span class="icon graph-up-icon"></span>
                                <?php echo e(__('admin::app.dashboard.increased', [
                                        'progress' => number_format($statistics['avg_sales']['progress'], 1)
                                    ])); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                </div>

            </div>

            <div class="graph-stats">

                <div class="left-card-container graph">
                    <div class="card" style="overflow: hidden;">
                        <div class="card-title" style="margin-bottom: 30px;">
                            <?php echo e(__('admin::app.dashboard.sales')); ?>

                        </div>

                        <div class="card-info" style="height: 100%;">

                            <canvas id="myChart" style="width: 100%; height: 87%"></canvas>

                        </div>
                    </div>
                </div>

                <div class="right-card-container category">
                    <div class="card">
                        <div class="card-title">
                            <?php echo e(__('admin::app.dashboard.top-performing-categories')); ?>

                        </div>

                        <div class="card-info <?php echo e(!count($statistics['top_selling_categories']) ? 'center' : ''); ?>">
                            <ul>

                                <?php $__currentLoopData = $statistics['top_selling_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li>
                                        <a href="<?php echo e(route('admin.catalog.categories.edit', $item->category_id)); ?>">
                                            <div class="description">
                                                <div class="name">
                                                    <?php echo e($item->name); ?>

                                                </div>

                                                <div class="info">
                                                    <?php echo e(__('admin::app.dashboard.product-count', ['count' => $item->total_products])); ?>

                                                    &nbsp;.&nbsp;
                                                    <?php echo e(__('admin::app.dashboard.sale-count', ['count' => $item->total_qty_invoiced])); ?>

                                                </div>
                                            </div>

                                            <span class="icon angle-right-icon"></span>
                                        </a>
                                    </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>

                            <?php if(! count($statistics['top_selling_categories'])): ?>

                                <div class="no-result-found">

                                    <i class="icon no-result-icon"></i>
                                    <p><?php echo e(__('admin::app.common.no-result-found')); ?></p>

                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>

            <?php $productImageHelper = app('Webkul\Product\Helpers\ProductImage'); ?>

            <div class="sale-stock">
                <div class="card">
                    <div class="card-title">
                        <?php echo e(__('admin::app.dashboard.top-selling-products')); ?>

                    </div>

                    <div class="card-info <?php echo e(!count($statistics['top_selling_products']) ? 'center' : ''); ?>">
                        <ul>

                            <?php $__currentLoopData = $statistics['top_selling_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>
                                    <a href="<?php echo e(route('admin.catalog.products.edit', $item->product_id)); ?>">
                                        <div class="product image">
                                            <?php $productBaseImage = $productImageHelper->getProductBaseImage($item->product); ?>

                                            <img class="item-image" src="<?php echo e($productBaseImage['small_image_url']); ?>" />
                                        </div>

                                        <div class="description">
                                            <div class="name">
                                                <?php if(isset($item->name)): ?>
                                                    <?php echo e($item->name); ?>

                                                <?php endif; ?>
                                            </div>

                                            <div class="info">
                                                <?php echo e(__('admin::app.dashboard.sale-count', ['count' => $item->total_qty_invoiced])); ?>

                                            </div>
                                        </div>

                                        <span class="icon angle-right-icon"></span>
                                    </a>
                                </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                        <?php if(! count($statistics['top_selling_products'])): ?>

                            <div class="no-result-found">

                                <i class="icon no-result-icon"></i>
                                <p><?php echo e(__('admin::app.common.no-result-found')); ?></p>

                            </div>

                        <?php endif; ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <?php echo e(__('admin::app.dashboard.customer-with-most-sales')); ?>

                    </div>

                    <div class="card-info <?php echo e(!count($statistics['customer_with_most_sales']) ? 'center' : ''); ?>">
                        <ul>

                            <?php $__currentLoopData = $statistics['customer_with_most_sales']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>
                                    <?php if($item->customer_id): ?>
                                        <a href="<?php echo e(route('admin.customer.edit', $item->customer_id)); ?>">
                                    <?php endif; ?>

                                        <div class="image">
                                            <span class="icon profile-pic-icon"></span>
                                        </div>

                                        <div class="description">
                                            <div class="name">
                                                <?php echo e($item->customer_full_name); ?>

                                            </div>

                                            <div class="info">
                                                <?php echo e(__('admin::app.dashboard.order-count', ['count' => $item->total_orders])); ?>

                                                    &nbsp;.&nbsp;
                                                <?php echo e(__('admin::app.dashboard.revenue', [
                                                    'total' => core()->formatBasePrice($item->total_base_grand_total_invoiced)
                                                    ])); ?>

                                            </div>
                                        </div>

                                        <span class="icon angle-right-icon"></span>

                                    <?php if($item->customer_id): ?>
                                        </a>
                                    <?php endif; ?>
                                </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                        <?php if(! count($statistics['customer_with_most_sales'])): ?>

                            <div class="no-result-found">

                                <i class="icon no-result-icon"></i>
                                <p><?php echo e(__('admin::app.common.no-result-found')); ?></p>

                            </div>

                        <?php endif; ?>
                    </div>

                </div>

                <div class="card">
                    <div class="card-title">
                        <?php echo e(__('admin::app.dashboard.stock-threshold')); ?>

                    </div>

                    <div class="card-info <?php echo e(!count($statistics['stock_threshold']) ? 'center' : ''); ?>">
                        <ul>

                            <?php $__currentLoopData = $statistics['stock_threshold']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>
                                    <a href="<?php echo e(route('admin.catalog.products.edit', $item->product_id)); ?>">
                                        <div class="image">
                                            <?php $productBaseImage = $productImageHelper->getProductBaseImage($item->product); ?>

                                            <img class="item-image" src="<?php echo e($productBaseImage['small_image_url']); ?>" />
                                        </div>

                                        <div class="description">
                                            <div class="name">
                                                <?php if(isset($item->product->name)): ?>
                                                    <?php echo e($item->product->name); ?>

                                                <?php endif; ?>
                                            </div>

                                            <div class="info">
                                                <?php echo e(__('admin::app.dashboard.qty-left', ['qty' => $item->total_qty])); ?>

                                            </div>
                                        </div>

                                        <span class="icon angle-right-icon"></span>
                                    </a>
                                </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                        <?php if(! count($statistics['stock_threshold'])): ?>

                            <div class="no-result-found">

                                <i class="icon no-result-icon"></i>
                                <p><?php echo e(__('admin::app.common.no-result-found')); ?></p>

                            </div>

                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

    <script type="text/x-template" id="date-filter-template">
        <div>
            <div class="control-group date">
                <date @onChange="applyFilter('start', $event)"><input type="text" class="control" id="start_date" value="<?php echo e($startDate->format('Y-m-d')); ?>" placeholder="<?php echo e(__('admin::app.dashboard.from')); ?>" v-model="start"/></date>
            </div>

            <div class="control-group date">
                <date @onChange="applyFilter('end', $event)"><input type="text" class="control" id="end_date" value="<?php echo e($endDate->format('Y-m-d')); ?>" placeholder="<?php echo e(__('admin::app.dashboard.to')); ?>" v-model="end"/></date>
            </div>
        </div>
    </script>

    <script>
        Vue.component('date-filter', {

            template: '#date-filter-template',

            data: function() {
                return {
                    start: "<?php echo e($startDate->format('Y-m-d')); ?>",
                    end: "<?php echo e($endDate->format('Y-m-d')); ?>",
                }
            },

            methods: {
                applyFilter: function(field, date) {
                    this[field] = date;

                    window.location.href = "?start=" + this.start + '&end=' + this.end;
                }
            }
        });

        $(document).ready(function () {

            var ctx = document.getElementById("myChart").getContext('2d');

            var data = <?php echo json_encode($statistics['sale_graph'], 15, 512) ?>;

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['label'],
                    datasets: [{
                        data: data['total'],
                        backgroundColor: 'rgba(34, 201, 93, 1)',
                        borderColor: 'rgba(34, 201, 93, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            maxBarThickness: 20,
                            gridLines : {
                                display : false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 20,
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, dataTemp) {
                                return data['formated_total'][tooltipItem.index];
                            }
                        }
                    }
                }
            });
        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>