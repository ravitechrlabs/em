<?php

class Bikefixr_Homepage_Block_Adminhtml_Homepage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('homepageGrid');
      $this->setDefaultSort('homepage_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('homepage/homepage')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('homepage_id', array(
          'header'    => Mage::helper('homepage')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'homepage_id',
      ));

      $this->addColumn('category_id', array(
          'header'    => Mage::helper('homepage')->__('Category'),
          'align'     =>'left',
          'index'     => 'category_id',
		  'renderer'  => 'Bikefixr_Homepage_Block_Adminhtml_Homepage_Category'
      ));

      $this->addColumn('status', array(
          'header'    => Mage::helper('homepage')->__('Status'),
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
                'header'    =>  Mage::helper('homepage')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('homepage')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('homepage')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('homepage')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('homepage_id');
        $this->getMassactionBlock()->setFormFieldName('homepage');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('homepage')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('homepage')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('homepage/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('homepage')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('homepage')->__('Status'),
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