<?php
	class Controller {
		protected $folder;

		public function render($file, $data = []) {
			$views_path = 'views/' . $this->folder . '/' . $file . '.php';
			if(is_file($views_path)) {
				extract($data);
				ob_start();
				require_once $views_path;
				$content = ob_get_clean();
				require_once 'views/layouts/application.php';
			}
		}
	}
?>