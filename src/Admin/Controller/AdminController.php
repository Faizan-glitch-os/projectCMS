<?php

namespace App\Admin\Controller;

class AdminController extends AbstractAdminController
{
    public function index()
    {
        $this->render('index', []);
    }
}
