<div class="card-body m-4 p-4 border rounded">
	<form method="POST" action="?controller=user&action=update">

		<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token'] ?>">

		<div class="form-group row">
			<label for="username" class="col-md-4 col-form-label text-md-right">
				Username
			</label>
			<div class="col-md-6">
				<input id="username" type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'] ?>" required autocomplete="username" autofocus>
			</div>
		</div>
		<hr>
		<div class="form-group row">
			<label for="password" class="col-md-4 col-form-label text-md-right">
				Password
			</label>
			<div class="col-md-6">
				<input id="password" type="password" class="form-control" name="password">
			</div>
		</div>
		<div class="form-group row">
			<label for="confirm-password" class="col-md-4 col-form-label text-md-right">
				Confirm Password
			</label>
			<div class="col-md-6">
				<input id="confirm-password" type="password" class="form-control" name="confirm_password">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-2 offset-md-5">
				<button type="submit" class="btn-primary form-control">
					Update setting
				</button>
			</div>
		</div>
	</form>
	<?php if (!empty($errors)) {?>
	<div class="m-4 p-4 border rounded">
		<?php 
			foreach ($errors as $error) {
				echo "<span class='text-danger'> $error </span><br>";
			}
		?>
	</div>
	<?php } ?>
	<hr>
	<!-- Delete -->
	<div class="form-group row">
		<div class="col-md-2 offset-md-5">
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
				Delete account
			</button>
			<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Are you sure you want to delete your account?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<form method="POST" action="?controller=user&action=destroy">
								<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token'] ?>">
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>