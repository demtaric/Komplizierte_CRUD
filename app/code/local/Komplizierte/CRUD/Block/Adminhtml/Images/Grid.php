<?php

class Komplizierte_CRUD_Block_Adminhtml_Images_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _construct()
    {
        $this->setId('imagesGrid');
        $this->_controller = 'adminhtml_crud';
        $this->setUseAjax(true);
        $this->setDefaultSort('image_id');
        $this->setDefaultDir('desc');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('komplizierte_crud/image')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('image_id', array(
            'header'        => Mage::helper('komplizierte_crud')->__('ID'),
            'align'         => 'right',
            'width'         => '20px',
            'filter_index'  => 'image_id',
            'index'         => 'image_id'
        ));

        $this->addColumn('title', array(
            'header'        => Mage::helper('komplizierte_crud')->__('Title'),
            'align'         => 'left',
            'filter_index'  => 'title',
            'index'         => 'title',
            'type'          => 'text',
            'width'         => '15%',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('image_path', array(
            'header'        => Mage::helper('komplizierte_crud')->__('Image'),
            'align'         => 'left',
            'index'         => 'image_path',
            'filter'        => false,
            'width'         => '70px',
            'renderer'      => 'komplizierte_crud/adminhtml_images_renderer_image'
        ));

        $this->addColumn('description', array(
            'header'        => Mage::helper('komplizierte_crud')->__('Description'),
            'align'         => 'left',
            'filter_index'  => 'description',
            'index'         => 'description',
            'type'          => 'text',
            'truncate'      => 150,
            'escape'        => true,
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('image_id');
        $this->getMassactionBlock()->setFormFieldName('image_id');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('komplizierte_crud')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('komplizierte_crud')->__('Are you sure?')
        ));
        return $this;
    }

    public function getRowUrl($quote)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $quote->getId(),
        ));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}