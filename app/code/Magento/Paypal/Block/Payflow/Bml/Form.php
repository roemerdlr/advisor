<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Paypal\Block\Payflow\Bml;

use Magento\Paypal\Model\Config;

/**
 *
 * @todo
 */
class Form extends \Magento\Paypal\Block\Bml\Form {
	/**
	 * Payment method code
	 * 
	 * @var string
	 */
	protected $_methodCode = Config::METHOD_WPP_PE_BML;
}
