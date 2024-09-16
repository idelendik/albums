<?php

declare(strict_types=1);

namespace Albums\interfaces\core;

use Albums\models\Image;

interface ImageUploaderInterface
{
    public function generateImagePath(string $uploadsPath, string $imageName): string;

    public function isSubfolder(string $basePath, string $targetPath): bool;

    public function isContainDeprecatedSymbols(string $path): bool;

    public function isPathValid(string $basePath, string $path): bool;

    public function create_folder(string $path): void;

    public function upload(Image $image): string;

    public function file_put_contents_force(string $path, mixed $data): void;
}