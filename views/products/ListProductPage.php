<div class="wrap-list-product-page">
	<h2 class="title">Danh Sách Sản Phẩm</h2>
	<a href="index.php?controller=product&action=addNew" class="btn btn-primary" id="btn-create">Thêm sản phẩm mới</a>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Tên sản phẩm</th>
				<th>Nhãn hiệu</th>
				<th>Mô tả</th>
				<th>Hình ảnh</th>
				<th>Giá bán</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $product) { ?>
			<tr>
				<td><?php echo $product->getId(); ?></td>
				<td><?php echo $product->getName(); ?></td>
				<td><?php echo $product->getBrand(); ?></td>
				<td><?php echo $product->getDescription(); ?></td>
				<td>
					<img src="<?php echo $product->getImage(); ?>" alt="img-product">
				</td>
				<td><?php echo $product->getPrice(); ?></td>
				<td class="custom">
					<a href="index.php?controller=product&action=find&id=<?php echo $product->getId();?>" class="btn btn-primary">Sửa</a>
					<a href="index.php?controller=product&action=delete&id=<?php echo $product->getId();?>" class="btn btn-danger">Xóa</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<style type="">
	.wrap-list-product-page .title {
		margin: 20px auto;
		text-align: center;
	}
	.wrap-list-product-page #btn-create {
		margin-bottom: 20px;
		text-align: right;
	}
	.wrap-list-product-page table td img {
		width: 120px;
		height: 120px;
	}
	.wrap-list-product-page table .custom {
		width: 145px;
	}
</style>