<?php

declare(strict_types=1);

namespace Tests\core;

use Albums\core\ImageUploader;
use PHPUnit\Framework\TestCase;

class ImageUploaderTest extends TestCase
{
    /** @test */
    public function generateImagePath_returns_result_if_image_name_valid()
    {
        $imageUploader = new ImageUploader();

        $path = $imageUploader->generateImagePath("uploads", "validImageName.jpg");

        $this->assertEquals("uploads" . DIRECTORY_SEPARATOR . "validImageName.jpg", $path);
    }

    /** @test */
    public function generateImagePath_throws_if_image_name_invalid()
    {
        $imageUploader = new ImageUploader();

        $this->expectException(\Exception::class);

        $imageUploader->generateImagePath("uploads", "invalid" . DIRECTORY_SEPARATOR . "ImageName.jpg");
    }

    /** @test */
    public function isSubfolder_returns_true_for_valid_subfolder()
    {
        $imageUploader = new ImageUploader();

        $this->assertTrue($imageUploader->isSubfolder("base/path", "base/path/subfolder"));
    }

    /** @test */
    public function isSubfolder_returns_false_for_invalid_subfolder()
    {
        $imageUploader = new ImageUploader();

        $this->assertFalse($imageUploader->isSubfolder("base/path", "base/pathDiff/subfolder"));
    }

    /** @test */
    public function isContainDeprecatedSymbols_returns_true_if_contains_deprecated_symbols()
    {
        $this->assertTrue((new ImageUploader())->isContainDeprecatedSymbols("base/../path"));
    }

    /** @test */
    public function isContainDeprecatedSymbols_returns_false_if_does_not_contain_deprecated_symbols()
    {
        $this->assertFalse((new ImageUploader())->isContainDeprecatedSymbols("base/path"));
    }

    /** @test */
    public function isPathValid_returns_true_if_path_is_valid()
    {
        $this->assertTrue((new ImageUploader())->isPathValid("base/path", "base/path/folder"));
    }

    /** @test */
    public function isPathValid_returns_false_if_path_is_not_valid()
    {
        $this->assertFalse((new ImageUploader())->isPathValid("base/path", "base/path/../folder"));
    }
}