<?php
class OrderController extends Controller
{
    private $orderModel;
    public function __construct()
    {
        parent::__construct();
        $this->orderModel = $this->loadModel('Order');
    }

    public function index()
    {
        $orders = $this->orderModel->getOrderData();
        $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        unset($_SESSION['message']);
        $this->render('admin/orders/index', ['orders' => $orders, 'message' => $message]);
    }

    public function approveOrder($order_code)
    {
        if (!empty($order_code)) {
            $this->orderModel->approveOrder($order_code);
            $_SESSION['message'] = 'Order Diterima.';
            header('Location: index.php?controller=order&action=index');
            exit();
        } else {
            $_SESSION['message'] = 'Data tidak ditemukan.';
            header('Location: index.php?controller=order&action=index');
            exit();
        }
    }

    public function cancelOrder($order_code)
    {
        if (!empty($order_code)) {
            $this->orderModel->cancelOrder($order_code);
            $_SESSION['message'] = 'Order Dibatalkan.';
            header('Location: index.php?controller=order&action=index');
            exit();
        } else {
            $_SESSION['message'] = 'Data tidak ditemukan.';
            header('Location: index.php?controller=order&action=index');
            exit();
        }
    }
    public function deleteOrder($order_code)
    {
        if (!empty($order_code)) {
            $this->orderModel->deleteOrder($order_code);
            $_SESSION['message'] = 'Order Dihapus.';
            header('Location: index.php?controller=order&action=index');
            exit();
        } else {
            $_SESSION['message'] = 'Data tidak ditemukan.';
            header('Location: index.php?controller=order&action=index');
            exit();
        }
    }
}
