<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Trans;

use Illuminate\Support\Str;
<<<<<<< HEAD
use Modules\Xot\Actions\Module\GetModulePathByGeneratorAction;
=======
use Nwidart\Modules\Facades\Module;
>>>>>>> 9d6070e (.)
use Webmozart\Assert\Assert;

class GetTransFilenameAction
{
    public function execute(string $filename): string
    {
        $lang = app()->getLocale();
        $ns = Str::before($filename, '::');
        $file = Str::between($filename, '::', '.');

<<<<<<< HEAD
        try {
            $langPath = app(GetModulePathByGeneratorAction::class)->execute($ns, 'lang');
            Assert::string($langPath, 'Percorso lang non valido');
        } catch (\Throwable $e) {
            $langPath = base_path('Modules/'.$ns.'/lang');
        }

        $lang_path_full = $langPath.'/'.$lang.'/'.$file.'.php';
        $lang_path_full = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $lang_path_full);

        return $lang_path_full;
=======
        $module_path = Module::getModulePath($ns);
        Assert::string($lang_path = config('modules.paths.generator.lang.path'));
        $lang_path_full = $module_path.''.$lang_path.'/'.$lang.'/'.$file.'.php';
        $lang_path_full = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $lang_path_full);

        $filename = $lang_path_full;

        return $filename;
>>>>>>> 9d6070e (.)
    }
}
