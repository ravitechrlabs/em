<?php

class Bikefixr_Homepage_Adminhtml_HomepageController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('homepage/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('homepage/homepage')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('homepage_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('homepage/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('homepage/adminhtml_homepage_edit'))
				->_addLeft($this->getLayout()->createBlock('homepage/adminhtml_homepage_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('homepage')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			
			if(isset($_FILES['categoryicon']['name']) && $_FILES['categoryicon']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('categoryicon');
					
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					
					
					
					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);
							
					$uploader->setAllowCreateFolders(true);
					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS . 'homepage' . DS;
					$uploader->save($path, $_FILES['categoryicon']['name'] );
					
				} catch (Exception $e) {
		      
		        }
	        
		        //this way the name is saved in DB
	  			$data['categoryicon'] = $_FILES['categoryicon']['name'];
			}
			/////////////////////By Ravi//////////////////////
			else{
				
					if(isset($data['categoryicon']['delete']) && $data['categoryicon']['delete'] == 1)
						$data['image_main'] = '';
					else
						unset($data['categoryicon']);
			}
			
		///////////////////////////////////////////////////	
		
		
		
		//////////////////////////By Ravi /////////////////////////
		if(isset($_FILES['bannerimage']['name']) && $_FILES['bannerimage']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('bannerimage');
					
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					
					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);
					//To create a folder automatically		
					$uploader->setAllowCreateFolders(true);
					// We set media as the upload dir
					//We add any folder inside media folder like shown below
					$path = Mage::getBaseDir('media') . DS . 'homepage' . DS;
					$uploader->save($path, $_FILES['bannerimage']['name'] );
					
				} catch (Exception $e) {
		      
		        }
	        
		        //this way the name is saved in DB
	  			$data['bannerimage'] = $_FILES['bannerimage']['name'];
			}
	
			else{
				
					if(isset($data['bannerimage']['delete']) && $data['bannerimage']['delete'] == 1)
						$data['image_main'] = '';
					else
						unset($data['bannerimage']);
			}
		///////////////////////////////////////////////////
		
		
		//////////////////////////By Ravi/////////////////
		
		/////////////////////////////////////////////////
		
		
		
		
		
		
		///////////////////////// By Ravi //////////////////////////
	  		foreach ($data as $key => $value)
    {
        if (is_array($value))
        {
            $data[$key] = implode(',',$this->getRequest()->getParam($key)); 
        }
    } 	
	  		//////////////////////////////////////////////////	
			$model = Mage::getModel('homepage/homepage');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('homepage')->__('Item was successfully saved'));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('homepage')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('homepage/homepage');
				 
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
        $homepageIds = $this->getRequest()->getParam('homepage');
        if(!is_array($homepageIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($homepageIds as $homepageId) {
                    $homepage = Mage::getModel('homepage/homepage')->load($homepageId);
                    $homepage->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($homepageIds)
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
        $homepageIds = $this->getRequest()->getParam('homepage');
        if(!is_array($homepageIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($homepageIds as $homepageId) {
                    $homepage = Mage::getSingleton('homepage/homepage')
                        ->load($homepageId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($homepageIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'homepage.csv';
        $content    = $this->getLayout()->createBlock('homepage/adminhtml_homepage_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'homepage.xml';
        $content    = $this->getLayout()->createBlock('homepage/adminhtml_homepage_grid')
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
        die;
    }
	
	public function subcategoryAction()
	{
		$categoryId = $this->getRequest()->getParam('categoryid');
		$categoryModel = Mage::getSingleton('catalog/category');
		
		$categories = $categoryModel->load($categoryId)->getChildren();
		$options = array();
		foreach(explode(",", $categories) as $category){
			$categoryData = $categoryModel->load($category);
			if(preg_match('/catego/i', $categoryData->getName())){ //fetching sub-categories
				$subCategories = $categoryData->getChildren();
				$options['sub_category'] = '';
				foreach(explode(",", $subCategories) as $sub_category){
					$sub_categoryData = $categoryModel->load($sub_category);
					$options['sub_category'] .= "<option value=".$sub_categoryData->getId().">".$sub_categoryData->getName()."</option>";
				}
			}elseif(preg_match('/brand/i', $categoryData->getName())){ //fetching brands
				$subCategories = $categoryData->getChildren();
				$options['brand'] = '';
				foreach(explode(",", $subCategories) as $sub_category){
					$sub_categoryData = $categoryModel->load($sub_category);
					$options['brand'] .= "<option value=".$sub_categoryData->getId().">".$sub_categoryData->getName()."</option>";
				}
			}
		}
		echo Mage::helper('core')->jsonEncode($options);
	}
}