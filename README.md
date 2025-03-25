🔥 CREA RUOLO E PERMESSO - Passi in Tinker

php artisan tinker

// Importa i modelli
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

// ✅ a) Crea un ruolo (solo la prima volta)
$role = Role::create(['name' => 'admin']);

// ✅ b) Crea un permesso
$permission = Permission::create(['name' => 'edit articles']);

// ✅ c) Assegna il permesso al ruolo
$role->givePermissionTo($permission);

// ✅ d) Recupera l'utente
$user = User::find(1);

// ✅ e) Assegna il ruolo all'utente
$user->assignRole('admin');

// ✅ f) (Facoltativo) Assegna anche il permesso direttamente all'utente
$user->givePermissionTo('edit articles');

// ✅ g) Verifica se l’utente ha il ruolo
$user->hasRole('admin'); // true

// ✅ h) Verifica se l’utente ha il permesso
$user->can('edit articles'); // true

✅ Proteggi le route con i middleware

Nel file web.php o api.php:

Route::get('/admin', function () {
    return 'Area Admin';
})->middleware('role:admin');

📌 Riepilogo comandi principali (pronto da incollare in Tinker)

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

$role = Role::create(['name' => 'admin']);
$permission = Permission::create(['name' => 'edit articles']);
$role->givePermissionTo($permission);

$user = User::find(1);
$user->assignRole('admin');
$user->givePermissionTo('edit articles');

✅ Fine! Ora sei pronto per gestire ruoli e permessi nella tua app Laravel


---

Se vuoi aggiungere una sezione "Test rapido" o badge per GitHub dimmelo e li preparo 🔥

