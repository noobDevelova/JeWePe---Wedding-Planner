<?php
class DashboardController extends Controller
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->loadModel('User');
    }

    public function index()
    {
        $metrics = $this->userModel->getDashboardMetrics();
        $this->render('admin/dashboard/index', ['metrics' => $metrics]);
    }
}
