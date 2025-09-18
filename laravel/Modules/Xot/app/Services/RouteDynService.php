<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

use function Safe\preg_replace;

/**
 * Class RouteDynService.
 */
class RouteDynService
{
    private static string $namespace_start = '';

    // Commentato: La proprietà $curr non viene mai letta, quindi potrebbe essere rimossa
    // private static ?string $curr = null;

    /**
     * @param  array<string, mixed>  $v
     * @return array<string, mixed>
     */
    public static function getGroupOpts(array $v, null|string $namespace): array
    {
        return [
            'prefix' => self::getPrefix($v, $namespace),
            'namespace' => self::getNamespace($v, $namespace),
            'as' => self::getAs($v, $namespace),
        ];
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getPrefix(array $v, null|string $namespace): string
    {
        if (isset($v['prefix'])) {
            Assert::string($prefix = $v['prefix'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

            return $prefix;
        }

        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $prefix = mb_strtolower($name);
        $param_name = self::getParamName($v, $namespace);
        if ($param_name !== '') {
            return $prefix . '/{' . $param_name . '}';
        }

        return $prefix;
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getAs(array $v, null|string $_namespace): string
    {
        if (isset($v['as'])) {
            Assert::string($as = $v['as'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

            return $as;
        }

        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $as = mb_strtolower($name);
        $as = str_replace('/', '.', $as);
        $as = preg_replace('/{.*}./', '', $as);
        $as = str_replace(['{', '}'], '', $as);

        return $as . '.';
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getNamespace(array $v, null|string $namespace): null|string
    {
        if (isset($v['namespace'])) {
            Assert::string($namespace = $v['namespace'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

            return $namespace;
        }

        Assert::string($namespace = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $namespace = str_replace(['{', '}'], '', $namespace);
        if ($namespace === '') {
            return null;
        }

        return Str::studly($namespace);
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getAct(array $v, null|string $_namespace): string
    {
        if (isset($v['act'])) {
            Assert::string($act = $v['act'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

            return $act;
        }

        Assert::nullOrString($v['act'] = $v['name']);
        Assert::nullOrString($v['act']);
        $v['act'] = preg_replace('/{.*}\//', '', (string) $v['act']);
        if ($v['act'] === null) {
            $v['act'] = '';
        }

        $v['act'] = str_replace('/', '_', $v['act']);
        $v['act'] = Str::camel($v['act']);
        $v['act'] = str_replace(['{', '}'], '', $v['act']);

        return Str::camel($v['act']);
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getParamName(array $v, null|string $_namespace): string
    {
        if (isset($v['param_name'])) {
            Assert::string($param_name = $v['param_name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

            return $param_name;
        }

        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $param_name = 'id_' . $name;
        $param_name = str_replace(['{', '}'], '', $param_name);

        return mb_strtolower($param_name);
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<int, string>
     */
    public static function getParamsName(array $v, null|string $namespace): array
    {
        $param_name = self::getParamName($v, $namespace);

        return [$param_name];
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<string, mixed>
     */
    public static function getResourceOpts(array $v, null|string $namespace): array
    {
        $param_name = self::getParamName($v, $namespace);
        $params_name = self::getParamsName($v, $namespace);
        Assert::isArray($params_name);

        $opts = [
            'parameters' => [mb_strtolower((string) $v['name']) => implode('}/{', $params_name)],
            'names' => self::prefixedResourceNames(self::getAs($v, $namespace)),
        ];

        if (isset($v['only'])) {
            $opts['only'] = $v['only'];
        }

        if ($param_name === '' && !isset($opts['only'])) {
            $opts['only'] = ['index'];
        }

        $opts['where'] = array_fill_keys($params_name, '[0-9]+');

        return $opts;
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getController(array $v, null|string $_namespace): string
    {
        if (isset($v['controller'])) {
            Assert::string($controller = $v['controller'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

            return $controller;
        }

        Assert::string($v['controller'] = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $v['controller'] = str_replace(['/', '{', '}'], ['_', '', ''], $v['controller']);
        $v['controller'] = Str::studly($v['controller']);
        $v['controller'] .= 'Controller';

        return $v['controller'];
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getUri(array $v, null|string $_namespace): string
    {
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

        // return mb_strtolower(is_string($v) ? $v : (string) $v['name);
        return $name;
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<int, string>
     */
    public static function getMethod(array $v, null|string $_namespace): array
    {
        if (isset($v['method'])) {
            return Arr::wrap($v['method']);
        }

        return ['get', 'post'];
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function getUses(array $v, null|string $namespace): string
    {
        $controller = self::getController($v, $namespace);
        $act = self::getAct($v, $namespace);

        return $controller . '@' . $act;
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<string, mixed>
     */
    public static function getCallback(array $v, null|string $namespace, null|string $curr): array
    {
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $as = Str::slug($name);
        $uses = self::getUses($v, $namespace);
        if ($curr !== null) {
            $uses = '\\' . self::$namespace_start . '\\' . $curr . '\\' . $uses;
        } else {
            $uses = '\\' . self::$namespace_start . '\\' . $uses;
        }

        return ['as' => $as, 'uses' => $uses];
    }

    /**
     * @param  array<int, array<string, mixed>>  $array
     */
    public static function dynamic_route(
        array $array,
        null|string $namespace = null,
        null|string $namespace_start = null,
        null|string $curr = null,
    ): void {
        Assert::isArray($array, 'The $array parameter must be an array.');
        Assert::notEmpty($array, 'The $array parameter cannot be empty.');

        if ($namespace_start !== null) {
            self::$namespace_start = $namespace_start;
        }

        foreach ($array as $v) {
            Assert::isArray($v, 'Each item in the array must be an array.');
            $group_opts = self::getGroupOpts($v, $namespace);
            $v['group_opts'] = $group_opts;

            self::createRouteResource($v, $namespace);

            Route::group($group_opts, static function () use ($v, $namespace, $curr): void {
                self::createRouteActs($v, $namespace, $curr);
                self::createRouteSubs($v, $namespace, $curr);
            });
        }
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function createRouteResource(array $v, null|string $namespace): void
    {
        if ($v['name'] === null) {
            return;
        }
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $opts = self::getResourceOpts($v, $namespace);
        $controller = self::getController($v, $namespace);

        Route::resource($name, $controller, $opts);
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function createRouteSubs(array $v, null|string $namespace, null|string $curr): void
    {
        if (!isset($v['subs'])) {
            return;
        }

        $sub_namespace = self::getNamespace($v, $namespace);
        $curr = $curr === null ? $sub_namespace : $curr;
        Assert::isArray($subs = $v['subs']);
        self::dynamic_route($subs, $sub_namespace, null, $curr);
    }

    /**
     * @param  array<string, mixed>  $v
     */
    public static function createRouteActs(array $v, null|string $namespace, null|string $curr): void
    {
        if (!isset($v['acts']) || !is_array($v['acts'])) {
            return;
        }

        $controller = self::getController($v, $namespace);
        foreach ($v['acts'] as $v1) {
            Assert::isArray($v1);
            $v1['controller'] = $controller;

            $method = self::getMethod($v1, $namespace);
            $uri = self::getUri($v1, $namespace);
            $callback = self::getCallback($v1, $namespace, $curr);
            Route::match($method, $uri, $callback);
        }
    }

    /**
     * @return array<string, string>
     */
    public static function prefixedResourceNames(string $prefix): array
    {
        if (mb_substr($prefix, -1) === '.') {
            $prefix = mb_substr($prefix, 0, -1);
        }

        return [
            'index' => $prefix . '.index',
            'create' => $prefix . '.create',
            'store' => $prefix . '.store',
            'show' => $prefix . '.show',
            'edit' => $prefix . '.edit',
            'update' => $prefix . '.update',
            'destroy' => $prefix . '.destroy',
        ];
    }

    // --------------------------------------------------
}
