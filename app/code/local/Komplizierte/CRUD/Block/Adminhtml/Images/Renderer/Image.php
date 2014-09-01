<?php

class Komplizierte_CRUD_Block_Adminhtml_Images_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }

    protected function _getValue(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        $value = str_replace("no_selection", "", $value);
        $url = Mage::getBaseUrl('media') . $value;
        $output = "<img src=". $url ." width='60px'/>";

        return $output;
    }
}