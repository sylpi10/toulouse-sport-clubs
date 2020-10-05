<?php

namespace App\Data;

use App\Entity\PostalCode;
use phpDocumentor\Reflection\Types\Integer;

class SearchData
 {

    /**
     * @var string
     */
     public $q = '';
    
    /**
     * @var string
     */
     public $cat = '';

     /**
      * @var PostalCode
      */
      public $postals = [];
  
    /**
     * 
     */
    // public $d31000;
    // /**
    //  * 
    //  */
    // public $d31100;
    // /**
    //  * 
    //  */
    // public $d31400;
 }
    