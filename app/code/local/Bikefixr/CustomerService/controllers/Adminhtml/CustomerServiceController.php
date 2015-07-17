<?php

class Bikefixr_CustomerService_Adminhtml_CustomerServiceController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('customerservice/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			// ->_addContent($this->getLayout()->createBlock('customerservice/adminhtml_customerservice'))
			->renderLayout();
	}

	public function editAction() {
		
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('customerservice/customerservice')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('customerservice_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('customerservice/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('customerservice/adminhtml_customerservice_edit'))
				->_addLeft($this->getLayout()->createBlock('customerservice/adminhtml_customerservice_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customerservice')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		///////////////////////////////////////////////////
			$postdata=$this->getRequest()->getPost();
			
			$children = $postdata['children']['value'];	
		////////////////////////////////////////////
			
		if ($data = $this->getRequest()->getPost()) {
			
			
	  	
	  			
			$model = Mage::getModel('customerservice/customerservice');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
				//->setId($this->getRequest()->getParam('customerservice_id'));
				
			/////////////////////////////////////////////////////////////	
			$model1 = Mage::getModel('customerservice/object');
			$postData = $postdata;
			
			$childrens = $postData['children'];
			unset($postData['children']);
				$model1->setData($postData);
			///////////////////////////////////////////////////////////
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				$model->save();
				
				//////////////////////////////////////////////////////////
				$parentId = $model->getCustomerserviceId();
				
				
				
				
				if (!empty($childrens))
                {
                    foreach ($childrens['delete'] as $_key => $_row)
                    {
                        $delete = (int)$_row;
                        $childrensData = $childrens['value'][$_key];

                        $_childrens = Mage::getModel('customerservice/object')->load((int)$childrensData['id']); // this is the model that stores the URLs data in a second table
						
					
						

                        if ($delete && 0 < (int)$_childrens->getId()) // exists & required to delete
                        {
                            $_childrens->delete();
                            continue;
                        }

                        if (!$delete)
                        {
                            if (0 == (int)$_childrens->getId()) // new item
                            {
                                Mage::getModel('customerservice/object')->setData(array(
                                    'customerservice_id' => $parentId,
                                    'child_title' => $childrensData['child_title'],
                                    'faq_category'   => $childrensData['faq_category'],
                                    'sort_order' => $childrensData['sort-order'],
                                ))->save();
                            }
                            else
                            {
                                $_childrens->addData(array(
                                    'customerservice_id'  => $parentId,
                                    'child_title' => $childrensData['child_title'],
                                    'faq_category'   => $childrensData['faq_category'],
                                    'sort_order' => $childrensData['sort-order'],
                                ))->save();
                            }
                        }
                    }
                }
				
				///////////////////////////////////////////////////////////
				
				
				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customerservice')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customerservice')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('customerservice/customerservice');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $customerserviceIds = $this->getRequest()->getParam('customerservice');
        if(!is_array($customerserviceIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($customerserviceIds as $customerserviceId) {
                    $customerservice = Mage::getModel('customerservice/customerservice')->load($customerserviceId);
                    $customerservice->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($customerserviceIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $customerserviceIds = $this->getRequest()->getParam('customerservice');
        if(!is_array($customerserviceIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($customerserviceIds as $customerserviceId) {
                    $customerservice = Mage::getSingleton('customerservice/customerservice')
                        ->load($customerserviceId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($customerserviceIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'customerservice.csv';
        $content    = $this->getLayout()->createBlock('customerservice/adminhtml_customerservice_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'customerservice.xml';
        $content    = $this->getLayout()->createBlock('customerservice/adminhtml_customerservice_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        
    }
}