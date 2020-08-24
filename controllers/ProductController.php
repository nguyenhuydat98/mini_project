<?php
	require_once 'Controller.php';
	require_once 'models/Product.php';

	class ProductController extends Controller
	{
		public function __construct() {
			$this->folder = 'products';
		}

		public function list() {
			$products = Product::getAll();
			$data = [
				'products' => $products
			];
			$this->render('ListProductPage', $data);
		}

		public function find() {
			if(isset($_GET['id'])) {
				$id = $_GET['id'];
				$product = Product::find($id);
				$data = [
					'product' => $product
				];
				$this->render('EditProductPage', $data);
			}
		}

		public function edit() {
			$image_link  = '';
			if(isset($_POST['edit-product']) && isset($_FILES['edit-image'])) {
				if (!$_FILES['edit-image']['error']) {
    				$image_link = BASE_URL . '/assets/images/'. $_FILES['edit-image']['name'];
				} else {
					$image_link = $_POST['image'];
				}
				Product::edit(
					$_POST['id'],
					$_POST['name'],
					$_POST['brand'],
					$_POST['description'],
					$image_link,
					$_POST['price'],
				);
				header('location: index.php?controller=product&action=list');
			}
		}

		public function addNew() {
			$this->render('CreateProductPage');
		}

		public function create() {
			if(isset($_POST['create-product']) && isset($_FILES['new-image'])) {
				if(!$_FILES['new-image']['error']) {
    				$image_link = BASE_URL . '/assets/images/'. $_FILES['new-image']['name'];
	        		Product::create(
						$_POST['name'],
						$_POST['brand'],
						$_POST['description'],
						$image_link,
						$_POST['price'],
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
	}
?>
