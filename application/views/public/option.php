<div class="col-md-10">
	<div class="panel panel-primary ww-panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">Repair Options by Device</h3>
	    </div>
	    <div class="panel-body">
			<div class="m-portlet__body">
				<!--begin: Search Form -->
				<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
					<div class="row align-items-center">
						<div class="col-xl-8 order-2 order-xl-1">
							<div class="form-group m-form__group row align-items-center">
								<div class="col-md-4">
									<div class="m-form__group m-form__group--inline">
										<div class="m-form__label">
											<label>
												Categories:
											</label>
										</div>
										<div class="m-form__control">
											<select class="form-control m-bootstrap-select" id="m_form_status">
												<option value="None">
													None
												</option>
												<?php
												foreach ($categories as $cat_item) {
												?>
												<option value="<?php echo $cat_item['category_id'];?>">
													<?php echo $cat_item['category_title'];?>
												</option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
								
								<script type="text/javascript">
									var options = <?php echo json_encode($options) ?>;
								</script>

								<div class="col-md-4">
									<div class="m-form__group m-form__group--inline">
										<div class="m-form__label">
											<label class="m-label m-label--single">
												Products:
											</label>
										</div>
										<div class="m-form__control">
											
											<select class="form-control m-bootstrap-select" id="m_form_type">
											</select>
												
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>

								<div class="col-md-4">
									
									<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="show_options">
										<span>
											<i class="la la-cart-plus"></i>
											<span>
												Show Options
											</span>
										</span>
									</a>
									<div class="m-separator m-separator--dashed d-xl-none"></div>
									
								</div>

							</div>
						</div>
						<div class="col-xl-4 order-1 order-xl-2 m--align-right">
							
						</div>
					</div>
				</div>
				<!--end: Search Form -->
		<!--begin: Datatable -->
				<div>
					<p id='err'/>
					<p><a class='btn' href="#add" rel="modal:open">Add New Product</a></p>
					<div style="overflow-x: scroll;">
						<table id="repairoptions-grid" class="table table-bordered display" cellspacing="0" width="100%">
							<thead>
								<tr class="info">
									<th>#</th>
									<th>Option</th>
									<th>SubNo</th>
									<th>Title</th>
									<th>Summary</th>
									<th>Price</th>
									<th>Price Down</th>
									<th>Actions</th>
								</tr>
							</thead>
						</table>
					</div>
					<form id="add" action="#" class="add_form modal" style="display:none;">
						<div id='msgAdd'/>
						<h3>Add a new product</h3>
		<!-- 				<p>
							<label>#</label>
							<input type="text" name="repair_id">
						</p> -->
						<p>
							<label>Option</label>
							<!-- <input type="text" name="repair_or_service"> -->
							<select name="repair_or_service">
								<option value="1">Repair</option>
								<option value="2">Service</option>
							</select>
						</p>
						<p>
							<label>SubNo</label>
							<input type="text" name="sub_type">
						</p>
						<p>
							<label>Title</label>
							<input type="text" name="repair_title">
						</p>
						<p>
							<label>Summary</label>
							<input type="text" name="repair_summary">
						</p>
						<p>
							<label>Price</label>
							<input type="text" name="repair_price">
						</p>
						<p>
							<label>Price Down</label>
							<input type="text" name="price_down">
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
<script type= 'text/javascript' src="<?php echo base_url();?>assets/js/repair-data-ajax.js" type="text/javascript"></script>