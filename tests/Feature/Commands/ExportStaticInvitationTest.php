<?php

namespace Tests\Feature\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExportStaticInvitationTest extends TestCase
{
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
            $this->assertFileDoesNotExist($outputDirectory.'/index.php');
            $this->assertStringContainsString('id="guest-name"', $html);
            $this->assertStringContainsString('new URLSearchParams(window.location.search)', $html);
            $this->assertStringContainsString("document.getElementById('guest-name').textContent = guestName;", $html);
            $this->assertStringContainsString('/audio/pernikahan-kita.mp3', $html);
            $this->assertStringContainsString('removedDefaultWish', $html);
            $this->assertStringContainsString('const initialWishes = [];', $html);
            $this->assertStringNotContainsString('Selamat untuk kedua mempelai!', $html);
            $this->assertStringContainsString('Kirim Hadiah', $html);
            $this->assertStringContainsString('+62 856-8468-295', $html);
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
}
