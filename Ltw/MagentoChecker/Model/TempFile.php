<?php
/**
 * A Magento 2 module named Ltw/MagentoChecker
 * Copyright © Ltw - 2019. All rights reserved.
 *
 * This file included in Ltw/MagentoChecker is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */
namespace Ltw\MagentoChecker\Model;

use Magento\Framework\Api\DataObjectHelper;
use Ltw\MagentoChecker\Api\Data\TempFileInterface;
use Ltw\MagentoChecker\Api\Data\TempFileInterfaceFactory;

/**
 * Class TempFile
 * @package Ltw\MagentoChecker\Model
 */
class TempFile extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var TempFileInterfaceFactory
     */
    protected $tempfileDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'ltw_magentochecker_tempfile';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TempFileInterfaceFactory $tempfileDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Ltw\MagentoChecker\Model\ResourceModel\TempFile $resource
     * @param \Ltw\MagentoChecker\Model\ResourceModel\TempFile\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TempFileInterfaceFactory $tempfileDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Ltw\MagentoChecker\Model\ResourceModel\TempFile $resource,
        \Ltw\MagentoChecker\Model\ResourceModel\TempFile\Collection $resourceCollection,
        array $data = []
    ) {
        $this->tempfileDataFactory = $tempfileDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve tempfile model with tempfile data
     * @return TempFileInterface
     */
    public function getDataModel()
    {
        $tempfileData = $this->getData();

        $tempfileDataObject = $this->tempfileDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $tempfileDataObject,
            $tempfileData,
            TempFileInterface::class
        );

        return $tempfileDataObject;
    }
}
