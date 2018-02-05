<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8"/>
        <title><?php print(isset($title) ? $title : "THESIS HUB"); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="refresh" content="3000" >
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="BISU Bilar Resource Portal" name="description"/>
        <meta content="Riziel Mendez" name="author"/>


       <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/plugin/summernote/summernote.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">
        
        <link rel="icon" type="image/png" href="<?=base_url();?>favicon.png">


            <?php // add css files
        $this->minify->css(array('default.css','admin.2.css','print.css'));
        echo $this->minify->deploy_css(FALSE, 'admin.min.css');


    ?>
        
        <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/admin.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/plugin/summernote/summernote.js');?>" type="text/javascript"></script>
<script type="text/javascript" src='<?=base_url("assets/plugin/notify/notify.min.js");?>'></script>
            <script type="text/javascript">
                $(function () {
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);

        
    });
   
   // Remove menu for searching
   $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('.side-body').removeClass('body-slide-in');


    });
});
                function callprint() {
                    window.print(this);
                }
                
            </script>
    </head>

</head>
<body>

    <div class="print-header">
        <img src="<?=base_url();?>public/images/logob.png" style="width:70px;height: 70px;margin-left: 50px;margin-top: 15px;">
    <p class="print print-title">Bohol Island State University - Bilar</p><br />
    <p class="print print-title2">Thesis Hub </p><br />
    <p class="print print-date"><?php echo date('Y/m/d h:m:s');?></p>
</div>



<?php
include VIEWPATH."admin/default/menu.php";
 ?>





<?php echo $body;?>




       
<div class="row">
    <!-- Modal -->
    <div id="readinfo" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">

                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Edit</button>
                </div>
            </div>

        </div>
    </div>
</div>
                    </div>
            <!-- /.content-area -->
                </div>

            </div>
            <!-- /.row -->

    
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<?php
if($this->uri->segment(3)) {
    $segment = $this->uri->segment(3);
}else{
    $segment = '';
} 
//echo $segment;
?>
<script type="text/javascript">
    
    $(function(){
        $('#txtsearch').on('keyup',function(){
            
            var searchh = $('#txtsearch').val();
            var data = "txtsearch=" + searchh;
            $('#searchoutput').html('');
            if(searchh.length < 2){
                return false;
            }
                    $.ajax({
                        type: 'post',
                        url: '<?=site_url("post/searchee").'/'.$segment;?>',
                        data: data,
                        success: function(response){
                            console.clear();
                            console.log(response);
                            //alert(response);
                            if(response.length <= 0){
                            $('#searchoutput').html("<div class='alert alert-danger'>No result.</div>");
                            return false;

                            }
                            $('#searchoutput').html(response);



                        }
                    });
            return false;
        });


        $('#frmsearch').on('submit',function(e){
            var searchh = $('#txtsearch').val();
            var data = "txtsearch=" + searchh;
            $('#searchoutput').html('');
            if(searchh.length < 2){
                return false;
            }
                    $.ajax({
                        type: 'post',
                        url: '<?=site_url("post/searchee").'/'.$segment;?>',
                        data: data,
                        success: function(response){
                            console.clear();
                            console.log(response);
                            //alert(response);
                            if(response.length <= 0){
                            $('#searchoutput').html("<div class='alert alert-danger'>No result.</div>");
                            return false;

                            }
                            $('#searchoutput').html(response);



                        }
                    });
            return false;
        });
    });
</script>
<?php
        $this->pagecounter->run_counter('page');
?>
</body>
</html>


<script type="text/javascript">

var isLookBehindSupported = false;
try { isLookBehindSupported = !!new RegExp("(?<=)"); } catch (e) {
/*In unsupported browsers, trying to create a lookbehind expression will simply error will simply error, which is caught here*/
}
if (isLookBehindSupported) {
    // Yay, lookbehind expressions are supported
    // alert('Yay, lookbehind expressions are supported');
    if (navigator.userAgent.indexOf("Chrome") !== -1){
    // YES, the user is suspected to support look-behind regexps 
    } else {
     /*put your old fall back code here*/ 
    //alert('Some feature may not work properly. Please used Chrome Version 50 to 63');
    $('.side-body').prepend('<div class="col-md-12><div><br /><p  class="alert alert-warning" style="color:red;background:#fff;padding:2px;font-size:11px;">Seems like you are not using google chrome browser. Some feature may not work properly. Please used Chrome Version 63 <i>(it may also work in Chrome Version 50 or later)</i> and javascript must be enable.</p></div></div>');
    }
} else {
    // Booo! Lookbehind not supported

    $('.side-body').prepend('<div class="col-md-12><div><br /><p  class="alert alert-warning" style="color:red;background:#fff;padding:2px;font-size:11px;">Seems like you are not using google chrome browser. Some feature may not work properly. Please used Chrome Version 63 <i>(it may also work in Chrome Version 50 or later)</i> and javascript must be enable.</p></div></div>');
}
</script>