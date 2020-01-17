
<div class="col-md-10">
	<div class="panel panel-primary ww-panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">All Orders</h3>
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
											Status:
										</label>
									</div>
									<div class="m-form__control">
										<select class="form-control m-bootstrap-select" id="m_form_type">
											<option value="0">All</option>
											<option value="1">Completed</option>
											<option value="2">InProgress</option>
											<option value="3">Cancel</option>
										</select>
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div>
							
							<!-- <script type="text/javascript">
								var options = <?php echo json_encode($options) ?>;
							</script> -->

							<div class="col-md-4">
								
								<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="show_options">
									<span>
										<i class="la la-cart-plus"></i>
										<span>
											Show Orders
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
					<!-- <p><a class='btn' href="#add" rel="modal:open">Add New Product</a></p> -->
					<div style="overflow-x: scroll;">
						<table id="order-grid" class="table table-bordered display" cellspacing="0" width="100%">
							<thead>
								<tr class="info">
									<th></th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>OrderID</th>
									<th>Total Price</th>
									<th>Status</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Actions</th>
									<th style="display: none;"></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!--end: Datatable -->
			</div>
		</div>
    </div>
</div>
<script type= 'text/javascript' src="<?php echo base_url();?>assets/js/order-data-ajax.js" type="text/javascript"></script>