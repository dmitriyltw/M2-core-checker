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
namespace Ltw\MagentoChecker\Model\OriginalFile;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;
use Ltw\MagentoChecker\Api\ClientFileReceiverInterface;
use Ltw\MagentoChecker\Model\Config;

/**
 * Class ClientFileReceiver
 * @package Ltw\MagentoChecker\Model\OriginalFile
 */
class ClientFileReceiver implements ClientFileReceiverInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ClientFileReceiver constructor.
     * @param LoggerInterface $logger
     * @param SerializerInterface $serializer
     * @param Config $config
     * @param Curl $curl
     */
    public function __construct(
        LoggerInterface $logger,
        SerializerInterface $serializer,
        Config $config,
        Curl $curl
    ) {
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->config = $config;
        $this->curl = $curl;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getOriginalFilesHash()
    {
        $requestUrl = $this->config->getApiRequestUrl();
        $this->curl->get($requestUrl);
        $receivedData = $this->curl->getBody();
        $result = $this->serializer->unserialize($receivedData);
        if (empty($result)) {
            throw new \Exception(__('Check the database, nothing to import'));
        }

        return $result;
    }
}
