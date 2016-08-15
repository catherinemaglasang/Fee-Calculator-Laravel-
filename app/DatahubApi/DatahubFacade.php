<?php 

namespace Thirty98\DatahubApi;

use Illuminate\Support\Facades\Facade;

class DatahubFacade extends Facade {
   protected static function getFacadeAccessor() { return 'datahubApi'; }
}

 // EOF