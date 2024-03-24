<div class="main">
    <h2>List Product</h2>
    <div class="create-product"><a href="http://localhost/learn-yii_framework_1.1/index.php/productform/create" class="btn btn-success mb-2">Add</a></div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td scope="row"><?php echo $i++; ?></td>
                    <th><?php echo $product->id; ?></th>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $product->price; ?></td>
                    <td><?php echo $product->qty; ?></td>
                    <th><?php echo $product->category->name; ?></th>
                    <th>
                        <a href="#" class="btn btn-warning">Update</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Hiển thị phân trang -->
    <?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));
    ?>
</div>