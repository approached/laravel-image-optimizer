<?php

namespace Approached\LaravelImageOptimizer\Middleware;

use Approached\LaravelImageOptimizer\ImageOptimizer;
use Closure;

class AutoImageOptimizer
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (in_array($request->method(), ['post', 'put', 'patch'])) {
            $imageOptimizer = new ImageOptimizer();

            foreach ($request->allFiles() as $file) {
                if (substr($file->getMimeType(), 0, 5) == 'image') {
                    $imageOptimizer->optimizeUploadedImageFile($file);
                }
            }
        }

        return $response;
    }
}
