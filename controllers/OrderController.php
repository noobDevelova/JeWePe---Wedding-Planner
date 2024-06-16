<?php
class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('admin/orders/index');
    }
}
