<?php

// GET PROJECTS

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

function projects() {
    $projects = Project::where('status', 1);
    return $projects;
}

function resizeAndSaveImage($base64Image, $sizes, $name, $path){

    // Directory to save images
    $uploadDir = public_path('storage/' . $path);
            
    // Create the directory if it doesn't exist
    if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

    foreach ($sizes as $value) {

        // GET TYPE AND IMAGE ENCRYPTED AND DECRYPT HER
        $image_parts = explode(";base64,", $base64Image);
        $image_base64 = base64_decode($image_parts[1]);

        // Resize the image
        $img = imagecreatefromstring($image_base64);
        $resized = imagescale($img, $value);

        // Save the resized image
        imagejpeg($resized, $uploadDir . $name . '-' . $value . 'px.jpg');

        // Free up memory
        imagedestroy($img);
        imagedestroy($resized);
    }

}


function findImage($pathAndFile){

    if(Storage::disk('public')->exists($pathAndFile)){
        $url = asset('storage/' . $pathAndFile);
    } else {
        $url = asset('/assets/media/avatars/blank.png');
    }

    return $url;

}

// PUT THE BACKGROUND IN THE TEXT COLOR
function hex2rgb($colour, $opacity) {
    
    // REMOVE # FROM STRING
    $colour = ltrim($colour, '#');

    // EXTRACT RGB FROM HEX
    $rgb = sscanf($colour, '%2x%2x%2x');
    $rgb[] = $opacity;

    // RETURN RGBA
    return sprintf('rgb(%d, %d, %d, %d%%)', ...$rgb);

}