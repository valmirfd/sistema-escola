<?php

declare(strict_types=1);

namespace App\Traits;

trait ValidationTrait
{

    /**
     * Valida o CPF informado
     * 
     * @param string $cpf
     * @param string $error
     * @return bool
     */
    public function validaCPF(string|null $cpf = null, string|null &$error = null): bool
    {

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
            $error = 'Por favor digite um CPF válido';
            return false;
        }



        // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $error = 'Por favor digite um CPF válido';
                return false;
            }
        }

        return true;
    }

    /**
     * @see https://gist.github.com/boliveirasilva/c927811ff4a7d43a0e0c
     *
     * @param string $error
     */
    public function validaPhone(string|null $phone = null, string|null &$error = null): bool
    {
        $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

        if (false == preg_match($regex, $phone)) {
            // O número não foi validado.
            $error = 'O telefone deve estar no formato: <b>(XX) 9XXXX-XXXX</b>';

            return false;
        }

        // Telefone válido.
        return true;
    }

    /**
     *
     * @param string $cnpj
     * @param string $error
     * @see inspirado em https://gist.github.com/guisehn/3276302
     * @return bool
     */
    public function validaCnpj(string|null $cnpj = null, string|null &$error = null): bool
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14) {
            $error = 'Por favor digite um CNPJ válido';
            return false;
        }


        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            $error = 'Por favor digite um CNPJ válido';
            return false;
        }


        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            $error = 'Por favor digite um CNPJ válido';
            return false;
        }


        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;


        $resultado = $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);

        if ($resultado === false) {
            $error = 'Por favor digite um CNPJ válido';
            return false;
        } else {
            return true;
        }
    }
}
