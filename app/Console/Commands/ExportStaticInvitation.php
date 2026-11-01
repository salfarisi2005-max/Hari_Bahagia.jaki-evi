<?php

namespace App\Console\Commands;

use App\Http\Controllers\WeddingController;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

#[Signature('app:export-static {--output=dist : The relative directory to export the static site to}')]
#[Description('Export the wedding invitation as a static site')]
class ExportStaticInvitation extends Command
{
    public function handle(WeddingController $weddingController): int
    {
        $relativeOutputPath = str_replace('\\', '/', (string) $this->option('output'));
        $pathSegments = explode('/', $relativeOutputPath);

        if (
            $relativeOutputPath === ''
            || str_starts_with($relativeOutputPath, '/')
            || str_contains($relativeOutputPath, ':')
            || in_array('..', $pathSegments, true)
            || in_array('.', $pathSegments, true)
        ) {
            $this->error('The output directory must be a relative path inside the project.');

            return self::FAILURE;
        }

        $audioDirectory = public_path('audio');

        if (! File::isDirectory($audioDirectory)) {
            $this->error('The public audio directory is missing.');

            return self::FAILURE;
        }

        $outputDirectory = base_path($relativeOutputPath);
        File::ensureDirectoryExists($outputDirectory);

        if (! File::copyDirectory($audioDirectory, $outputDirectory.'/audio')) {
            $this->error('The audio assets could not be copied to the static site.');

            return self::FAILURE;
        }

        $buildDirectory = public_path('build');

        if (File::isDirectory($buildDirectory) && ! File::copyDirectory($buildDirectory, $outputDirectory.'/build')) {
            $this->error('The compiled assets could not be copied to the static site.');

            return self::FAILURE;
        }

        foreach (['favicon.ico', 'robots.txt'] as $fileName) {
            $sourcePath = public_path($fileName);

            if (File::exists($sourcePath) && ! File::copy($sourcePath, $outputDirectory.'/'.$fileName)) {
                $this->error("The public file [{$fileName}] could not be copied to the static site.");

                return self::FAILURE;
            }
        }

        $html = $weddingController->index(Request::create('/'))->render();

        if (! File::put($outputDirectory.'/index.html', $html)) {
            $this->error('The static invitation page could not be written.');

            return self::FAILURE;
        }

        $this->info("Static invitation exported to [{$relativeOutputPath}].");

        return self::SUCCESS;
    }
}
