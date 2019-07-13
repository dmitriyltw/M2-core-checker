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
namespace Ltw\MagentoChecker\Model\Data;

use Ltw\MagentoChecker\Api\Data\TempFileInterface;

/**
 * Class TempFile
 * @package Ltw\MagentoChecker\Model\Data
 */
class TempFile extends \Magento\Framework\Api\AbstractExtensibleObject implements TempFileInterface
{
    /**
     * Get file_id
     * @return string|null
     */
    public function getFileId()
    {
        return $this->_get(self::FILE_ID);
    }

    /**
     * Set file_id
     * @param string $fileId
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setFileId($fileId)
    {
        return $this->setData(self::FILE_ID, $fileId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ltw\MagentoChecker\Api\Data\TempFileExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Ltw\MagentoChecker\Api\Data\TempFileExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ltw\MagentoChecker\Api\Data\TempFileExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get file_path
     * @return string|null
     */
    public function getFilePath()
    {
        return $this->_get(self::FILE_PATH);
    }

    /**
     * Set file_path
     * @param string $filePath
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setFilePath($filePath)
    {
        return $this->setData(self::FILE_PATH, $filePath);
    }

    /**
     * Get file_hash
     * @return string|null
     */
    public function getFileHash()
    {
        return $this->_get(self::FILE_HASH);
    }

    /**
     * Set file_hash
     * @param string $fileHash
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setFileHash($fileHash)
    {
        return $this->setData(self::FILE_HASH, $fileHash);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Ltw\MagentoChecker\Api\Data\TempFileInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
