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

use Ltw\MagentoChecker\Api\Data\FileInterfaceFactory;
use Ltw\MagentoChecker\Api\FileRepositoryInterface;
use Ltw\MagentoChecker\Helper\File;

/**
 * Class FileChecker
 * @package Ltw\MagentoChecker\Cron
 */
class FileChecker
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Ltw\MagentoChecker\Model\Config
     */
    private $config;

    /**
     * @var \Ltw\MagentoChecker\Model\FileScanner\FileScanner
     */
    private $fileScanner;

    /**
     * @var FileRepositoryInterface
     */
    protected $fileRepositoryInterface;

    /**
     * @var FileInterfaceFactory
     */
    protected $fileInterfaceFactory;

    /**
     * FileChecker constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param FileRepositoryInterface $fileRepositoryInterface
     * @param \Ltw\MagentoChecker\Model\FileScanner\FileScanner $fileScanner
     * @param FileInterfaceFactory $fileInterfaceFactory
     * @param \Ltw\MagentoChecker\Model\Config $config
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        FileRepositoryInterface $fileRepositoryInterface,
        \Ltw\MagentoChecker\Model\FileScanner\FileScanner $fileScanner,
        FileInterfaceFactory $fileInterfaceFactory,
        \Ltw\MagentoChecker\Model\Config $config
    ) {
        $this->fileInterfaceFactory = $fileInterfaceFactory;
        $this->fileRepositoryInterface = $fileRepositoryInterface;
        $this->config = $config;
        $this->fileScanner = $fileScanner;
        $this->logger = $logger;
    }

    /**
     * Execute the cron
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        if ($this->config->isEnabled()) {
            $result = $this->fileScanner->createHash();
            foreach ($result as $key => $value) {
                $model = $this->fileInterfaceFactory->create();
                $model->setFilePath($key)->setFileHash($value);
                $this->fileRepositoryInterface->save($model);
            }
            $this->logger->info('Сron job completed, data saved to database');
        }
    }
}
