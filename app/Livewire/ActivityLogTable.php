<?php 

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActivityLog;

class ActivityLogTable extends Component{

    use WithPagination;
    public $search = '';
    public $action = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function render(){

        $query = ActivityLog::query();

        if ($this->search) {
            $query->where('description', 'like', '%' . $this->search . '%');
        }

        if ($this->action) {
            $query->where('action', $this->action);
        }

        $logs = $query
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.activity-log-table', compact('logs'));


    }

}