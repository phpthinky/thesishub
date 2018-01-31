<div class="wrapper">
  <div class="container">
    <div class="row">

      <div class="col-md-12" id="search-top-menu">
        <div class="bisu-logo">
          <div class="container home-title">
            <h4>Resource Portal</h4>
          </div>
          <nav class="navbar navbar-inverse">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="<?=site_url();?>"><h4>Resource Portal</h4></a>
                  <?php /*<form class="navbar-form <?php echo isset($ishidesearch) ? $ishidesearch : ''; ?>" action="<?=site_url('search');?>" method="get">
                          <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search" name="q">
                              <span class="input-group-btn">
                                  <button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-search"></span></button>
                              </span>
                          </div>
                      </form>  */ ?>
                  </div>
                  <!-- Collection of nav links, forms, and other content for toggling -->
                  <div id="navbarCollapse" class="collapse navbar-collapse">
                      
                      <ul class="nav navbar-nav navbar-right">

                          <li class="<?php  ?>"><a href="<?php echo site_url('search'); ?>"> Home</a></li>

                          <?php if (!$this->aauth->is_loggedin()): ?>
                            
                          <li class="<?php  ?>"><a href="<?php echo site_url('login'); ?>"> Login</a></li>
                          <?php endif ?>
                          <?php if ($this->aauth->is_loggedin()): ?>
                            <li class="<?php ?>"><a href="<?=site_url('u/my_account');?>"> Profile</a></li>
                          <li class="dropdown <?php  ?>">
                              <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Messages <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                  <li><a href="<?php echo site_url(); ?>/u/compose">Compose</a></li>
                                  <li><a href="<?php echo site_url(); ?>/u/inbox">Inbox</a></li>
                                  <li><a href="<?php echo site_url(); ?>/u/sents">Sent Items</a></li>
                                  <li class="divider"></li>
                                  <li><a href="<?php echo site_url(); ?>/u/trash">Trash</a></li>
                              </ul>
                          </li>
                          <?php if ($this->aauth->is_admin()) {
                            # code...
                            ?> 
                          <li><a href="<?=site_url('dashboard');?>"> <span>Panel</span></a></li>
                     
                            <?php
                          } ?>
                     
                          <li><a href="<?=site_url('logout');?>"> <span>Logout</span></a></li>
                          <?php endif ?>
                          
                      </ul>
                  </div>
              </nav>

        </div>              
      </div>
    </div> <!-- div row -->
  </div> <!-- div container -->
</div><!-- div wrapper -->