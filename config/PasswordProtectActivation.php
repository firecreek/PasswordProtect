<?php

  /**
   * Password Protect Activation
   *
   * @package  Croogo
   * @author   Darren Moore <darren.m@firecreek.co.uk>
   * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
   * @link     http://www.firecreek.co.uk
   */
  class PasswordProtectActivation {
  /**
   * onActivate will be called if this returns true
   *
   * @param  object $controller Controller
   * @return boolean
   */
      public function beforeActivation(&$controller) {
          return true;
      }
  /**
   * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
   *
   * @param object $controller Controller
   * @return void
   */
      public function onActivation(&$controller) {
          // ACL: set ACOs with permissions
          $controller->Croogo->addAco('PasswordProtect');
          $controller->Croogo->addAco('PasswordProtect/admin_index');
          $controller->Croogo->addAco('PasswordProtect/admin_add');
          $controller->Croogo->addAco('PasswordProtect/admin_edit');
          $controller->Croogo->addAco('PasswordProtect/admin_delete');
          $controller->Croogo->addAco('PasswordProtect/admin_enable');
          $controller->Croogo->addAco('PasswordProtect/admin_disable');
      }
      
  /**
   * onDeactivate will be called if this returns true
   *
   * @param  object $controller Controller
   * @return boolean
   */
      public function beforeDeactivation(&$controller) {
          return true;
      }
      
  /**
   * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
   *
   * @param object $controller Controller
   * @return void
   */
      public function onDeactivation(&$controller) {
          // ACL: remove ACOs with permissions
          $controller->Croogo->removeAco('PasswordProtect');
      }
      
  }
  
?>