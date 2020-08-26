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
			}
			if (User::findByName($_SESSION['username'])->id == $product->getUserId()) {
				$data = [
					'product' => $product,
					'errors'  => $errors
				];
				$this->render('EditProductPage', $data);
			} else {
				die("Không thể sửa sản phẩm này.");
			}
		}

		public function edit() {
			if(isset($_POST['edit-product']) && isset($_FILES['edit-image'])) {
				$errors = $this->checkValidateInput();

				$destination = 'assets/images/' . basename($_FILES['edit-image']['name']);
				$imageFileType = pathinfo($destination, PATHINFO_EXTENSION);
				$types = ['jpg', 'jpeg', 'png'];
				
				if($_FILES['edit-image']['error'] !== 4) {
					if(!getimagesize($_FILES['edit-image']['tmp_name'])) {
						$errors['image'] = "File này không phải là ảnh.";
					}
					else if(!in_array($imageFileType, $types)) {
						$errors['image'] = "Chỉ chấp nhận ảnh có định dạng jpg, jpeg và png.";
					}
					else if(!move_uploaded_file($_FILES['edit-image']['tmp_name'], $destination)) {
						$errors['image'] = "Ảnh chưa được hệ thống lưu lại.";
					}
				}
				
				if(!empty($errors)) {
					$this->find($errors);
				} else {
					if($_FILES['edit-image']['error'] == 4) {
						$image_link = $_POST['image'];
					} else {
						$image_link = BASE_URL . '/assets/images/'. $_FILES['edit-image']['name'];
					}
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
			if(isset($_POST['create-product']) && isset($_FILES['new-image'])) {
				$errors = $this->checkValidateInput();

				$destination = 'assets/images/' . basename($_FILES['new-image']['name']);
				$imageFileType = pathinfo($destination, PATHINFO_EXTENSION);
				$types = ['jpg', 'jpeg', 'png'];

				if($_FILES['new-image']['error']){
					if($_FILES['new-image']['error'] == 4) {
						$errors['image'] = "Chưa chọn file ảnh.";
					} else {
						$errors['image'] = "File lỗi, mã lỗi là " . $_FILES['new-image']['error'];
					}
				}
				else if(!getimagesize($_FILES['new-image']['tmp_name'])) {
					$errors['image'] = "File này không phải là ảnh.";
				}
				else if(!in_array($imageFileType, $types)) {
					$errors['image'] = "Chỉ chấp nhận ảnh có định dạng jpg, jpeg và png.";
				}
				else if(!move_uploaded_file($_FILES['new-image']['tmp_name'], $destination)) {
					$errors['image'] = "Ảnh chưa được hệ thống lưu lại.";
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
			$pattern = "/^[aAàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬbBcCdDđĐeEèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆfFgGhHiIìÌỉỈĩĨíÍịỊjJkKlLmMnNoOòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢpPqQrRsStTuUùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰvVwWxXyYỳỲỷỶỹỸýÝỵỴzZ0-9 .]+$/";
			foreach ($_POST as $key => $value) {
				if($value == null) {
					$errors[$key] = "Không được bỏ trống.";
				}
				else {
					if($key == 'price') {
						if(!is_numeric($value) || (int)$value < 0) {
							$errors[$key] = "Giá bán phải là số nguyên dương.";
						}
					}
					if($key != 'price' && $key != 'image' && !preg_match($pattern, $value)) {
						$errors[$key] = "Không hợp lệ.";
					}
				}
			}
			return $errors;
		}
	}
?>
