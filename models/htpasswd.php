<?php

  /**
   * Htpasswd Model
   *
   * @category Model
   * @package  Croogo
   * @version  1.0
   * @author   Darren Moore <darren.m@firecreek.co.uk>
   * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
   * @link     http://www.firecreek.co.uk
   */
  class Htpasswd extends PasswordprotectAppModel
  {
    /**
     * Name
     *
     * @access public
     * @var string
     */
    public $name = 'Htpasswd';
    
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
     * Construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
      
      $this->file = APP.'.htpasswd';
      $this->File = new File($this->file);
    }
    
    
    /**
     * Find records
     *
     * @access public
     * @return array
     */
    public function find()
    {
      $output = array();
    
      $lines = $this->File->read();
      $lines = explode("\n",$lines);
      
      if(count($lines) > 0)
      {
        foreach($lines as $line)
        {
          $line = trim($line);
          
          if(strpos($line,':') !== false)
          {
            $output[] = array(
              $this->alias => array(
                'username' => substr($line,0,strpos($line,':')),
                'password' => substr($line,strpos($line,':')+1)
              )
            );
          }
        }
      }
      
      return $output;
    }
    
    
    /**
     * Delete record
     *
     * @access public
     * @return array
     */
    public function delete($username)
    {
      $output = null;
      $records = $this->find();
      
      foreach($records as $record)
      {
        if($record[$this->alias]['username'] != $username)
        {
          $output .= $record[$this->alias]['username'].':'.$record[$this->alias]['password']."\n";
        }
      }
      
      return $this->File->write($output);
    }
    
    
    /**
     * Save record
     *
     * @access public
     * @return array
     */
    public function save($data)
    {
      $this->delete($data['Htpasswd']['username']);
    
      $data['Htpasswd']['password'] = crypt($data['Htpasswd']['password'], base64_encode($data['Htpasswd']['password']));
      
      return $this->File->append("\n".$data['Htpasswd']['username'].':'.$data['Htpasswd']['password']);
    }
    
  
  }

?>