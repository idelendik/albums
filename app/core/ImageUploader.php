<?php

declare(strict_types=1);

namespace Albums\core;

use Albums\interfaces\core\ImageUploaderInterface;
use Albums\models\Image;

class ImageUploader implements ImageUploaderInterface
{
    private const PATH_UPLOADS_RELATIVE = "/storage/uploads";

    public function generateImagePath(
        string $uploadsPath,
        string $imageName
    ): string
    {
        switch (true) {
            case str_contains($imageName, DIRECTORY_SEPARATOR):
            case str_contains($imageName, ".."):
                throw new \Exception("Can't generate image path. Image name contains invalid characters.");
            default:
                return $uploadsPath . DIRECTORY_SEPARATOR . $imageName;
        }
    }

    public function isSubfolder(string $basePath, string $targetPath): bool
    {
        /**
         * we don't use str_starts_with() here
         * because it considers that for example 'base/pathDiff/subfolder' is a subfolder 'base/path'
         * however in this case 'base/path' and 'base/pathDiff' are sibling folders
         */

        $basPathParts = explode(DIRECTORY_SEPARATOR, $basePath);
        $targetPathParts = explode(DIRECTORY_SEPARATOR, $targetPath);

        foreach ($basPathParts as $idx => $pathPart) {
            if ($pathPart !== $targetPathParts[$idx]) {
                return false;
            }
        }

        return true;
    }

    public function isContainDeprecatedSymbols(string $path): bool
    {
        // to prevent creating folders outside the project root
        $deprecatedSymbols = [".."];

        foreach ($deprecatedSymbols as $deprecatedSymbol) {
            if (str_contains($path, $deprecatedSymbol)) {
                return true;
            }
        }

        return false;
    }

    public function isPathValid(string $basePath, string $path): bool
    {
        if ($this->isContainDeprecatedSymbols($path)) {
            return false;
        }

        if (!$this->isSubfolder($basePath, $path)) {
            return false;
        }

        return true;
    }

    public function create_folder(string $path): void
    {
        if (!(new ImageUploader())->isPathValid(PATH_BASE, $path)) {
            throw new \Exception("invalid path provided");
        }

        $path_to_create = explode(PATH_BASE, rtrim($path, DIRECTORY_SEPARATOR))[1];
        $path_parts_to_create = array_slice(explode(DIRECTORY_SEPARATOR, $path_to_create), 1);

        $current_path = PATH_BASE;

        foreach ($path_parts_to_create as $path_part) {
            $current_path .= "/$path_part";

            if (!file_exists($current_path)) {
                mkdir($current_path);
            }
        }
    }

    public function upload(Image $image): string
    {
        $file_name = $image->getName();
        $file_content = $image->getContent();

        $path_relative = $this->generateImagePath(self::PATH_UPLOADS_RELATIVE, $file_name);
        $path_absolute = $this->generateImagePath(PATH_UPLOADS, $file_name);

        $this->file_put_contents_force($path_absolute, $file_content);

        return $path_relative;
    }

    public function file_put_contents_force(string $path, mixed $data): void
    {
        $this->create_folder(PATH_UPLOADS);

        file_put_contents($path, $data);
    }
}