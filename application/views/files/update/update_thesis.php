<div class="row other-option" id="option-6" style="display:none;">
				<div class="col-md-12">
				<h4><label>Undergraduate Thesis</label></h4>
				<div class="row">
				<form class="form " id="frm-6" action="../post/save" method="post">
					<input type="hidden" name="slug" id="slug">
					<div class="panel panel-default">
						<div class="panel-heading">
							<label>Researcher <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('researcher')">Add more...</a></label>
							<div id="msgresearcher" style="display: inline-block;"></div>
						</div>
						<div class="panel-body">
							<div class="row"  id="divresearcher">
							<div class="col-md-8">
									
								<label>Name of researcher</label>
								<input type="text" class="form-control" name="researcher[]" id="researcher" placeholder="Type researcher full name" onkeyup="names(this.id);" autocomplete="off">
								<ul class="ul-on-input" id="ul-on-input-researcher"></ul>
							</div>
							<div class="col-md-4">
									<label>Position / title </label><input type="text" class="form-control" name="researcher-position[]" id="researcher-position" placeholder="Type researcher position or NA" autocomplete="off">
							
							</div>
						
							</div>
						</div>

					</div>


			<div class="panel panel-default">
				<div class="panel-heading">
					<label>Committee <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('committee')">Add more...</a></label>
					<div id="msgcommittee" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="row"  id="divcommittee">
						<div class="col-md-8">
							
							<label>Name of committee</label><input type="text" class="form-control" name="committee[]" id="committee" placeholder="Type committee full name" onkeyup="names(this.id)" autocomplete="off">
							<ul class="ul-on-input" id="ul-on-input-committee"></ul>
						</div>
						<div class="col-md-4">
							<label>Position / title </label><input type="text" class="form-control" name="committee-position[]" id="committee-position" placeholder="Type committee position or NA">
					
						</div>	
					</div>
				</div>

			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<label>Examining Panel <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('panel')">Add more...</a></label>
					<div id="msgpanel" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="row"  id="divpanel">
						<div class="col-md-8">
							
							<label>Name of panel</label><input type="text" class="form-control" name="panel[]" id="panel" placeholder="Type panel full name" onkeyup="names(this.id)" autocomplete="off">
							<ul class="ul-on-input" id="ul-on-input-panel"></ul>
						
						</div>
						<div class="col-md-4">
							
							<label>Position / title </label><input type="text" class="form-control" name="panel-position[]" id="panel-position" placeholder="Type panel position or NA">
					
						</div>
					</div>
				</div>

			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						
					<div class="col-md-8">
							
						<div class="form-group">
						<label>Rating</label>
							<input type="number" max="5" class="form-control" name="rating" id="rating" placeholder='Type rating here...'>
						</div>
					</div>
					</div>
				</div>
			</div>

				</form>
				</div>
				</div>
			</div>