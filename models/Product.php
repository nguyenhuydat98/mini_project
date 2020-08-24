<?php
	class Product
	{
		private $id;
		private $user_id;
		private $name;
		private $brand;
		private $description;
		private $image;
		private $price;

		public function __construct($id, $user_id, $name, $brand, $description, $image, $price) {
			$this->id = $id;
			$this->user_id = $user_id;
			$this->name = $name;
			$this->brand = $brand;
			$this->description = $description;
			$this->image = $image;
			$this->price = $price;
		}

		public function getId() {
			return $this->id;
		}

		public function getUserId() {
			return $this->user_id;
		}

		public function getName() {
			return $this->name;
		}

		public function getBrand() {
			return $this->brand;
		}

		public function getDescription() {
			return $this->description;
		}

		public function getImage() {
			return $this->image;
		}

		public function getPrice() {
			return $this->price;
		}

		public function getAll() {
			$products = [];
			$conn  = DB::getConnection();
			$sql   = "SELECT * FROM products";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)) {
				while($row = mysqli_fetch_array($result)) {
					$products[] = new Product(
						$row['id'],
						$row['user_id'],
						$row['name'],
						$row['brand'],
						$row['description'],
						$row['image'],
						$row['price']
					);
				}
			}
			DB::closeConnection();
			return $products;
		}

		public function find($id) {
			$conn = DB::getConnection();
			$sql  = "SELECT * FROM products WHERE id = '$id'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)) {
				$row = mysqli_fetch_array($result);
				return new Product(
					$row['id'],
					$row['user_id'],
					$row['name'],
					$row['brand'],
					$row['description'],
					$row['image'],
					$row['price']
				);
			}
			DB::closeConnection();
			return null;
		}

		public function edit($id, $name, $brand, $description, $image, $price) {
			$conn = DB::getConnection();
			$sql = "UPDATE products SET
				name = '$name',
				brand = '$brand',
				description = '$description',
				image = '$image',
				price = '$price' WHERE id = '$id'
			";
			$result = mysqli_query($conn, $sql);
			DB::closeConnection();
		}

		public function create($user_id, $name, $brand, $description, $image, $price) {
			$conn = DB::getConnection();
			$sql  = "INSERT INTO products(user_id, name, brand, description, image, price) VALUES(
				'$user_id',
				'$name',
				'$brand',
				'$description',
				'$image',
				'$price'
			)";
			$result = mysqli_query($conn, $sql);
			DB::closeConnection();
		}

		public function delete($id) {
			$conn = DB::getConnection();
			$sql  = "DELETE FROM products WHERE id = '$id'";
			$result = mysqli_query($conn, $sql);
			DB::closeConnection();
		}
	}
?>