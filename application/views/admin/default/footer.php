
       
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