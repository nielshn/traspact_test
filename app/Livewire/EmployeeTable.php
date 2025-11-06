<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\Unit;

class EmployeeTable extends Component
{
    use WithPagination;

    public $search = '';
    public $unit_id = '';
    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Employee::with(['unit', 'position', 'rank', 'religion'])
            ->when($this->search, fn($q) =>
            $q->where('first_name', 'like', "%{$this->search}%")
                ->orWhere('nip', 'like', "%{$this->search}%"))
            ->when($this->unit_id, fn($q) =>
            $q->where('unit_id', $this->unit_id))
            ->orderBy('first_name');

        return view('livewire.employee-table', [
            'employees' => $query->paginate(10),
            'units' => Unit::with('children')->whereNull('parent_id')->get(),
        ])->layout('layouts.app');
    }
}
