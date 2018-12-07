<?php

namespace TYPO3\CMS\Cal\Utility;

use Doctrine\DBAL\FetchMode;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the TYPO3 extension Calendar Base (cal).
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 extension Calendar Base (cal) project - inspiring people to share!
 */

/**
 * class.tx_cal_cache.php
 *
 * @author Mario Matzulla <mario@matzullas.de>
 * @package TYPO3
 * @subpackage
 *
 */
class Cache {
	var $cachingEngine;
	var $tx_cal_cache;
	var $lifetime = 0;
	var $ACCESS_TIME = 0;

	/** @var ConnectionPool $connectionPool */
	var $connectionPool;

	/**
	 * Constructor.
	 * Takes the name of the caching backend as parameter.
	 *
	 * @param $cachingEngine string
	 */
	public function __construct($cachingEngine) {
		$this->cachingEngine = $cachingEngine;
		switch ($this->cachingEngine) {
			case 'cachingFramework' :
				$this->initCachingFramework();
				break;

			case 'memcached' :
				$this->initMemcached();
				break;

			// default = internal
		}

		$this->connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
	}

	function initMemcached() {
		$this->tx_cal_cache = new \Memcache ();
		$this->tx_cal_cache->connect('localhost', 11211);
	}

	function initCachingFramework() {
		try {
			$GLOBALS ['typo3CacheFactory']->create(
				'tx_cal_cache',
				\TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
				$GLOBALS ['TYPO3_CONF_VARS'] ['SYS'] ['caching'] ['cacheConfigurations'] ['tx_cal_cache'] ['backend'],
				$GLOBALS ['TYPO3_CONF_VARS'] ['SYS'] ['caching'] ['cacheConfigurations'] ['tx_cal_cache'] ['options']
			);
		} catch (\TYPO3\CMS\Core\Cache\Exception\DuplicateIdentifierException $e) {
			// do nothing, a cal_cache cache already exists
		}

		$this->tx_cal_cache = $GLOBALS ['typo3CacheManager']->getCache('tx_cal_cache');
	}

	function set($hash, $content, $ident, $lifetime = 0) {
		if ($lifetime == 0) {
			$lifetime = $this->lifetime;
		}
		if ($this->cachingEngine == 'cachingFramework') {
			$this->tx_cal_cache->set($hash, $content, array(
				'ident_'.$ident
			), $lifetime);
		} elseif ($this->cachingEngine == 'memcached') {
			$this->tx_cal_cache->set($hash, $content, false, $lifetime);
		} else {
			$table = 'tx_cal_cache';
			$fields_values = array(
				'identifier' => $hash,
				'content'    => $content,
				'crdate'     => $GLOBALS ['EXEC_TIME'],
				'lifetime'   => $lifetime
			);
			$connection = $this->connectionPool->getConnectionForTable($table);
			$connection->delete($table, ['identifier' => $hash]);
			$result = $connection->insert($table, $fields_values);
			if ($result !== 1) {
				throw new \RuntimeException('Could not write cache record to database: '.$connection->errorCode(), 1431458130);
			}
		}
	}

	function get($hash) {
		$cacheEntry = FALSE;
		if ($this->cachingEngine == 'cachingFramework' || $this->cachingEngine == 'memcached') {
			$cacheEntry = $this->tx_cal_cache->get($hash);
		} else {
			$select_fields = 'content';
			$from_table = 'tx_cal_cache';

			$builder = $this->connectionPool->getQueryBuilderForTable($from_table);

			$cRec = $builder
				->select($select_fields)
				->from($from_table)
				->where($builder->expr()->eq('identifier', '?'))
				->andWhere($builder->expr()->orX(
					'lifetime = 0', 'crdate + lifetime > ?'
				))
				->setParameters([$hash, $this->ACCESS_TIME])
				->execute()
				->fetchAll(FetchMode::ASSOCIATIVE);

			if (is_array($cRec [0]) && $cRec [0] ['content'] != '') {
				$cacheEntry = $cRec [0] ['content'];
			}
		}

		return $cacheEntry;
	}
}

?>