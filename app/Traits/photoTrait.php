<?php

namespace App\Traits;



Trait photoTrait
{
   function savephoto($photo,$folder)
    {

    $file_extension = $photo->extension();
    $file_name = time().'.'.$file_extension;
    $path = $folder;
    $photo ->move($path,$file_name);
    return $file_name;
    }

//getClientOriginalExtension  extension
}
