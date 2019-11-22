<div class="navbar-left">
    <ul class="menubar">
        <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="menu-item <?php echo e($menu->getActive($menuItem)); ?>">
                <a href="<?php echo e(count($menuItem['children']) ? current($menuItem['children'])['url'] : $menuItem['url']); ?>">
                    <span class="icon <?php echo e($menuItem['icon-class']); ?>">
                    </span>
                    <span>
                        <?php echo e(trans($menuItem['name'])); ?>

                    </span>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>