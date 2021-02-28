<?php
  /**
   * Registry
   * 
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: class_registry.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');


  abstract class Registry
  {
      static $objects = array();


      /**
       * Registry::get()
       * 
       * @param mixed $name
       * @return
       */
      public static function get($name)
      {
          return isset(self::$objects[$name]) ? self::$objects[$name] : null;
      }

      /**
       * Registry::set()
       * 
       * @param mixed $name
       * @param mixed $object
       * @return
       */
      public static function set($name, $object)
      {
          self::$objects[$name] = $object;
      }
  }
?>