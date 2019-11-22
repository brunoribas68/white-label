<div class="navbar-top">
    <div class="navbar-top-left">
        <div class="brand-logo">
            <a href="<?php echo e(route('admin.dashboard.index')); ?>">
                <?php if(core()->getConfigData('general.design.admin_logo.logo_image')): ?>
                    <img src="<?php echo e(\Illuminate\Support\Facades\Storage::url(core()->getConfigData('general.design.admin_logo.logo_image'))); ?>" alt="Bagisto" style="height: 40px; width: 110px;"/>
                <?php else: ?>
                    <img src="<?php echo e(asset('vendor/webkul/ui/assets/images/logo.png')); ?>" alt="Bagisto"/>
                <?php endif; ?>
            </a>
        </div>
    </div>

    <div class="navbar-top-right">
        <div class="profile">
            <span class="avatar">
            </span>

            <div class="profile-info">
                <div class="dropdown-toggle">
                    <div style="display: inline-block; vertical-align: middle;">
                        <span class="name">
                            <?php echo e(auth()->guard('admin')->user()->name); ?>

                        </span>

                        <span class="role">
                            <?php echo e(auth()->guard('admin')->user()->role['name']); ?>

                        </span>
                    </div>
                    <i class="icon arrow-down-icon active"></i>
                </div>

                <div class="dropdown-list bottom-right">
                    <div class="dropdown-container">
                        <label>Account</label>
                        <ul>
                            <li>
                                <a href="<?php echo e(route('shop.home.index')); ?>" target="_blank"><?php echo e(trans('admin::app.layouts.visit-shop')); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.account.edit')); ?>"><?php echo e(trans('admin::app.layouts.my-account')); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.session.destroy')); ?>"><?php echo e(trans('admin::app.layouts.logout')); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>