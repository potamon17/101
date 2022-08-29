<?php

namespace Andriy\Points\Block\Widget;

use Andriy\Points\Model\ResourceModel\Points\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Shipping\Model\Config;
use Magento\Widget\Block\BlockInterface;

class PointsList extends Template implements BlockInterface, IdentityInterface
{

    /**
     * Cache tag
     */
    const CACHE_TAG = 'andriy_points_lost';

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @var Config
     */
    protected Config $shipconfig;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        ScopeConfigInterface $scopeConfig,
        Config $shipconfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->shipconfig = $shipconfig;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string[]
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG];
    }

    /**
     * @return array
     */
    public function getPointsCollection(): array
    {
        $points = $this->collectionFactory->create();
        return $points->getItems();
    }

    /**
     * @param $codeBlock
     * @return mixed
     */
    public function getShipping($codeBlock): mixed
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
