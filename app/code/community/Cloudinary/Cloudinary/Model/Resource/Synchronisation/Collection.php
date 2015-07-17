<?php

use CloudinaryExtension\Migration\SynchronizedMediaRepository;

class Cloudinary_Cloudinary_Model_Resource_Synchronisation_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
    implements SynchronizedMediaRepository, Cloudinary_Cloudinary_Model_Resource_Media_Collection_Interface
{

    protected function _construct()
    {
        $this->_init('cloudinary_cloudinary/synchronisation');
    }

    private function _getResource()
    {
        return parent::getResource();
    }

    protected function _getConnection()
    {
        $resource = $this->_getResource();

        return $resource->getReadConnection();
    }

    protected function _getMainTable()
    {
        $resource = $this->_getResource();

        return $resource->getMainTable();
    }

    public function findUnsynchronisedImages($limit=200)
    {
        $this->getSelect()
             ->joinRight('catalog_product_entity_media_gallery', 'value_id=media_gallery_id', '*')
             ->where('cloudinary_synchronisation_id is null')
             ->limit($limit)
        ;

        return $this->getItems();
    }
}