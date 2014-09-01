<?php

class Komplizierte_CRUD_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'komplizierte_crud';
        $this->_mode = 'edit';
        $this->_controller = 'adminhtml';

        $imageId = (int)$this->getRequest()->getParam($this->_objectId);
        $image = Mage::getModel('komplizierte_crud/image')->load($imageId);
        Mage::register('current_image', $image);
    }

    public function getHeaderText()
    {
        $image = Mage::registry('current_image');
        if ($image->getId()) {
            return Mage::helper('komplizierte_crud')->__("Edit Image '%s'", $this->escapeHtml($image->getTitle()));
        } else {
            return Mage::helper('komplizierte_crud')->__("Add new Image");
        }
    }
}