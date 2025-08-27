# Modulo Notify - Sistema di Notifiche Push

## Panoramica

Il modulo Notify gestisce l'invio di notifiche push attraverso Firebase Cloud Messaging (FCM) per dispositivi mobili e web. Fornisce un'interfaccia Filament per testare e inviare notifiche push agli utenti registrati.

## Caratteristiche Principali

- **Notifiche Push**: Invio di notifiche push attraverso Firebase FCM
- **Gestione Dispositivi**: Supporto per dispositivi iOS, Android e Web
- **Interfaccia Filament**: Pagina di test per inviare notifiche push
- **Validazione Token**: Verifica automatica dei token dei dispositivi
- **Gestione Errori**: Gestione robusta degli errori di invio

## Struttura del Modulo

```
Modules/Notify/
├── app/
│   ├── Filament/
│   │   └── Clusters/
│   │       └── Test/
│   │           └── Pages/
│   │               └── SendPushNotification.php
│   ├── Models/
│   ├── Services/
│   └── Providers/
├── config/
├── database/
├── docs/
├── lang/
├── resources/
└── tests/
```

## Componenti Principali

### SendPushNotification Page

Pagina Filament per testare l'invio di notifiche push:

- **Selezione Dispositivo**: Dropdown per selezionare il dispositivo target
- **Form Notifica**: Campi per titolo, corpo, tipo e dati aggiuntivi
- **Invio**: Pulsante per inviare la notifica push
- **Feedback**: Notifiche di successo/errore

### Caratteristiche Tecniche

- **Firebase Integration**: Utilizza Kreait Firebase per l'invio
- **Token Validation**: Verifica automatica dei token dei dispositivi
- **Priority Management**: Supporto per priorità alta delle notifiche
- **Data Payload**: Supporto per dati personalizzati nelle notifiche

## Configurazione

### Firebase Configuration

```php
// config/firebase.php
return [
    'credentials' => [
        'file' => storage_path('firebase-credentials.json'),
    ],
    'project_id' => env('FIREBASE_PROJECT_ID'),
    'database_url' => env('FIREBASE_DATABASE_URL'),
];
```

### Environment Variables

```env
FIREBASE_PROJECT_ID=your-project-id
FIREBASE_DATABASE_URL=https://your-project.firebaseio.com
FIREBASE_CREDENTIALS_FILE=storage/firebase-credentials.json
```

## Utilizzo

### Invio Notifica Programmatico

```php
use Modules\Notify\Services\PushNotificationService;

$service = app(PushNotificationService::class);
$service->sendToDevice($deviceToken, $title, $body, $data);
```

### Invio Notifica a Utente

```php
use Modules\Notify\Services\PushNotificationService;

$service = app(PushNotificationService::class);
$service->sendToUser($userId, $title, $body, $data);
```

### Invio Notifica a Gruppo

```php
use Modules\Notify\Services\PushNotificationService;

$service = app(PushNotificationService::class);
$service->sendToTopic('news', $title, $body, $data);
```

## Modelli e Relazioni

### DeviceUser

Modello che gestisce la relazione tra utenti e dispositivi:

```php
class DeviceUser extends Model
{
    protected $fillable = [
        'user_id',
        'device_id',
        'push_notifications_token',
        'push_notifications_enabled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }
}
```

### Relazioni

- **User**: Relazione con l'utente proprietario
- **Device**: Relazione con il dispositivo fisico
- **Profile**: Relazione con il profilo utente

## API Endpoints

### POST /api/notifications/send

Invia una notifica push a un dispositivo specifico:

```json
{
    "device_token": "fcm_token_here",
    "title": "Titolo Notifica",
    "body": "Corpo della notifica",
    "data": {
        "type": "news",
        "id": "123"
    }
}
```

### POST /api/notifications/send-to-user

Invia una notifica push a un utente specifico:

```json
{
    "user_id": 123,
    "title": "Titolo Notifica",
    "body": "Corpo della notifica",
    "data": {
        "type": "reminder",
        "action": "view"
    }
}
```

## Testing

### Test Unitari

```bash
php artisan test Modules/Notify/tests/Unit
```

### Test Feature

```bash
php artisan test Modules/Notify/tests/Feature
```

### Test Pest

```bash
./vendor/bin/pest Modules/Notify/tests
```

## Sicurezza

### Validazione Token

- Verifica automatica dei token FCM
- Controllo dello stato di abilitazione delle notifiche
- Validazione dei dati di input

### Rate Limiting

- Limite di invio per utente
- Controllo frequenza notifiche
- Protezione da spam

### Autenticazione

- Richiesta autenticazione per l'invio
- Verifica permessi utente
- Log delle operazioni

## Monitoraggio e Logging

### Log delle Notifiche

```php
Log::info('Push notification sent', [
    'user_id' => $userId,
    'device_token' => $deviceToken,
    'title' => $title,
    'sent_at' => now(),
]);
```

### Metriche

- Numero notifiche inviate
- Tasso di successo
- Tempo di consegna
- Errori comuni

## Troubleshooting

### Problemi Comuni

1. **Token Invalidi**
   - Verificare la validità del token FCM
   - Controllare la configurazione Firebase
   - Verificare le credenziali

2. **Notifiche Non Consegnate**
   - Controllare lo stato del dispositivo
   - Verificare le impostazioni privacy
   - Controllare la connessione internet

3. **Errori Firebase**
   - Verificare la configurazione del progetto
   - Controllare le credenziali di servizio
   - Verificare i limiti di quota

### Debug

```php
// Abilita debug per le notifiche
config(['notify.debug' => true]);

// Log dettagliato
Log::debug('Push notification details', [
    'message' => $message->toArray(),
    'target' => $deviceToken,
]);
```

## Best Practices

### Invio Notifiche

1. **Frequenza**: Non inviare troppe notifiche
2. **Timing**: Considerare il fuso orario dell'utente
3. **Personalizzazione**: Utilizzare dati dinamici
4. **Testing**: Testare sempre prima dell'invio

### Gestione Token

1. **Validazione**: Verificare sempre i token
2. **Aggiornamento**: Mantenere i token aggiornati
3. **Pulizia**: Rimuovere token non validi
4. **Backup**: Mantenere backup dei token

### Performance

1. **Batch**: Inviare notifiche in batch
2. **Queue**: Utilizzare code per notifiche massive
3. **Caching**: Cache dei token validi
4. **Monitoring**: Monitorare le performance

## Roadmap

### Funzionalità Future

- [ ] Supporto per notifiche in-app
- [ ] Template di notifica personalizzabili
- [ ] Analytics avanzate
- [ ] A/B testing delle notifiche
- [ ] Supporto per notifiche rich media
- [ ] Integrazione con altri servizi push

### Miglioramenti

- [ ] Ottimizzazione performance
- [ ] Miglioramento gestione errori
- [ ] Espansione API
- [ ] Documentazione avanzata
- [ ] Test di copertura completa

## Contributi

### Sviluppo

1. Fork del repository
2. Creazione branch feature
3. Implementazione funzionalità
4. Test completi
5. Pull request con documentazione

### Standard di Codice

- PSR-12 coding standards
- PHPStan livello 9+
- Test coverage >90%
- Documentazione PHPDoc completa

## Licenza

Questo modulo è rilasciato sotto la licenza MIT. Vedi il file LICENSE per i dettagli.

## Supporto

Per supporto tecnico o domande:

- **Issues**: GitHub Issues
- **Documentazione**: Questa documentazione
- **Wiki**: Wiki del progetto
- **Chat**: Canale Slack/Teams

---

*Ultimo aggiornamento: {{ date('Y-m-d') }}*
