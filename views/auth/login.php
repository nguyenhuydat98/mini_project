<div class="card m-5 justify-content-center">
	<div class="card-body text-center">
		<label class="font-weight-bold"> LOGIN </label>
        <hr>
		<form method="POST" action="?controller=login&action=authenticate">
            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" required autocomplete="username" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-3">
	                    <input type="checkbox" name="remember_me" id="remember"> 
		                <label>
		                	Remember Me
		                </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">
                        Login
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