<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ParentStudent extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];
}
