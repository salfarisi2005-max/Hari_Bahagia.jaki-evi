<?php

namespace Tests\Feature\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExportStaticInvitationTest extends TestCase
{
    use RefreshDatabase;

    public function test_rejects_output_directory_outside_the_project(): void
    {
        $this->artisan('app:export-static', ['--output' => '../outside'])
            ->assertFailed();
    }

    public function test_exports_a_standalone_invitation_and_required_assets(): void
    {
        $relativeOutputPath = 'storage/framework/testing/netlify-export-'.Str::uuid();
        $outputDirectory = base_path($relativeOutputPath);

        try {
            $this->artisan('app:export-static', ['--output' => $relativeOutputPath])
                ->assertSuccessful();

            $htmlPath = $outputDirectory.'/index.html';
            $html = File::get($htmlPath);

            $this->assertFileExists($htmlPath);
            $this->assertFileExists($outputDirectory.'/audio/pernikahan-kita.mp3');
            $this->assertFileExists($outputDirectory.'/images/couple-cartoon.jpg');
            $this->assertFileExists($outputDirectory.'/images/bride-cartoon.jpg');
            $this->assertFileExists($outputDirectory.'/images/dana-logo.jpg');
            $this->assertFileExists($outputDirectory.'/images/cartoon-couple-navy.jpg');
            $this->assertFileExists($outputDirectory.'/images/cartoon-couple-pink.jpg');
            $this->assertFileDoesNotExist($outputDirectory.'/index.php');
            $this->assertStringContainsString('id="guest-name"', $html);
            $this->assertStringContainsString('new URLSearchParams(window.location.search)', $html);
            $this->assertStringContainsString("document.getElementById('guest-name').textContent = guestName;", $html);
            $this->assertStringContainsString('/audio/pernikahan-kita.mp3', $html);
            $this->assertStringContainsString('/images/couple-cartoon.jpg', $html);
            $this->assertStringContainsString('/images/bride-cartoon.jpg', $html);
            $this->assertStringContainsString('/images/dana-logo.jpg', $html);
            $this->assertStringContainsString('/images/cartoon-couple-navy.jpg', $html);
            $this->assertStringContainsString('/images/cartoon-couple-pink.jpg', $html);
            $this->assertStringContainsString('id="theme-toggle"', $html);
            $this->assertStringContainsString('const initialWishes = [];', $html);
            $this->assertStringNotContainsString('Selamat untuk kedua mempelai!', $html);
            $this->assertStringContainsString('Kirim Hadiah', $html);
            $this->assertStringContainsString('wedding-wishes-v2', $html);
            $this->assertStringContainsString('08568468295', $html);
            $this->assertStringNotContainsString('csrf-token', $html);
            $this->assertStringNotContainsString('http://localhost/', $html);
            $this->assertStringNotContainsString('Simpan Perubahan', $html);
            $this->assertStringNotContainsString('data-action', $html);
            $this->assertStringNotContainsString('window.confirm', $html);
            $this->assertStringNotContainsString('Powered by Netlify', $html);
        } finally {
            File::deleteDirectory($outputDirectory);
        }
    }

    public function test_exports_without_database_tables_and_disables_backend_features(): void
    {
        Schema::dropIfExists('wishes');

        $relativeOutputPath = 'storage/framework/testing/netlify-no-database-'.Str::uuid();
        $outputDirectory = base_path($relativeOutputPath);

        try {
            $this->artisan('app:export-static', ['--output' => $relativeOutputPath])
                ->assertSuccessful();

            $html = File::get($outputDirectory.'/index.html');

            $this->assertStringContainsString('hanya menampilkan undangan', $html);
            $this->assertStringNotContainsString('id="wish-form"', $html);
            $this->assertStringNotContainsString('href="/admin/login"', $html);
        } finally {
            File::deleteDirectory($outputDirectory);
        }
    }
}
