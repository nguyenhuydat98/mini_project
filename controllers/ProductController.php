<?php
	require_once 'Controller.php';
	require_once 'models/Product.php';
	require_once 'models/User.php';

	class ProductController extends Controller
	{
		public function __construct() {
			if (!$_SESSION['isLogged']) {
				header('Location: '.BASE_URL.'/?controller=login&action=login');
			}
			$this->folder = 'products';
		}

		public function list() {
			$products = Product::getAll();
			$data = [
				'products' => $products
			];
			$this->render('ListProductPage', $data);
		}

		public function find($errors = []) {
			if(isset($_GET['id']) || isset($_POST['id'])) {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
				} else if(isset($_POST['id'])) {
					$id = $_POST['id'];
				}
				$product = Product::find($id);
				$data = [
					'product' => $product,
					'errors'  => $errors
				];
				$this->render('EditProductPage', $data);
			}
		}

		public function edit() {
			if(isset($_POST['edit-product'])) {
				$errors = $this->checkValidateInput();
				if (isset($_FILES['edit-image']) && $_FILES['edit-image']['error']) {
					$image_link = $_POST['image'];
				} else {
					$image_link = BASE_URL . '/assets/images/'. $_FILES['edit-image']['name'];
				}
				if(!empty($errors)) {
					$this->find($errors);
				} else {
					Product::edit(
						$_POST['id'],
						$_POST['name'],
						$_POST['brand'],
						$_POST['description'],
						$image_link,
						$_POST['price']
					);
					header('location: index.php?controller=product&action=list');
				}
			}
		}

		public function addNew($errors = []) {
			$data = [
				'errors' => $errors
			];
			$this->render('CreateProductPage', $data);
		}

		public function create() {
			if(isset($_POST['create-product'])) {
				$errors = $this->checkValidateInput();
				if(isset($_FILES['new-image']) && $_FILES['new-image']['error']) {
					$errors['image'] = "File lỗi.";
				}

				if(!empty($errors)) {
					$this->addNew($errors);
				} else {
					$image_link = BASE_URL . '/assets/images/'. $_FILES['new-image']['name'];
	        		Product::create(
	        			User::findByName($_SESSION['username'])->id,
						$_POST['name'],
						$_POST['brand'],
						$_POST['description'],
						$image_link,
						$_POST['price']
					);
					header('location: index.php?controller=product&action=list');
				}
			}
		}

		public function delete() {
			$id = $_GET['id'];
			Product::delete($id);
			header('location: index.php?controller=product&action=list');
		}

		public function checkValidateInput() {
			$errors = [];
			foreach ($_POST as $key => $value) {
				if($value == null) {
					$errors[$key] = "Không được bỏ trống.";
				}
				else if($key == 'price' && !filter_var($value, FILTER_VALIDATE_INT)) {
					$errors[$key] = "Giá bán phải là số nguyên.";
				}
			}
			return $errors;
		}

	}
?>
