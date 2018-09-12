<?php

class PagLegal_Custompaymentmethod_Block_Form_Custompaymentmethod extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('paglegal/form/paglegal.phtml');
    }
}

?>