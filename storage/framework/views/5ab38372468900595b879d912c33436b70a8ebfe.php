<div class="header" id="header">
    <div class="header-top">
        <div class="left-content">
            <ul class="logo-container">
                <li>
                    <a href="<?php echo e(route('shop.home.index')); ?>">
                        <?php if($logo = core()->getCurrentChannel()->logo_url): ?>
                            <img class="logo" src="<?php echo e($logo); ?>" />
                        <?php else: ?>
                            <img class="logo" src="<?php echo e(bagisto_asset('images/logo.svg')); ?>" />
                        <?php endif; ?>
                    </a>
                </li>
            </ul>

            <ul class="search-container">
                <li class="search-group">
                    <form role="search" action="<?php echo e(route('shop.search.index')); ?>" method="GET" style="display: inherit;">
                        <input type="search" name="term" class="search-field" placeholder="<?php echo e(__('shop::app.header.search-text')); ?>" required>

                        <div class="search-icon-wrapper">
                            <button class="" class="background: none;">
                                <i class="icon icon-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>

        <?php
            $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
            $searchTerm = explode("&", $query);

            foreach($searchTerm as $term){
                if (strpos($term, 'term') !== false) {
                    $serachQuery = $term;
                }
            }
        ?>

        <div class="right-content">

            <span class="search-box"><span class="icon icon-search" id="search"></span></span>

            <ul class="right-content-menu">

                <?php echo view_render_event('bagisto.shop.layout.header.currency-item.before'); ?>


                <?php if(core()->getCurrentChannel()->currencies->count() > 1): ?>
                    <li class="currency-switcher">
                        <span class="dropdown-toggle">
                            <?php echo e(core()->getCurrentCurrencyCode()); ?>


                            <i class="icon arrow-down-icon"></i>
                        </span>

                        <ul class="dropdown-list currency">
                            <?php $__currentLoopData = core()->getCurrentChannel()->currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <?php if(isset($serachQuery)): ?>
                                        <a href="?<?php echo e($serachQuery); ?>&currency=<?php echo e($currency->code); ?>"><?php echo e($currency->code); ?></a>
                                    <?php else: ?>
                                        <a href="?currency=<?php echo e($currency->code); ?>"><?php echo e($currency->code); ?></a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php echo view_render_event('bagisto.shop.layout.header.currency-item.after'); ?>



                <?php echo view_render_event('bagisto.shop.layout.header.account-item.before'); ?>


                <li>
                    <span class="dropdown-toggle">
                        <i class="icon account-icon"></i>

                        <span class="name"><?php echo e(__('shop::app.header.account')); ?></span>

                        <i class="icon arrow-down-icon"></i>
                    </span>

                    <?php if(auth()->guard('customer')->guest()): ?>
                        <ul class="dropdown-list account guest">
                            <li>
                                <div>
                                    <label style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">
                                        <?php echo e(__('shop::app.header.title')); ?>

                                    </label>
                                </div>

                                <div style="margin-top: 5px;">
                                    <span style="font-size: 12px;"><?php echo e(__('shop::app.header.dropdown-text')); ?></span>
                                </div>

                                <div style="margin-top: 15px;">
                                    <a class="btn btn-primary btn-md" href="<?php echo e(route('customer.session.index')); ?>" style="color: #ffffff">
                                        <?php echo e(__('shop::app.header.sign-in')); ?>

                                    </a>

                                    <a class="btn btn-primary btn-md" href="<?php echo e(route('customer.register.index')); ?>" style="float: right; color: #ffffff">
                                        <?php echo e(__('shop::app.header.sign-up')); ?>

                                    </a>
                                </div>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php if(auth()->guard('customer')->check()): ?>
                        <ul class="dropdown-list account customer">
                            <li>
                                <div>
                                    <label style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">
                                        <?php echo e(auth()->guard('customer')->user()->first_name); ?>

                                    </label>
                                </div>

                                <ul>
                                    <li>
                                        <a href="<?php echo e(route('customer.profile.index')); ?>"><?php echo e(__('shop::app.header.profile')); ?></a>
                                    </li>

                                    <li>
                                        <a href="<?php echo e(route('customer.wishlist.index')); ?>"><?php echo e(__('shop::app.header.wishlist')); ?></a>
                                    </li>

                                    <li>
                                        <a href="<?php echo e(route('shop.checkout.cart.index')); ?>"><?php echo e(__('shop::app.header.cart')); ?></a>
                                    </li>

                                    <li>
                                        <a href="<?php echo e(route('customer.session.destroy')); ?>"><?php echo e(__('shop::app.header.logout')); ?></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>

                <?php echo view_render_event('bagisto.shop.layout.header.account-item.after'); ?>



                <?php echo view_render_event('bagisto.shop.layout.header.cart-item.before'); ?>


                <li class="cart-dropdown-container">

                    <?php echo $__env->make('shop::checkout.cart.mini-cart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                </li>

                <?php echo view_render_event('bagisto.shop.layout.header.cart-item.after'); ?>


            </ul>

            <span class="menu-box" ><span class="icon icon-menu" id="hammenu"></span>
        </div>
    </div>

    <div class="header-bottom" id="header-bottom">
        <?php echo $__env->make('shop::layouts.header.nav-menu.navmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <div class="search-responsive mt-10" id="search-responsive">
        <form role="search" action="<?php echo e(route('shop.search.index')); ?>" method="GET" style="display: inherit;">
            <div class="search-content">
                <button style="background: none; border: none; padding: 0px;">
                    <i class="icon icon-search"></i>
                </button>
                <input type="search" name="term" class="search">
                <i class="icon icon-menu-back right"></i>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {

            $('body').delegate('#search, .icon-menu-close, .icon.icon-menu', 'click', function(e) {
                toggleDropdown(e);
            });

            function toggleDropdown(e) {
                var currentElement = $(e.currentTarget);

                if (currentElement.hasClass('icon-search')) {
                    currentElement.removeClass('icon-search');
                    currentElement.addClass('icon-menu-close');
                    $('#hammenu').removeClass('icon-menu-close');
                    $('#hammenu').addClass('icon-menu');
                    $("#search-responsive").css("display", "block");
                    $("#header-bottom").css("display", "none");
                } else if (currentElement.hasClass('icon-menu')) {
                    currentElement.removeClass('icon-menu');
                    currentElement.addClass('icon-menu-close');
                    $('#search').removeClass('icon-menu-close');
                    $('#search').addClass('icon-search');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "block");
                } else {
                    currentElement.removeClass('icon-menu-close');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "none");
                    if (currentElement.attr("id") == 'search') {
                        currentElement.addClass('icon-search');
                    } else {
                        currentElement.addClass('icon-menu');
                    }
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>
