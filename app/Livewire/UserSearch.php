<?php 

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserSearch extends Component
{
    use WithPagination;
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function render(){

        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        $users = $query
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(2);

        return view('livewire.user-search', compact('users'));
    }

    public function sortBy($field){
        if ($this->sortField === $field) {
            // toggle direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    
}