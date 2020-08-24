<div class="wrap-list-product-page">
	<h2 class="text-center">Danh Sách Sản Phẩm</h2>
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

					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-<?php echo $product->getId();?>">Xoá</button>
					<div class="modal fade" id="delete-<?php echo $product->getId();?>" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Xóa sản phẩm?</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Bạn chắc chắn muốn xóa sản phẩm có id = <?php echo $product->getId();?> không?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Trở lại</button>
									<form method="POST" action="index.php?controller=product&action=delete&id=<?php echo $product->getId();?>">
										<button type="submit" class="btn btn-danger">Xóa sản phẩm</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<style type="">
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