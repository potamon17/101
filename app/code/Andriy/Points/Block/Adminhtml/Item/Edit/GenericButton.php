<?php

namespace Andriy\Points\Block\Adminhtml\Item\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class GenericButton
{
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected \Magento\Framework\UrlInterface $urlBuilder;

    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected \Magento\Framework\Registry $registry;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    /**
     * Return the synonyms group Id.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        $contact = $this->registry->registry('entity_id');
        return $contact ? $contact->getId() : null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
