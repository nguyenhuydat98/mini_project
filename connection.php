<?php
	class DB {
		protected $conn = null;

		public function getConnection() {
			if(!isset($conn)) {
				$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connect DB Fail: " . mysqli_connect_error());
				mysqli_set_charset($conn, "utf-8");
			}
			return $conn;
		}

		public function closeConnection() {
			if(isset($conn)) {
				mysqli_close($conn);
			}
		}

	}
?>