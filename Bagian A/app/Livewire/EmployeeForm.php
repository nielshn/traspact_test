<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\{Employee, Unit, Position, Rank, Religion};
use Illuminate\Database\QueryException;

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

    public function mount($employee = null)
    {
        if ($employee) {
            $this->employee = is_string($employee)
                ? Employee::findOrFail($employee)
                : $employee;

            foreach ($this->form as $key => $val) {
                $this->form[$key] = $this->employee->{$key};
            }
        }
    }

    public function save()
    {
        // Siapkan rules dinamis untuk validasi NIP unik
        $nipRule = 'nullable|string|unique:employees,nip';
        if ($this->employee && $this->employee->exists) {
            $nipRule .= ',' . $this->employee->id; // pengecualian untuk dirinya sendiri
        }

        $validated = $this->validate([
            'form.nip' => $nipRule,
            'form.first_name' => 'required|string',
            'form.gender' => 'required|in:L,P',
            'photo' => 'nullable|image|max:2048',
        ])['form'];

        try {
            // Upload foto jika ada
            if ($this->photo) {
                $validated['photo_path'] = $this->photo->store('employee_photos', 'public');
            }

            // Simpan data (update atau create)
            if ($this->employee && $this->employee->exists) {
                $this->employee->update($validated);
                session()->flash('success', 'Data pegawai berhasil diperbarui.');
            } else {
                Employee::create($validated);
                session()->flash('success', 'Data pegawai berhasil ditambahkan.');
            }

            return redirect()->route('employees.index');
        } catch (QueryException $e) {
            // Tangani error duplikat NIP
            if ($e->getCode() == 23000) {
                $this->addError('form.nip', 'NIP ini sudah terdaftar pada pegawai lain.');
            } else {
                session()->flash('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
            }
        }
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
