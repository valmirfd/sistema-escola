<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\ParentStudent;
use App\Entities\Student;
use App\Models\ParentModel;
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

    public function new(): string
    {
        $parentCode = esc($this->request->getGet('parent_code'));

        $parent = model(ParentModel::class)->getByCode(code: $parentCode);


        $this->dataToView['title'] = 'Cadastrar novo estudante';
        $this->dataToView['student'] = new Student([
            'parent' => $parent
        ]);

        $this->dataToView['errors'] = session()->getFlashdata('errors');

        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }
}
