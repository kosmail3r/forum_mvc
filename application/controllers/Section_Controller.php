<?php
include_once 'application/core/Controller.php';

class Section_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->model = new Section_Model();
    }

    public function index_action()
    {
        $data = $this->model->getAll();
        $this->view->generate('header_view.php','sections_view.php', 'template_view.php', $data);
    }


}