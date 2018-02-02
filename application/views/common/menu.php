
<nav class="navbar navbar-coloftech">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                      <button type="button" data-target="#nav-portal" data-toggle="collapse" class="navbar-toggle">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="<?=site_url();?>"></a>
                
                  </div>
                  <!-- Collection of nav links, forms, and other content for toggling -->
                  <div id="nav-portal" class="collapse navbar-collapse">
                      
                      <ul class="nav navbar-nav navbar-left">

                          <li class="<?php  ?>"><a href="<?php echo site_url(); ?>"> Home</a></li>
                          <li><a href="<?php echo site_url(); ?>/search">Search</a></li>

                          <?php if (!$this->aauth->is_loggedin()): ?>
                            
                          <li class="<?php  ?>"><a href="<?php echo site_url('signin'); ?>"> Login</a></li>
                          <li class="<?php  ?>"><a href="<?php echo site_url('signup'); ?>"> Signup</a></li>
                          <?php endif ?>
                          <?php if ($this->aauth->is_loggedin()): ?>
                          
                          <li><a href="<?=site_url('user/directory');?>"> <span>My directory</span></a></li>
                          <li><a href="<?=site_url('setting/security');?>"> <span>My account</span></a></li>
                         
                          <?php if ($this->session->userdata['permit'] == 'staffs' || $this->aauth->is_admin()): ?>
                            
                          <li><a href="<?=site_url('dashboard');?>"> <span>Administration</span></a></li>
                          <?php endif ?>
                     
                          
                     
                          
                     
                          <li><a href="<?=site_url('logout');?>"> <span>Logout</span></a></li>
                          <?php endif ?>
                          
                      </ul>
                  </div>
              </nav>