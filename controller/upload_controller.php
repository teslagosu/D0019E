<?php
include_once __DIR__."/../model/message.php";
include_once __DIR__."/../constants.php";
//check if file exist, if it does rename it


function uploadImage($fileName){
    $upload_error = array(
        UPLOAD_ERR_OK          => "Inga fel.",
        UPLOAD_ERR_INI_SIZE    => "Filen är större än den storlek som anges i php.ini (upload_max_filesize).",
        UPLOAD_ERR_FORM_SIZE   => "Filen är större än den största filstorlek som angets i formuläret (MAX_FILE_SIZE).",
        UPLOAD_ERR_PARTIAL     => "Filen blev delvis uppladdad.",
        UPLOAD_ERR_NO_FILE     => "Ingen fil är vald.",
        UPLOAD_ERR_NO_TMP_DIR  => "Ingen temporär katalog finns på webbservern.",
        UPLOAD_ERR_CANT_WRITE  => "Kan inte skriva till disk.",
        UPLOAD_ERR_EXTENSION   => "Filuppladdningen är stoppad av ett tillägg (extension)."
    );
    $message = "";
    $tmp_file = $_FILES['reg_image']['tmp_name'];
    $upload_dir = __DIR__."../uploads/";
    $target_file = basename($_FILES['reg_image']['name']);

    // Glöm inte att kontrollera om filen redan finns,
    // och bestäm vad som ska hända om den gör det.
    // Använd php-funktionen file_exists() för att kontrollera
    // detta och utför sedan lämplig åtgärd om den finns.
    move_uploaded_file($tmp_file, $upload_dir . $target_file);
    // Om move_uploaded_file returnerar true så gick uppladdningen bra
    if(move_uploaded_file($tmp_file, $upload_dir . $target_file))
    {
        $message = uploadSuccessful();
    }

    // Något gick fel vid uppladdningen
    else
    {
        $error = $_FILES['file_upload']['error'];
        $message = $upload_error[$error];
    }

}

function renameFile($imgFile){
   if($pos = strrpos($imgFile,'.')){
       $name = substr($imgFile,0,$pos);
       $ext = substr($imgFile,$pos);
   }else{
       $name = $imgFile;
   }


    $count=1;
    $newImageFileName = $imgFile;

    $path = base."images/".$imgFile;
    console_log($path);
    while(file_exists($path)){
        $newImageFileName = $name.'_'.$count.$ext;
        $count++;
    }

    return $newImageFileName;
}



function doesImageNameExist($imageName){
    if(base."uploads/".$imageName == $imageName){
        return true;
    }else{
        return false;
    }

}


?>
