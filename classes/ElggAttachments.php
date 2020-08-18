<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ElggAttachments extends ElggFile {

    const SUBTYPE = 'attachments';

    public function initializeAttributes() {
      parent::initializeAttributes();
      $this->attributes['subtype'] = self::SUBTYPE;
    }


   public function getDisplayName() {
      $name = parent::getDisplayName();
      
      if (!$name) {
        $name = elgg_echo('untitled');
     }

     return $name;
   }
   
   public function saveArchive($name) {
		$uf = get_uploaded_file($name);
		if (!$uf) {
			return FALSE;
		}
		$this->open("write");
		$this->write($uf);
		$this->close();

		return true;
	}

}

