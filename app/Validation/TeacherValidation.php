<?php

namespace App\Validation;

use App\Traits\ValidationTrait;

class TeacherValidation
{
    use ValidationTrait;

    public function getRules(?int $id = null): array
    {
        return [
            'id' => [
                'rules' => 'permit_empty|is_natural_no_zero'
            ],
            'name' => [
                'rules' => 'required|max_length[128]|min_length[3]',
                'errors' => [
                    'required' => 'Informe o nome completo',
                    'max_length' => 'O nome não pode ter mais que 128 caractéres',
                    'min_length' => 'O nome não pode ter menos que 3 caractéres',
                ],
            ],
            'cpf' => [
                'rules' => "required|exact_length[14]|validaCPF|is_unique[teachers.cpf,id,{$id}]",
                'errors' => [
                    'required'     => 'Informe o CPF válido.',
                    'exact_length' => 'Exemplo: 000.000.000-00',
                    'is_unique'   => 'CPF já cadastrado no sistema.',
                ],
            ],
            'email' => [
                'rules' => "required|max_length[128]|valid_email|is_unique[teachers.email,id,{$id}]",
                'errors' => [
                    'required'     => 'Informe o email válido.',
                    'max_length' => 'O email não pode ter mais que 128 caractéres',
                    'is_unique'   => 'CPF já cadastrado no sistema.',
                ],
            ],
            'phone' => [
                'rules' => "required|exact_length[15]|validaPhone|is_unique[teachers.phone,id,{$id}]",
                'errors' => [
                    'required'     => 'Informe o celular.',
                    'exact_length' => 'Exemplo: (99) 99999-9999',
                    'is_unique'   => 'Celular já cadastrado no sistema.',
                ],
            ],
        ];
    }
}
