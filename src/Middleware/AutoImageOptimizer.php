<?php

namespace Approached\LaravelImageOptimizer\Middleware;

use Closure;

class AutoImageOptimizer
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() != 'GET') {

            /** @var \Approached\LaravelImageOptimizer\ImageOptimizer $imageOptimizer */
            $imageOptimizer = app('Approached\LaravelImageOptimizer\ImageOptimizer');

            foreach ($request->allFiles() as $file) {
                if ($this->isImageFile($file)) {
                    $imageOptimizer->optimizeUploadedImageFile($file);
                }
            }
        }

        return $next($request);
    }

    protected function isImageFile($file)
    {
        return substr($file->getMimeType(), 0, 5) == 'image';
    }
}
