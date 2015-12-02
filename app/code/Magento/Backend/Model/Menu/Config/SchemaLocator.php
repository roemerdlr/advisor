<?php

/**
 * Menu configuration schema locator
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Backend\Model\Menu\Config;

use Magento\Framework\Module\Dir;

class SchemaLocator implements \Magento\Framework\Config\SchemaLocatorInterface {
	/**
	 * Path to corresponding XSD file with validation rules for merged config
	 *
	 * @var string
	 */
	protected $_schema = null;
	
	/**
	 * Path to corresponding XSD file with validation rules for separate config files
	 *
	 * @var string
	 */
	protected $_perFileSchema = null;
	
	/**
	 *
	 * @param \Magento\Framework\Module\Dir\Reader $moduleReader        	
	 */
	public function __construct(\Magento\Framework\Module\Dir\Reader $moduleReader) {
		$this->_schema = $moduleReader->getModuleDir ( Dir::MODULE_ETC_DIR, 'Magento_Backend' ) . '/menu.xsd';
	}
	
	/**
	 * Get path to merged config schema
	 *
	 * @return string|null
	 */
	public function getSchema() {
		return $this->_schema;
	}
	
	/**
	 * Get path to pre file validation schema
	 *
	 * @return string|null
	 */
	public function getPerFileSchema() {
		return $this->_perFileSchema;
	}
}