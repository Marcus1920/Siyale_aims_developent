<?php

class myelFinder extends elFinder {
  // Custom error message if description isn't found
  const ERROR_DESC_NOT_FOUND = 'Description not found';

  // ...

  // Modify the constructor
  // Run the old constructor and register 'desc' as a new command
  public function __construct($opts) {
    parent::__construct($opts);
    $this->commands['desc'] = array('target' => TRUE, 'content' => FALSE);
  }

  // Implement the desc command
  protected function desc($args) {
    // Get the target directory and $desc parameter
    $target = $args['target'];
    $desc   = $args['content'];

    // Get the volume, and if successful, the file
    $volume = $this->volume($target);
    $file   = $volume ? $volume->file($target) : false;

    // Check if desc is disabled, and if we can get the true description
    $disabled = $volume ? $volume->commandDisabled('desc') : false;
    $desc     = (!$disabled && $volume) ? $volume->desc($target, $desc) : false;

    // Start accumulating the results
    $results = array();

    if (!$file) {
      // File not found; send "file not found" error message
      $results['error'] = $this->error(self::ERROR_FILE_NOT_FOUND);
    } elseif ($disabled) {
      // Command disabled; send "access denied" messsage, with filename
      $results['error'] = $this->error(self::ERROR_ACCESS_DENIED, $file['name']);
    } elseif ($desc == -1) {
      // No description; send "description not found" message, with filename
      $results['error'] = $this->error(self::ERROR_DESC_NOT_FOUND, $file['name']);
    } else {
      // Success!
      $results['desc'] = $desc;
    }

    return $results;
  }

  // ...
}
