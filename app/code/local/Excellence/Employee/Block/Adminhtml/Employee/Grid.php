<?php

class Excellence_Employee_Block_Adminhtml_Employee_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('employeeGrid');
      $this->setDefaultSort('id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('employee/employee')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('employee_id', array(
          'header'    => Mage::helper('employee')->__('ID'),
          'align'     =>'right',
          'width'     => '10px',
          'index'     => 'id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('employee')->__('Name'),
          'align'     =>'left',
          'index'     => 'name',
		  'width'	  =>  '50px',
      ));

	  
      $this->addColumn('content', array(
			'header'    => Mage::helper('employee')->__('Description'),
			'width'     => '100px',
			'index'     => 'content',
      ));
	  


		$this->addColumn('Freak', array(
				'header' => Mage::helper('employee')->__('Delete'),
				'width'  => '50px',
				'index'  => 'freak',
				'type'	=> 'button',
				
		)	);
		
	  
      return parent::_prepareColumns();
  }


}