<?php

// GET PROJECTS

use App\Models\Project;

function projects() {
    $projects = Project::where('status', 1)->get();
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