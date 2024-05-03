<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <!-- <a href="<?=base_url();?>home" class="logo"><i class="fa fa-star"></i><span> Bintang Baru</span></a> -->
            <!-- Image Logo here -->
            <a href="<?=base_url();?>" class="logo">
                <i class="icon-c-logo"> <img src="<?= base_url()?>assets/images/logo/logo-only-white.png" height="42"/> </i>
                <span><img src="<?= base_url()?>assets/images/logo/logo-2-white.png" height="42"/></span>
            </a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>


                <ul class="nav navbar-nav navbar-right pull-right">
                    
                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><?= $this->session->userdata['logged_in']['fullname']?> <img src="<?= base_url()?>assets/images/users/avatar-5.png" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url()?>auth/users/profile"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                            <!-- <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>
                            <li class="divider"></li> -->
                            <li><a href="<?= base_url()?>logout"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->