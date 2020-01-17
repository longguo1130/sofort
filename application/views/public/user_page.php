<div class="col-md-10">
	<div class="panel panel-primary ww-panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">All Users</h3>
	    </div>
	    <div class="panel-body">
			<div class="m-portlet__body">
		<!--begin: Datatable -->
				<div>
					<p id='err'/>
					<p><a class='btn' href="#add" rel="modal:open">Add a new user</a></p>
					<div style="overflow-x: scroll;">
						<table id="user-grid" class="table table-bordered display" cellspacing="0" width="100%">
							<thead>
								<tr class="info">
									<th>#</th>
									<th>name</th>
									<th>first_name</th>
									<th>surname</th>
									<!-- <th>company_name</th> -->
									<th>address</th>
									<th>postcode</th>
									<th>place</th>
									<th>country</th>
									<!-- <th>reg_no</th> -->
									<th>email</th>
									<th>telephone_no</th>
									<!-- <th>password</th> -->
									<th>user_level</th>
									<!-- <th>customer_id</th> -->
									<th>Actions</th>
								</tr>
							</thead>
						</table>
					</div>

					<form id="add" action="#" class="add_form modal" style="display:none;">
						<div id='msgAdd'/>
						<h3>Add a new user</h3>
<!-- 						<p>
							<label>#</label>
							<input class="form-control" type="text" name="user_id">
						</p> -->
						<p>
							<label>name</label>
							<input class="form-control" type="text" name="name">
						</p>
						<p>
							<label>FirstName</label>
							<input class="form-control" type="text" name="first_name">
						</p>
						<p>
							<label>Surname</label>
							<input class="form-control" type="text" name="surname">
						</p>
						<p>
							<label>CompanyName</label>
							<input class="form-control" type="text" name="company_name">
						</p>
						<p>
							<label>Address</label>
							<input class="form-control" type="text" name="address">
						</p>
						<p>
							<label>Postcode</label>
							<input class="form-control" type="text" name="postcode">
						</p>
						<p>
							<label>Place</label>
							<input class="form-control" type="text" name="place">
						</p>
						<p>
							<label>Country</label>
							<input class="form-control" type="text" name="country">
						</p>
						<!-- <p>
							<label>RegNo</label>
							<input class="form-control" type="text" name="reg_no">
						</p> -->
						<p>
							<label>Email</label>
							<input class="form-control" type="text" name="email">
						</p>
						<p>
							<label>TelephoneNo</label>
							<input class="form-control" type="text" name="telephone_no">
						</p>
						<p>
							<label>Password</label>
							<input class="form-control" type="password" name="password">
						</p>
						<p>
							<label>UserLevel</label>
							<!-- <input class="form-control" type="text" name="user_level"> -->
							<select class="form-control custom-select" name="user_level">
								<option value="1">Admin User</option>
								<option value="2">Business User</option>
								<option value="3">Partner User</option>
								<option value="4">Facility User</option>
								<option value="5">Driver User</option>
								<option value="6">Normal User</option>
							</select>

						</p>
						<!-- <p>
							<label>CustomerID</label>
							<input class="form-control" type="text" name="customer_id">
						</p> -->
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
<script type= 'text/javascript' src="<?php echo base_url();?>assets/js/user-data-ajax.js" type="text/javascript"></script>