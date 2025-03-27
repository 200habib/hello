use App\Models\User;
use App\Models\Item;

class ItemPolicy
{
    // Solo gli admin possono creare
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    // Solo gli admin possono eliminare
    public function delete(User $user, Item $item)
    {
        return $user->hasRole('admin');
    }
}






🔹 1. Creare l'Observer per Plat

Esegui il comando:

php artisan make:observer PlatObserver --model=Plat

Questo creerà il file:
📁 app/Observers/PlatObserver.php

Aprilo e modificalo così:

namespace App\Observers;

use App\Models\Plat;
use App\Models\User;
use App\Notifications\NewPlatNotification;

class PlatObserver
{
    // 📌 Metodo chiamato automaticamente dopo la creazione di un Plat
    public function created(Plat $plat)
    {
        // Invia la notifica via email a tutti gli utenti
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewPlatNotification($plat));
        }
    }
}

🔹 2. Registrare l'Observer nel Provider

Apri il file 📁 app/Providers/AppServiceProvider.php e aggiungi questo codice nel metodo boot():

use App\Models\Plat;
use App\Observers\PlatObserver;

public function boot()
{
    Plat::observe(PlatObserver::class);
}

🔹 3. Ora Laravel invierà Email Automaticamente!

Ogni volta che un nuovo Plat viene creato, Laravel invierà automaticamente una notifica via email a tutti gli utenti.

✅ Nessun bisogno di modificare il controller
✅ Funziona con factory(), Seeder o qualsiasi creazione di Plat
🔹 4. Testare la Notifica

Apri Tinker e crea un nuovo piatto:

php artisan tinker

Poi esegui:

use App\Models\Plat;

Plat::create([
    'nom' => 'Pasta Carbonara',
    'recette' => 'Uova, guanciale, pecorino, pepe.',
    'image' => 'https://m.media-amazon.com/images/I/8126RXA1kiL.jpg',
    'user_id' => 1,
]);

📌 Ora Laravel invierà automaticamente un'email a tutti gli utenti registrati! 🎉

Se hai usato Mailtrap, controlla la tua inbox su https://mailtrap.io.
Se hai usato Gmail, verifica nella tua casella di posta.














🔹 2. L'Observer intercetta la creazione del Plat

Nel file PlatObserver.php, abbiamo questo codice:

namespace App\Observers;

use App\Models\Plat;
use App\Models\User;
use App\Notifications\NewPlatNotification;

class PlatObserver
{
    public function created(Plat $plat)
    {
        // Recupera tutti gli utenti registrati
        $users = User::all();

        // Invia una notifica email a ogni utente
        foreach ($users as $user) {
            $user->notify(new NewPlatNotification($plat));
        }
    }
}

✅ Laravel chiama il metodo created(Plat $plat) subito dopo che un nuovo piatto è stato salvato nel database.
✅ Il codice recupera tutti gli utenti e invia una notifica via email con i dettagli del nuovo piatto.
🔹 3. Laravel invia la notifica via email

La notifica è definita in NewPlatNotification.php.

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewPlatNotification extends Notification
{
    use Queueable;
    protected $plat;

    public function __construct($plat)
    {
        $this->plat = $plat;
    }

    public function via($notifiable)
    {
        return ['mail']; // Solo email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nuovo Piatto Aggiunto! 🍕')
            ->greeting('Ciao ' . $notifiable->name . '!')
            ->line("Un nuovo piatto è stato aggiunto: **{$this->plat->nom}**")
            ->action('Visualizza il piatto', url('/plats/' . $this->plat->id))
            ->line('Grazie per aver utilizzato la nostra piattaforma!');
    }
}

✅ Laravel invia un'email a ogni utente con il nome del piatto e un link per visualizzarlo.
🔹 4. Registrazione dell'Observer in Laravel

Nel file AppServiceProvider.php, abbiamo registrato l'Observer:

use App\Models\Plat;
use App\Observers\PlatObserver;

public function boot()
{
    Plat::observe(PlatObserver::class);
}

✅ Questo dice a Laravel: "Quando un Plat viene creato, esegui il codice in PlatObserver".
