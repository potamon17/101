<?php

namespace Andriy\Points\Ui\Component\Source;

use Magento\Framework\Option\ArrayInterface;

class Shipping implements ArrayInterface
{
    protected $scopeConfig;
    protected $shipconfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shipconfig
    ) {
        $this->shipconfig = $shipconfig;
        $this->scopeConfig = $scopeConfig;
    }

    public function toOptionArray(): array
    {
        $activeCarriers = $this->shipconfig->getActiveCarriers();

        foreach ($activeCarriers as $carrierCode => $carrierModel) {
            $options = [];

            if ($carrierMethods = $carrierModel->getAllowedMethods()) {
                foreach ($carrierMethods as $methodCode => $method) {
                    $code = $carrierCode . '_' . $methodCode;
                    $options[] = ['value' => $code, 'label' => $method];
                }
                $carrierTitle = $this->scopeConfig
                    ->getValue('carriers/' . $carrierCode . '/title');
            }

            $methods[] = ['value' => $options, 'label' => $carrierTitle];
        }

        return $methods;

    }
}
