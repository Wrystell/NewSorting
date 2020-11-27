<?php
namespace Rexen\NewSorting\Plugin\Model;

use Magento\Store\Model\StoreManagerInterface;

class Config  {


    protected $_storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }


    public function afterGetAttributeUsedForSortByArray(\Magento\Catalog\Model\Config $catalogConfig, $options)
    {
        $store = $this->_storeManager->getStore();
        $currencySymbol = $store->getCurrentCurrency()->getCurrencySymbol();

        // Remove specific default sorting options
        $default_options = [];
        $default_options['name'] = $options['name'];
        $default_options['price'] = $options['price'];

        unset($options['position']);
        unset($options['name']);
        unset($options['price']);

        //Changing label
        $customOption['position'] = __( 'Relevance' );

        //New sorting options
        //$customOption['created_at'] = __( ' Novità' );


        $customOption['name'] = $default_options['name'];

        $customOption['price'] = $default_options['price'];

        //Merge default sorting options with custom options
        $options = array_merge($customOption, $options);

        return $options;
    }
}

