<?php if(core()->getConfigData('general.design.admin_logo.logo_image')): ?>
    <img src="<?php echo e(\Illuminate\Support\Facades\Storage::url(core()->getConfigData('general.design.admin_logo.logo_image'))); ?>" alt="Bagisto" style="height: 40px; width: 110px;"/>
<?php else: ?>
    <img src="<?php echo e(bagisto_asset('images/logo.svg')); ?>">
<?php endif; ?>