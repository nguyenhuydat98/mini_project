<?php
	require_once 'Controller.php';
	require_once 'models/User.php';

	class RegisterController extends Controller {
		
		public function __construct () {
			// check if user is logged in or not, redirect to home page if does.
			if (isset($_COOKIE['username']) && isset($_COOKIE['remember_token'])) {
				$username = $_COOKIE['username'];
				$remember_token = $_COOKIE['remember_token'];
				$user = User::findByName($username);
				if ($user->remember_token == $remember_token) {
					$_SESSION['username'] = $username;
					$_SESSION['isLogged'] = true;
				}
			}
			if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true) {
				header('Location: '.BASE_URL.'/index.php?controller=product&action=list');
			}
			// set view folder
			$this->folder = 'auth';
		}

		public function create($errors = []) {
			$data = [
				"errors" => $errors,
			];
			$this->render('register',$data);
		}

		public function store() {
			// get data
			$username = '';
			$password = '';
			$confirm_password = '';
			$errors = [];
			if (isset($_POST['username'])) {
				$username = $_POST['username'];
			}
			if (isset($_POST['password'])) {
				$password = $_POST['password'];
			}
			if (isset($_POST['confirm_password'])) {
				$confirm_password = $_POST['confirm_password'];
			}
			// validate data
			if (isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf'])) {
				die('invalid token');
			}
			if (!is_string($username) || !ctype_alnum($username) || strlen($username)<4 || !ctype_alpha($username[0])) {
				$errors[] = "Invalid username";
			}
			if (!is_string($password) || strlen($password)<8) {
				$errors[] = "Invalid password";
			}
			if ($password != $confirm_password) {
				$errors[] = "Password does not match";
			}
			if (!empty($errors)) {
				$this->create($errors);
			}
			else {
				//get connection
				$conn = DB::getConnection();
				$username = mysqli_real_escape_string($conn,$username);
				DB::closeConnection();
				// check database for user
				$user = User::findByName($username,true);
				if ($user->id != NULL) {
					$errors[] = "Username already taken";
					$this->create($errors);
				}
				else {
					$user = new User;
					$user->username = $username;
					$user->password = password_hash($password, PASSWORD_DEFAULT);
					$user->save();
					echo "<script> alert('Account created. Please login.');
						window.location.href ='". BASE_URL."';
					</script>";
				}
			}
		}
	}
