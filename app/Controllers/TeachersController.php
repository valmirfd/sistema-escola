<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Address;
use App\Entities\Teacher;
use App\Models\TeacherModel;
use App\Validation\AddressValidation;
use App\Validation\TeacherValidation;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class TeachersController extends BaseController
{

    private const VIEWS_DIRECTORY = 'Teachers/';

    private TeacherModel $teacherModel;

    public function __construct()
    {
        $this->teacherModel = model(TeacherModel::class);
    }

    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os professores';
        $this->dataToView['teachers'] = $this->teacherModel->orderBy('id', 'DESC')->findAll();

        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    public function new(): string
    {
        $this->dataToView['title'] = 'Cadastrar novo professor';
        $this->dataToView['teacher'] = new Teacher([
            'address' => new Address()
        ]);

        $this->dataToView['errors'] = session()->getFlashdata('errors');

        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    public function create(): RedirectResponse
    {
        $rules = (new TeacherValidation)->getRules();

        //O Controller já tem a classe de validação disponível
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        $teacher = new Teacher($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        $address = new Address($this->validator->getValidated());

        $success = $this->teacherModel->store(teacher: $teacher, address: $address);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível salvar o professor!');
        }


        return redirect()
            ->route('teachers.web')
            ->with('success', 'Professor cadastrado com sucesso!');
    }

    public function show($id): string
    {
        $id = (string) Decrypt($id);

        $teacher = $this->teacherModel->getByID(id: $id, withAddress: true);

        $this->dataToView['title'] = "Detalhes do professor";
        $this->dataToView['teacher'] = $teacher;

        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    public function edit($id): string
    {
        $id = (string) Decrypt($id);

        $teacher = $this->teacherModel->getByID(id: $id, withAddress: true);

        $this->dataToView['title'] = "Editar professor";
        $this->dataToView['teacher'] = $teacher;
        $this->dataToView['errors'] = session()->getFlashdata('errors');

        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    public function update(string $id): RedirectResponse
    {
        $id = (string) Decrypt($id);

        $teacher = $this->teacherModel->getByID(id: $id, withAddress: true);

        $rules = (new TeacherValidation)->getRules($teacher->id);

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        //populamos o responsável com os dados validados
        $teacher->fill($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        //recuperamos o endereço associado
        $address = $teacher->address;

        $address->fill($this->validator->getValidated());

        $success = $this->teacherModel->store(teacher: $teacher, address: $address);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível editar o professor!');
        }

        return redirect()
            ->route('teachers.show', [Encrypt($teacher->id)])
            ->with('success', 'Professor editado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $id = (string) Decrypt($id);

        $teacher = $this->teacherModel->getByID(id: $id);

        $success = $this->teacherModel->destroy($teacher);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível excluir o professor!');
        }

        return redirect()->route('teachers.web')->with('success', 'Professor excluído com sucesso!');
    }
}
