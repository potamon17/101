<?php

namespace Andriy\Points\Model;

use Andriy\Points\Api\Data;
use Andriy\Points\Api\PointsRepositoryInterface;
use Andriy\Points\Model\ResourceModel\Points;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PointsRepository implements PointsRepositoryInterface
{
    /**
     * @var Points
     */
    protected Points $resource;

    /**
     * @var PointsFactory
     */
    protected PointsFactory $pointsFactory;

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
                'Could not delete the Point: %1',
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
