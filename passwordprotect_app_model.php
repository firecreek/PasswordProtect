<?php

  class PasswordprotectAppModel extends AppModel {

    public function exists()
    {
      return file_exists($this->file);
    }

    public function writable()
    {
      return is_writable($this->file);
    }

    public function readable()
    {
      return is_readable($this->file);
    }

  }

?>