<?php
class ProductFormController extends Controller
{
    public $layout = 'mylayout'; // sử dụng layout custom

    // Lấy danh sách sản phẩm
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';

        // Đếm tổng số sản phẩm
        $totalItemCount = Product::model()->count($criteria);
        // Tạo đối tượng phân trang
        $pages = new CPagination($totalItemCount);
        $pages->pageSize = 10; // Số sản phẩm hiển thị trên mỗi trang
        // Thiết lập các thông số phân trang
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);
        $data = [
            'products' => $products,
            'pages' => $pages
        ];
        $this->render('index', $data);
    }

    // tạo sản phẩm
    public function actionCreate()
    {
        $model = new Product();
        $categories = Category::model()->findAll();
        $categoryList = CHtml::listData($categories, 'id', 'name'); // chuyển mảng các đối tượng thành mảng dữ liệu khóa - giá trị
        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $data = [
            'model' => $model,
            'categoryList' => $categoryList
        ];
        $this->render('create', $data);
    }

    // sửa sản phẩm
    public function actionUpdate()
    {
    }
    // xóa sản phẩm
    public function actionDelete()
    {
    }
}
