<?php
/**
 * FAQ accordion for Magento

 */

/**
 * FAQ accordion for Magento
 *
 * Website: www.hiremagento.com 
 * Email: hiremagento@gmail.com
 */
class HM_Faq_Adminhtml_Faq_CategoryController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Initialization of current view - add's breadcrumps and the current menu status
     * 
     * @return HM_Faq_AdminController
     */
    protected function _initAction()
    {
        $this->_usedModuleName = 'hm_faq';
        
        $this->loadLayout()
                ->_setActiveMenu('cms/faq')
                ->_addBreadcrumb($this->__('CMS'), $this->__('CMS'))
                ->_addBreadcrumb($this->__('FAQ'), $this->__('FAQ'));
        
        return $this;
    }

    /**
     * Displays the FAQ overview grid.
     * 
     */
    public function indexAction()
    {
        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('hm_faq/adminhtml_category'))
                ->renderLayout();
    }
    
    /**
     * Displays the new FAQ item form
     */
    public function newAction()
    {
        $this->_forward('edit');
    }
    
    /**
     * Displays the new FAQ item form or the edit FAQ item form.
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('category_id');
        $model = Mage::getModel('hm_faq/category');
        
        // if current id given -> try to load and edit current FAQ category
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('hm_faq')->__('This FAQ category no longer exists')
                );
                $this->_redirect('*/*/');
                return;
            }
        }
        
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        
        Mage::register('faq_category', $model);
        
        $this->_initAction()
                ->_addBreadcrumb(
                    $id
                        ? Mage::helper('hm_faq')->__('Edit FAQ Category')
                        : Mage::helper('hm_faq')->__('New FAQ Category'),
                    $id
                        ? Mage::helper('hm_faq')->__('Edit FAQ Category')
                        : Mage::helper('hm_faq')->__('New FAQ Category')
                )
                ->_addContent(
                        $this->getLayout()
                                ->createBlock('hm_faq/adminhtml_category_edit')
                                ->setData('action', $this->getUrl('*/*/save'))
                )
                ->_addLeft($this->getLayout()->createBlock('hm_faq/adminhtml_category_edit_tabs'));
        
        $this->renderLayout();
    }

    /**
     * Action that does the actual saving process and redirects back to overview
     */
    public function saveAction()
    {
		$postdata=$this->getRequest()->getPost();
		//print_r($postdata);
//		print_r($postdata['urls']);
		$url=$postdata['urls']['value'];
	        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            
            // init model and set data
            $model = Mage::getModel('hm_faq/category');
            $model->setData($data);
			
			$model1 = Mage::getModel('hm_faq/object');
			$postData = $postdata;
				 
            $urls = $postData['urls'];
		       unset($postData['urls']);
                $model1->setData($postData);
            
            // try to save it
            try {
                // save the data
                $model->save();
		
				/* By ravi */
				//$parentId="1";
				$parentId = $model->getCategoryId();
               // $model1->save();
			    // save urls
//				print_r($urls); die();		
                if (!empty($urls))
                {
                    foreach ($urls['delete'] as $_key => $_row)
                    {
                        $delete = (int)$_row;
                        $urlsData = $urls['value'][$_key];

                        $_urls = Mage::getModel('hm_faq/object')->load((int)$urlsData['id']); // this is the model that stores the URLs data in a second table

                        if ($delete && 0 < (int)$_urls->getId()) // exists & required to delete
                        {
                            $_urls->delete();
                            continue;
                        }

                        if (!$delete)
                        {
                            if (0 == (int)$_urls->getId()) // new item
                            {
                                Mage::getModel('hm_faq/object')->setData(array(
                                    'category_id' => $parentId,
                                    'url_label' => $urlsData['label'],
                                    'url_link'   => $urlsData['url'],
                                    'sort_order' => $urlsData['sort-order'],
                                ))->save();
                            }
                            else
                            {
                                $_urls->addData(array(
                                    'category_id'  => $parentId,
                                    'url_label' => $urlsData['label'],
                                    'url_link'   => $urlsData['url'],
                                    'sort_order' => $urlsData['sort-order'],
                                ))->save();
                            }
                        }
                    }
                }

                // And wrap up the transaction
                //Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
               // [...]

               // $this->_redirect('*/*/');
               // return;
			    // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('hm_faq')->__('FAQ Category was successfully saved')
                );
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array (
                            'category_id' => $model->getId() ));
                    return;															
                }
			 }
            catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addException($e, $e->getMessage());
                // save data in session
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                // redirect to edit form
                $this->_redirect('*/*/edit', array (
                        'category_id' => $this->getRequest()->getParam('category_id') ));
                return;
            }
			
        }
        $this->_redirect('*/*/');
    }

    /**
     * Action that does the actual saving process and redirects back to overview
     */
    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('category_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('hm_faq/category');
                $model->load($id);
                $model->delete();
                
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('hm_faq')->__('FAQ Category was successfully deleted'));
                
                // go to grid
                $this->_redirect('*/*/');
                return;
            
            }
            catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                
                // go back to edit form
                $this->_redirect('*/*/edit', array (
                        'category_id' => $id ));
                return;
            }
        }
        
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('hm_faq')->__('Unable to find a FAQ Category to delete'));
        
        // go to grid
        $this->_redirect('*/*/');
    }
    
    /**
     * Simple access control
     *
     * @return boolean True if user is allowed to edit FAQ
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/cms/faq');
    }
}
