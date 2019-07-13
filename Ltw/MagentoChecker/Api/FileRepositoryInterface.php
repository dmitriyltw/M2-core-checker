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
namespace Ltw\MagentoChecker\Api;

/**
 * Interface FileRepositoryInterface
 * @package Ltw\MagentoChecker\Api
 */
interface FileRepositoryInterface
{
    /**
     * Save File
     * @param \Ltw\MagentoChecker\Api\Data\FileInterface $file
     * @return \Ltw\MagentoChecker\Api\Data\FileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Ltw\MagentoChecker\Api\Data\FileInterface $file
    );

    /**
     * Retrieve File
     * @param string $fileId
     * @return \Ltw\MagentoChecker\Api\Data\FileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($fileId);

    /**
     * Retrieve File matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ltw\MagentoChecker\Api\Data\FileSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete File
     * @param \Ltw\MagentoChecker\Api\Data\FileInterface $file
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Ltw\MagentoChecker\Api\Data\FileInterface $file
    );

    /**
     * Delete File by ID
     * @param string $fileId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($fileId);
}
