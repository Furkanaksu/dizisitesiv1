<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="<?php echo site_url(); ?>admin/dashboard" class="sidebar-brand">
                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong>Pro</strong>UI</span>
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="page_ready_user_profile.html">
                        <img src="<?php echo base_url(); ?>assets/admin/img/placeholders/avatars/avatar2.jpg" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name"><?php echo $this->session->userdata('Name'); ?> <?php echo $this->session->userdata('Surname'); ?></div>
                <div class="sidebar-user-links">
                    <a href="page_ready_user_profile.html" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                    <a href="page_ready_inbox.html" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a>
                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                    <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                    <a href="<?php echo site_url(); ?>admin/logout" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Theme Colors -->
            <!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->
            <ul class="sidebar-section sidebar-themes clearfix sidebar-nav-mini-hide">
                <!-- You can also add the default color theme
                <li class="active">
                    <a href="javascript:void(0)" class="themed-background-dark-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default Blue"></a>
                </li>
                -->
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-night themed-border-night" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/night.css" data-toggle="tooltip" title="Night"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-amethyst themed-border-amethyst" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-modern themed-border-modern" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/modern.css" data-toggle="tooltip" title="Modern"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-autumn themed-border-autumn" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-flatie themed-border-flatie" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/flatie.css" data-toggle="tooltip" title="Flatie"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-spring themed-border-spring" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/spring.css" data-toggle="tooltip" title="Spring"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-fancy themed-border-fancy" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/fancy.css" data-toggle="tooltip" title="Fancy"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-fire themed-border-fire" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-coral themed-border-coral" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/coral.css" data-toggle="tooltip" title="Coral"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-lake themed-border-lake" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/lake.css" data-toggle="tooltip" title="Lake"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-forest themed-border-forest" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/forest.css" data-toggle="tooltip" title="Forest"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-waterlily themed-border-waterlily" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/waterlily.css" data-toggle="tooltip" title="Waterlily"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-emerald themed-border-emerald" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/emerald.css" data-toggle="tooltip" title="Emerald"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-dark-blackberry themed-border-blackberry" data-theme="<?php echo base_url(); ?>assets/admin/css/themes/blackberry.css" data-toggle="tooltip" title="Blackberry"></a>
                </li>
            </ul>
            <!-- END Theme Colors -->

            <!-- ------------------------- Sidebar Navigation ---------------------------------------------------- -->
            <ul class="sidebar-nav">
                <li>
                    <a href="<?php echo site_url(); ?>Admin/GetAdmins"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Admins</span></a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>Admin/Movies"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Filmler</span></a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>Admin/ImagesUpload"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Resimler</span></a>
                </li>
            </ul>

            <!-- ------------------------------------- END Sidebar Navigation----------------------------------- -->

            <!-- Sidebar Notifications -->
            <!-- END Sidebar Notifications -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>