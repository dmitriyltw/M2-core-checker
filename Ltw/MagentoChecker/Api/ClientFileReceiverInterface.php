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
namespace Ltw\MagentoChecker\Api;

/**
 * Interface ClientFileReceiverInterface
 * @package Ltw\MagentoChecker\Api
 */
interface ClientFileReceiverInterface
{
    /**
     * @return mixed
     */
    public function getOriginalFilesHash();
}
