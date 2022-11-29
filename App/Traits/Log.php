<?php

namespace App\Traits;

trait Log{
  public static function gravarLog(){
    echo "--------------------------------\n";
    echo date("Y-m-d H:i:s");
    echo "\n";

    echo get_class();
    echo "\n";

    echo "--------------------------------\n\n";
  }
}