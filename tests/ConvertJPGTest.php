<?php

class ConvertJPGTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->originalFile = __DIR__.'/files/testimage.jpg';
        $this->compressedFile = $temp_file = sys_get_temp_dir().'/php_image_optimizer.jpg';
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
    public function it_converts_jpg_file()
    {
        /** @var \Approached\LaravelImageOptimizer\ImageOptimizer $imageOptimizer */
        $imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');

        // check original file
        $this->assertTrue(file_exists($this->originalFile));
        $this->printFileInformation($this->originalFile);

        // compress
        $imageOptimizer->optimizeImage($this->compressedFile);

        // check compressed file
        $this->assertTrue(file_exists($this->compressedFile));
        $this->printFileInformation($this->compressedFile);

        // check compressing
        $this->assertLessThan(filesize($this->originalFile), filesize($this->compressedFile));
        $this->printFilesizeDifference($this->originalFile, $this->compressedFile);
    }
}
