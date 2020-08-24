<?php
	require_once 'Controller.php';
	require_once 'models/User.php';

	class LoginController extends Controller {
		
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

		public function login($errors = []) {
			$data = [
				"errors" => $errors,
			];
			$this->render('login',$data);
		}

		public function authenticate() {
			// get data
			$username = '';
			$password = '';
			$errors = [];
			if (isset($_POST['username'])) {
				$username = $_POST['username'];
			}
			if (isset($_POST['password'])) {
				$password = $_POST['password'];
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
			if (!empty($errors)) {
				$this->login($errors);
			}
			else {
				//get connection
				$conn = DB::getConnection();
				$username = mysqli_real_escape_string($conn,$username);
				DB::closeConnection();
				// check database for user
				$user = User::findByName($username);
				if ($user->id == NULL || !password_verify($password, $user->password)) {
					$errors[] = "No user match our credentials.";
					$this->login($errors);
				}
				else {
					$_SESSION['isLogged'] = true;
					$_SESSION['username'] = $user->username;
					// create remember me token
					if (isset($_POST['remember_me'])) {
						$token = $user->setToken();
						$user->save();
						setcookie('remember_token',$token, time()+3600*24*30);
						setcookie('username',$user->username, time()+3600*24*30);
					}
				}
				if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true) header('Location: '.BASE_URL);
			}
		}
	}
