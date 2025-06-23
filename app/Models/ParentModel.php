<?php

namespace App\Models;

use App\Entities\Address;
use App\Entities\ParentStudent;
use App\Models\Basic\AppModel;


class ParentModel extends AppModel
{
    protected $table            = 'parents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = ParentStudent::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'address_id',
        'name',
        'email',
        'cpf',
        'phone',
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeData', 'setCode'];
    protected $beforeUpdate   = ['escapeData'];

    public function store(ParentStudent $parent, Address $address): bool
    {
        try {

            //Iniciamos a transaction [Tudo é executado ou nada será executado]
            $this->db->transException(true)->transStart();

            model(AddressModel::class)->save($address);
            $parent->address_id = $address->id ?? model(AddressModel::class)->getInsertID();

            $this->save($parent);

            //Fim da transaction
            $this->db->transComplete();

            //Retornamos o status da transaction: true/false
            return $this->db->transStatus();
        } catch (\Throwable $th) {
            log_message('error', "Erro ao salvar o responsável: {$th->getMessage()}");
            return false;
        }
    }
}
