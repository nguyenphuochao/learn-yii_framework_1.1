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
        $sql = "SELECT products.id,
                       products.name,
                       products.price,
                       products.qty,
                       products.description,
                       categories.name as category_name
                     FROM products inner join categories
                     on products.category_id = categories.id order by id desc LIMIT $offset,$limit";
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
