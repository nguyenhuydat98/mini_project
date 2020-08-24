<?php
	require_once 'Controller.php';
	require_once 'models/User.php';

	class UserController extends Controller {
		
		public function __construct () {
			// check if user is logged in or not, if not redirect user.
			if (!$_SESSION['isLogged']) {
				header('Location: '.BASE_URL.'/?controller=login&action=login');
			}
			// set view folder
			$this->folder = "users";
		}

		public function edit($errors = []) {
			$data = [
				"title" => "User setting",
				"errors" => $errors,
			];
			$this->render('edit',$data);
		}

		public function update() {
			// get data
			$username = '';
			$password = '';
			$email = '';
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
			if (!is_string($username) || !ctype_alnum($username) || strlen($username)<4) {
				$errors[] = "Invalid username";
			}
			if ($password != NULL) {
				if (!is_string($password) || strlen($password)<8) {
					$errors[] = "Invalid password";
				}
				if ($password != $confirm_password) {
					$errors[] = "Passwords does not match";
				}
			}
			$user = User::findByName($_SESSION['username'],true);
			if ($user->id == NULL) {
				$errors[] = "Cant find user";
			}
			if (!empty($errors)) {
				$this->edit($errors);
			}
			else {
				// save user's data to database
				$user->username = $username;
				$_SESSION['username'] = $username;
				if ($password != NULL) {
					$user->password = password_hash($password, PASSWORD_DEFAULT);
				}
				$user->save();
				header("Location: ".BASE_URL.'/');
			}
		}

		public function destroy() {
			// get current auth user
			$user = User::findByName($_SESSION['username']);
			// delete user
			$user->delete();
			// log out user
			header("Location: ".BASE_URL.'/?controller=logout&action=logout');
		}
	}
