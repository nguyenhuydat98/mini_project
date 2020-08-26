<div class="wrap-edit-product-page">
	<h2 class="text-center">Sửa Thông Tin Sản Phẩm</h2>
	<form action="index.php?controller=product&action=edit" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Mã sản phẩm</label>
			<input type="text" name="id" class="form-control" value="<?php echo $product->getId(); ?>" readonly>
		</div>
		<div class="form-group">
			<label>Tên sản phẩm</label>
			<input type="text" name="name" class="form-control" value="<?php echo $product->getName(); ?>">
			<div class="text-danger">
				<?php if(isset($errors['name'])) echo $errors['name']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Nhãn hiệu</label>
			<input type="text" name="brand" class="form-control" value="<?php echo $product->getBrand();?>">
			<div class="text-danger">
				<?php if(isset($errors['brand'])) echo $errors['brand']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Mô tả</label>
			<input type="text" name="description" class="form-control" value="<?php echo $product->getDescription(); ?>" >
			<div class="text-danger">
				<?php if(isset($errors['description'])) echo $errors['description']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Hình ảnh</label>
			<img src="<?php echo $product->getImage();?>">
			<input type="text" name="image" class="form-control" value="<?php echo $product->getImage();?>" readonly>
			<input type="file" name="edit-image" class="form-control" >
			<div class="text-danger">
				<?php if(isset($errors['image'])) echo $errors['image']; ?>
			</div>
		</div>
		<div class="form-group">
			<label>Giá bán</label>
			<input type="text" name="price" class="form-control" value="<?php echo $product->getPrice();?>">
			<div class="text-danger">
				<?php if(isset($errors['price'])) echo $errors['price']; ?>
			</div>
		</div>
		<input type="submit" name="edit-product" value="Lưu thay đổi" class="btn btn-primary">
	</form>
</div>
<style type="text/css">
	.wrap-edit-product-page img {
		width: 100px;
		height: 100px;
	}
</style>