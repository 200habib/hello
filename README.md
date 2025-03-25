# ✅ Guida all'Uso di Spatie Laravel Permission

## 🔥 5. CREA RUOLO E PERMESSO - Passi in Tinker

### 📌 Lancia Tinker:
```bash
php artisan tinker
```

// 📥 1. Importa i modelli necessari
// Role e Permission vengono dal package Spatie
// User è il modello standard di Laravel
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

// 🔨 2. Crea un nuovo ruolo chiamato 'admin'
// Questo salverà il ruolo nella tabella 'roles' del database
$role = Role::create(['name' => 'admin']);

// 🔐 3. Crea un nuovo permesso chiamato 'edit articles'
// Questo rappresenta l'azione di "modificare articoli" e viene salvato nella tabella 'permissions'
$permission = Permission::create(['name' => 'edit articles']);

// 🔗 4. Assegna il permesso 'edit articles' al ruolo 'admin'
// Chiunque avrà il ruolo 'admin' potrà eseguire l'azione di modificare articoli
$role->givePermissionTo($permission);

// 👤 5. Recupera l'utente a cui vuoi assegnare il ruolo
// In questo esempio stiamo recuperando l'utente con ID 1 dal database
$user = User::find(1);

// 🎯 6. Assegna il ruolo 'admin' all'utente selezionato
// Questo collega l'utente al ruolo 'admin' e gli concede automaticamente tutti i permessi del ruolo
$user->assignRole('admin');

// 🔄 7. (Opzionale) Assegna direttamente anche il permesso all'utente
// Anche se l'utente eredita già il permesso dal ruolo, puoi assegnarlo direttamente per casi specifici
$user->givePermissionTo('edit articles');


✅ Verifica se tutto funziona

Sempre da tinker, puoi verificare se l’utente ha effettivamente i ruoli e i permessi:

// Verifica se l’utente ha il ruolo 'admin'
$user->hasRole('admin'); // Deve restituire true

// Verifica se l’utente ha il permesso 'edit articles'
$user->can('edit articles'); // Deve restituire true


✅ Proteggi le Route con il Middleware di Spatie

Puoi usare il middleware role per proteggere le tue route e permettere l’accesso solo agli utenti con il ruolo richiesto:

// Esempio di protezione route
Route::get('/admin', function () {
    return 'Area Admin';
})->middleware('role:admin');

✅ Solo gli utenti con il ruolo admin potranno accedere a questa route.