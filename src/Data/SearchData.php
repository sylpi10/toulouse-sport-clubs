<?php

namespace App\Data;

use App\Entity\Category;
use App\Entity\PostalCode;
use App\Entity\SportClub;
use App\Repository\SportClubRepository;
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
     private $cat = '';

     /**
      * @var PostalCode
      */
      public $postals;

      /**
       * @var Category
       */
      public $categories;   
  

 }
