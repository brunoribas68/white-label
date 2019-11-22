<?php $wishListHelper = app('Webkul\Customer\Helpers\Wishlist'); ?>

<?php if(auth()->guard('customer')->check()): ?>
    <?php echo view_render_event('bagisto.shop.products.wishlist.before'); ?>


    <a <?php if($wishListHelper->getWishlistProduct($product)): ?> class="add-to-wishlist already" <?php else: ?> class="add-to-wishlist" <?php endif; ?> href="<?php echo e(route('customer.wishlist.add', $product->product_id)); ?>" id="wishlist-changer">
        <span class="icon wishlist-icon"></span>
    </a>

    <?php echo view_render_event('bagisto.shop.products.wishlist.after'); ?>

<?php endif; ?>
