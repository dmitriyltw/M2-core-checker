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

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Ltw\MagentoChecker\Api\FileRepositoryInterface;

/**
 * Class FileList
 * @package Ltw\MagentoChecker\Model
 */
class FileList
{
    /**
     * @var FileRepositoryInterface
     */
    protected $fileRepositoryInterface;

    /**
     * @var SearchCriteriaInterface
     */
    protected $searchCriteria;

    /**
     * @var SortOrder
     */
    protected $sortOrder;

    /**
     * FileList constructor.
     * @param SortOrder $sortOrder
     * @param FileRepositoryInterface $fileRepositoryInterface
     * @param SearchCriteriaInterface $searchCriteria
     */
    public function __construct(
            SortOrder $sortOrder,
            FileRepositoryInterface $fileRepositoryInterface,
            SearchCriteriaInterface $searchCriteria
    ) {
        $this->sortOrder = $sortOrder;
        $this->searchCriteria = $searchCriteria;
        $this->fileRepositoryInterface = $fileRepositoryInterface;
    }

    /**
     * @return \Ltw\MagentoChecker\Api\Data\FileInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getFilesListHashFromDb()
    {
        return $this->fileRepositoryInterface->getList($this->searchCriteria)->getItems();
    }
}
