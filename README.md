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
