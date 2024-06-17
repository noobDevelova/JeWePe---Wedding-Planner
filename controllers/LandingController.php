<?php
class LandingController extends Controller
{
    private $productModel;
    private $orderModel;

    public function __construct()
    {
        $this->productModel = $this->loadModel('Product');
        $this->orderModel = $this->loadModel('Order');
    }
    public function index()
    {
        $products = $this->productModel->getAllProduct();
        $this->render('landing/index', ['products' => $products]);
    }

    public function details($package_code)
    {

        // Mendapatkan data produk
        $product = $this->productModel->getProductByCode($package_code);
        // Merender halaman edit dengan data produk
        $this->render('landing/details', ['product' => $product]);
    }

    public function addOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'package_id' => $_POST['package_id'],
                'customer_name' => $_POST['customer_name'],
                'customer_phone_number' => $_POST['customer_phone_number'],
                'customer_email' => $_POST['customer_email'],
                'wedding_date' => $_POST['wedding_date']
            ];

            $this->orderModel->addOrder($data);

            header('Location: index.php?controller=landing&action=index');
            exit();
        }
    }
}
