<div class="col-md-10">
	<div class="panel panel-primary ww-panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">All Categories</h3>
	    </div>
	    <div class="panel-body">
			<div class="m-portlet__body">
		<!--begin: Datatable -->
				<div>
					<p id='err'/>
					<p><a class='btn' href="#add" rel="modal:open">Add a new category</a></p>
					<div style="overflow-x: scroll;">
						<table id="category-grid" class="table table-bordered display" cellspacing="0" width="100%">
							<thead>
								<tr class="info">
									<th>#</th>
									<th>Category Title</th>
									<th>Category Desc</th>
									<th>Actions</th>
								</tr>
							</thead>
						</table>
					</div>
					
					<form id="add" action="#" class="add_form modal" style="display:none;">
						<div id='msgAdd'/>
						<h3>Add a new category</h3>
						<p>
							<label>Category Title</label>
							<input type="text" name="category_title">
						</p>
						<p>
							<label>Category Description</label>
							<input type="text" name="category_desc">
						</p>
						<p>
							<input type="submit" id="addNew" value="Submit" style="color:#000">
						</p>
					</form>
				</div>
				<!--end: Datatable -->
			</div>
		</div>
    </div>
</div>
<script type= 'text/javascript' src="<?php echo base_url();?>assets/js/category-data-ajax.js" type="text/javascript"></script>