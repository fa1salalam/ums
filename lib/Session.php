<?php

class Session
{

  /**
   * Initialize Session
   * @return session will start
   */
  public static function init()
  {
    if (version_compare(phpversion(), '5.4.0', '<')) {
      if (session_id() == '') {
        session_start();
      }
    }else{
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
    }
  }

  /**
   * Set Session value
   * @param String or Integer $key and $val a Peramenter summary
   * @return Just set Seesion key
   */
  public static function set($key, $val)
  {
    $_SESSION[$key] = $val;
  }

  /**
   * Get Session Value by key
   * @param String or Integer $key a peremeter summary
   * @return Session value or boolean value a value summary
   */
  public static function get($key)
  {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }else{
      return false;
    }
  }

  /**
   * To Destroy Session
   * @return login page and unset Session values
   */
  public static function destroy()
  {
    session_destroy();
    session_unset();
    header('Location:login.php');
  }

  /**
   * Check Seession value exist or not exist
   * @return login page and destroy all session 
   */
  public static function CheckSession()
  {
    if (self::get('login') == FALSE) {
      session_destroy();
      header('Location:login.php');
    }
  }

  /**
   * Check Login
   * @return index page if login seession is true
   */
  public static function CheckLogin()
  {
    if (self::get("login") == TRUE) {
      header('Location:index.php');
    }
  }
}

?>
