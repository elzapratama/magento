<?php
namespace Lime\Simple\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;

class Topmenu implements ObserverInterface
{
    protected  $_storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager=$storeManager;
    }
    /**
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Framework\Data\Tree\Node $menu */
        $menu = $observer->getMenu();
        $tree = $menu->getTree();
        $data = [
            'name'      => __('Home'),
            'id'        => 'some-unique-id-here',
            'url'       => $this->_storeManager->getStore()->getBaseUrl().'simple',
            'is_active' => false,
        ];
        $node = new Node($data, 'id', $tree, $menu);
        $menu->addChild($node);
        return $this;
    }
}