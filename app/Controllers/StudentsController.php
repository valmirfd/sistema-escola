<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\HTTP\ResponseInterface;

class StudentsController extends BaseController
{
    private const VIEWS_DIRECTORY = 'Students/';

    private StudentModel $studentModel;

    public function __construct()
    {
        $this->studentModel = model(StudentModel::class);
    }

    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os estudantes';
        $this->dataToView['students'] = $this->studentModel->orderBy('id', 'DESC')->findAll();

        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }
}
