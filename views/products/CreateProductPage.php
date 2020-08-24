<div class="wrap-create-product-page">
	<h2 class="title">Thêm Sản Phẩm Mới</h2>
	<form action="index.php?controller=product&action=create" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Tên sản phẩm</label>
			<input type="text" name="name" class="form-control">
		</div>
		<div class="form-group">
			<label>Nhãn hiệu</label>
			<input type="text" name="brand" class="form-control">
		</div>
		<div class="form-group">
			<label>Mô tả</label>
			<input type="text" name="description" class="form-control">
		</div>
		<div class="form-group">
			<label>Hình ảnh</label>
			<input type="file" name="new-image" class="form-control" value="" >
		</div>
		<div class="form-group">
			<label>Giá bán</label>
			<input type="text" name="price" class="form-control">
		</div>
		<input type="submit" name="create-product" value="Thêm sản phẩm" class="btn btn-primary">
	</form>
</div>
<style type="text/css">
	.wrap-create-product-page .title {
		margin: 20px auto;
		text-align: center;
	}
</style>