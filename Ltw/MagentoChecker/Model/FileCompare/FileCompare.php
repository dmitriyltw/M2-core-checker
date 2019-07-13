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
namespace Ltw\MagentoChecker\Model\FileCompare;

use Ltw\MagentoChecker\Api\ClientFileReceiverInterface;
use Ltw\MagentoChecker\Model\FileScanner\FileScanner;

/**
 * Class FileCompare
 * @package Ltw\MagentoChecker\Model\FileCompare
 *
 */
class FileCompare
{
    /**
     * @var ClientFileReceiverInterface
     */
    protected $receiver;

    /**
     * @var FileScanner
     */
    protected $fileScanner;

    /**
     * FileCompare constructor.
     * @param ClientFileReceiverInterface $receiver
     * @param FileScanner $fileScanner
     */
    public function __construct(
        ClientFileReceiverInterface $receiver,
        FileScanner $fileScanner
    ) {
        $this->fileScanner = $fileScanner;
        $this->receiver = $receiver;
    }

    /**
     * @return array|bool|float|int|string|null
     */
    private function getReceivedFiles()
    {
        return $this->receiver->getOriginalFilesHash();
    }

    /**
     * @return array
     */
    private function getScannedFiles()
    {
        return $this->fileScanner->createHash();
    }

    /**
     * @return array $result
     */
    public function compareFiles()
    {
        $result = [];
        $receivedFiles = $this->getReceivedFiles();
        $scannedFiles = $this->getScannedFiles();
        foreach ($receivedFiles as $receivedFile) {
            foreach ($scannedFiles as $filePath => $fileHash) {
                if ($receivedFile['file_path'] == $filePath) {
                    if ($receivedFile['file_hash'] != $fileHash) {
                        $result[] = $filePath;
                    }
                }
            }
        }

        return $result;
    }
}
