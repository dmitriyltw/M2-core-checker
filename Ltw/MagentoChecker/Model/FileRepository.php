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
use Ltw\MagentoChecker\Api\Data\FileInterfaceFactory;
use Ltw\MagentoChecker\Api\Data\FileSearchResultsInterfaceFactory;
use Ltw\MagentoChecker\Api\FileRepositoryInterface;
use Ltw\MagentoChecker\Model\ResourceModel\File as ResourceFile;
use Ltw\MagentoChecker\Model\ResourceModel\File\CollectionFactory as FileCollectionFactory;

/**
 * Class FileRepository
 * @package Ltw\MagentoChecker\Model
 */
class FileRepository implements FileRepositoryInterface
{
    /**
     * @var FileCollectionFactory
     */
    protected $fileCollectionFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var ResourceFile
     */
    protected $resource;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * @var FileSearchResultsInterfaceFactory
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
     * @var FileInterfaceFactory
     */
    protected $dataFileFactory;

    /**
     * @param ResourceFile $resource
     * @param FileFactory $fileFactory
     * @param FileInterfaceFactory $dataFileFactory
     * @param FileCollectionFactory $fileCollectionFactory
     * @param FileSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceFile $resource,
        FileFactory $fileFactory,
        FileInterfaceFactory $dataFileFactory,
        FileCollectionFactory $fileCollectionFactory,
        FileSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->fileFactory = $fileFactory;
        $this->fileCollectionFactory = $fileCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataFileFactory = $dataFileFactory;
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
        \Ltw\MagentoChecker\Api\Data\FileInterface $file
    ) {
        /* if (empty($file->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $file->setStoreId($storeId);
        } */

        $fileData = $this->extensibleDataObjectConverter->toNestedArray(
            $file,
            [],
            \Ltw\MagentoChecker\Api\Data\FileInterface::class
        );

        $fileModel = $this->fileFactory->create()->setData($fileData);

        try {
            $this->resource->save($fileModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the file: %1',
                $exception->getMessage()
            ));
        }
        return $fileModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($fileId)
    {
        $file = $this->fileFactory->create();
        $this->resource->load($file, $fileId);
        if (!$file->getId()) {
            throw new NoSuchEntityException(__('File with id "%1" does not exist.', $fileId));
        }
        return $file->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->fileCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Ltw\MagentoChecker\Api\Data\FileInterface::class
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
        \Ltw\MagentoChecker\Api\Data\FileInterface $file
    ) {
        try {
            $fileModel = $this->fileFactory->create();
            $this->resource->load($fileModel, $file->getFileId());
            $this->resource->delete($fileModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the File: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($fileId)
    {
        return $this->delete($this->getById($fileId));
    }
}
