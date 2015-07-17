<?php

class Bikefixr_CustomerService_Block_Adminhtml_CustomerService_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('customerserviceGrid');
      $this->setDefaultSort('customerservice_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('customerservice/customerservice')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('customerservice_id', array(
          'header'    => Mage::helper('customerservice')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'customerservice_id',
      ));

      $this->addColumn('cscategory', array(
          'header'    => Mage::helper('customerservice')->__('Category'),
          'align'     =>'left',
		  'width'	  => '400px',
          'index'     => 'cscategory',
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('customerservice')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */
	  
	   $this->addColumn('cstab', array(
          'header'    => Mage::helper('customerservice')->__('Tab Name'),
          'align'     =>'left',
		  'width'	  => '150px',
          'index'     => 'cstab',
		  'type'	  => 'options',
		  'options'    => array(
              1 => 'Order Related Queries',
              2 => 'Any Other Queries',
          ),
      ));

      $this->addColumn('status', array(
          'header'    => Mage::helper('customerservice')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('customerservice')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('customerservice')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('customerservice')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('customerservice')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('customerservice_id');
        $this->getMassactionBlock()->setFormFieldName('customerservice');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('customerservice')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('customerservice')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('customerservice/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('customerservice')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('customerservice')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}