<?php

class elFinderVolumeMyDriver extends elFinderVolumeLocalFileSystem {
  // ...

  // Command to implement
  public function desc($target, $newdesc = NULL) {
    // get readable path from hash
    $path = $this->decode($target);

    if ($newdesc == NULL) {
      // Get current the description
      $desc = $this->getYourCoolDescription($target);
    } else {
      // Write a new description
      $desc = $this->writeYourCoolDescription($target, $newdesc);
    }

    return $desc;
  }

  // Get a description of the $target
  // @return the description if it exists; -1 otherwise
  protected function getYourCoolDescription($target) {
    // Your implementation here
    // This one just returns 'desc' every time
    return 'desc';
  }

  // Writing a description for the $target
  // @return the description if successful; -1 otherwise
  protected function writeYourCoolDescription($target, $newdesc) {
    // Your implementation here
    // This one just returns the new description
    return $newdesc;
  }

  // ...
}
