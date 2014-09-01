<?php

class Komplizierte_CRUD_CrudController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('komplizierte');
        $this->renderLayout();
    }
}