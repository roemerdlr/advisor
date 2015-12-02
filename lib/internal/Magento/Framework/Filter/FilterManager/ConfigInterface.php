<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Filter\FilterManager;

/**
 * Filter manager config interface
 */
interface ConfigInterface {
	/**
	 * Get list of factories
	 *
	 * @return string[]
	 */
	public function getFactories();
}