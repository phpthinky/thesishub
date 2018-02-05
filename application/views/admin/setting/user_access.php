
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        	<h4><?php echo isset($title) ? $title : "Portal"; ?> </h4>

	<?php print(isset($content) ? $content : "Nothing to display here."); ?>
           
         
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