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
/**
 * @copyright  Copyright (c) 2009 AITOC, Inc.
 */
class Aitoc_Aitinstall_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var string
     */
    static protected $_classPath = '/app/code/%s/Aitoc/Aitsys/Model/Aitsys.php';
    
    /**
     * @var string
     */
    static protected $_licensesPath = '/app/code/local/Aitoc/Aitsys/install/*.xml';

    /**
     * @var array
     */
    static protected $_pools = array('community', 'local');

    /**
     * Check whether both new and old installers are installed or only one of them
     * 
     * @return bool
     */
    public function isDoubleInstallerVersion()
    {
        foreach (self::$_pools as $pool) {
            if (!file_exists( BP . sprintf(self::$_classPath, $pool) )) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Check whether old installer contains some licenses
     * 
     * @return bool
     */
    public function isThereAnyLicenses()
    {
        $licenses = glob(BP . self::$_licensesPath);
        return !empty($licenses);
    }
    
    /**
     * @return string
     */
    public function getInfoLink()
    {
        return 'http://www.aitoc.com/media/guides/license_convertation_guide.pdf';
    }
    
    /**
     * @return string
     */
    public function getSupportLink()
    {
        return 'https://www.aitoc.com/en/contacts.html?support';
    }
}