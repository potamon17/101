<?php
namespace Andriy\Points\Api;

interface PointsRepositoryInterface
{

    /**
     * @param \Andriy\Points\Api\Data\PointsInterface $point
     * @return \Andriy\Points\Api\Data\PointsInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function save(\Andriy\Points\Api\Data\PointsInterface $point);

    /**
     * @param int $pointId
     * @return \Andriy\Points\Api\Data\PointsInterface
     * @throws \Andriy\Points\Api\Data\PointsInterface
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function get(int $pointId);

    /**
     * @param \Andriy\Points\Api\Data\PointsInterface $point
     * @return bool
     * @throws \Andriy\Points\Api\Data\PointsInterface
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function delete(\Andriy\Points\Api\Data\PointsInterface $point);

    /**
     * @param int $pointId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function deleteById(int $pointId);


}
