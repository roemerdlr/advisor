<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Backend\Block;

use Magento\Framework\App\State;
use Magento\Framework\Component\ComponentRegistrar;

/**
 * Test class for \Magento\Backend\Block\Menu
 */
class MenuTest extends \PHPUnit_Framework_TestCase {
	/**
	 *
	 * @var \Magento\Backend\Block\Menu $blockMenu
	 */
	protected $blockMenu;
	
	/** @var \Magento\Framework\App\Cache\Type\Config $configCacheType */
	protected $configCacheType;
	
	/**
	 *
	 * @var array
	 */
	protected $backupRegistrar;
	protected function setUp() {
		$this->configCacheType = \Magento\TestFramework\Helper\Bootstrap::getObjectManager ()->create ( 'Magento\Framework\App\Cache\Type\Config' );
		$this->configCacheType->save ( '', \Magento\Backend\Model\Menu\Config::CACHE_MENU_OBJECT );
		
		$this->blockMenu = \Magento\TestFramework\Helper\Bootstrap::getObjectManager ()->create ( 'Magento\Backend\Block\Menu' );
		
		$reflection = new \ReflectionClass ( 'Magento\Framework\Component\ComponentRegistrar' );
		$paths = $reflection->getProperty ( 'paths' );
		$paths->setAccessible ( true );
		$this->backupRegistrar = $paths->getValue ();
		$paths->setAccessible ( false );
	}
	
	/**
	 * Verify that Admin Navigation Menu elements have correct titles & are located on correct levels
	 */
	public function testRenderNavigation() {
		$menuConfig = $this->prepareMenuConfig ();
		$menuHtml = $this->blockMenu->renderNavigation ( $menuConfig->getMenu () );
		$menu = new \SimpleXMLElement ( $menuHtml );
		
		$item = $menu->xpath ( '/ul/li/a/span' ) [0];
		$this->assertEquals ( 'System', ( string ) $item, '"System" item is absent or located on wrong menu level.' );
		
		$item = $menu->xpath ( '/ul//ul/li/strong/span' ) [0];
		$this->assertEquals ( 'Report', ( string ) $item, '"Report" item is absent or located on wrong menu level.' );
		
		$liTitles = [ 
				'Private Sales',
				'Invite',
				'Invited Customers' 
		];
		foreach ( $menu->xpath ( '/ul//ul//ul/li/a/span' ) as $sortOrder => $item ) {
			$this->assertEquals ( $liTitles [$sortOrder], ( string ) $item, '"' . $liTitles [$sortOrder] . '" item is absent or located on wrong menu level.' );
		}
	}
	
	/**
	 *
	 * @return \Magento\Backend\Model\Menu\Config
	 */
	protected function prepareMenuConfig() {
		$this->loginAdminUser ();
		
		$reflection = new \ReflectionClass ( 'Magento\Framework\Component\ComponentRegistrar' );
		$paths = $reflection->getProperty ( 'paths' );
		$paths->setAccessible ( true );
		$paths->setValue ( [ 
				ComponentRegistrar::MODULE => [ ],
				ComponentRegistrar::THEME => [ ],
				ComponentRegistrar::LANGUAGE => [ ] 
		] );
		$paths->setAccessible ( false );
		
		ComponentRegistrar::register ( ComponentRegistrar::MODULE, 'Magento_Backend', __DIR__ . '/_files/menu/Magento/Backend' );
		
		/* @var $validationState \Magento\Framework\App\Arguments\ValidationState */
		$validationState = \Magento\TestFramework\Helper\Bootstrap::getObjectManager ()->create ( 'Magento\Framework\App\Arguments\ValidationState', [ 
				'appMode' => State::MODE_DEFAULT 
		] );
		
		/* @var $configReader \Magento\Backend\Model\Menu\Config\Reader */
		$configReader = \Magento\TestFramework\Helper\Bootstrap::getObjectManager ()->create ( 'Magento\Backend\Model\Menu\Config\Reader', [ 
				'validationState' => $validationState 
		] );
		
		return \Magento\TestFramework\Helper\Bootstrap::getObjectManager ()->create ( 'Magento\Backend\Model\Menu\Config', [ 
				'configReader' => $configReader,
				'configCacheType' => $this->configCacheType 
		] );
	}
	
	/**
	 *
	 * @return void
	 */
	protected function loginAdminUser() {
		\Magento\TestFramework\Helper\Bootstrap::getObjectManager ()->get ( 'Magento\Backend\Model\UrlInterface' )->turnOffSecretKey ();
		
		$auth = \Magento\TestFramework\Helper\Bootstrap::getObjectManager ()->get ( 'Magento\Backend\Model\Auth' );
		$auth->login ( \Magento\TestFramework\Bootstrap::ADMIN_NAME, \Magento\TestFramework\Bootstrap::ADMIN_PASSWORD );
	}
	
	/**
	 *
	 * @return void
	 */
	protected function tearDown() {
		$this->configCacheType->save ( '', \Magento\Backend\Model\Menu\Config::CACHE_MENU_OBJECT );
		$reflection = new \ReflectionClass ( 'Magento\Framework\Component\ComponentRegistrar' );
		$paths = $reflection->getProperty ( 'paths' );
		$paths->setAccessible ( true );
		$paths->setValue ( $this->backupRegistrar );
		$paths->setAccessible ( false );
	}
}
