<?php
	require_once 'Controller.php';
	require_once 'models/User.php';

	class LogoutController extends Controller {
		
		public function __construct () {
			if (!$_SESSION['isLogged']) {
				header('Location: '.BASE_URL.'/?controller=login&action=login');
			}
		}

		public function logout() {
			// clear remember token and username
			if (isset($_COOKIE['username'])) {
				// remove username cookies
				setcookie("username", "", time() - 3600);
			}
			if (isset($_COOKIE['remember_token'])) {
				// remove token cookies
				setcookie("remember_token", "", time() - 3600);
			}
			// end session
			session_destroy();
			header('Location: '.BASE_URL.'/');
		}
	}
