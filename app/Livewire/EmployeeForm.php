<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\{Employee, Unit, Position, Rank, Religion};

class EmployeeForm extends Component
{
    use WithFileUploads;

    public $employee;
    public $photo;
    public $form = [
        'nip' => '',
        'first_name' => '',
        'last_name' => '',
        'birth_place' => '',
        'birth_date' => '',
        'gender' => 'L',
        'rank_id' => '',
        'position_id' => '',
        'unit_id' => '',
        'religion_id' => '',
        'address' => '',
        'phone' => '',
        'npwp' => '',
    ];

    protected $rules = [
        'form.first_name' => 'required|string',
        'form.gender' => 'required|in:L,P',
        'photo' => 'nullable|image|max:2048',
    ];

    public function mount($employee = null)
    {
        if ($employee) {
            $this->employee = is_string($employee)
                ? Employee::findOrFail($employee)
                : $employee;

            $this->form = $this->employee->only(array_keys($this->form));
        }
    }

    public function save()
    {
        $validated = $this->validate()['form'];

        if ($this->photo) {
            $validated['photo_path'] = $this->photo->store('employee_photos', 'public');
        }

        if ($this->employee && $this->employee->exists) {
            $this->employee->update($validated);
            session()->flash('success', 'Data pegawai berhasil diperbarui.');
        } else {
            Employee::create($validated);
            session()->flash('success', 'Data pegawai berhasil ditambahkan.');
        }

        return redirect()->route('employees.index');
    }

    public function render()
    {
        return view('livewire.employee-form', [
            'units' => Unit::all(),
            'positions' => Position::all(),
            'ranks' => Rank::all(),
            'religions' => Religion::all(),
        ])->layout('layouts.app');
    }
}
