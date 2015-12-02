<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Search\Dynamic\Algorithm;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\ObjectManagerInterface;

class Repository {
	/**
	 *
	 * @var ObjectManagerInterface
	 */
	private $objectManager;
	
	/**
	 *
	 * @var array
	 */
	private $algorithms = [ ];
	
	/**
	 *
	 * @var AlgorithmInterface[]
	 */
	private $instances = [ ];
	
	/**
	 * Construct
	 *
	 * @param ObjectManagerInterface $objectManager        	
	 * @param array $algorithms        	
	 */
	public function __construct(ObjectManagerInterface $objectManager, array $algorithms) {
		$this->objectManager = $objectManager;
		$this->algorithms = $algorithms;
	}
	
	/**
	 * Create algorithm
	 *
	 * @param string $algorithmType        	
	 * @param array $data        	
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @return AlgorithmInterface
	 */
	public function get($algorithmType, array $data = []) {
		if (! isset ( $this->instances [$algorithmType] )) {
			if (! isset ( $this->algorithms [$algorithmType] )) {
				throw new LocalizedException ( new \Magento\Framework\Phrase ( '%1 was not found in algorithms', [ 
						$algorithmType 
				] ) );
			}
			
			$className = $this->algorithms [$algorithmType];
			$model = $this->objectManager->create ( $className, $data );
			
			if (! $model instanceof AlgorithmInterface) {
				throw new LocalizedException ( new \Magento\Framework\Phrase ( '%1 doesn\'t extends \Magento\Framework\Search\Dynamic\Algorithm\AlgorithmInterface', [ 
						$className 
				] ) );
			}
			$this->instances [$algorithmType] = $model;
		}
		
		return $this->instances [$algorithmType];
	}
}
