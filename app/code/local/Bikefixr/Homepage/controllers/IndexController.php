<?php
class Bikefixr_Homepage_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/homepage?id=15 
    	 *  or
    	 * http://site.com/homepage/id/15 	
    	 */
    	/* 
		$homepage_id = $this->getRequest()->getParam('id');

  		if($homepage_id != null && $homepage_id != '')	{
			$homepage = Mage::getModel('homepage/homepage')->load($homepage_id)->getData();
		} else {
			$homepage = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($homepage == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$homepageTable = $resource->getTableName('homepage');
			
			$select = $read->select()
			   ->from($homepageTable,array('homepage_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$homepage = $read->fetchRow($select);
		}
		Mage::register('homepage', $homepage);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}