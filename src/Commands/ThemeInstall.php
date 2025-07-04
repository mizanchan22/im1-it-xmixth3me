<?php

namespace IM1\ThemeInstaller\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ThemeInstall extends BaseCommand
{
    protected $group       = 'im1';
    protected $name        = 'im1:theme';
    protected $description = 'Various Theme dah embeded dalam ni.';

    public function run(array $params)
    {
        CLI::newLine();
        CLI::write('████████╗███████╗███╗   ███╗██████╗ ██╗      █████╗ ████████╗███████╗    ██╗███╗   ███╗', 'light_green');
        CLI::write('╚══██╔══╝██╔════╝████╗ ████║██╔══██╗██║     ██╔══██╗╚══██╔══╝██╔════╝    ██║████╗ ████║', 'light_green');
        CLI::write('   ██║   █████╗  ██╔████╔██║██████╔╝██║     ███████║   ██║   █████╗      ██║██╔████╔██║', 'light_green');
        CLI::write('   ██║   ██╔══╝  ██║╚██╔╝██║██╔═══╝ ██║     ██╔══██║   ██║   ██╔══╝      ██║██║╚██╔╝██║', 'light_green');
        CLI::write('   ██║   ███████╗██║ ╚═╝ ██║██║     ███████╗██║  ██║   ██║   ███████╗    ██║██║ ╚═╝ ██║', 'light_green');
        CLI::write('   ╚═╝   ╚══════╝╚═╝     ╚═╝╚═╝     ╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚═╝╚═╝     ╚═╝', 'light_green');
        CLI::newLine();

        CLI::write(str_pad('Themes IM1', 85, ' ', STR_PAD_BOTH), 'yellow');
        CLI::write(str_pad('& much more!', 85, ' ', STR_PAD_BOTH), 'light_green');
        CLI::write('');

        CLI::newLine();

        CLI::write("1. Bootstrap 5", 'white');
        CLI::newLine();

        $version = CLI::prompt("Pilih versi Bootstrap (1)");

        if ($version === '1') {
            $this->selectBootstrap5();
        } else {
            CLI::error("❌ Versi belum disokong.");
        CLI::newLine();

        }
    }

    protected function selectBootstrap5(): void
    {
        CLI::newLine();
        CLI::write("Tema Bootstrap 5:", 'cyan');
        CLI::write("1. AdminLTE (on progress)", 'white');
        CLI::write("2. NiceAdmin (soon)", 'white');
        CLI::write("3. Sneat (on progress)", 'white');
        CLI::newLine();

        $choice = CLI::prompt("Pilih tema (1-2)");

        $themeMap = [
            '1' => 'adminlte',
            '2' => 'niceadmin',
            '3' => 'sneat',
        ];

        if (!isset($themeMap[$choice])) {
            CLI::error("❌ Pilihan tidak sah.");
        CLI::newLine();

            return;
        }

        $themeKey = $themeMap[$choice];
        $this->copyTheme($themeKey);
    }

    protected function copyTheme(string $themeKey): void
    {
        $vendorPath    = ROOTPATH . 'vendor/mizanchan22/im1-it-xmixth3me/stubs/';
        $sourceViews   = $vendorPath . "views/layout_files/" . $themeKey;
        $sourceAssetsCSS  = $vendorPath . "public/assets/" . $themeKey . "/css";
        $sourceAssetsJS  = $vendorPath . "public/assets/" . $themeKey . "/js";
        $sourceAssetsVendor  = $vendorPath . "public/assets/" . $themeKey . "/vendor"; //Arif
        $sourceAssetsImg  = $vendorPath . "public/assets/" . $themeKey . "/img"; //Arif
        $sourceAssetsFont  = $vendorPath . "public/assets/" . $themeKey . "/fonts";

        $targetViews   = APPPATH . 'Views/layouts/';
        $targetAssetsCSS  = FCPATH . 'assets/css/';
        $targetAssetsJS  = FCPATH . 'assets/js/';
        $targetAssetsVendor  = FCPATH . 'assets/vendor/'; //Arif
        $targetAssetsImg  = FCPATH . 'assets/img/'; //Arif
        $targetAssetsFont  = FCPATH . 'assets/fonts/'; 

        $this->deleteDirectory(FCPATH . 'assets/'); // Delete the entire assets folder
        mkdir(FCPATH . 'assets', 0755, true);       // Recreate base assets folder

        $this->recreateFolder($targetViews, $sourceViews);
        $this->recreateFolder($targetAssetsCSS, $sourceAssetsCSS);
        $this->recreateFolder($targetAssetsJS, $sourceAssetsJS);
        $this->recreateFolder($targetAssetsVendor, $sourceAssetsVendor);
        $this->recreateFolder($targetAssetsImg, $sourceAssetsImg);
        $this->recreateFolder($targetAssetsFont, $sourceAssetsFont);

        $this->copyDirectory($sourceViews, $targetViews);
        $this->copyDirectory($sourceAssetsCSS, $targetAssetsCSS);
        $this->copyDirectory($sourceAssetsJS, $targetAssetsJS);
        $this->copyDirectory($sourceAssetsVendor, $targetAssetsVendor); //Arif
        $this->copyDirectory($sourceAssetsImg, $targetAssetsImg); //Arif
        $this->copyDirectory($sourceAssetsFont, $targetAssetsFont);

        $this->updateBaseController();
        $this->replaceWelcomeMessage();

        CLI::write("✅ Tema '$themeKey' telah dipasang ke projek CI4 anda.", 'green');
        CLI::newLine();
         if (realpath($targetViews)) {
            CLI::write("📁 Layouts: " . realpath($targetViews), 'blue');
        }
        if (realpath($targetAssetsCSS)) {
            CLI::write("📁 Assets CSS:  " . realpath($targetAssetsCSS), 'blue');
        }
        if (realpath($targetAssetsJS)) {
            CLI::write("📁 Assets JS:  " . realpath($targetAssetsJS), 'blue');
        }
        if (realpath($targetAssetsVendor)) {
            CLI::write("📁 Assets Vendor:  " . realpath($targetAssetsVendor), 'blue');
        }
        if (realpath($targetAssetsImg)) {
            CLI::write("📁 Assets Img:  " . realpath($targetAssetsImg), 'blue');
        }
        if (realpath($targetAssetsFont)) {
            CLI::write("📁 Assets Fonts:  " . realpath($targetAssetsFont), 'blue');
        }
        CLI::newLine(2);
    }

