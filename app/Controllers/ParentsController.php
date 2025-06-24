<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Address;
use App\Entities\ParentStudent;
use App\Models\ParentModel;
use App\Validation\AddressValidation;
use App\Validation\ParentValidation;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class ParentsController extends BaseController
{

    private const VIEWS_DIRECTORY = 'Parents/';

    private ParentModel $parentModel;

    public function __construct()
    {
        $this->parentModel = model(ParentModel::class);
    }

    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os responsáveis';
        $this->dataToView['parents'] = $this->parentModel->orderBy('id', 'DESC')->findAll();

        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    public function new(): string
    {
        $this->dataToView['title'] = 'Cadastrar novo responsável';
        $this->dataToView['parent'] = new ParentStudent([
            'address' => new Address()
        ]);

        $this->dataToView['errors'] = session()->getFlashdata('errors');

        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    public function create(): RedirectResponse
    {
        $rules = (new ParentValidation)->getRules();

        //O Controller já tem a classe de validação disponível
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        $parent = new ParentStudent($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        $address = new Address($this->validator->getValidated());

        $success = $this->parentModel->store(parent: $parent, address: $address);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível salvar o responsável!');
        }

        return redirect()
            ->route('parents.web')
            ->with('success', 'Responsável cadastrado com sucesso!');
    }

    public function show($id): string
    {
        $id = (string) Decrypt($id);

        $parent = $this->parentModel->getByID(id: $id, withAddress: true);

        $this->dataToView['title'] = "Detalhes do responsável";
        $this->dataToView['parent'] = $parent;

        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    public function edit($id): string
    {
        $id = (string) Decrypt($id);

        $parent = $this->parentModel->getByID(id: $id, withAddress: true);

        $this->dataToView['title'] = "Editar responsável";
        $this->dataToView['parent'] = $parent;
        $this->dataToView['errors'] = session()->getFlashdata('errors');

        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    public function update(string $id): RedirectResponse
    {
        $id = (string) Decrypt($id);

        $parent = $this->parentModel->getByID(id: $id, withAddress: true);

        $rules = (new ParentValidation)->getRules($parent->id);

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        //populamos o responsável com os dados validados
        $parent->fill($this->validator->getValidated());

        $rules = (new AddressValidation)->getRules();

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput() // Para manter os dados no input
                ->with('errors', $this->validator->getErrors());
        }

        //recuperamos o endereço associado
        $address = $parent->address;

        $address->fill($this->validator->getValidated());

        $success = $this->parentModel->store(parent: $parent, address: $address);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível editar o responsável!');
        }

        return redirect()
            ->route('parents.show', [Encrypt($parent->id)])
            ->with('success', 'Responsável editado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $id = (string) Decrypt($id);

        $parent = $this->parentModel->getByID(id: $id);

        $success = $this->parentModel->destroy($parent);

        if (!$success) {
            return redirect()
                ->back()
                ->with('danger', 'Oppss! Não foi possível excluir o responsável!');
        }

        return redirect()->route('parents.web')->with('success', 'Responsável excluído com sucesso!');
    }
}
