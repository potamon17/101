<?php


namespace Andriy\Points\Model\ResourceModel\Points;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Andriy\Points\Model\Points',
            'Andriy\Points\Model\ResourceModel\Points'
        );
    }
}
