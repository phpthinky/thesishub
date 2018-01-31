<div class="col-md-12">
 

  <div class="">
    <div class="col-md-12 content">
      
           <div class="content">
            <br />
            <div class="col-md-12">
              <div class="col-md-12 title-blue-light" style=""><h4>Welcome</h4></div>

            <div class="col-md-8"><br/>
                <?php 
            if (!empty($welcome)) {
               # code...
               if (is_array($welcome)) {
                 # code...
                echo $welcome[0]->setting_value;
               }
             } ?>

            </div>
            <div class="col-md-4"><br/></div>
          </div>
            <br />
            <div class="col-md-12">
              <br />
              <div class="col-md-12  title-blue-light" style="background: #0066ff;color: #fff"><h4>Latest Post</h4></div>
              
              
            <?php if(!empty($latest_post));

            if (is_array($latest_post)) {
               foreach ($latest_post as $key) {

                ?>
                <div class="col-md-4 post-content"><br/>
                
                  <div class="panel panel-info post-latest">
                    <div class="panel-heading">
                       <a href="<?=site_url('read/'.$key->years.'/'.$key->slug);?>" style='text-decoration:none;'><h5><?=$key->title;?><i class="fa fa-arrow-right go pull-right"></i></h5></a>
                    </div>
                    <div class="panel-body">
                      <div class="col-md-4">
                        <img style="width:100%;" src="<?=base_url('public/images/img-400x400.png');?>">
                        
                      </div>
                      <div class="col-md-8">
                    <?=$this->global_model->limitext($key->description);?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
               }
             } ?>

            </div>
           </div>
    </div>
  </div>  
</div>
