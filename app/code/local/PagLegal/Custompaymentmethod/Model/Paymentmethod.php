<?php

class PagLegal_Custompaymentmethod_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
    protected $_code  = 'custompaymentmethod';
    protected $_formBlockType = 'custompaymentmethod/form_custompaymentmethod';
    protected $_infoBlockType = 'custompaymentmethod/info_custompaymentmethod';

    public function validaCPF($cpf) 
    {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }

    public function assignData($data)
    {
        $info = $this->getInfoInstance();

        if ($data->getCustomFieldOne())
        {
            $info->setCustomFieldOne($data->getCustomFieldOne());
        }


        return $this;
    }

    public function validate()
    {
        parent::validate();
        $info = $this->getInfoInstance();

        if (!$info->getCustomFieldOne())
        {
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__("CPF é um campo obrigatório.\n");
        }

        if ($errorMsg)
        {
            Mage::throwException($errorMsg);
        }

        return $this;
    }

    public function getOrderPlaceRedirectUrl()
    {
        
    }



}

?>