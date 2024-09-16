<?php

declare(strict_types=1);

namespace Albums\core;

class Validator
{
    public static function string(string $value, int $min_length = 0, int $max_length = 255): ?string
    {
        $error_message = null;

        $value = trim($value);

        if ((strlen($value) < $min_length) || ($max_length < strlen($value))) {
            $error_message = "${$value} should be between ${min_length} and ${max_length} chars long";
        }

        return $error_message;
    }

    public static function image(array $file): bool
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('Failed to upload file ');
        }

        $maxFileSize = 3 * 1024 * 1024;
        if ($file['size'] > $maxFileSize) {
            throw new \Exception("The file is too large. Max {$maxFileSize
            } Mb");
        }

        $originalFileName = $file['name'];
        if (!preg_match("/^[A-Za-z0-9\s._-]+$/", $originalFileName)) {
            throw new \Exception('The filename contains illegal characters');
        }

        $fileMimeType = $file['type'];
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        if (!in_array($fileMimeType, $allowedMimeTypes)) {
            throw new \Exception('Invalid MIME type');
        }

        return true;
    }
}
