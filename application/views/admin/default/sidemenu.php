<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=site_url('dashboard');?>">
                <img src="<?=base_url('public/images/thesishub.png');?>">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                </a>
            </li>            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php print(isset($username) ? $username : "User"); ?> <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=site_url('u/editprofile');?>"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                    <li><a href="<?=site_url('u/changepass');?>"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=site_url('logout');?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i> Home <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="<?=site_url('dashboard');?>"><i class="fa fa-angle-double-right"></i> Dashboard</a></li>
                        <li><a href="<?=site_url();?>"><i class="fa fa-angle-double-right"></i> Welcome page</a></li>
                        <li><a href="<?=site_url('search');?>"><i class="fa fa-angle-double-right"></i> Research panel</a></li>
                        <?php if ($this->aauth->is_admin()) {
                            # code...
                            ?>
                        <li><a href="<?=site_url('s/settings');?>"><i class="fa fa-angle-double-right"></i> Settings</a></li>


                       <?php  } ?>
                    </ul>
                </li>
                <?php if ($this->aauth->is_admin()) {
                            # code...
                            ?>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-star"></i>  Post <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                       <!-- -// <li><a href="<?=site_url('post');?>"><i class="fa fa-angle-double-right"></i> View</a></li> */ ?-->
                        <li><a href="<?=site_url('post/create');?>"><i class="fa fa-angle-double-right"></i> New</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> Add category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?=site_url('users');?>"><i class="fa fa-fw fa-user-plus"></i>  Users</a>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#group"><i class="fa fa-fw fa-group"></i>  Group <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="group" class="collapse">
                        <li><a href="<?=site_url('group');?>"><i class="fa fa-angle-double-right"></i> List group</a></li>
                        <li><a href="<?=site_url('group/create');?>"><i class="fa fa-angle-double-right"></i> Create group</a></li>
                        <li><a href="<?=site_url('group/add');?>"><i class="fa fa-angle-double-right"></i> Create permission</a></li>
                    </ul>
                </li>

                <?php } ?>

                <li>
                    <a href="#" data-toggle="collapse" data-target="#messages"><i class="fa fa-fw fa-paper-plane-o"></i>  Messages <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="messages" class="collapse">
                        <li><a href="<?=site_url('messages/compose');?>"><i class="fa fa-angle-double-right"></i> Compose</a></li>
                        <li><a href="<?=site_url('messages');?>"><i class="fa fa-angle-double-right"></i> Inbox</a></li>
                        <li><a href="<?=site_url('messages/sent');?>"><i class="fa fa-angle-double-right"></i> Sent</a></li>
                        <?php /*
                        <li><a href="<?=site_url('messages/draft');?>"><i class="fa fa-angle-double-right"></i> Draft</a></li>
                        <li><a href="<?=site_url('messages/trash');?>"><i class="fa fa-angle-double-right"></i> Trash</a></li>  */ ?>
                    </ul>
                </li>
                <li>
                </li>
                <?php if ($this->aauth->is_admin()) {
                            # code...
                            ?>
                <li>
                    <a href="counter"><i class="fa fa-fw fa fa-question-circle"></i> Statistics</a>
                </li>
                <li>
                    <a href="faq"><i class="fa fa-fw fa fa-question-circle"></i> Help</a>
                </li>

                <?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                <br>
                    <div class="subtitle"><h4><?php print(isset($subtitle) ? $subtitle : "Subtitle"); ?></h4></div>
                    <div class="col-sm-12 col-md-12 content-area">