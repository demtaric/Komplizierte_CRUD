<?php

class Komplizierte_CRUD_Block_Adminhtml_Images extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        $this->_addButtonLabel = Mage::helper('komplizierte_crud')->__('Add New Image');

        $this->_blockGroup = 'komplizierte_crud';
        $this->_controller = 'adminhtml_images';
        $this->_headerText = Mage::helper('komplizierte_crud')->__('Images');
    }
}