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
namespace Ltw\MagentoChecker\Model\FileScanner;

use Ltw\MagentoChecker\Model\Config;

/**
 * Class FileScanner
 * @package Ltw\MagentoChecker\Model\FileScanner
 */
class FileScanner
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var IgnoreFolder
     */
    protected $ignoreFolder;

    /**
     * FileScanner constructor.
     * @param Config $config
     * @param IgnoreFolder $ignoreFolder
     */
    public function __construct(
        Config $config,
        IgnoreFolder $ignoreFolder
    ) {
        $this->config = $config;
        $this->ignoreFolder = $ignoreFolder;
    }

    /**
     * @param string $path
     * @return array
     */
    private function getFileList($path)
    {
        $array = [];
        $ignore = $this->ignoreFolder->getIgnoredFolders();
        $files = array_diff(scandir($path), ['.','..']);
        foreach ($files as $file) {
            if (in_array($file, $ignore)) {
                continue;
            }
            if (is_dir($path . '/' . $file)) {
                $array = array_merge($array, $this->getFileList($path . '/' . $file));
            } else {
                $array[$path . '/' . $file] = $file;
            }
        }

        return $array;
    }

    /**
     * @return array
     */
    private function pathModifier()
    {
        $array = [];
        $basePath = $this->config->getAbsoluteFolderPath();
        $data = $this->getFileList($basePath);
        $replacedPath = $this->config->getScanFolderName();

        foreach ($data as $filePath=>$fileHash) {
            $path = str_replace($basePath, $replacedPath, $filePath);
            $array[$path] = $fileHash;
        }

        return $array;
    }

    /**
     * @return array
     */
    public function createHash()
    {
        $array = [];
        $data = $this->pathModifier();
        $hashType = $this->config->getTypeHash();
        foreach ($data as $filePath => $fileHash) {
            $array[$filePath] = hash($hashType, $fileHash);
        }

        return $array;
    }
}
