<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Checkout\Api;

/**
 * Interface for managing guest shipping address information
 * @api
 */
interface GuestShippingInformationManagementInterface {
	/**
	 *
	 * @param string $cartId        	
	 * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation        	
	 * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
	 */
	public function saveAddressInformation($cartId, \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation);
}
