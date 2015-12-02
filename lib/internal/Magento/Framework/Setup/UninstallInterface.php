<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Setup;

/**
 * Interface for handling data removal during module uninstall
 */
interface UninstallInterface {
	/**
	 * Invoked when remove-data flag is set during module uninstall.
	 *
	 * @param SchemaSetupInterface $setup        	
	 * @param ModuleContextInterface $context        	
	 * @return void
	 */
	public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context);
}
