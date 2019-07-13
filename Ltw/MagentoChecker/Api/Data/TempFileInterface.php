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
 * Interface TempFileInterface
 * @package Ltw\MagentoChecker\Api\Data
 */
interface TempFileInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const FILE_ID = 'file_id';
    const FILE_HASH = 'file_hash';
    const FILE_PATH = 'file_path';
    const STATUS = 'status';

    /**
     * Get file_id
     * @return string|null
     */
    public function getFileId();

    /**
     * Set file_id
     * @param string $fileId
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setFileId($fileId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ltw\MagentoChecker\Api\Data\TempFileExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Ltw\MagentoChecker\Api\Data\TempFileExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ltw\MagentoChecker\Api\Data\TempFileExtensionInterface $extensionAttributes
    );

    /**
     * Get file_path
     * @return string|null
     */
    public function getFilePath();

    /**
     * Set file_path
     * @param string $filePath
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setFilePath($filePath);

    /**
     * Get file_hash
     * @return string|null
     */
    public function getFileHash();

    /**
     * Set file_hash
     * @param string $fileHash
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setFileHash($fileHash);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setStatus($status);
}
