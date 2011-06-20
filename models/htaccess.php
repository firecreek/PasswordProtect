<?php

  /**
   * Htaccess Model
   *
   * @category Model
   * @package  Croogo
   * @version  1.0
   * @author   Darren Moore <darren.m@firecreek.co.uk>
   * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
   * @link     http://www.firecreek.co.uk
   */
  class Htaccess extends PasswordprotectAppModel
  {
    /**
     * Name
     *
     * @access public
     * @var string
     */
    public $name = 'Htaccess';
    
    /**
     * Use table
     *
     * @access public
     * @var boolean
     */
    public $useTable = false;
    
    /**
     * File object
     *
     * @access public
     * @var object
     */
    public $File = null;
    
    /**
     * File
     *
     * @access public
     * @var string
     */
    public $file = null;
    
    /**
     * Protection
     *
     * @access public
     * @var string
     */
    public $protection = null;
    
    /**
     * Has one
     *
     * @access public
     * @var array
     */
    public $hasOne = array(
      'Htpasswd' => array(
        'className' => 'Passwordprotect.Htpasswd'
      )
    );
    
    
    /**
     * Construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
      
      //File
      $this->file = ROOT.DS.'.htaccess';
      $this->File = new File($this->file);
      
      //Protection
      $protection = array();
      $protection[] = 'AuthType Basic';
      $protection[] = 'AuthName "Protected Area"';
      $protection[] = 'AuthUserFile '.$this->Htpasswd->file;
      $protection[] = 'Require valid-user';
      $this->protection = implode("\n",$protection);
    }
    
    
    /**
     * Check if enabled
     *
     * @access public
     * @return boolean
     */
    public function enabled()
    {
      $contents = $this->File->read();
      
      if(strpos($contents,'Require valid-user') !== false)
      {
        return true;
      }
      
      return false;
    }
    
    
    /**
     * Enable
     *
     * @access public
     * @return boolean
     */
    public function enable()
    {
      $this->disable();
      
      return $this->File->append("\n".$this->protection);
    }
    
    
    /**
     * Disable
     *
     * @access public
     * @return boolean
     */
    public function disable()
    {
      $contents = $this->File->read();
      
      //Lines to remove
      $remove = array();
      $protection = explode("\n",$this->protection);
      foreach($protection as $line)
      {
        $remove[] = '/'.substr($line,0,strpos($line,' ')).'.*$/s';
      }
      
      $newContents = preg_replace($remove,'',$contents);
      
      if($contents != $newContents)
      {
        return $this->File->write($newContents);
      }
      else
      {
        return false;
      }
      
    }
  
  
  }

?>