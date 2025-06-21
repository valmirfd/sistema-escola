<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Address extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];

    public function getFullAddress(): string
    {
        return sprintf(
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            $this->street,
            $this->number ?? 'N/A',
            $this->district,
            $this->city,
            $this->state,
            $this->postalcode
        );
    }
}
