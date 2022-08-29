<?php

namespace Andriy\Points\Model;

use Andriy\Points\Api\PointsRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Andriy\Points\Model\ResourceModel\Points;
use Andriy\Points\Api\Data;

class PointsRepository implements PointsRepositoryInterface
{
    protected $resource;
    protected $pointsFactory;

    public function __construct(
        Points $resource,
        PointsFactory $pointsFactory
    ) {
        $this->pointsFactory = $pointsFactory;
        $this->resource = $resource;
    }
    public function save(Data\PointsInterface $point): Data\PointsInterface
    {
        try {
            /** @noinspection PhpParamsInspection */
            $this->resource->save($point);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $point;
    }

    public function get(int $pointId): Data\PointsInterface
    {
        $point = $this->pointsFactory->create();

        $point->load($pointId);
        if (!$point->getId()) {
            throw new NoSuchEntityException(__('Point with id "%1" does not exist.', $pointId));
        }

        return $point;
    }

    public function delete(Data\PointsInterface $point): bool
    {
        try {
            $this->resource->delete($point);
        } catch (\Exception $exception) {
            /** @noinspection PhpUndefinedClassInspection */
            throw new CouldNotDeleteException(__(
                'Could not delete the Faq: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById(int $pointId): bool
    {
        return $this->delete($this->get($pointId));
    }
}