    protected function recreateFolder(string $targetPath, ?string $sourcePath = null, ?string $label = null): void
    {
        if ($sourcePath && !is_dir($sourcePath)) {
            $name = $label ?? basename($targetPath);
            CLI::newLine();
            CLI::write("⚠️  Folder '$name' tidak wujud dalam tema, skip buat '$targetPath'.", 'yellow');
            return;
        }

        if (is_dir($targetPath)) {
            $this->deleteDirectory($targetPath);
        }

        mkdir($targetPath, 0755, true);
    }

    protected function copyDirectory(string $src, string $dst): void
    {
        if (!is_dir($src)) {
        // CLI::error("❌ Folder tidak wujud: $src");
        // CLI::newLine();

            return;
        }

        $dir = opendir($src);
        @mkdir($dst, 0755, true);

        while (false !== ($file = readdir($dir))) {
            if ($file !== '.' && $file !== '..') {
                $srcPath = "$src/$file";
                $dstPath = "$dst/$file";

                if (is_dir($srcPath)) {
                    $this->copyDirectory($srcPath, $dstPath);
                } else {
                    copy($srcPath, $dstPath);
                }
            }
        }

        closedir($dir);
    }

    protected function deleteDirectory(string $dir): void
    {
        if (!file_exists($dir)) return;

        foreach (scandir($dir) as $item) {
            if ($item === '.' || $item === '..') continue;
            $path = "$dir/$item";
            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                unlink($path);
            }
        }

        rmdir($dir);
    }

    protected function updateBaseController(): void
    {
        $file = APPPATH . 'Controllers/BaseController.php';

        if (!file_exists($file)) {
            CLI::error("❌ BaseController.php tidak dijumpai.");
        CLI::newLine();

            return;
        }

        $original = "protected \$helpers = [];";
        $replacement = "protected \$helpers = ['html', 'form', 'date'];";

        $content = file_get_contents($file);

        if (strpos($content, $replacement) !== false) {
            CLI::newLine();
            CLI::write("ℹ️  BaseController.php sudah dikemaskini sebelum ini.", 'yellow');
            return;
        }

        if (strpos($content, $original) === false) {
            CLI::error("❌ Gagal cari line helpers dalam BaseController.php");
            CLI::newLine();

            return;
        }

        $updated = str_replace($original, $replacement, $content);
        file_put_contents($file, $updated);

        CLI::write("✅ BaseController.php dikemaskini dengan helper ['html', 'form', 'date']", 'green');
    }


        protected function replaceWelcomeMessage(): void
        {
            $file = APPPATH . 'Views/welcome_message.php';

            if (!file_exists($file)) {
                CLI::error("❌ welcome_message.php tidak dijumpai.");
        CLI::newLine();

                return;
            }

            $newContent = <<<PHP
        <?= \$this->extend('layouts/main_layout') ?>
<?= \$this->section('app-wrapper') ?>

<!-- app wrapper -->
<div class="app-wrapper">
    <!-- Content -->
    <div class="text-center" style="font-family: 'Lato', sans-serif; font-size: 36px; font-weight: bold; color: #555">
        Done Installation......</div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->

<?= \$this->endSection() ?>
PHP;

file_put_contents($file, $newContent);
CLI::write("✅ welcome_message.php digantikan dengan template layout.", 'green');
}

}