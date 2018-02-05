
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        	<div class="col-md-12">
        	<h4>Site settings </h4></div>



            <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#welcome">Welcome page</a></li>
          <li><a data-toggle="tab" href="#header">Header</a></li>
          <li><a data-toggle="tab" href="#footer">Footer</a></li>
          <li><a data-toggle="tab" href="#guide">User Guide</a></li>
        </ul>

        <div class="tab-content">
        	<div id="welcome" class="col-md-12 tab-pane fade in active">
        		<div class="panel">
        			<div class="panel-heading"><h3>Welcome page</h3></div>
        			<div class="panel-body">
        			<form class="form form-horizontal" action="<?=site_url('setting/update_welcome');?>" method="post">
        				<div class="hidden"><input type="hidden" id="s_id" name="s_id" value="<?=isset($welcome) ? $welcome[0]->id : '';?>" /></div>
        				<div class="form-group">
        				<label>Content</label>
        				<textarea id="desc" name="desc" class="summernote"><?=isset($welcome) ? $welcome[0]->setting_value : '';?></textarea>
        				</div>
        				<div class="form-group">
        					<label></label>
        					<button type="submit" class="btn btn-default" style="margin-left:-5px">Save</button>
        				</div>
        			</form>
        			</div>
        		</div>
        	</div>

            <div id="header" class="col-md-12 tab-pane fade">
                <div class="panel">
                    <div class="panel-heading"><h3>Header</h3></div>
                    <div class="panel-body">
                    <form class="form form-horizontal" action="<?=site_url('setting/header');?>" method="post">
                        <div class="hidden"><input type="hidden" id="s_id" name="s_id" value="<?=!empty($header) ? $header[0]->id : '';?>" /></div>
                        <div class="form-group">
                        <label>Content</label>
                        <textarea id="desc" name="desc" class="summernote"><?=!empty($header) ? $header[0]->setting_value : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-default" style="margin-left:-5px">Save</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div id="footer" class="col-md-12 tab-pane fade">
                <div class="panel">
                    <div class="panel-heading"><h3>Footer</h3></div>
                    <div class="panel-body">
                    <form class="form form-horizontal" action="<?=site_url('setting/update_footer');?>" method="post">
                        <div class="hidden"><input type="hidden" id="s_id" name="s_id" value="<?=!empty($footer) ? $footer[0]->id : '';?>" /></div>
                        <div class="form-group">
                        <label>Content</label>
                        <textarea id="desc" name="desc" class="summernote"><?=!empty($footer) ? $footer[0]->setting_value : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-default" style="margin-left:-5px">Save</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div id="guide" class="col-md-12 tab-pane fade">
                <div class="panel">
                    <div class="panel-heading"><h3>User Guide</h3></div>
                    <div class="panel-body">
                    <form class="form form-horizontal" action="<?=site_url('setting/update_footer');?>" method="post">
                        <div class="hidden"><input type="hidden" id="s_id" name="s_id" value="<?=!empty($guide) ? $guide[0]->id : '';?>" /></div>
                        <div class="form-group">
                        <label>Content</label>
                        <textarea id="desc" name="desc" class="summernote"><?=!empty($guide) ? $guide[0]->setting_value : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-default" style="margin-left:-5px">Save</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            
            </div>

       	</div>
    </div>

    <script type="text/javascript">

  $('.summernote').summernote({
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    },
    height:200
	});

  </script>