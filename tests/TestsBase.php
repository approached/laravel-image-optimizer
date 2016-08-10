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

        $saveSize = filesize($originalFile) - filesize($compressedFile);
        fwrite(STDOUT, 'Saved: ' . $saveSize . PHP_EOL);


        $saveSizePercent = (100 / filesize($originalFile)) * $saveSize;
        $saveSizePercent = round($saveSizePercent);
        fwrite(STDOUT, 'Saved in percent: ' . $saveSizePercent . '%' . PHP_EOL);
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
}
