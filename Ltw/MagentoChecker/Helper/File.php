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
namespace Ltw\MagentoChecker\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class File
 * @package Ltw\MagentoChecker\Helper
 */
class File extends AbstractHelper
{
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $startTime = microtime(true);
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $endTime = microtime(true);
    }

    /**
     * @param $startTime
     * @param $endTime
     * @return mixed
     */
    public function getJobTime($startTime, $endTime)
    {
        return $result = $endTime - $startTime;
    }
}
