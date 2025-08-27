# Sistema di Autenticazione - Modulo User

## Panoramica

Il sistema di autenticazione del modulo User fornisce un'infrastruttura robusta e sicura per la gestione degli accessi all'applicazione.

## 🏗️ Componenti

### 1. Modello User
```php
use Modules\User\Models\User;

class User extends Authenticatable
{
    use HasRoles, HasTeams, HasTenants;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
```

### 2. Middleware di Autenticazione
```php
// app/Http/Kernel.php
protected $routeMiddleware = [
    'auth' => \Modules\User\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'guest' => \Modules\User\Http\Middleware\RedirectIfAuthenticated::class,
];
```

### 3. Controller di Autenticazione
```php
namespace Modules\User\Http\Controllers\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Credenziali non valide.',
        ]);
    }
}
```

## 🔐 Funzionalità di Sicurezza

### Password Policy
- Lunghezza minima: 8 caratteri
- Complessità: Maiuscole, minuscole, numeri, simboli
- Storia: Non riutilizzare le ultime 5 password
- Scadenza: Cambio obbligatorio ogni 90 giorni

### Autenticazione a Due Fattori (2FA)
```php
// Abilitazione 2FA
$user->enableTwoFactorAuth();

// Verifica codice 2FA
if ($user->verifyTwoFactorCode($code)) {
    // Accesso consentito
}
```

### Gestione Sessioni
```php
// Configurazione sessioni
'session' => [
    'lifetime' => 120, // 2 ore
    'expire_on_close' => false,
    'secure' => true, // Solo HTTPS
    'http_only' => true,
    'same_site' => 'lax',
],
```

## 🚀 Utilizzo

### Login
```php
// Autenticazione base
Auth::attempt(['email' => $email, 'password' => $password]);

// Autenticazione con remember me
Auth::attempt($credentials, $request->boolean('remember'));

// Verifica stato autenticazione
if (Auth::check()) {
    $user = Auth::user();
}
```

### Logout
```php
// Logout e invalidazione sessione
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
```

### Protezione Route
```php
// Route protette
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
});

// Route per guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login']);
});
```

## 📱 API Authentication

### Sanctum Token
```php
// Generazione token
$token = $user->createToken('api-token')->plainTextToken;

// Verifica token
if ($request->bearerToken()) {
    $user = Auth::guard('sanctum')->user();
}
```

## 🔗 Collegamenti

- [**README Modulo User**](README.md)
- [**Sistema Autorizzazione**](authorization.md)
- [**Gestione Team**](teams.md)
- [**Multi-tenancy**](multi-tenancy.md)

---

*Ultimo aggiornamento: giugno 2025*
