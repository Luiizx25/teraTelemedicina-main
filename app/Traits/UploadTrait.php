<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait {

    private function imageUpload($files, $folder='images',$imageColumnName=false)
    {
        if(is_null($files))
            return false;

        if(!is_array($files))
            $arrFiles[] = $files;
        else
            $arrFiles = $files;

        foreach ($arrFiles as $file)
        {
            if($imageColumnName)
                $uploadedImages[] = [$imageColumnName => $file->store($folder,'public')]; // folder = products / disk = public
            else
                $uploadedImages   = $file->store($folder,'public');
        }

        return $uploadedImages;
    }
    
    private function fileDelete($file = false)
    {
        if (!$file || !Storage::exists($file))
            return false;
        else
            return Storage::delete($file);
    }
}
