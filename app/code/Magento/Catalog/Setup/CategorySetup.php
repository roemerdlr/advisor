<?php

/**
 * Catalog entity setup
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Setup;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product\Type;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;

class CategorySetup extends EavSetup {
	/**
	 * Category model factory
	 *
	 * @var CategoryFactory
	 */
	private $categoryFactory;
	
	/**
	 * Init
	 *
	 * @param ModuleDataSetupInterface $setup        	
	 * @param Context $context        	
	 * @param CacheInterface $cache        	
	 * @param CollectionFactory $attrGroupCollectionFactory        	
	 * @param CategoryFactory $categoryFactory        	
	 */
	public function __construct(ModuleDataSetupInterface $setup, Context $context, CacheInterface $cache, CollectionFactory $attrGroupCollectionFactory, CategoryFactory $categoryFactory) {
		$this->categoryFactory = $categoryFactory;
		parent::__construct ( $setup, $context, $cache, $attrGroupCollectionFactory );
	}
	
	/**
	 * Creates category model
	 *
	 * @param array $data        	
	 * @return \Magento\Catalog\Model\Category @codeCoverageIgnore
	 */
	public function createCategory($data = []) {
		return $this->categoryFactory->create ( $data );
	}
	
	/**
	 * Default entities and attributes
	 *
	 * @return array @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	public function getDefaultEntities() {
		return [ 
				'catalog_category' => [ 
						'entity_model' => 'Magento\Catalog\Model\ResourceModel\Category',
						'attribute_model' => 'Magento\Catalog\Model\ResourceModel\Eav\Attribute',
						'table' => 'catalog_category_entity',
						'additional_attribute_table' => 'catalog_eav_attribute',
						'entity_attribute_collection' => 'Magento\Catalog\Model\ResourceModel\Category\Attribute\Collection',
						'attributes' => [ 
								'name' => [ 
										'type' => 'varchar',
										'label' => 'Name',
										'input' => 'text',
										'sort_order' => 1,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'General Information' 
								],
								'is_active' => [ 
										'type' => 'int',
										'label' => 'Is Active',
										'input' => 'select',
										'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
										'sort_order' => 2,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'General Information' 
								],
								'description' => [ 
										'type' => 'text',
										'label' => 'Description',
										'input' => 'textarea',
										'required' => false,
										'sort_order' => 4,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'wysiwyg_enabled' => true,
										'is_html_allowed_on_front' => true,
										'group' => 'General Information' 
								],
								'image' => [ 
										'type' => 'varchar',
										'label' => 'Image',
										'input' => 'image',
										'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
										'required' => false,
										'sort_order' => 5,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'General Information' 
								],
								'meta_title' => [ 
										'type' => 'varchar',
										'label' => 'Page Title',
										'input' => 'text',
										'required' => false,
										'sort_order' => 6,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'General Information' 
								],
								'meta_keywords' => [ 
										'type' => 'text',
										'label' => 'Meta Keywords',
										'input' => 'textarea',
										'required' => false,
										'sort_order' => 7,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'General Information' 
								],
								'meta_description' => [ 
										'type' => 'text',
										'label' => 'Meta Description',
										'input' => 'textarea',
										'required' => false,
										'sort_order' => 8,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'General Information' 
								],
								'display_mode' => [ 
										'type' => 'varchar',
										'label' => 'Display Mode',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Mode',
										'required' => false,
										'sort_order' => 10,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Display Settings' 
								],
								'landing_page' => [ 
										'type' => 'int',
										'label' => 'CMS Block',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Page',
										'required' => false,
										'sort_order' => 20,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Display Settings' 
								],
								'is_anchor' => [ 
										'type' => 'int',
										'label' => 'Is Anchor',
										'input' => 'select',
										'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
										'required' => false,
										'sort_order' => 30,
										'group' => 'Display Settings' 
								],
								'path' => [ 
										'type' => 'static',
										'label' => 'Path',
										'required' => false,
										'sort_order' => 12,
										'visible' => false,
										'group' => 'General Information' 
								],
								'position' => [ 
										'type' => 'static',
										'label' => 'Position',
										'required' => false,
										'sort_order' => 13,
										'visible' => false,
										'group' => 'General Information' 
								],
								'all_children' => [ 
										'type' => 'text',
										'required' => false,
										'sort_order' => 14,
										'visible' => false,
										'group' => 'General Information' 
								],
								'path_in_store' => [ 
										'type' => 'text',
										'required' => false,
										'sort_order' => 15,
										'visible' => false,
										'group' => 'General Information' 
								],
								'children' => [ 
										'type' => 'text',
										'required' => false,
										'sort_order' => 16,
										'visible' => false,
										'group' => 'General Information' 
								],
								'custom_design' => [ 
										'type' => 'varchar',
										'label' => 'Custom Design',
										'input' => 'select',
										'source' => 'Magento\Theme\Model\Theme\Source\Theme',
										'required' => false,
										'sort_order' => 10,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Custom Design' 
								],
								'custom_design_from' => [ 
										'type' => 'datetime',
										'label' => 'Active From',
										'input' => 'date',
										'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
										'required' => false,
										'sort_order' => 30,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Custom Design' 
								],
								'custom_design_to' => [ 
										'type' => 'datetime',
										'label' => 'Active To',
										'input' => 'date',
										'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
										'required' => false,
										'sort_order' => 40,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Custom Design' 
								],
								'page_layout' => [ 
										'type' => 'varchar',
										'label' => 'Page Layout',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Layout',
										'required' => false,
										'sort_order' => 50,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Custom Design' 
								],
								'custom_layout_update' => [ 
										'type' => 'text',
										'label' => 'Custom Layout Update',
										'input' => 'textarea',
										'backend' => 'Magento\Catalog\Model\Attribute\Backend\Customlayoutupdate',
										'required' => false,
										'sort_order' => 60,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Custom Design' 
								],
								'level' => [ 
										'type' => 'static',
										'label' => 'Level',
										'required' => false,
										'sort_order' => 24,
										'visible' => false,
										'group' => 'General Information' 
								],
								'children_count' => [ 
										'type' => 'static',
										'label' => 'Children Count',
										'required' => false,
										'sort_order' => 25,
										'visible' => false,
										'group' => 'General Information' 
								],
								'available_sort_by' => [ 
										'type' => 'text',
										'label' => 'Available Product Listing Sort By',
										'input' => 'multiselect',
										'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Sortby',
										'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Sortby',
										'sort_order' => 40,
										'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Category\Helper\Sortby\Available',
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Display Settings' 
								],
								'default_sort_by' => [ 
										'type' => 'varchar',
										'label' => 'Default Product Listing Sort By',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Sortby',
										'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Sortby',
										'sort_order' => 50,
										'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Category\Helper\Sortby\DefaultSortby',
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Display Settings' 
								],
								'include_in_menu' => [ 
										'type' => 'int',
										'label' => 'Include in Navigation Menu',
										'input' => 'select',
										'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
										'default' => '1',
										'sort_order' => 10,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'General Information' 
								],
								'custom_use_parent_settings' => [ 
										'type' => 'int',
										'label' => 'Use Parent Category Settings',
										'input' => 'select',
										'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
										'required' => false,
										'sort_order' => 5,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Custom Design' 
								],
								'custom_apply_to_products' => [ 
										'type' => 'int',
										'label' => 'Apply To Products',
										'input' => 'select',
										'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
										'required' => false,
										'sort_order' => 6,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Custom Design' 
								],
								'filter_price_range' => [ 
										'type' => 'decimal',
										'label' => 'Layered Navigation Price Step',
										'input' => 'text',
										'required' => false,
										'sort_order' => 51,
										'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Category\Helper\Pricestep',
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Display Settings' 
								] 
						] 
				],
				'catalog_product' => [ 
						'entity_model' => 'Magento\Catalog\Model\ResourceModel\Product',
						'attribute_model' => 'Magento\Catalog\Model\ResourceModel\Eav\Attribute',
						'table' => 'catalog_product_entity',
						'additional_attribute_table' => 'catalog_eav_attribute',
						'entity_attribute_collection' => 'Magento\Catalog\Model\ResourceModel\Product\Attribute\Collection',
						'attributes' => [ 
								'name' => [ 
										'type' => 'varchar',
										'label' => 'Name',
										'input' => 'text',
										'frontend_class' => 'validate-length maximum-length-255',
										'sort_order' => 1,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'searchable' => true,
										'visible_in_advanced_search' => true,
										'used_in_product_listing' => true,
										'used_for_sort_by' => true 
								],
								'sku' => [ 
										'type' => 'static',
										'label' => 'SKU',
										'input' => 'text',
										'frontend_class' => 'validate-length maximum-length-64',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Sku',
										'unique' => true,
										'sort_order' => 2,
										'searchable' => true,
										'comparable' => true,
										'visible_in_advanced_search' => true 
								],
								'description' => [ 
										'type' => 'text',
										'label' => 'Description',
										'input' => 'textarea',
										'sort_order' => 3,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'searchable' => true,
										'comparable' => true,
										'wysiwyg_enabled' => true,
										'is_html_allowed_on_front' => true,
										'visible_in_advanced_search' => true 
								],
								'short_description' => [ 
										'type' => 'text',
										'label' => 'Short Description',
										'input' => 'textarea',
										'sort_order' => 4,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'searchable' => true,
										'comparable' => true,
										'wysiwyg_enabled' => true,
										'is_html_allowed_on_front' => true,
										'visible_in_advanced_search' => true,
										'used_in_product_listing' => true,
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'price' => [ 
										'type' => 'decimal',
										'label' => 'Price',
										'input' => 'price',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Price',
										'sort_order' => 1,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'searchable' => true,
										'filterable' => true,
										'visible_in_advanced_search' => true,
										'used_in_product_listing' => true,
										'used_for_sort_by' => true,
										'apply_to' => 'simple,virtual',
										'group' => 'Prices' 
								],
								'special_price' => [ 
										'type' => 'decimal',
										'label' => 'Special Price',
										'input' => 'price',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Price',
										'required' => false,
										'sort_order' => 3,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'used_in_product_listing' => true,
										'apply_to' => 'simple,virtual',
										'group' => 'Prices',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'special_from_date' => [ 
										'type' => 'datetime',
										'label' => 'Special Price From Date',
										'input' => 'date',
										'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
										'required' => false,
										'sort_order' => 4,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'used_in_product_listing' => true,
										'apply_to' => 'simple,virtual',
										'group' => 'Prices',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'special_to_date' => [ 
										'type' => 'datetime',
										'label' => 'Special Price To Date',
										'input' => 'date',
										'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
										'required' => false,
										'sort_order' => 5,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'used_in_product_listing' => true,
										'apply_to' => 'simple,virtual',
										'group' => 'Prices',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'cost' => [ 
										'type' => 'decimal',
										'label' => 'Cost',
										'input' => 'price',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Price',
										'required' => false,
										'user_defined' => true,
										'sort_order' => 6,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'apply_to' => 'simple,virtual',
										'group' => 'Prices',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'weight' => [ 
										'type' => 'decimal',
										'label' => 'Weight',
										'input' => 'weight',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Weight',
										'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Weight',
										'sort_order' => 5,
										'apply_to' => 'simple,virtual',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'manufacturer' => [ 
										'type' => 'int',
										'label' => 'Manufacturer',
										'input' => 'select',
										'required' => false,
										'user_defined' => true,
										'searchable' => true,
										'filterable' => true,
										'comparable' => true,
										'visible_in_advanced_search' => true,
										'apply_to' => Type::TYPE_SIMPLE,
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'meta_title' => [ 
										'type' => 'varchar',
										'label' => 'Meta Title',
										'input' => 'text',
										'required' => false,
										'sort_order' => 20,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Meta Information',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'meta_keyword' => [ 
										'type' => 'text',
										'label' => 'Meta Keywords',
										'input' => 'textarea',
										'required' => false,
										'sort_order' => 30,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Meta Information',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'meta_description' => [ 
										'type' => 'varchar',
										'label' => 'Meta Description',
										'input' => 'textarea',
										'required' => false,
										'note' => 'Maximum 255 chars',
										'class' => 'validate-length maximum-length-255',
										'sort_order' => 40,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Meta Information',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'image' => [ 
										'type' => 'varchar',
										'label' => 'Base Image',
										'input' => 'media_image',
										'frontend' => 'Magento\Catalog\Model\Product\Attribute\Frontend\Image',
										'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Product\Helper\Form\BaseImage',
										'required' => false,
										'sort_order' => 0,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'used_in_product_listing' => true,
										'group' => 'General' 
								],
								'small_image' => [ 
										'type' => 'varchar',
										'label' => 'Small Image',
										'input' => 'media_image',
										'frontend' => 'Magento\Catalog\Model\Product\Attribute\Frontend\Image',
										'required' => false,
										'sort_order' => 2,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'used_in_product_listing' => true,
										'group' => 'Images' 
								],
								'thumbnail' => [ 
										'type' => 'varchar',
										'label' => 'Thumbnail',
										'input' => 'media_image',
										'frontend' => 'Magento\Catalog\Model\Product\Attribute\Frontend\Image',
										'required' => false,
										'sort_order' => 3,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'used_in_product_listing' => true,
										'group' => 'Images' 
								],
								'media_gallery' => [ 
										'type' => 'varchar',
										'label' => 'Media Gallery',
										'input' => 'gallery',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Media',
										'required' => false,
										'sort_order' => 4,
										'group' => 'Images' 
								],
								'old_id' => [ 
										'type' => 'int',
										'required' => false,
										'sort_order' => 6,
										'visible' => false 
								],
								'tier_price' => [ 
										'type' => 'decimal',
										'label' => 'Tier Price',
										'input' => 'text',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Tierprice',
										'required' => false,
										'sort_order' => 7,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'apply_to' => 'simple,virtual',
										'group' => 'Prices' 
								],
								'color' => [ 
										'type' => 'int',
										'label' => 'Color',
										'input' => 'select',
										'required' => false,
										'user_defined' => true,
										'searchable' => true,
										'filterable' => true,
										'comparable' => true,
										'visible_in_advanced_search' => true,
										'apply_to' => implode ( ',', [ 
												Type::TYPE_SIMPLE,
												Type::TYPE_VIRTUAL,
												Configurable::TYPE_CODE 
										] ),
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'news_from_date' => [ 
										'type' => 'datetime',
										'label' => 'Set Product as New from Date',
										'input' => 'date',
										'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
										'required' => false,
										'sort_order' => 7,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'used_in_product_listing' => true,
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'news_to_date' => [ 
										'type' => 'datetime',
										'label' => 'Set Product as New to Date',
										'input' => 'date',
										'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
										'required' => false,
										'sort_order' => 8,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'used_in_product_listing' => true,
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'gallery' => [ 
										'type' => 'varchar',
										'label' => 'Image Gallery',
										'input' => 'gallery',
										'required' => false,
										'sort_order' => 5,
										'group' => 'Images' 
								],
								'status' => [ 
										'type' => 'int',
										'label' => 'Status',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Product\Attribute\Source\Status',
										'sort_order' => 9,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'searchable' => true,
										'used_in_product_listing' => true 
								],
								'minimal_price' => [ 
										'type' => 'decimal',
										'label' => 'Minimal Price',
										'input' => 'price',
										'required' => false,
										'sort_order' => 8,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'visible' => false,
										'apply_to' => 'simple,virtual',
										'group' => 'Prices' 
								],
								'visibility' => [ 
										'type' => 'int',
										'label' => 'Visibility',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Product\Visibility',
										'default' => '4',
										'sort_order' => 12,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE 
								],
								'custom_design' => [ 
										'type' => 'varchar',
										'label' => 'Custom Design',
										'input' => 'select',
										'source' => 'Magento\Theme\Model\Theme\Source\Theme',
										'required' => false,
										'sort_order' => 1,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Design',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'custom_design_from' => [ 
										'type' => 'datetime',
										'label' => 'Active From',
										'input' => 'date',
										'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
										'required' => false,
										'sort_order' => 2,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Design',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'custom_design_to' => [ 
										'type' => 'datetime',
										'label' => 'Active To',
										'input' => 'date',
										'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
										'required' => false,
										'sort_order' => 3,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Design',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'custom_layout_update' => [ 
										'type' => 'text',
										'label' => 'Custom Layout Update',
										'input' => 'textarea',
										'backend' => 'Magento\Catalog\Model\Attribute\Backend\Customlayoutupdate',
										'required' => false,
										'sort_order' => 4,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Design' 
								],
								'page_layout' => [ 
										'type' => 'varchar',
										'label' => 'Page Layout',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Product\Attribute\Source\Layout',
										'required' => false,
										'sort_order' => 5,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Design',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => false 
								],
								'category_ids' => [ 
										'type' => 'static',
										'label' => 'Categories',
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Category',
										'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Category',
										'required' => false,
										'sort_order' => 9,
										'visible' => true,
										'group' => 'General' 
								],
								'options_container' => [ 
										'type' => 'varchar',
										'label' => 'Display Product Options In',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Entity\Product\Attribute\Design\Options\Container',
										'required' => false,
										'default' => 'container2',
										'sort_order' => 6,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'group' => 'Design' 
								],
								'required_options' => [ 
										'type' => 'static',
										'input' => 'text',
										'required' => false,
										'sort_order' => 14,
										'visible' => false,
										'used_in_product_listing' => true 
								],
								'has_options' => [ 
										'type' => 'static',
										'input' => 'text',
										'required' => false,
										'sort_order' => 15,
										'visible' => false 
								],
								'image_label' => [ 
										'type' => 'varchar',
										'label' => 'Image Label',
										'input' => 'text',
										'required' => false,
										'sort_order' => 16,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'visible' => false,
										'used_in_product_listing' => true 
								],
								'small_image_label' => [ 
										'type' => 'varchar',
										'label' => 'Small Image Label',
										'input' => 'text',
										'required' => false,
										'sort_order' => 17,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'visible' => false,
										'used_in_product_listing' => true 
								],
								'thumbnail_label' => [ 
										'type' => 'varchar',
										'label' => 'Thumbnail Label',
										'input' => 'text',
										'required' => false,
										'sort_order' => 18,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
										'visible' => false,
										'used_in_product_listing' => true 
								],
								'created_at' => [ 
										'type' => 'static',
										'input' => 'date',
										'sort_order' => 19,
										'visible' => false 
								],
								'updated_at' => [ 
										'type' => 'static',
										'input' => 'date',
										'sort_order' => 20,
										'visible' => false 
								],
								'country_of_manufacture' => [ 
										'type' => 'varchar',
										'label' => 'Country of Manufacture',
										'input' => 'select',
										'source' => 'Magento\Catalog\Model\Product\Attribute\Source\Countryofmanufacture',
										'required' => false,
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
										'visible' => true,
										'user_defined' => false,
										'searchable' => false,
										'filterable' => false,
										'comparable' => false,
										'visible_on_front' => false,
										'unique' => false,
										'apply_to' => 'simple,bundle',
										'group' => 'General',
										'is_used_in_grid' => true,
										'is_visible_in_grid' => false,
										'is_filterable_in_grid' => true 
								],
								'quantity_and_stock_status' => [ 
										'group' => 'General',
										'type' => 'int',
										'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Stock',
										'label' => 'Quantity',
										'input' => 'select',
										'input_renderer' => 'Magento\CatalogInventory\Block\Adminhtml\Form\Field\Stock',
										'source' => 'Magento\CatalogInventory\Model\Source\Stock',
										'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
										'default' => \Magento\CatalogInventory\Model\Stock::STOCK_IN_STOCK,
										'user_defined' => false,
										'visible' => true,
										'required' => false,
										'searchable' => false,
										'filterable' => false,
										'comparable' => false,
										'unique' => false 
								] 
						] 
				] 
		];
	}
}
