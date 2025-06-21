<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Address;
use App\Entities\ParentStudent;
use CodeIgniter\HTTP\ResponseInterface;

class ParentsController extends BaseController
{
    private const VIEWS_DIRECTORY = 'Parents/';

    public function index(): string
    {
        $this->dataToView['title'] = 'Gerenciar os responsáveis';

        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

     public function new(): string
    {
        $this->dataToView['title'] = 'Cadastrar novo responsável';
        $this->dataToView['parent'] = new ParentStudent([
            'address' => new Address()
        ]);

        
        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }
}
