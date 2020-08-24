<div class="wrap-create-product-page">
	<h2 class="text-center">Thêm Sản Phẩm Mới</h2>
	<form action="index.php?controller=product&action=create" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Tên sản phẩm</label>
			<input type="text" name="name" class="form-control">
			<div class="text-danger">
				<?php if(isset($errors['name'])) echo $errors['name']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Nhãn hiệu</label>
			<input type="text" name="brand" class="form-control">
			<div class="text-danger">
				<?php if(isset($errors['brand'])) echo $errors['brand']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Mô tả</label>
			<input type="text" name="description" class="form-control">
			<div class="text-danger">
				<?php if(isset($errors['description'])) echo $errors['description']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Hình ảnh</label>
			<input type="file" name="new-image" class="form-control" value="" >
			<div class="text-danger">
				<?php if(isset($errors['image'])) echo $errors['image']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Giá bán</label>
			<input type="text" name="price" class="form-control">
			<div class="text-danger">
				<?php if(isset($errors['price'])) echo $errors['price']; ?>
			</div>
		</div>
		<input type="submit" name="create-product" value="Thêm sản phẩm" class="btn btn-primary">
	</form>
</div>