<?php

class Bikefixr_Homepage_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function toOptionArray($addEmpty =true)
    {
        $options = array();
		$options[0] =  '- Please Select -';
        foreach($this->load_tree() as $category){
            $options[$category['value']]=  $category['label'];
        }
        return $options;
    }
    
    public function buildCategoriesMultiselectValues(Varien_Data_Tree_Node $node, $values, $level =0)
    {
        $level++;
		if($level == 3){ //we have to show only third level category in drop down
			$values[$node->getId()]['value'] = $node->getId();
			$values[$node->getId()]['label'] = $node->getName();
		}
		foreach($node->getChildren() as $child)
		{
			$values = $this->buildCategoriesMultiselectValues($child, $values, $level);
		}
        return $values;
    }
    
    public function load_tree()
    {
        $store =Mage::app()->getFrontController()->getRequest()->getParam('store',0);
        $parentId = $store ?Mage::app()->getStore($store)->getRootCategoryId():1;  // Current store root category
        
        $tree =Mage::getResourceSingleton('catalog/category_tree')->load();
        $root = $tree->getNodeById($parentId);
    
        if($root && $root->getId()==1)
        {
            $root->setName(Mage::helper('catalog')->__('Root'));
        }
    
        $collection =Mage::getModel('catalog/category')->getCollection()
			->setStoreId($store)
			->addAttributeToSelect('name')
			->addAttributeToSelect('is_active');
    
        $tree->addCollectionData($collection,true);
    
        return $this->buildCategoriesMultiselectValues($root, array());
    }
}