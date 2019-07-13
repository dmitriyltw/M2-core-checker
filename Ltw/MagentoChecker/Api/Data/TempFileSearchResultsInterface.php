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
namespace Ltw\MagentoChecker\Api\Data;

/**
 * Interface TempFileSearchResultsInterface
 * @package Ltw\MagentoChecker\Api\Data
 */
interface TempFileSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get TempFile list.
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface[]
     */
    public function getItems();

    /**
     * Set file_id list.
     * @param \Ltw\MagentoChecker\Api\Data\TempFileInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
