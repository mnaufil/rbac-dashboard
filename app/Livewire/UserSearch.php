<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserSearch extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {

        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        $users = $query->paginate(2);

        return view('livewire.user-search', compact('users'));
    }

    
}