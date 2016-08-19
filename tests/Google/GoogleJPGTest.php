<?php

class GoogleJPGTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->originalFile = __DIR__.'/files/inka-seeschwalbe.jpg';
        $this->compressedFile = '/tmp/inka-seeschwalbe_compressed.jpg';
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
    public function it_converts_png_file()
    {
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

        // google said: file must be smaller than 19%
        $fileSizeDifference = $this->getFilesizeDifferencePercent($this->originalFile, $this->compressedFile);
        $this->assertGreaterThanOrEqual(83, $fileSizeDifference);

        // google said: file must be saved 18,8 KB
        $fileSizeDifferenceSize = $this->getFilesizeDifference($this->originalFile, $this->compressedFile);
        $this->assertGreaterThanOrEqual(1880, $fileSizeDifferenceSize);
    }
}
