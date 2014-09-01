<?php

class Komplizierte_CRUD_CrudController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('komplizierte');
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('komplizierte_crud/adminhtml_images_grid')->toHtml()
        );
    }

    public function newAction()
    {
        $this->_title($this->__('Add new Image'));
        $this->loadLayout();
        $this->_setActiveMenu('komplizierte_crud');
        $this->_addBreadcrumb(Mage::helper('komplizierte_crud')->__('Add new Image'), Mage::helper('komplizierte_crud')->__('Add new Image'));
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__('Edit Image'));
        $this->loadLayout();
        $this->_setActiveMenu('komplizierte_crud');
        $this->_addBreadcrumb(Mage::helper('komplizierte_crud')->__('Edit Image'), Mage::helper('komplizierte_crud')->__('Edit Image'));
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try {
                $model = Mage::getModel('komplizierte_crud/image');
                if(isset($_FILES['image_path']['name']) && $_FILES['image_path']['name'] != '') {
                    try {
                        $uploader = new Varien_File_Uploader('image_path');
                        $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(false);
                        $mediaPath  = Mage::getBaseDir('media') . DS . 'komplizierte_crud' . DS;
                        $uploader->save($mediaPath, $_FILES['image_path']['name']);
                        $data['image_path'] = 'komplizierte_crud' . DS.  $_FILES['image_path']['name'];
                    }
                    catch (Exception $e) {
                        Mage::logException($e);
                        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('image_id')));
                    }
                } else {
                    if(isset($data['image_path']['delete']) && $data['image_path']['delete'] == 1)
                        $data['image_path'] = '';
                    else
                        unset($data['image_path']);
                }
                $model->setData($data);
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('komplizierte_crud')->__('Image successfully saved'));
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
            }
        }

        return $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        $imageId = $this->getRequest()->getParam('id', false);

        try {
            Mage::getModel('komplizierte_crud/image')->setId($imageId)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('komplizierte_crud')->__('Image successfully deleted'));

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
        }

        $this->_redirectReferer();
    }

    public function massDeleteAction()
    {
        $imageIds = $this->getRequest()->getParam('image_id');
        if(!is_array($imageIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('komplizierte_crud')->__('Please select Image(s).'));
        } else {
            try {
                $imageModel = Mage::getModel('komplizierte_crud/image');
                foreach ($imageIds as $imageId) {
                    $imageModel->load($imageId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('komplizierte_crud')->__(
                        'Total of %d record(s) were deleted.', count($imageIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}