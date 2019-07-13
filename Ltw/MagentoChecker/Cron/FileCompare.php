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
namespace Ltw\MagentoChecker\Cron;

use Psr\Log\LoggerInterface;
use Ltw\MagentoChecker\Model\FileCompare\FileCompare as ModelFileCompare;
use Ltw\MagentoChecker\Model\FileList;
use Ltw\MagentoChecker\Model\FileScanner\FileScanner;

/**
 * Class FileCompare
 * @package Ltw\MagentoChecker\Cron
 */
class FileCompare
{
    /**
     * @var FileList
     */
    protected $fileList;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var FileScanner
     */
    protected $fileScanner;

    /**
     * @var ModelFileCompare
     */
    protected $comparer;

    /**
     * CheckMatches constructor.
     * @param FileList $fileList
     * @param FileScanner $fileScanner
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModelFileCompare $comparer,
        FileList $fileList,
        FileScanner $fileScanner,
        LoggerInterface $logger
    ) {
        $this->comparer = $comparer;
        $this->fileList = $fileList;
        $this->fileScanner = $fileScanner;
        $this->logger = $logger;
    }

    /**
     * Execute the cron
     */
    public function execute()
    {
        if ($this->comparer->compareFiles()) {
            $this->logger->info('Cron job completed, data was compared');
        }
    }
}
