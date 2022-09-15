<?php

//use Carbon\Carbon;
if (! function_exists('uniqueNameAndMove')) {
    function uniqueNameAndMove($file, $path){
            $original_image_name = $file->getClientOriginalName();
            $new_image_name = uniqid() . $original_image_name;
            $file->move(public_path($path), $new_image_name);
            return $new_image_name;
    }
}
