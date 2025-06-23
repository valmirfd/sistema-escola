<?php

namespace App\Validation;


class AddressValidation
{


    public function getRules(): array
    {
        return [
            'street' => [
                'rules' => "required|max_length[70]",
                'errors' => [
                    'required'     => 'Informe o nome da rua.',
                    'max_length' => 'O nome da rua deve ter no máximo 70 caractéres',
                ],
            ],
            'number' => [
                'rules' => "permit_empty",
            ],
            'city' => [
                'rules' => "required|max_length[70]",
                'errors' => [
                    'required'     => 'Informe o nome da cidade.',
                    'max_length' => 'O nome da cidade deve ter no máximo 70 caractéres',
                ],
            ],
            'district' => [
                'rules' => "required|max_length[70]",
                'errors' => [
                    'required'     => 'Informe o nome do bairro.',
                    'max_length' => 'O nome do bairro deve ter no máximo 70 caractéres',
                ],
            ],
            'postalcode' => [
                'rules' => 'required|exact_length[9]', //32113-110
                'errors' => [
                    'required' => 'Informe o CEP',
                    'exact_length' => 'Exemplo: 00000-000',
                ],
            ],
            'state' => [
                'rules' => "required|max_length[2]",
                'errors' => [
                    'required'     => 'Informe o nome do Estado.',
                    'max_length' => 'O nome do Estado deve ter no máximo 02 caractéres',
                ],
            ],
        ];
    }
}
