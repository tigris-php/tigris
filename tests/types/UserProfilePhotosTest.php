<?php


use Tigris\Telegram\Types\Arrays\PhotoSizeMatrix;
use Tigris\Telegram\Types\UserProfilePhotos;

class UserProfilePhotosTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = UserProfilePhotos::parse([
            [
            'total_count' => 12,
                'photos' => [
                    [
                        'file_id' => 'foobar',
                        'width' => 640,
                        'height' => 480,
                        'file_size' => 1024,
                    ],
                    [
                        'file_id' => 'foobar',
                        'width' => 640,
                        'height' => 480,
                        'file_size' => 1024,
                    ],
                ]
            ],
        ]);

        $this->assertInstanceOf(UserProfilePhotos::class, $a);
        $this->assertAttributeInstanceOf(PhotoSizeMatrix::class, 'photos', $a);
    }
}