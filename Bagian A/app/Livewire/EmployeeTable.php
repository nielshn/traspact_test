<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\{Employee, Unit};

class EmployeeTable extends Component
{
    use WithPagination;

    public $search = '';
    public $unit_id = '';

    // temporary input sebelum diklik “Cari”
    public $tempSearch = '';
    public $tempUnitId = '';

    public $allUnits = [];
    protected $paginationTheme = 'tailwind';

    protected $queryString = [
        'search' => ['except' => ''],
        'unit_id' => ['except' => ''],
    ];

    public function mount()
    {
        $this->allUnits = Unit::orderBy('name')->get();

        // Sync nilai awal
        $this->tempSearch = $this->search;
        $this->tempUnitId = $this->unit_id;
    }

    public function getHasPendingFiltersProperty()
    {
        return $this->tempSearch !== $this->search || $this->tempUnitId !== $this->unit_id;
    }

    public function applyFilters()
    {
        $this->search = $this->tempSearch;
        $this->unit_id = $this->tempUnitId;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'unit_id', 'tempSearch', 'tempUnitId']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Employee::with(['unit', 'position', 'rank', 'religion'])
            ->when($this->search, function ($q) {
                $s = '%' . $this->search . '%';
                $q->where(function ($qq) use ($s) {
                    $qq->where('first_name', 'like', $s)
                        ->orWhere('last_name', 'like', $s)
                        ->orWhere('nip', 'like', $s)
                        ->orWhere('phone', 'like', $s);
                });
            })
            ->when($this->unit_id, fn($q) => $q->where('unit_id', (int)$this->unit_id))
            ->orderBy('first_name');

        return view('livewire.employee-table', [
            'employees' => $query->paginate(10),
            'allUnits'  => $this->allUnits,
        ])->layout('layouts.app');
    }
}
