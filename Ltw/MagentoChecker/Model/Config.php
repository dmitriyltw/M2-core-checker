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
namespace Ltw\MagentoChecker\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config
 * @package Ltw\MagentoChecker\Model
 */
class Config
{
    const XML_PATH_ENABLED = 'magento_checker/configurable_cron/enabled';

    const SCAN_FOLDER_NAME = '/vendor/allure-framework';

    const HASH_SHA256 = 'sha256';

    const HASH_MD5 = 'md5';

    const API_REQUEST_URL = 'http://magento23.lc/rest/V1/hashfiles';

    /**
     * @var ScopeConfigInterface
     */
    private $config;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $config
     */
    public function __construct(
        ScopeConfigInterface $config
    ) {
        $this->config = $config;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->config->getValue(self::XML_PATH_ENABLED, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }

    /**
     * @return string
     */
    public function getAbsoluteFolderPath()
    {
        return BP . self::SCAN_FOLDER_NAME;
    }

    /**
     * @return string
     */
    public function getScanFolderName()
    {
        return self::SCAN_FOLDER_NAME;
    }

    /**
     * @return string
     */
    public function getTypeHash()
    {
        return self::HASH_SHA256;
    }

    /**
     * @return string
     */
    public function getApiRequestUrl()
    {
        return self::API_REQUEST_URL;
    }
}
