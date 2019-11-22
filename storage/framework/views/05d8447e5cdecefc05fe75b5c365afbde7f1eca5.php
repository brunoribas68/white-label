<div class="aside-nav">
    <ul>
        <?php if(request()->route()->getName() != 'admin.configuration.index'): ?>
            <?php $keys = explode('.', $menu->currentKey);  ?>

            <?php if(isset($keys) && strlen($keys[0])): ?>
            <?php $__currentLoopData = array_get($menu->items, current($keys) . '.children'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($menu->getActive($item)); ?>">
                    <a href="<?php echo e($item['url']); ?>">
                        <?php echo e(trans($item['name'])); ?>


                        <?php if($menu->getActive($item)): ?>
                            <i class="angle-right-icon"></i>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php else: ?>
            <?php $__currentLoopData = $config->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($item['key'] == request()->route('slug') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.configuration.index', $item['key'])); ?>">
                        <?php echo e(isset($item['name']) ? trans($item['name']) : ''); ?>


                        <?php if($item['key'] == request()->route('slug')): ?>
                            <i class="angle-right-icon"></i>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>

    <!-- <div class="close-nav-aside">
        <i class="icon angle-left-icon close-icon"></i>
    </div> -->
</div>
