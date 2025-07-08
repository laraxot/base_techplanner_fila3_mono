<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Module;

use Webmozart\Assert\Assert;
use Illuminate\Support\Facades\Config;

class GetModulePathByGeneratorAction
{
    public function execute(string $moduleName, string $generatorPath): string
    {
<<<<<<< HEAD
        $relativePath = Config::string('modules.paths.generator.'.$generatorPath.'.path');
=======
        $relativePath = config('modules.paths.generator.'.$generatorPath.'.path');
>>>>>>> 7bf59db (.)

        $res = module_path($moduleName, $relativePath);
        Assert::string($res);

        return $res;
    }
}
