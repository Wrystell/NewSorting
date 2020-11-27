<?php
namespace Rexen\NewSorting\Plugin\Product\ProductList;

class Toolbar
{

    public function aroundSetCollection(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
        \Closure $proceed,
        $collection
    ) {
        $currentOrder = $subject->getCurrentOrder();
        $result = $proceed($collection);

        if ($currentOrder) {
            /*
            if ($currentOrder == 'created_at') {
                $subject->getCollection()->setOrder('created_at', 'desc');
            }
            */
            if ($currentOrder == 'position') {
                $subject->getCollection()->setOrder('created_at', 'desc');
            }
        }

        return $result;
    }
}