<?php

namespace Andriy\Points\Block\Widget;

use Andriy\Points\Model\ResourceModel\Points\CollectionFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PointsList extends Template implements BlockInterface, IdentityInterface
{

    /**
     * Cache tag
     */
    const CACHE_TAG = 'andriy_points_lost';

    private $collectionFactory;
    protected $scopeConfig;
    protected $shipconfig;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shipconfig,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->shipconfig = $shipconfig;
        $this->scopeConfig = $scopeConfig;
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG];
    }

    public function getPointsCollection()
    {
        $points = $this->collectionFactory->create();
        return $points->getItems();
    }

    public function getShipping($codeBlock)
    {
        $activeCarriers = $this->shipconfig->getActiveCarriers();
        foreach ($activeCarriers as $carrierCode => $carrierModel) {
            if ($carrierMethods = $carrierModel->getAllowedMethods()) {
                foreach ($carrierMethods as $methodCode => $method) {
                    $code = $carrierCode . '_' . $methodCode;
                    if ($code == $codeBlock) {
                        return $carrierTitle = $this->scopeConfig
                            ->getValue('carriers/' . $carrierCode . '/title');

                    }
                }
            }
        }
    }
}
