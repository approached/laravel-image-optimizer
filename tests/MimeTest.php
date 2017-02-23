<?php

class MimeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->originalFile = __DIR__.'/files/mime-testimage.png'; // jpg mime type
        $this->compressedFile = $temp_file = sys_get_temp_dir().'/php_image_optimizer.PNG';
        copy($this->originalFile, $this->compressedFile);
    }

    public function tearDown()
    {
        unlink($this->compressedFile);
        parent::tearDown();
    }

    /**
     * @test
     */
    public function it_converts_file_with_different_mime_and_extension()
    {
        /** @var \Approached\LaravelImageOptimizer\ImageOptimizer $imageOptimizer */
        $imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');

        // check original file
        $this->assertTrue(file_exists($this->originalFile));
        $this->printFileInformation($this->originalFile);

        // compress
        $imageOptimizer->optimizeUploadedImageFile(new \Symfony\Component\HttpFoundation\File\UploadedFile($this->compressedFile, 'mime-testimage.png'));

        // check compressed file
        $this->assertTrue(file_exists($this->compressedFile));
        $this->printFileInformation($this->compressedFile);

        // check compressing
        $this->assertLessThan(filesize($this->originalFile), filesize($this->compressedFile));
        $this->printFilesizeDifference($this->originalFile, $this->compressedFile);
    }
}
