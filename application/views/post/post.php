<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 id='form_head'>List all</h3>
            <form class="form" id="frmsearch" name="frmsearch">
                <div class="form-inline">
                    <label for="search" >Search </label><input type="text" name="txtsearch" id="txtsearch" class="form-control"><button class="btn btn-default"><i class='fa fa-search'></i></button>
                </div>
            </form>
 
            <?php if (isset($results)) { ?>
                <table class="table table-border">
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Action</th>
                    </thead>
                     
                    <?php foreach ($results as $data) { ?>
                        <tr>
                            <td><?php echo $data->page_id ?></td>
                            <td><?php echo $data->title ?></td>
                            <?php //<td><a href="<?php echo site_url("post/read/$data->slug"); " class="btn btn-success" >Read</a></td> ?>
                            <td><a href="#readinfo" class="btn btn-success" onclick="readinfo('<?=$data->slug;?>','<?=$data->title;?>'); return true;">Read</a></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <div>No user(s) found.</div>
            <?php } ?>
 
            <?php echo isset($links) ?  echo $links : ''; ?>
    </div>

</div>

<script type="text/javascript">
       function readinfo(slug,title){
        //alert(id);
        //$('.')
        var data = slug;
                $.ajax({
                        type: 'get',
                        url: '<?=site_url("post/read/");?>'+slug,
                        data: data,
                        success: function(response){
                            console.log(response);
                                $('.loader').hide();//return false;
                                $('.modal-title').html(title);
                                $('.modal-body').html(response);
                                $('#readinfo').modal('show');
                            


                        }
                    });


       }
</script>