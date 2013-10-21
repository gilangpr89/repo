<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initConfig ()
    {
        $config = new Zend_Config($this->getOptions(), true);
        Zend_Registry::set('config', $config);
        return $config;
    }
    
	protected function _initRequest ()
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $config = Zend_Registry::get('config');
        $app = $config->get('app');
        if (isset($_SERVER['SERVER_NAME']) && $app->get('domain','nodomain') == $_SERVER['SERVER_NAME']) {
            if ($app->get('domain',false) !== false)
                $request->setBaseUrl($app->get('base_url','/'));
            else
                $request->setBaseUrl('/');
        } else {
            $request->setBaseUrl($app->get('base_url','/'));
        }
        $front->setRequest($request);
        return $request;
    }

    protected function _initTimezone()
    {
        $defaultTimezone = 'Asia/Jakarta';
        $config = Zend_Registry::get('config');
        $app = $config->get('app');
        $timeZone = $app->get('timezone', $defaultTimezone);
        date_default_timezone_set($timeZone);
    }
    
    protected function _initAutoload() {
    	
    	$front = $this->bootstrap("frontController")->frontController;
    	$modules = $front->getControllerDirectory();
    	$default = $front->getDefaultModule();
    	foreach (array_keys($modules) as $module) {
    		if ($module === $default) {
    			continue;
    		}
    		$moduleloader = new Zend_Application_Module_Autoloader(array(
    				'namespace' => $module,
    				'basePath'  => $front->getModuleDirectory($module)));
    	}
    }
    
    protected function _initNamespaces()
    {
        $al = Zend_Loader_Autoloader::getInstance();
        $al->registerNamespace('MyIndo_');
        $al->registerNamespace('fpdf_');
    }
    
    protected function _initPlugin()
    {
    	$front = Zend_Controller_Front::getInstance();
    	$front->registerPlugin(new MyIndo_Api_Acl(), 1);

    }
}