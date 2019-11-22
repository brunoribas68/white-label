<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <title><?php echo $__env->yieldContent('page_title'); ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="icon" sizes="16x16" href="<?php echo e(asset('vendor/webkul/ui/assets/images/favicon.ico')); ?>" />

        <link rel="stylesheet" href="<?php echo e(asset('vendor/webkul/ui/assets/css/ui.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendor/webkul/admin/assets/css/admin.css')); ?>">

        <?php echo $__env->yieldContent('head'); ?>

        <?php echo $__env->yieldContent('css'); ?>

        <?php echo view_render_event('bagisto.admin.layout.head'); ?>


    </head>

    <body <?php if(core()->getCurrentLocale()->direction == 'rtl'): ?> class="rtl" <?php endif; ?> style="scroll-behavior: smooth;">
        <?php echo view_render_event('bagisto.admin.layout.body.before'); ?>


        <div id="app">

            <flash-wrapper ref='flashes'></flash-wrapper>

            <?php echo view_render_event('bagisto.admin.layout.nav-top.before'); ?>


            <?php echo $__env->make('admin::layouts.nav-top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo view_render_event('bagisto.admin.layout.nav-top.after'); ?>



            <?php echo view_render_event('bagisto.admin.layout.nav-left.before'); ?>


            <?php echo $__env->make('admin::layouts.nav-left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo view_render_event('bagisto.admin.layout.nav-left.after'); ?>



            <div class="content-container">

                <?php echo view_render_event('bagisto.admin.layout.content.before'); ?>


                <?php echo $__env->yieldContent('content-wrapper'); ?>

                <?php echo view_render_event('bagisto.admin.layout.content.after'); ?>


            </div>

        </div>

        <script type="text/javascript">
            window.flashMessages = [];

            <?php if($success = session('success')): ?>
                window.flashMessages = [{'type': 'alert-success', 'message': "<?php echo e($success); ?>" }];
            <?php elseif($warning = session('warning')): ?>
                window.flashMessages = [{'type': 'alert-warning', 'message': "<?php echo e($warning); ?>" }];
            <?php elseif($error = session('error')): ?>
                window.flashMessages = [{'type': 'alert-error', 'message': "<?php echo e($error); ?>" }];
            <?php elseif($info = session('info')): ?>
                window.flashMessages = [{'type': 'alert-info', 'message': "<?php echo e($info); ?>" }];
            <?php endif; ?>

            window.serverErrors = [];
            <?php if(isset($errors)): ?>
                <?php if(count($errors)): ?>
                    window.serverErrors = <?php echo json_encode($errors->getMessages(), 15, 512) ?>;
                <?php endif; ?>
            <?php endif; ?>
        </script>

        <script type="text/javascript" src="<?php echo e(asset('vendor/webkul/admin/assets/js/admin.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('vendor/webkul/ui/assets/js/ui.js')); ?>"></script>
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', function() {
                moveDown = 60;
                moveUp =  -60;
                count = 0;
                countKeyUp = 0;
                pageDown = 60;
                pageUp = -60;
                scroll = 0;

                listLastElement = $('.menubar li:last-child').offset();

                if (listLastElement) {
                    lastElementOfNavBar = listLastElement.top;
                }

                navbarTop = $('.navbar-left').css("top");
                menuTopValue = $('.navbar-left').css('top');
                menubarTopValue = menuTopValue;

                documentHeight = $(document).height();
                menubarHeight = $('ul.menubar').height();
                navbarHeight = $('.navbar-left').height();
                windowHeight = $(window).height();
                contentHeight = $('.content').height();
                innerSectionHeight = $('.inner-section').height();
                gridHeight = $('.grid-container').height();
                pageContentHeight = $('.page-content').height();

                if (menubarHeight <= windowHeight) {
                    differenceInHeight = windowHeight - menubarHeight;
                } else {
                    differenceInHeight = menubarHeight - windowHeight;
                }

                if (menubarHeight > windowHeight) {
                    document.addEventListener("keydown", function(event) {
                        if ((event.keyCode == 38) && count <= 0) {
                            count = count + moveDown;

                            $('.navbar-left').css("top", count + "px");
                        } else if ((event.keyCode == 40) && count >= -differenceInHeight) {
                            count = count + moveUp;

                            $('.navbar-left').css("top", count + "px");
                        } else if ((event.keyCode == 33) && countKeyUp <= 0) {
                            countKeyUp = countKeyUp + pageDown;

                            $('.navbar-left').css("top", countKeyUp + "px");
                        } else if ((event.keyCode == 34) && countKeyUp >= -differenceInHeight) {
                            countKeyUp = countKeyUp + pageUp;

                            $('.navbar-left').css("top", countKeyUp + "px");
                        } else {
                            $('.navbar-left').css("position", "fixed");
                        }
                    });

                    $("body").css({minHeight: $(".menubar").outerHeight() + 100 + "px"});

                    window.addEventListener('scroll', function() {
                        documentScrollWhenScrolled = $(document).scrollTop();

                            if (documentScrollWhenScrolled <= differenceInHeight + 200) {
                                $('.navbar-left').css('top', -documentScrollWhenScrolled + 60 + 'px');
                                scrollTopValueWhenNavBarFixed = $(document).scrollTop();
                            }
                    });
                }
            });
        </script>
        <?php echo $__env->yieldPushContent('scripts'); ?>

        <?php echo view_render_event('bagisto.admin.layout.body.after'); ?>


        <div class="modal-overlay"></div>
    </body>
</html>