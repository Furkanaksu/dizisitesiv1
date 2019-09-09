<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title><?php echo $MetaTitle; ?> </title>

    <meta name="description" content="<?php echo $MetaDescription; ?>">
    <meta name="author" content="Furkan Aksu">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link href="<?php echo base_url(); ?>assets/front/css/custom.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/img/icon180.png" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/themes.css">
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="<?php echo base_url(); ?>assets/admin/js/vendor/modernizr.min.js"></script>
</head>
<!-- Page Wrapper -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available classes:

    'page-loading'      enables page preloader
-->
<div id="page-wrapper">
    <!-- Preloader -->
    <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
    <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
    <div class="preloader themed-background">
        <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
        <div class="inner">
            <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
            <div class="preloader-spinner hidden-lt-ie10"></div>
        </div>
    </div>
    <!-- END Preloader -->

    <!-- Page Container -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
        Available #page-container classes:

        '' (None)                                       for a full main and alternative sidebar hidden by default (> 991px)

        'sidebar-visible-lg'                            for a full main sidebar visible by default (> 991px)
        'sidebar-partial'                               for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)
        'sidebar-partial sidebar-visible-lg'            for a partial main sidebar which opens on mouse hover, visible by default (> 991px)
        'sidebar-mini sidebar-visible-lg-mini'          for a mini main sidebar with a flyout menu, enabled by default (> 991px + Best with static layout)
        'sidebar-mini sidebar-visible-lg'               for a mini main sidebar with a flyout menu, disabled by default (> 991px + Best with static layout)

        'sidebar-alt-visible-lg'                        for a full alternative sidebar visible by default (> 991px)
        'sidebar-alt-partial'                           for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)
        'sidebar-alt-partial sidebar-alt-visible-lg'    for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)

        'sidebar-partial sidebar-alt-partial'           for both sidebars partial which open on mouse hover, hidden by default (> 991px)

        'sidebar-no-animations'                         add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!

        'style-alt'                                     for an alternative main style (without it: the default style)
        'footer-fixed'                                  for a fixed footer (without it: a static footer)

        'disable-menu-autoscroll'                       add this to disable the main menu auto scrolling when opening a submenu

        'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
        'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

        'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links
    -->
    <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
        <!-- Alternative Sidebar -->
        <?php $this->load->view('back/sidebar-right');?>
        <!-- END Alternative Sidebar -->

        <!-- Main Sidebar -->
        <?php $this->load->view('back/sidebar-left');?>
        <!-- END Main Sidebar -->

        <!-- Main Container -->
        <div id="main-container">
            <!-- Header -->
            <!-- In the PHP version you can set the following options from inc/config file -->
            <!--
                Available header.navbar classes:

                'navbar-default'            for the default light header
                'navbar-inverse'            for an alternative dark header

                'navbar-fixed-top'          for a top fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                    'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                'navbar-fixed-bottom'       for a bottom fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                    'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
            -->
            <?php $this->load->view('back/header');?>
            <!-- END Header -->

            <!-- Page content -->
            <?php $this->load->view($View);?>

            <!-- END Page Content -->

            <!-- Footer -->
            <footer class="clearfix">
                <div class="pull-right">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                </div>
                <div class="pull-left">
                    <span id="year-copy"></span> &copy; <a href="https://1.envato.market/x4R" target="_blank">ProUI 3.8</a>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</div>
<!-- END Page Wrapper -->

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
            </div>
            <!-- END Modal Header -->
            <!-- Modal Body -->
            <!-- END Modal Body -->
        </div>
    </div>
</div>





<!-- END User Settings -->

<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="<?php echo base_url(); ?>assets/admin/js/vendor/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/app.js?v=0.1"></script>

<!-- Google Maps API Key (you will have to obtain a Google Maps API key to use Google Maps) -->
<!-- For more info please have a look at https://developers.google.com/maps/documentation/javascript/get-api-key#key -->
<script src="<?php echo base_url(); ?>assets/admin/js/helpers/gmaps.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/helpers/ckeditor/ckeditor.js"></script>


<?php if($View == 'admin/dashboard') { ?>
    <script src="<?php echo base_url(); ?>assets/admin/js/pages/index.js"></script>
    <script>$(function(){ Index.init(); });</script>
<?php } ?>


<?php if($View == 'admin/AddAdmin') { ?>
    <script src="<?php echo base_url(); ?>assets/admin/js/pages/formsValidation.js"></script>
    <script>$(function(){ FormValidation.addAdmin(); });</script>
<?php } ?>

<script>
    function showDeleteModal(id, deleteUrl) {
        $('#modal-delete').modal('show');
        $('#modal-delete').find('#confirmdelete').off('click').on('click',function () {
            location.href = deleteUrl;
        });
    }
</script>

<script>
    $(document).ready(function () {
        $('.dropzone').dropzone({
            dictDefaultMessage: 'YÜKLE',
            acceptedFiles: 'image/*',
            complete: function (file) {
                location.reload(-1);
            }
        });
    });
</script>

<script>
    function showMessageModal(id, detailUrl) {
        $('#modal-message').modal('show');
        $('#modal-message .modal-body .row-content').html('');
        


        $.ajax({
            url: detailUrl,

            type:"GET",
            dataType:"json",
            beforeSend: function(){
                $('#modal-message .modal-body .row-content').html('<i class="fa fa-spinner fa-4x fa-spin></i>"');

            },
            success: function (data) {
                var content = '';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('productId'); ?>:</strong></div><div class="col-sm-9">' + data.ProductId + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('surname'); ?>:</strong></div><div class="col-sm-9">' + data.Surname + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('price'); ?>:</strong></div><div class="col-sm-9">' + data.Price + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('name'); ?>:</strong></div><div class="col-sm-9">' + data.Name + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('phoneNumber'); ?>:</strong></div><div class="col-sm-9">' + data.PhoneNumber + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('email'); ?>:</strong></div><div class="col-sm-9">' + data.Mail + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('status'); ?>:</strong></div><div class="col-sm-9">' + data.Status + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('date'); ?>:</strong></div><div class="col-sm-9">' + data.Date + '</div></div>';
                content += '<div class="row"><div class="col-sm-3"><strong><?php echo $this->lang->line('message'); ?>:</strong></div><div class="col-sm-9">' + data.Message + '</div></div>';


                $('#modal-message .modal-body .row-content').html(content);
            }
        });


    }
</script>




<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-trash-o"></i></h2>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <button type="button" class="btn btn-md btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-md btn-danger" id="confirmdelete">Confirm Delete</button>
                </div>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>

<div id="modal-message" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title">Message</h2>
            </div>
            <div class="modal-body">
                <div class="row-content"></div>

                <div class="row text-center" style="margin-top:50px;">
                    <button type="button" class="btn btn-md btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>


</body>
</html>