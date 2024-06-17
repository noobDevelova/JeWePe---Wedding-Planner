<?php
class LaporanController extends Controller
{
    private $orderModel;
    public function __construct()
    {
        parent::__construct();
        $this->orderModel = $this->loadModel('Order');
    }

    public function index()
    {

        $report = $this->orderModel->getOrderReport();
        $this->render('admin/laporan/index', ['report' => $report]);
    }
}
