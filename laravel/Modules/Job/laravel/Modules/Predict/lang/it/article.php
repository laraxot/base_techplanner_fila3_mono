<?php

declare(strict_types=1);

/*
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Models\Profile;
use Webmozart\Assert\Assert;
*/
// NNOO PERCHE SE UNO E' SLOGGATO DA ERRORE !!
/*
Assert::notNull($user = Auth::user(),'['.__LINE__.']['.__FILE__.']');
Assert::notNull($profile = $user->profile,'['.__LINE__.']['.__FILE__.']');
Assert::isInstanceOf($profile, Profile::class);
*/
return [
    'navigation' => [
        'name' => 'Articolo',
        'plural' => 'Articoli',
        'group' => [
            'name' => 'Content',
        ],
    ],

    'rating' => [
        'no_import' => 'Nessuna cifra inserita',
        'import_zero' => 'Nessuna cifra inserita',
        'import_min' => 'Hai superato la cifra di :credits: crediti',
        'no_choice' => 'Nessuna opzione scelta',
    ],
    'single_expired' => 'Scaduto',
    'expired' => 'Articolo scaduto, non si possono fare più scommesse',
    'no_vote' => 'Siamo spiacenti, ma questa votazione è chiusa da :TIME, per favore prova a fare un altra previsione',
    'your_bet' => 'La tua scelta',
    'your_amount' => 'Previsione',
    'if_win' => 'Se vinci',
    'place-bet' => 'Fai la tua scelta',
    'sell' => 'Vendi',
    'quote-stock' => 'Quotazione',
    'your_stocks' => 'Azioni',

    // 'fields' => [
    //     'name' => 'Nome',
    //     'guard_name' => 'Guard',
    //     'permissions' => 'Permessi',
    //     'roles' => 'Ruoli',
    //     'updated_at' => 'Aggiornato il',
    //     'first_name' => 'Nome',
    //     'last_name' => 'Cognome',
    // ],
    // 'actions' => [
    //     'import' => [
    //         'fields' => [
    //             'import_file' => 'Seleziona un file XLS o CSV da caricare',
    //         ],
    //     ],
    //     'export' => [
    //         'filename_prefix' => 'Aree al',
    //         'columns' => [
    //             'name' => 'Nome area',
    //             'parent_name' => 'Nome area livello superiore',
    //         ],
    //     ],
    // ],
];
