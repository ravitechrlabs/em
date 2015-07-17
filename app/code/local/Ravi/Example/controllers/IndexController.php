<?php
class Ravi_Example_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/example?id=15 
    	 *  or
    	 * http://site.com/example/id/15 	
    	 */
    	/* 
		$example_id = $this->getRequest()->getParam('id');

  		if($example_id != null && $example_id != '')	{
			$example = Mage::getModel('example/example')->load($example_id)->getData();
		} else {
			$example = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($example == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$exampleTable = $resource->getTableName('example');
			
			$select = $read->select()
			   ->from($exampleTable,array('example_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$example = $read->fetchRow($select);
		}
		Mage::register('example', $example);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}