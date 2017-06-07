<?php

use Illuminate\Http\UploadedFile;

class MiddlewareTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function it_converts_file_with_middleware()
    {
        $filePath = __DIR__ . '/files/testimage.jpg';
        $filesize = filesize($filePath);
        $uploadFile = new \Symfony\Component\HttpFoundation\File\UploadedFile($filePath, 'foo.jpg');

        $request = new Illuminate\Http\Request();
        $request->setMethod('POST');
        $request->replace(array('testimage' => $uploadFile));
        // TODO image file is not detect

        $mw = new \Approached\LaravelImageOptimizer\Middleware\AutoImageOptimizer();
        $mw->handle($request, function ($req) {

        });

        // TODO check imagesize
    }
}
