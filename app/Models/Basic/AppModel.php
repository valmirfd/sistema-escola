<?php

namespace App\Models\Basic;


use CodeIgniter\Model;

abstract class AppModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->setSQLMode();
    }

    protected function setSQLMode(): void
    {
        $this->db->simpleQuery("set session sql_mode=''");
    }

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;

    protected function escapeData(array $data): array
    {
        return esc($data);
    }

    protected function setCode(array $data): array
    {
        if (!isset($data['data'])) {
            return $data;
        }

        do {
            $length = 10;
            $characters = '0123456789';
            $code = '';

            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[random_int(0,  strlen($characters) - 1)];
            }
        } while ($this->where(['code' => $code])->countAllResults() > 0);

        $data['data']['code'] = $code;

        return $data;
    }
}
