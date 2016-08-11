<?php

class TestsBase extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Approached\LaravelImageOptimizer\ServiceProvider'];
    }

    protected function printFileInformation($filepath)
    {
        fwrite(STDOUT, 'File: ' . $filepath . PHP_EOL);
        fwrite(STDOUT, 'Size: ' . filesize($filepath) . PHP_EOL);
    }

    protected function printFilesizeDifference($originalFile, $compressedFile)
    {
        $saveSize = $this->getFilesizeDifference($originalFile, $compressedFile);
        fwrite(STDOUT, 'Saved: ' . $saveSize . PHP_EOL);

        $fileSizeDifferent = $this->getFilesizeDifferencePercent($originalFile, $compressedFile);
        fwrite(STDOUT, 'Saved in percent: ' . $fileSizeDifferent . '%' . PHP_EOL);
    }

    /**
     * @param $originalFile
     * @param $compressedFile
     * @return float
     */
    protected function getFilesizeDifferencePercent($originalFile, $compressedFile)
    {
        $saveSize = $this->getFilesizeDifference($originalFile, $compressedFile);
        $saveSizePercent = (100 / filesize($originalFile)) * $saveSize;
        return round($saveSizePercent);
    }

    /**
     * @test
     */
    public function it_allows_to_use_service()
    {
        $this->assertNotEmpty(
            app('Approached\LaravelImageOptimizer\ImageOptimizer')
        );
    }

    /**
     * @param $originalFile
     * @param $compressedFile
     * @return int
     */
    protected function getFilesizeDifference($originalFile, $compressedFile)
    {
        $saveSize = filesize($originalFile) - filesize($compressedFile);
        return $saveSize;
    }
}
