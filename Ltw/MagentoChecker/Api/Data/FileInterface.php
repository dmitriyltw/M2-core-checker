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
 * Interface FileInterface
 * @package Ltw\MagentoChecker\Api\Data
 */
interface FileInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const FILE_HASH = 'file_hash';
    const FILE_PATH = 'file_path';
    const FILE_ID = 'file_id';

    /**
     * Get file_id
     * @return string|null
     */
    public function getFileId();

    /**
     * Set file_id
     * @param string $fileId
     * @return \Ltw\MagentoChecker\Api\Data\FileInterface
     */
    public function setFileId($fileId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ltw\MagentoChecker\Api\Data\FileExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Ltw\MagentoChecker\Api\Data\FileExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ltw\MagentoChecker\Api\Data\FileExtensionInterface $extensionAttributes
    );

    /**
     * Get file_path
     * @return string|null
     */
    public function getFilePath();

    /**
     * Set file_path
     * @param string $filePath
     * @return \Ltw\MagentoChecker\Api\Data\FileInterface
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
     * @return \Ltw\MagentoChecker\Api\Data\FileInterface
     */
    public function setFileHash($fileHash);
}
