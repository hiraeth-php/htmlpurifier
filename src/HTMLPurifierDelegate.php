<?php

namespace Hiraeth\HTMLPurifier;

use Hiraeth;
use HTMLPurifier;
use HTMLPurifier_Config;

/**
 *
 */
class HTMLPurifierDelegate implements Hiraeth\Delegate
{
	/**
	 * Get the class for which the delegate operates.
	 *
	 * @static
	 * @access public
	 * @return string The class for which the delegate operates
	 */
	static public function getClass()
	{
		return 'HTMLPurifier';
	}


	/**
	 * Get the interfaces for which the delegate provides a class.
	 *
	 * @static
	 * @access public
	 * @return array A list of interfaces for which the delegate provides a class
	 */
	static public function getInterfaces()
	{
		return [];
	}


	/**
	 *
	 */
	public function __construct(Hiraeth\Application $app, Hiraeth\Configuration $config)
	{
		$this->app    = $app;
		$this->config = $config;
	}


	/**
	 * Get the instance of the class for which the delegate operates.
	 *
	 * @access public
	 * @param Hiraeth\Broker $broker The dependency injector instance
	 * @return Object The instance of the class for which the delegate operates
	 */
	public function __invoke(Hiraeth\Broker $broker)
	{
		$config     = HTMLPurifier_Config::createDefault();
		$cache_path = $this->app->getDirectory(
			$this->config->get('htmlpurifier', 'cache_path', 'writable/cache/htmlpurifier'),
			TRUE
		);

		foreach ([
			'Cache.SerializerPath'              => $cache_path,
			'Cache.SerializerPermissions'       => 0775,
			'AutoFormat.RemoveEmpty.RemoveNbsp' => $this->config->get('htmlpurifier', 'remove_empty', TRUE),
			'AutoFormat.RemoveEmpty'            => $this->config->get('htmlpurifier', 'remove_empty', TRUE),
			'HTML.Trusted'                      => $this->config->get('htmlpurifier', 'trusted', FALSE),
			'HTML.ForbiddenAttributes'          => $this->config->get('htmlpurifier', 'forbidden.attributes', []),
			'HTML.ForbiddenElements'            => $this->config->get('htmlpurifier', 'forbidden.elements', []),
			'Attr.ForbiddenClasses'             => $this->config->get('htmlpurifier', 'forbidden.classes', []),
		] as $setting => $value) {
			$config->set($setting, $value);
		}

		return new HTMLPurifier($config);
	}
}
