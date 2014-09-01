<?php

class Komplizierte_CRUD_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $image = Mage::registry('current_image');
        $form = new Varien_Data_Form(array('enctype' => 'multipart/form-data'));
        $fieldset = $form->addFieldset('edit_image', array(
            'legend' => Mage::helper('komplizierte_crud')->__('Image Details')
        ));

        if ($image->getId()) {
            $fieldset->addField('image_id', 'hidden', array(
                'name'      => 'image_id',
                'required'  => true
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('komplizierte_crud')->__('Title'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('image_path', 'image', array(
            'name' => 'image_path',
            'label' => Mage::helper('komplizierte_crud')->__('Image'),
            'required' => false,
        ));

        $fieldset->addField('description', 'editor', array(
            'name'      => 'description',
            'label'     => Mage::helper('komplizierte_crud')->__('Description'),
            'style'     => 'width: 98%; height: 200px;',
            'wysiwyg' => true,
            'required'  => true,
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
        ));

        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setValues($image->getData());
        $this->setForm($form);
    }
}