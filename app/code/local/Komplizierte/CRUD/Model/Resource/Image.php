<?php

class Komplizierte_CRUD_Model_Resource_Image extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('komplizierte_crud/image', 'image_id');
    }

}