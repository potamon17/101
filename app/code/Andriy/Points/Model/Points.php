<?php

namespace Andriy\Points\Model;

class Points extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, \Andriy\Points\Api\Data\PointsInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'andriy_points_item';

    const POINTS_ID = 'entity_id';
    /**
     * @var string
     */
    protected $_cacheTag = 'andriy_points_item';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'andriy_points_item';

    /**
     * Initialize resource model.
     */
    public $pointsFactory;

    protected function _construct()
    {
        $this->_init('Andriy\Points\Model\ResourceModel\Points');
    }
    /** @noinspection PhpMissingReturnTypeInspection */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /** @noinspection PhpMissingReturnTypeInspection */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    public function getCustomAttribute($attributeCode)
    {
        // TODO: Implement getCustomAttribute() method.
    }

    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        // TODO: Implement setCustomAttribute() method.
    }

    public function getCustomAttributes()
    {
        // TODO: Implement getCustomAttributes() method.
    }

    public function setCustomAttributes(array $attributes)
    {
        // TODO: Implement setCustomAttributes() method.
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId(): int
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    public function setName(string $name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getAddress(): string
    {
        return $this->getData(self::ADDRESS);
    }

    public function setAddress(string $address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    public function getLatitude(): string
    {
        return $this->getData(self::LATITUDE);
    }

    public function setLatitude(string $latitude): Points
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    public function getLongitude(): string
    {
        return $this->getData(self::LONGITUDE);
    }

    public function setLongitude(string $longitude): Points
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

    public function getLocation(): string
    {
        return $this->getData(self::LOCATION);
    }

    public function setLocation(string $location): Points
    {
        return $this->setData(self::LOCATION, $location);
    }

    public function getShippingId(): string
    {
        return $this->getData(self::SHIPPING_ID);
    }

    public function setShippingId(string $shippingId): Points
    {
        return $this->setData(self::SHIPPING_ID, $shippingId);
    }
}
