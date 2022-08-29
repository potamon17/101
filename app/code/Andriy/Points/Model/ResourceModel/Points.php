<?php

namespace Andriy\Points\Model\ResourceModel;

class Points extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('andriy_points_item', 'entity_id');
    }
}
