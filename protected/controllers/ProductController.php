<?php
class ProductController extends Controller
{
    // api list product
    public function actionIndex()
    {
        $request = Yii::app()->request; // lấy đối tượng request
        if ($request->getRequestType() != 'GET') {
            throw new CHttpException(400, 'Yêu cầu không hợp lệ');
        }
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 5;
        $offset = ($page - 1) * $limit;
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $search = "where 1";
        if($name){
            $search = "where products.name like '%$name%' ";
        }
        $sql = "SELECT products.id,
                       products.name,
                       products.price,
                       products.qty,
                       products.description,
                       categories.name as category_name
                     FROM products inner join categories
                     on products.category_id = categories.id $search  order by id desc LIMIT $offset,$limit";
        $products = Yii::app()->db->createCommand($sql)->queryAll(); // Viết code thuần lấy data

        $data = [
            'status' => 200,
            'mess' => 'oke',
            'data' => $products
        ];
        echo CJSON::encode($data);
    }

    // api create product
    public function actionCreateProduct()
    {
        $request = Yii::app()->request; // lấy đối tượng request
        if ($request->getRequestType() != 'POST') {
            throw new CHttpException(400, 'Yêu cầu không hợp lệ');
        }
        $name = $request->getParam('name');
        $price = $request->getParam('price');
        $qty = $request->getParam('qty');
        $description = $request->getParam('description');
        $category_id = $request->getParam('category_id');
        // tạo mới
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        $product->qty = $qty;
        $product->description = $description;
        $product->category_id = $category_id;
        if ($product->save()) {
            $data = [
                'status' => 200,
                'mess' => 'oke',
                'data' => $product
            ];
            echo CJSON::encode($data);
        } else {
            // Trả về lỗi nếu không thể tạo sản phẩm
            echo CJSON::encode($product->getErrors());
        }
    }
    // api view product
    public function actionViewProduct($id)
    {
        $request = Yii::app()->request; // lấy đối tượng request
        if ($request->getRequestType() != 'GET') {
            throw new CHttpException(400, 'Yêu cầu không hợp lệ');
        }
        $product = Product::model()->findByPk($id);
        if ($product) {
            $data = [
                'status' => 200,
                'mess' => 'Oke',
                'data' => $product
            ];
            echo CJSON::encode($data);
        } else {
            echo CJSON::encode(['mess' => 'ID không tồn tại']);
        }
    }
    // api update product
    public function actionUpdateProduct($id)
    {
        $request = Yii::app()->request; // lấy đối tượng request
        if ($request->getRequestType() != 'PUT') {
            throw new CHttpException(400, 'Yêu cầu không hợp lệ');
        }
        $name = $request->getParam('name');
        $price = $request->getParam('price');
        $qty = $request->getParam('qty');
        $description = $request->getParam('description');
        $category_id = $request->getParam('category_id');
        $product = Product::model()->findByPk($id);
        if ($product) {
            if ($name)
                $product->name = $name;
            if ($price)
                $product->price = $price;
            if ($qty)
                $product->qty = $qty;
            if ($description)
                $product->description = $description;
            if ($category_id)
                $product->category_id = $category_id;

            $product->save();
            $data = [
                'status' => 200,
                'mess' => 'Oke',
                'data' => $product
            ];
            echo CJSON::encode($data);
        } else {
            echo CJSON::encode(['mess' => 'ID không tồn tại']);
        }
    }
    // api delete product
    public function actionDeleteProduct($id)
    {
        $request = Yii::app()->request; // lấy đối tượng request
        if ($request->getRequestType() != 'DELETE') {   // kiểm tra phương thức hợp lệ hay không
            throw new CHttpException(400, 'Yêu cầu không hợp lệ');
        }
        $product = Product::model()->findByPk($id);
        if ($product) {
            $product->delete();
            $data = [
                'status' => 200,
                'mess' => 'Xóa thành công',
            ];
            echo CJSON::encode($data);
        } else {
            echo CJSON::encode(['mess' => 'ID không tồn tại']);
        }
    }
}
