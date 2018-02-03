
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        	<h4>DASHBOARD </h4>

           
         
            <div class="col-md-12">
              <div class="col-md-12 title-blue-light" style="">User guide</div>

            <div class="col-md-8"><br/>
                <?php 
            if (!empty($guide)) {
               # code...
               if (is_array($guide)) {
                 # code...
                echo $guide[0]->setting_value;
               }
             } ?>

            </div>
            <div class="col-md-4"><br/></div>
          </div>

          <div class="col-md-12"> <br /> <br /> 
              <div class="col-md-12 title-blue-light" style="">Activity logs </div> 
              <br /> <br /> 
                 <?php print(isset($content) ? $content : "Nothing to display here."); ?>
              <br />
          </div>
        </div>
    </div>

</div>


<script type="text/javascript">
	
	function unblocked(id) {
		// body...

			$.ajax({
    			type: 'post',
    			url: '<?=site_url("d/unblocked");?>',
    			data: 'id='+id,
    			dataType: 'json',
                beforeSend: function(){
                    $('#frmresources').hide('fast');
                    $('.result').html('<center><div class="loader"></div></center>');
                },
                success: function (resp) {
                    console.clear();

                    console.log(resp);

                    if (resp.stats == true) {
                    	$('#tr-'+id).remove();
                    }               

                }
    		});
	}
</script>