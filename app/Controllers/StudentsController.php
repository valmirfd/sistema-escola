<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\ParentStudent;
use App\Entities\Student;
use App\Models\ParentModel;
use App\Models\StudentModel;
use App\Validation\StudentValidation;
use CodeIgniter\HTTP\RedirectResponse;
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

        //Buscamos o responsável
        $parent = model(ParentModel::class)->getByCode(code: $parentCode);


        $this->dataToView['title'] = 'Cadastrar novo estudante';
        $this->dataToView['student'] = new Student([
            'parent' => $parent
        ]);

        $this->dataToView['errors'] = session()->getFlashdata('errors');

        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    public function create(): RedirectResponse
    {
        $rules = (new StudentValidation)->getRules();

        //O Controller já tem a classe de validação disponível
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        $parentCode = (string) $this->request->getPost('parent_code');

        //Buscamos o responsável
        $parent = model(ParentModel::class)->getByCode(code: $parentCode);

        $student = new Student($this->validator->getValidated());
        $student->parent_id = $parent->id;

        $success = $this->studentModel->save($student);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível salvar o estudante!');
        }

        $createdStudent = $this->studentModel->find($this->studentModel->getInsertID());

        return redirect()
            ->route('students.show', [Encrypt($createdStudent->id)])
            ->with('success', 'Estudante cadastrado com sucesso!');
    }


    public function show($id): string
    {
        $id = (string) Decrypt($id);

        $student = $this->studentModel->getByID(id: $id, withParent: true);

        $this->dataToView['title'] = "Detalhes do estudante";
        $this->dataToView['student'] = $student;

        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    public function edit($id): string
    {
        $id = (string) Decrypt($id);

        $student = $this->studentModel->getByID(id: $id, withParent: true);

        $this->dataToView['title'] = "Editar estudante";
        $this->dataToView['student'] = $student;

        $this->dataToView['errors'] = session()->getFlashdata('errors');

        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }


    public function update(string $id): RedirectResponse
    {
        $id = (string) Decrypt($id);

        $student = $this->studentModel->getByID(id: $id);

        $rules = (new StudentValidation)->getRules($student->id);

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        //populamos o responsável com os dados validados
        $student->fill($this->validator->getValidated());

        $success = $this->studentModel->save($student);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível editar o estudante!');
        }

        return redirect()
            ->route('students.show', [Encrypt($student->id)])
            ->with('success', 'Estudante editado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
         $id = (string) Decrypt($id);

        $student = $this->studentModel->getByID(id: $id);

        $success = $this->studentModel->delete($student->id);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível excluir o estudante!');
        }

        return redirect()->route('students.web')->with('success', 'Estudante excluído com sucesso!');
    }
}
