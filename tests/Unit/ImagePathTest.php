<?php

namespace Tests\Unit;

use App\Models\Image;
use PHPUnit\Framework\TestCase;

class ImagePathTest extends TestCase
{

    const TEST_HASH = "12341234123412341234123412341234";

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_image_path_building()
    {
        $path = Image::buildPath(ImagePathTest::TEST_HASH);
        $this->assertEquals("images/".ImagePathTest::TEST_HASH.".jpg", $path);
    }

    public function test_image_thumb_path_building()
    {
        $path = Image::buildPath(ImagePathTest::TEST_HASH, true);
        $this->assertEquals("images/".ImagePathTest::TEST_HASH."_thumb.jpg", $path);
    }
}
