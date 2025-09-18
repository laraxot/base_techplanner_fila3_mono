<?php

declare(strict_types=1);

use Illuminate\Support\HtmlString;

if (! function_exists('wep_insert')) {
    /**
     * Generate Alpine binding for the Wire Elements Pro Insert component.
     *
     * @return HtmlString
     */
    function wep_insert($types = [], $scope = [])
    {
        $config = [
            'types' => $types,
            'scope' => $scope,
        ];

        $e = "JSON.parse(atob('".base64_encode(\Safe\json_encode($config))."'))";

        return new HtmlString('x-data="SupportsWepInsert('.$e.')" x-bind="insertInput"');
    }
}
