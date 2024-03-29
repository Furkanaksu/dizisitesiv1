<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <!-- Basic need -->
    <title>Dizi Sitesi V1</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600'>
    <!-- Mobile specific meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone-no">

    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/plugins.css');?> ">
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/style.css');?> ">

</head>
<body>
<!--preloading-->
<div id="preloader">
    <img class="logo" src="<?php echo base_url('assets/front/'); ?>images\logo1.png" alt="">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>
<!--end of preloading-->

<div class="login-wrapper" id="signup-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>sign up</h3>
        <form method="post" action="<?php echo base_url(); ?>Uyeislemleri/kayitol">
            <div class="row">
                <label for="username-2">
                    Kullanıcı Adı:
                    <input type="text" name="username" id="username-2">
                </label>
            </div>

            <div class="row">
                <label for="email-2">
                    your email:
                    <input type="text" name="email" id="email">
                </label>
            </div>
            <div class="row">
                <label for="sifre">
                    Password:
                    <input type="password" name="password" id="password">
                </label>
            </div>
            <div class="row">
                <label for="sifre2">
                    re-type Password:
                    <input type="password" name="confirm" id="confirm">
                </label>
            </div>
            <div class="row">
                <button type="submit">sign up</button>
            </div>
        </form>
    </div>
</div>

<!--login form popup-->

<!--end of signup form popup-->

<!-- BEGIN | Header -->
<header class="ht-header">
    <div class="container">
        <nav class="navbar navbar-default navbar-custom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header logo">
                <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <div id="nav-icon1">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <a href="index.html"><img class="logo" src="<?php echo base_url('assets/front/'); ?>images\logo1.png" alt=""></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav flex-child-menu menu-left">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown">
                            Home <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="index.html">Home 01</a></li>
                            <li><a href="homev2.html">Home 02</a></li>
                            <li><a href="homev3.html">Home 03</a></li>
                        </ul>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                            movies<i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Movie grid<i class="ion-ios-arrow-forward"></i></a>
                                <ul class="dropdown-menu level2">
                                    <li><a href="moviegrid.html">Movie grid</a></li>
                                    <li><a href="moviegridfw.html">movie grid full width</a></li>
                                </ul>
                            </li>
                            <li><a href="movielist.html">Movie list</a></li>
                            <li><a href="moviesingle.html">Movie single</a></li>
                            <li class="it-last"><a href="seriessingle.html">Series single</a></li>
                        </ul>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                            celebrities <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="celebritygrid01.html">celebrity grid 01</a></li>
                            <li><a href="celebritygrid02.html">celebrity grid 02 </a></li>
                            <li><a href="celebritylist.html">celebrity list</a></li>
                            <li class="it-last"><a href="celebritysingle.html">celebrity single</a></li>
                        </ul>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                            news <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="bloglist.html">blog List</a></li>
                            <li><a href="bloggrid.html">blog Grid</a></li>
                            <li class="it-last"><a href="blogdetail.html">blog Detail</a></li>
                        </ul>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                            community <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="userfavoritegrid.html">user favorite grid</a></li>
                            <li><a href="userfavoritelist.html">user favorite list</a></li>
                            <li><a href="userprofile.html">user profile</a></li>
                            <li class="it-last"><a href="userrate.html">user rate</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav flex-child-menu menu-right">
                    <?php if($this->session->userdata('Name') == '' || $this->session->userdata('Name') == NULL){?>
                    <li class=""><a href="<?php echo base_url(); ?>Uyeislemleri/login">LOG In</a></li>
                    <li class="btn signupLink"><a href="#">sign up</a></li>
                    <?php }else{ ?>
                        <li ><a style="color: #01FF70"><?php echo $this->session->userdata('Name').' '.$this->session->userdata('Surname') ?></a></li>
                        <li ><a style="color: orangered" href="<?php echo base_url(); ?>Uyeislemleri/logout">Çıkış Yap</a></li>
                    <?php }?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <!-- top search form -->
        <?php echo validation_errors(); ?>
        <?php echo $this->session->flashdata('info'); ?>
        <?php echo $this->session->flashdata('success'); ?>
        <div class="top-search">
            <select>
                <option value="united">TV show
                <option value="saab">Others
            </select>
            <input type="text" placeholder="Search for a movie, TV Show or celebrity that you are looking for">
        </div>
    </div>
</header>
<!-- END | Header -->