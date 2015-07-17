<?php
/**
 * Layered Navigation Pro
 *
 * @category:    AdjustWare
 * @package:     AdjustWare_Nav
 * @version      2.6.1
 * @license:     lOeKpIO8WfhJjGJEKeiy8x6dx2Qzsqo8LrDiR2B3nm
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
class AdjustWare_Nav_Model_Rewrite_CatalogResourceEavMysql4ProductIndexerEavSource extends Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Indexer_Eav_Source
{
    /** Reindex updated product children also with configurable update
     * 
     * @author ksenevich@aitoc.com
     */
    public function reindexEntities($processIds)
    {
        if (!is_array($processIds)) 
        {
            $processIds = array($processIds);
        }

        $childIds = $this->getRelationsByParent($processIds);
        if ($childIds) 
        {
            $processIds = array_unique(array_merge($processIds, $childIds));
        }

        return parent::reindexEntities($processIds);
    }
}