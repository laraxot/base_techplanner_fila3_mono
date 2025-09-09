# REGOLA CRITICA: Studio Classe Base Obbligatorio

## 🚨 ERRORE GRAVE DA EVITARE

**SEMPRE studiare la classe base prima di estendere** per evitare duplicazioni di trait e metodi.

## ❌ VIOLAZIONI GRAVI
```php
// BaseModel già ha HasFactory
abstract class BaseModel extends Model
{
    use HasFactory;  // ← GIÀ QUI
}

// ❌ ERRORE GRAVE - Duplicazione
class County extends BaseModel  
{
    use HasFactory;  // ← DUPLICAZIONE!
    
    protected static function newFactory()  // ← METODO DUPLICATO!
    {
        return CountyFactory::new();
    }
}
```

## ✅ PATTERN CORRETTO
```php
// ✅ BaseModel centralizza trait
abstract class BaseModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Updater;
}

// ✅ Modelli figli PULITI
class County extends BaseModel
{
    // NIENTE trait duplicati!
    // NIENTE metodi newFactory()!
    
    protected $fillable = ['campo1', 'campo2'];
}
```

## 📋 CHECKLIST OBBLIGATORIA

### Prima di Estendere QUALSIASI Classe
- [ ] **Leggere** completamente la classe base
- [ ] **Verificare** tutti i trait inclusi
- [ ] **Controllare** tutti i metodi implementati
- [ ] **NON duplicare** trait esistenti
- [ ] **NON reimplementare** metodi esistenti

### Trait Comuni da NON Duplicare
- **HasFactory** - Quasi sempre in BaseModel
- **SoftDeletes** - Spesso in BaseModel
- **BelongsToTenant** - Modelli multi-tenant
- **Updater** - Trait custom Xot
- **LogsActivity** - Spatie activitylog

## 🔧 ENFORCEMENT
- PHPStan checks per trait duplicati
- Code review obbligatoria
- Script automatici di verifica

*Ultimo aggiornamento: gennaio 2025*
