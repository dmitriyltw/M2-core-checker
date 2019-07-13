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
 * Interface TempFileRepositoryInterface
 * @package Ltw\MagentoChecker\Api
 */
interface TempFileRepositoryInterface
{
    /**
     * Save TempFile
     * @param \Ltw\MagentoChecker\Api\Data\TempFileInterface $tempFile
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Ltw\MagentoChecker\Api\Data\TempFileInterface $tempFile
    );

    /**
     * Retrieve TempFile
     * @param string $tempfileId
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($tempfileId);

    /**
     * Retrieve TempFile matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ltw\MagentoChecker\Api\Data\TempFileSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete TempFile
     * @param \Ltw\MagentoChecker\Api\Data\TempFileInterface $tempFile
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Ltw\MagentoChecker\Api\Data\TempFileInterface $tempFile
    );

    /**
     * Delete TempFile by ID
     * @param string $tempfileId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tempfileId);
}
