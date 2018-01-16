<?php 

if (!defined('_PS_VERSION_')) {
  exit;
}

class basic_plugin extends Module
{
     public function __construct()
  {
    $this->name = 'basic_plugin';
    $this->tab = 'front_office_features';
    $this->version = '1';
    $this->author = 'Wirecard Romania';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Wirecard Payment');
    $this->description = $this->l('Pay simple and safe with Wirecard Payment.');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    if (!Configuration::get('MYMODULE_NAME')) {
      $this->warning = $this->l('No name provided');
    }
  }
  
public function install()
{
  if (Shop::isFeatureActive()) {
    Shop::setContext(Shop::CONTEXT_ALL);
  }
 
  if (!parent::install() ||
    !$this->registerHook('leftColumn') ||
    !$this->registerHook('header') ||
    !Configuration::updateValue('MYMODULE_NAME', 'my friend')
  ) {
    return false;
  }
 
  return true;
}

public function uninstall()
{
 if (!parent::uninstall() ||
    !Configuration::deleteByName('MYMODULE_NAME')
  ) {
    return false;
  }
 
  return true;
}



}
?>