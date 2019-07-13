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
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Ltw\MagentoChecker\Api\Data\TempFileInterfaceFactory;
use Ltw\MagentoChecker\Api\Data\TempFileSearchResultsInterfaceFactory;
use Ltw\MagentoChecker\Api\TempFileRepositoryInterface;
use Ltw\MagentoChecker\Model\ResourceModel\TempFile as ResourceTempFile;
use Ltw\MagentoChecker\Model\ResourceModel\TempFile\CollectionFactory as TempFileCollectionFactory;

/**
 * Class TempFileRepository
 * @package Ltw\MagentoChecker\Model
 */
class TempFileRepository implements TempFileRepositoryInterface
{
    /**
     * @var TempFileCollectionFactory
     */
    protected $tempFileCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var ResourceTempFile
     */
    protected $resource;

    /**
     * @var TempFileInterfaceFactory
     */
    protected $dataTempFileFactory;

    /**
     * @var TempFileFactory
     */
    protected $tempFileFactory;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var TempFileSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param ResourceTempFile $resource
     * @param TempFileFactory $tempFileFactory
     * @param TempFileInterfaceFactory $dataTempFileFactory
     * @param TempFileCollectionFactory $tempFileCollectionFactory
     * @param TempFileSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceTempFile $resource,
        TempFileFactory $tempFileFactory,
        TempFileInterfaceFactory $dataTempFileFactory,
        TempFileCollectionFactory $tempFileCollectionFactory,
        TempFileSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->tempFileFactory = $tempFileFactory;
        $this->tempFileCollectionFactory = $tempFileCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTempFileFactory = $dataTempFileFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Ltw\MagentoChecker\Api\Data\TempFileInterface $tempFile
    ) {
        /* if (empty($tempFile->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $tempFile->setStoreId($storeId);
        } */

        $tempFileData = $this->extensibleDataObjectConverter->toNestedArray(
            $tempFile,
            [],
            \Ltw\MagentoChecker\Api\Data\TempFileInterface::class
        );

        $tempFileModel = $this->tempFileFactory->create()->setData($tempFileData);

        try {
            $this->resource->save($tempFileModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the tempFile: %1',
                $exception->getMessage()
            ));
        }
        return $tempFileModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($tempFileId)
    {
        $tempFile = $this->tempFileFactory->create();
        $this->resource->load($tempFile, $tempFileId);
        if (!$tempFile->getId()) {
            throw new NoSuchEntityException(__('TempFile with id "%1" does not exist.', $tempFileId));
        }
        return $tempFile->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->tempFileCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Ltw\MagentoChecker\Api\Data\TempFileInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Ltw\MagentoChecker\Api\Data\TempFileInterface $tempFile
    ) {
        try {
            $tempFileModel = $this->tempFileFactory->create();
            $this->resource->load($tempFileModel, $tempFile->getTempfileId());
            $this->resource->delete($tempFileModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the TempFile: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($tempFileId)
    {
        return $this->delete($this->getById($tempFileId));
    }

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @return TempFileRepository
     */
    public function setCollectionProcessor($collectionProcessor)
    {
        $this->collectionProcessor = $collectionProcessor;
        return $this;
    }
}
