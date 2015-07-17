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
class AdjustWare_Nav_Block_Catalog_Layer_Filter_Attribute extends Mage_Catalog_Block_Layer_Filter_Attribute
{
    protected $_featuredItems = array();
    protected $_optionUses    = array();

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('adjnav/filter/attribute.phtml');
        $this->_filterModelName = 'adjnav/catalog_layer_filter_attribute';
    }

    public function getVar(){
        return $this->_filter->getRequestVar();
    }

    public function getClearUrl()
    {
        $url = '';
        $query = Mage::helper('adjnav')->getParams();
        if (!empty($query[$this->getVar()])){
            $query[$this->getVar()] = null;
            $url = Mage::getUrl('*/*/*', array(
                '_use_rewrite' => true,
                '_query'       => $query,
             ));
        }

        return $url;
    }

    public function getAttributeDisplayType()
    {
        return $this->_filter->getAttributeModel()->getAdjnavDisplayType();
    }

    public function getHtmlId($item)
    {
        return $this->getVar() . '-' . $item->getValueString();
    }

    public function isSelected($item)
    {
        $ids = (array)$this->_filter->getActiveState();
        return in_array($item->getValueString(), $ids);
    }

    public function getItemsArray()
    {

        $items                = array();
        $this->_featuredItems = array();
        $featuredValuesLimitDisabled = false;
        $featuredValuesLimit  = $this->helper('adjnav/featured')->getFeaturedValuesLimit();
        if($featuredValuesLimit == 0) {
            $featuredValuesLimitDisabled = true;
        }
        $iconsOnly            = (2 == $this->getColumnsNum());
        $baseUrl              = Mage::app()->getStore()->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $hideLinks            = Mage::getStoreConfig('design/adjnav/remove_links');

        if(version_compare(Mage::getVersion(), '1.9.1.0', '>=')
            && Mage::helper('configurableswatches')->isEnabled())
        {
            $isColorSwatch = Mage::helper('configurableswatches')->attrIsSwatchType($this->getAttributeModel());
            if(!empty($isColorSwatch))
            {
                $iconsOnly = true;

                $_dimHelper = Mage::helper('configurableswatches/swatchdimensions');
                $this->setSwatchInnerWidth($_dimHelper->getInnerWidth(Mage_ConfigurableSwatches_Helper_Swatchdimensions::AREA_LAYER));
                $this->setSwatchInnerHeight($_dimHelper->getInnerHeight(Mage_ConfigurableSwatches_Helper_Swatchdimensions::AREA_LAYER));
                $this->setSwatchOuterWidth($_dimHelper->getOuterWidth(Mage_ConfigurableSwatches_Helper_Swatchdimensions::AREA_LAYER));
                $this->setSwatchOuterHeight($_dimHelper->getOuterHeight(Mage_ConfigurableSwatches_Helper_Swatchdimensions::AREA_LAYER));
            }
        }

        foreach ($this->getItems() as $_item)
        {
			$htmlParams = 'id="' . $this->getHtmlId($_item) . '" ';

			$href = Mage::helper('adjnav')->trimBaseUrl();

			if (!$hideLinks)
			{
				$href .= $this->getRequestPath();

				$params = Mage::helper('adjnav')->getParams();

				if (isset($params[$this->getVar()]))
				{
					$values = explode('-', $params[$this->getVar()]);
					$valueKey = array_search($_item->getValueString(), $values);
                    if (false === $valueKey)
                    {
                        $values[] = $_item->getValueString();
                    }
                    else
                    {
                        unset($values[$valueKey]);
                    }
					$params[$this->getVar()] = implode('-', array_unique($values));
				}
				else
				{
					$params[$this->getVar()] = $_item->getValueString();
				}

				if ($params = http_build_query($params))
				{
					$href .= '?' . $params;
				}
			}

			$htmlParams .= 'href="' . $href . '" ';
            $htmlParams .= 'class="adj-nav-attribute ';
            if ('default' == $this->getAttributeDisplayType()) {
                $htmlParams .= ($featuredValuesLimitDisabled || $featuredValuesLimit > 0 ? '' : 'other ' );
            }
            $htmlParams .= ($this->isSelected($_item) ? 'adj-nav-attribute-selected' : '') . '" ';

            $icon = '';
            if ($this->getVisualizationType() > 0){
                //$icon = '<img border="0" alt="'.$this->escapeHtml($_item->getLabel()).'" src="'.$baseUrl.'icons/'.$_item->getIcon().'" />';
                $classes = $this->isSelected($_item) ? 'adj-nav-icon-selected ' : '';
                $classes .= 'adj-nav-icon-span';
                $icon = $this->getAttributeFilterItemsIcon($_item, $this, $classes);
            }
            elseif(!empty($isColorSwatch))
            {
                $icon = $this->getAttributeFilterItemsIconFromMagento($_item);
                $htmlParams .= ' style="height: 30px;"';
            }

            $qty = '';
            if (!$this->getHideQty() && (!$iconsOnly || !empty($isColorSwatch)))
            {
                $qty =  '(' .  $_item->getCount() .')';
            }

            $label = $_item->getLabel();
            if ($iconsOnly && !empty($icon)){
                $label = '';
            }
            $label = $icon .' '. $label;

            if(version_compare(Mage::getVersion(), '1.9.0.0', '>='))
            {
                $items[]        = ($_item->getCount() > 0) ? '<a onclick="return false;" '.$htmlParams.'>'.$label.' <span class="count">'.$qty.'</span></a>' : '<span class="adj-nav-attr-disabled">'.$label.' <span class="count">'.$qty.'</span></span>';
            }
            else
            {
                $items[]        = ($_item->getCount() > 0) ? '<a onclick="return false;" '.$htmlParams.'>'.$label.'</a>'.$qty : '<span class="adj-nav-attr-disabled">'.$label.'</span>'.$qty;
            }
            $isFeaturedItem = false;
            if (($featuredValuesLimit > 0) || $featuredValuesLimitDisabled)
            {
                $isFeaturedItem = true;
                if (!$featuredValuesLimitDisabled)
                {
                    $featuredValuesLimit--;
                }
            }
            $this->_featuredItems[] = $isFeaturedItem;
        }

        return $items;
    }


    public function getAttributeFilterItemsIconFromMagento($_item)
    {
        $_swatchInnerWidth = $this->getSwatchInnerWidth();
        $_swatchInnerHeight = $this->getSwatchInnerHeight();
        $_swatchOuterWidth = $this->getSwatchOuterWidth();
        $_swatchOuterHeight = $this->getSwatchOuterHeight();

        $_label = $_item->getLabel();
        $_swatchUrl = Mage::helper('configurableswatches/productimg')->getGlobalSwatchUrl($_item, $_label, $_swatchInnerWidth, $_swatchInnerHeight);
        $_hasImage = (!empty($_swatchUrl));
        $_linkCss = 'height:' . $_swatchOuterHeight . 'px; ' . ((!$_hasImage) ? 'min-' : '') . 'width:' . $_swatchOuterWidth . 'px;';

        $icon = '<span class="swatch-label"';
        if ($_hasImage)
        {
            $icon .= ' style="' . $_linkCss . '">
            <img src="'.$_swatchUrl.'" alt="'.$_label.'" title="'.$_label.'" width="'.$_swatchInnerWidth.'" height="'.$_swatchInnerHeight.'" />';
        }
        else
        {
            $icon .= ' style="padding:0 5px;">'.$_label;
        }
        $icon .= '</span>';

        return $icon;
    }

    /**
     * @param $_item
     * @param $filterAttribute
     * @param $classes
     * @return string
     */
    public function getAttributeFilterItemsIcon($_item, $filterAttribute, $classes)
    {
        $qty = ($filterAttribute->getShowQty()) ? ' (' .  $_item->getCount() .')' : '';
        $icon = '';

        switch($filterAttribute->getVisualizationType()) {
            case AdjustWare_Icon_Helper_Data::VISUALIZATION_TYPE_IMAGES:
                if($_item->getIcon())
                {
                    $icon = '<img border="0" class="'.$classes.'" alt="'.$this->escapeHtml($_item->getLabel()).$qty.'" title="'.$this->escapeHtml($_item->getLabel()).$qty.'" src="'. Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'icons/l_'.$_item->getIcon().'" />';
                }
                break;
            case AdjustWare_Icon_Helper_Data::VISUALIZATION_TYPE_COLOR:
                if($_item->getColor())
                {
                    $htmlParams = 'class="adjcolor' . $filterAttribute->getColorIconType() .' adjdef adjsmall '.$classes.'"' ;
                    $icon = '<span '. $htmlParams.' title="'.$this->escapeHtml($_item->getLabel()).$qty.'" style="background:'.$_item->getColor().'"></span>';
                }
                break;
            case AdjustWare_Icon_Helper_Data::VISUALIZATION_TYPE_ICONS:
                $htmlParams =  'class="icons-'.$filterAttribute->getId().' icon' . $filterAttribute->getIconType() . ' adjdef adjsmall '.$classes.'"';
                $text = '&nbsp;' . $_item->getLabel() . '&nbsp;';
                $icon = '<span '.$htmlParams.' title="'.$this->escapeHtml($_item->getLabel()).$qty.'">'.$text.'</span>';

                break;
        }

        return $icon;
    }

    /**
     * Will return GET part of the request
     *
     *	@return string
     */
    public function getRequestPath()
    {
    	$request = Mage::app()->getRequest();

    	$requestPath = '';

    	if ($request->isXmlHttpRequest())
    	{
    		$requestPath = Mage::getSingleton('core/session')->getRequestPath();
    	}
    	else
    	{
    		Mage::getSingleton('core/session')->setRequestPath($requestPath = $request->getRequestString());
    	}

    	return $this->escapeHtml($requestPath);
    }

    public function getFeaturedItemStyle($key)
    {
        if (!empty($this->_featuredItems[$key]))
        {
            return 'attr-val-featured';
        }

        return 'attr-val-other';
    }

    public function isShowMoreButton()
    {
        $featuredValuesLimit = $this->helper('adjnav/featured')->getFeaturedValuesLimit();
        if ($featuredValuesLimit && $featuredValuesLimit < count($this->getItems()))
        {
            return true;
        }

        return false;
    }

    /** Implement custom sorting for items if configured
     *
     * @see Mage_Catalog_Model_Layer_Filter_Abstract::getItems()
     * @author ksenevich@aitoc.com
     */
    public function getItems()
    {
        $items = parent::getItems();

        $featuredLimit = Mage::helper('adjnav/featured')->getFeaturedValuesLimit();
        $featuredLimitDisabled = $featuredLimit == 0;
        if (!Mage::helper('adjnav/featured')->isRangeValues())
        {
            return $items;
        }

        $usesRanges  = array();
        $names       = array();
        $attributeId = $this->getAttributeModel()->getId();
        $optionUses  = Mage::getModel('adjnav/eav_entity_attribute_option_stat')->getSortedOptions($attributeId);

        foreach ($items as $k => $item)
        {
            $item->setSortRange(0);

            if (isset($optionUses[$item->getValueString()]))
            {
                $item->setSortRange($optionUses[$item->getValueString()]);
            }
        }

        usort($items, array($this, 'sortItems'));

        $featuredIndex = array();
        $names         = array();
        foreach ($items as $k => $item)
        {
            $item->setSortRange(0);

            if (($k < $featuredLimit) || $featuredLimitDisabled)
            {
                if ($featuredLimitDisabled)
                {
                    $item->setSortRange(1000000 - $k);
                }
                else
                {
                    $item->setSortRange($featuredLimit - $k);
                }
            }
        }

        usort($items, array($this, 'sortItems'));

        return $items;
    }

    public function getAttributeId()
    {
        return $this->_filter->getAttributeModel()->getId();
    }

    public function sortItems($item1, $item2)
    {
        if ($item1->getSortRange() == $item2->getSortRange())
        {//Zend_Debug::dump($item1->getLabel().' '.$item2->getLabel());
            return strcmp($item1->getLabel(), $item2->getLabel());
        }
//Zend_Debug::dump($item1->getLabel().' '.$item2->getLabel().' '.$item1->getSortRange().' '.$item2->getSortRange());
        return (($item1->getSortRange() < $item2->getSortRange()) ? 1 : -1);
    }
}