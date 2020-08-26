<div class="card m-5 justify-content-center">
	<div class="card-body text-center">
		<label class="font-weight-bold"> SIGN UP </label>
        <hr>
		<form method="POST" action="?controller=register&action=store">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token'] ?>">
            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" required autocomplete="username" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Re-enter password</label>

                <div class="col-md-6">
                    <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">
                        Sign up
                    </button>
                </div>
            </div>
        </form>
	</div>
	<?php
		if (!empty($errors)) { ?>
	<hr>
	<p class="text-danger">
		<ul>
		<?php
			foreach($errors as $error) {
				echo "<li class='text-danger'><b>".$error."<br></b></li>";
			}
		?>
		</ul>
	</p>

	<?php 
		}
	?>
</div>