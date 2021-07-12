<?php

namespace App\Http\Traits;

trait UploadTrait
{
    public function foto_profil_upload($query,$id_pengguna){
        $ext = strtolower($query->getClientOriginalExtension());
        $image_full_name = $id_pengguna . '/' . $ext;
        $upload_path = 'Images/Avatar/';
        $image_url = $upload_path.$image_full_name;
        $success = $query->move($upload_path,$image_full_name);
        return $image_url;
    }
}
