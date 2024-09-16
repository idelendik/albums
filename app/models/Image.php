<?php

declare(strict_types=1);

namespace Albums\models;

use Albums\core\Model;

class ImageException extends \Exception
{
}

class Image extends Model
{
    private array $imageFileMeta;
    private string $imageName;
    private string $imageContent;
    private string $mimeType;

    public function __construct(array $fileData)
    {
        $NAME_LENGTH = 10;

        $imageFileTmpName = $this->getFileTmpName($fileData);

        $this->mimeType = $this->getMimeType($fileData);

        $this->imageFileMeta = $this->getFileMeta($imageFileTmpName);

        $this->imageName = bin2hex(random_bytes($NAME_LENGTH)); // TODO: rethink it

        $this->imageContent = $this->getFileContent($imageFileTmpName);
    }

    private function getFileTmpName(array $fileData): string
    {
        $IMAGE_TMP_NAME_INDEX_IN_FILE_DATA_ARRAY = "tmp_name";

        if (!isset($fileData[$IMAGE_TMP_NAME_INDEX_IN_FILE_DATA_ARRAY])) {
            throw new ImageException("An error occurred while getting file temporary name");
        }

        return $fileData[$IMAGE_TMP_NAME_INDEX_IN_FILE_DATA_ARRAY];
    }

    private function getFileMeta(string $imageTempName): array
    {
        $meta = getimagesize($imageTempName);
        if (false === $meta) {
            throw new ImageException("An error occurred while getting image meta");
        }

        return $meta;
    }

    private function getFileContent(string $fileName): string
    {
        $imageFileContent = file_get_contents($fileName);
        if (false === $imageFileContent) {
            throw new ImageException("An error occurred while getting image content");
        }

        return $imageFileContent;
    }

    private function getMimeType(array $fileData): string
    {
        $mimeType = $fileData['type'];
        if (false === $mimeType) {
            throw new ImageException("An error occurred while getting image mime type");
        }

        return $mimeType;
    }

    public function getName(): string
    {
        return $this->imageName . $this->getExtension($this->imageFileMeta);
    }

    public function getContent(): string
    {
        return $this->imageContent;
    }

    private function getExtensionType(array $fileData): int
    {
        $IMAGE_TYPE_INDEX_IN_ITS_META_ARRAY = 2;

        if (!isset($fileData[$IMAGE_TYPE_INDEX_IN_ITS_META_ARRAY])) {
            throw new ImageException("An error occurred while getting image extension type");
        }

        return $fileData[$IMAGE_TYPE_INDEX_IN_ITS_META_ARRAY];
    }

    private function getExtension(array $fileData): string
    {
        $fileExtension = image_type_to_extension($this->getExtensionType($fileData));
        if (false === $fileExtension) {
            throw new ImageException("An error occurred while getting image extension");
        }

        return $fileExtension;
    }

    public function addNameAppendix(string $appendix): void
    {
        $this->imageName .= $appendix;
    }

    public function setContent(string $content): void
    {
        $this->imageContent = $content;
    }

    public function mimeType(): string
    {
        return $this->mimeType;
    }
}
