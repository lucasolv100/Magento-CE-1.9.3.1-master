<?php

class PagLegal_Custompaymentmethod_Block_Info_Custompaymentmethod extends Mage_Payment_Block_Info
{
    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation)
        {
            return $this->_paymentSpecificInformation;
        }

        $data = array();
        if ($this->getInfo()->getCustomFieldOne())
        {
            $data[Mage::helper('payment')->__('CPF')] = $this->getInfo()->getCustomFieldOne();
        }

        $transport = parent::_prepareSpecificInformation($transport);

        return $transport->setData(array_merge($data, $transport->getData()));
    }
}

?>