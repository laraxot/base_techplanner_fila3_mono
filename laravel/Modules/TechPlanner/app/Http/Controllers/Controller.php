<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controller base per il modulo TechPlanner.
 * 
 *
 * 
 * Questo controller fornisce le funzionalità base comuni a tutti i controller
 * del modulo TechPlanner, incluse le autorizzazioni e la validazione.
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
