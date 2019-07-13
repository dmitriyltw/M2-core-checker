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
use Ltw\MagentoChecker\Api\Data\FileInterface;
use Ltw\MagentoChecker\Api\Data\FileInterfaceFactory;

/**
 * Class File
 * @package Ltw\MagentoChecker\Model
 */
class File extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'ltw_magentochecker_file';

    /**
     * @var FileInterfaceFactory
     */
    protected $fileDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param FileInterfaceFactory $fileDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Ltw\MagentoChecker\Model\ResourceModel\File $resource
     * @param \Ltw\MagentoChecker\Model\ResourceModel\File\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        FileInterfaceFactory $fileDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Ltw\MagentoChecker\Model\ResourceModel\File $resource,
        \Ltw\MagentoChecker\Model\ResourceModel\File\Collection $resourceCollection,
        array $data = []
    ) {
        $this->fileDataFactory = $fileDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve file model with file data
     * @return FileInterface
     */
    public function getDataModel()
    {
        $fileData = $this->getData();

        $fileDataObject = $this->fileDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $fileDataObject,
            $fileData,
            FileInterface::class
        );

        return $fileDataObject;
    }
}
