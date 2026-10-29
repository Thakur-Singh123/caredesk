<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('upload_and_resize_image')) {
    function upload_and_resize_image($file, $folder = 'profile-images', $maxDimension = 300, $oldImagePath = null)
    {
        // 1. Delete old image if it exists in storage
        if ($oldImagePath) {
            $fullOldPath = $folder . '/' . $oldImagePath;
            if (Storage::disk('public')->exists($fullOldPath)) {
                Storage::disk('public')->delete($fullOldPath);
            }
        }

        // 2. Ensure directory exists automatically
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        // 3. Generate a unique file name
        $filename = 'img_' . uniqid() . '_' . time() . '.jpg';
        $destinationPath = storage_path('app/public/' . $folder);
        $filePath = $destinationPath . '/' . $filename;

        // 4. Get original image dimensions and type
        list($width, $height) = getimagesize($file->getRealPath());
        $extension = strtolower($file->getClientOriginalExtension());

        $src = match ($extension) {
            'png' => imagecreatefrompng($file->getRealPath()),
            default => imagecreatefromjpeg($file->getRealPath()),
        };

        // 5. Calculate new dimensions while preserving the aspect ratio (Fixed math operators)
        if ($width > $height) {
            $newWidth = $maxDimension;
            $newHeight = floor($height * ($maxDimension / $width));
        } else {
            $newHeight = $maxDimension;
            $newWidth = floor($width * ($maxDimension / $height));
        }

        // 6. Create resized image resource
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        
        $white = imagecolorallocate($tmp, 255, 255, 255);
        imagefilledrectangle($tmp, 0, 0, $newWidth, $newHeight, $white);

        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // 7. Save compressed image as high-quality JPEG
        imagejpeg($tmp, $filePath, 80);
        imagedestroy($src);
        imagedestroy($tmp);

        // 8. Return ONLY the file name to be saved in the database
        return $filename;
    }

    if (!function_exists('get_profile_image')) {
        /**
         * Get the full URL for the user's profile image or return a default avatar.
         *
         * @param string|null $imageName
         * @param string $folder
         * @return string
         */
        function get_profile_image($imageName, $folder = 'profile-images')
        {
            if ($imageName) {
                // Check if it already contains the full path or just the filename
                $path = str_contains($imageName, $folder) ? $imageName : $folder . '/' . $imageName;
                
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                    return asset('storage/' . $path);
                }
            }

            // Default fallback avatar if no image exists or file is missing
            return asset('no-image.png');
        }
    }
}