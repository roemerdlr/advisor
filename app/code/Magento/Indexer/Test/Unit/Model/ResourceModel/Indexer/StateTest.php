<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Indexer\Test\Unit\Model\ResourceModel\Indexer;

class StateTest extends \PHPUnit_Framework_TestCase {
	/**
	 *
	 * @var \Magento\Indexer\Model\ResourceModel\Indexer\State
	 */
	protected $model;
	public function testConstruct() {
		$resourceMock = $this->getMock ( '\Magento\Framework\App\ResourceConnection', [ ], [ ], '', false );
		$objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager ( $this );
		$arguments = $objectManager->getConstructArguments ( '\Magento\Indexer\Model\ResourceModel\Indexer\State', [ 
				'resource' => $resourceMock 
		] );
		$this->model = $objectManager->getObject ( '\Magento\Indexer\Model\ResourceModel\Indexer\State', $arguments );
		$this->assertEquals ( [ 
				[ 
						'field' => [ 
								'indexer_id' 
						],
						'title' => __ ( 'State for the same indexer' ) 
				] 
		], $this->model->getUniqueFields () );
	}
}
