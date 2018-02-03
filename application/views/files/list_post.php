
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">

            <div class="panel">

                <div class="panel-body">
                 
            <h4>Post <a class="btn btn-default" id="btnaddresource" href="<?=site_url('post/add');?>">Add new<i class="fa fa-add"></i></a></h4> 
                   </div>

                <div class="panel-body" style="display: none;" id="div-add-resource">
                    <div class="result"></div>
                    <form class="form" method="post" action="file/save_resource" enctype="multipart/form-data" id="frmresources" name="frmresources">
                        <div class="form-group">
                            <label class="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Type title here">
                        </div>
                        <div class="form-group">
                            <label class="title">Description</label>
                            <textarea type="text" name="desc" id="desc" class="form-control" placeholder="Type short descrition here"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="title">Keyword</label>
                            <input type="text" name="tags" id="tags" class="form-control" placeholder="Type keyword here separate by comma eg. hello,hi,world">
                        </div>

                        <div class="form-group">
                            <label class="title">Upload</label>
                            <input type="file" name="filez" id="filez" class="btn alert-info" accept="image/*,audio/mp3,video/*,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf,.docx,.pptx,.xlsx">
                        </div>
                        <div class="from-group">
                            <label></label><button class="btn btn-info" id="btnsave">Save</button>
                        </div>
                    </form>
                </div>
            <div class="panel-body">
                <form class="form" action="<?=site_url('post/index');?>" method="get">
                    <div class="form-inline">
                        <input type="text" name="q" id="q" class="form-control" style="width:95%;" placeholder="Search here.." value="<?php echo  $this->input->get('q') ? $this->input->get('q') : '';?>"><button class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            </div>
            <div class="content-area">
                
    <?php 
    if (isset($list_life)) {
        # code...
        if (is_array($list_life)) {
            # code...
            echo "<table class='table table-striped'>";
            echo "<thead>
            <tr>
            <th><input type='checkbox' name='checkpostall' id='checkpostall' class='checkboxes'></th>
            <th>BOOK #</th>
            <th>TITLE</th>
            <th>DATE OF STUDY</th>
            <th class='hidden'>STUDENT</th>
            <th></th>
            </tr>
            </thead>";
            echo "<tbody>";
            foreach ($list_life as $key) {
                # code...
                # code...
                if(isset($key->contents)){

                $key->description = $key->contents;
                }
                $bookno = (!empty($key->bookno)) ? $key->bookno : '-not defined-';

                //$date = date_format($key->date_created, 'F Y');

                $time = strtotime( $key->date_created );
                $date = date( 'F Y', $time ); 

     
                echo "<tr   id='tr-$key->page_id'>
                    <td><input type='checkbox' name='checkpost' id='checkpost_$key->page_id' value='$key->page_id' class='checkboxes'></td>
                    <td>$key->bookno</td>
                    <td>$key->title</td>
                    <td>$date</td>
                    <td width='70px' id='td-$key->page_id' class='hidden'>YES</td>
                    <td width='110px'><a class='btn btn-default' href='post/edit?id=$key->page_id'><i class='fa fa-edit'></i></a> <span class='btn btn-danger'  onclick='delete_file(\"$key->page_id,1\")'><i class='fa fa-trash-o'></i></span></td>
                    
                </tr>"  ;

            }
            echo "</tbody>";
            echo "<tfooter>
                <tr><td colspan='5'><button type='button' class='btn btn-default' id='btn_select_all' onclick=''>Select all</button> <button type='button' class='btn btn-default' id='btn-remove-s'>Remove selected</button></td></tr>
            </tfooter>";
            echo "</table>";
        }
     } ?>
                <div class="col-md-12"><?=isset($links) ? $links: ''; ?></div>
            </div>
           
         
        </div>
    </div>

</div>

<script type="text/javascript">
   

    function delete_file(id,status) {
        // body...
        //alert(status);return false;
            $.ajax({
                type: 'post',
                url: '<?=site_url("post/delete_file");?>',
                data: 'file_id='+id+'&status='+status,
                dataType:'json',
                success: function (resp) {
                    console.clear();
                    console.log(resp);
                    if (resp.stats == true) {
                        if (status == 1) {

                        $('#tr-'+id).remove(); 
                    }else{

                        $('#tr-'+id).remove();  
                    }                   
                    }

                }
            });
    }
function toggle(source) {
  checkboxes = document.getElementsByName('checkpost');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
        if($("#btn-remove-s").hasClass('alert-danger')){
            $("#btn-remove-s").removeClass('alert-danger');
        }else{
        $("#btn-remove-s").addClass('alert-danger');        
        }
  }
}

$('#checkpostall').on('click',function(){
    toggle(this);
});
var is_click = false;
$('#btn_select_all').on('click',function(){
    $('#checkpostall').click();
    if(is_click == true){
    $(this).html('Select all');
    is_click = false;
}else{

    $(this).html('Deselect all');
    is_click = true;
}

        if($("#btn-remove-s").hasClass('alert-danger')){
            $("#btn-remove-s").removeClass('alert-danger');
        }else{
        $("#btn-remove-s").addClass('alert-danger');        
        }
});

$("#btn-remove-s").click(function(){
    var selectedPost = new Array();
    $('input[name="checkpost"]:checked').each(function() {

        selectedPost.push(this.value);
        delete_file(this.value,1);

    });
console.log(selectedPost);

//alert("Number of selected Languages: "+selectedPost.length+"\n"+"And, they are: "+selectedPost);
});
</script>