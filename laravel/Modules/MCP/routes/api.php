<?php

use Illuminate\Support\Facades\Route;
use Modules\MCP\Controllers\MCPController;

Route::prefix('mcp')->group(function () {
    Route::get('validate/{model}', [MCPController::class, 'validateModel']);
    Route::get('context/{model}', [MCPController::class, 'getModelContext']);
    Route::get('related/{model}', [MCPController::class, 'getRelatedModels']);
    Route::post('store/{model}/{key}', [MCPController::class, 'storeModelData']);
    Route::get('retrieve/{model}/{key}', [MCPController::class, 'retrieveModelData']);
    Route::get('fetch/{model}', [MCPController::class, 'fetchExternalData']);
});
