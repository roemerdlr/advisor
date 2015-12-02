<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\View\Element\UiComponent\DataProvider;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Api\Filter;

/**
 * Class RegularFilter
 */
class RegularFilter implements FilterApplierInterface {
	/**
	 * Apply regular filters like collection filters
	 *
	 * @param AbstractDb $collection        	
	 * @param Filter $filter        	
	 * @return void
	 */
	public function apply(AbstractDb $collection, Filter $filter) {
		$collection->addFieldToFilter ( $filter->getField (), [ 
				$filter->getConditionType () => $filter->getValue () 
		] );
	}
}
