<?php

declare(strict_types=1);

namespace Albums\core;

use Albums\models\Image;

class ThumbnailGenerator
{
    private Image $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function generate(int $width, int $height = -1): Image
    {
        $srcGdImage = imagecreatefromstring($this->image->getContent());
        $dstGdImage = imagescale($srcGdImage, $width, $height);

        switch ($this->image->mimeType()) {
            case 'image/jpeg':
                // TODO: investigate imagecreatefromjpeg();
                $processorFn = 'imagejpeg';
                break;
            case 'image/png':
                $processorFn = 'imagepng';
                break;
            default:
                throw new \Exception("Unsupported image format");
        }

        ob_start();
        call_user_func($processorFn, $dstGdImage);
        $imageContent = ob_get_clean();

        $this->image->addNameAppendix("_thumb");
        $this->image->setContent($imageContent);

        return $this->image;
    }
}