<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Rank;
use App\Models\Religion;
use App\Models\Unit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $q = Employee::with(['unit', 'position', 'rank', 'religion']);
        if ($request->search) {
            $search = $request->search;
            $q->where(function ($qq) use ($search) {
                $qq->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        if ($request->unit_id) {
            $q->where('unit_id', $request->unit_id);
        }
        $employees = $q->orderBy('first_name')->paginate(10)->withQueryString();
        $units = Unit::with('children')->whereNull('parent_id')->get();
        return view('employees.index', compact('employees', 'units'));
    }

    public function create()
    {
        $units = Unit::all();
        $positions = Position::all();
        $ranks = Rank::all();
        $religions = Religion::all();
        return view('employees.create', compact('units', 'positions', 'ranks', 'religions'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'nip' => 'nullable|string|unique:employees,nip',
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'birth_place' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:L,P',
            'rank_id' => 'nullable|exists:ranks,id',
            'position_id' => 'nullable|exists:positions,id',
            'unit_id' => 'nullable|exists:units,id',
            'religion_id' => 'nullable|exists:religions,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'npwp' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($req->hasFile('photo')) {
            $path =  $req->file('photo')->store('employee_photos', 'public');
            $data['photo_path'] = $path;
        }
        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $units = Unit::all();
        $positions = Position::all();
        $ranks = Rank::all();
        $religions = Religion::all();
        return view('employees.edit', compact('employee', 'units', 'positions', 'ranks', 'religions'));
    }

    public function update(Request $req, Employee $employee)
    {
        $data = $req->validate([
            'nip' => "nullable|string|unique:employees,nip,{$employee->id}",
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'birth_place' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:L,P',
            'rank_id' => 'nullable|exists:ranks,id',
            'position_id' => 'nullable|exists:positions,id',
            'unit_id' => 'nullable|exists:units,id',
            'religion_id' => 'nullable|exists:religions,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'npwp' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);
        if ($req->hasFile('photo')) {
            // hapus foto lama
            if ($employee->photo_path) Storage::disk('public')->delete($employee->photo_path);
            $data['photo_path'] = $req->file('photo')->store('photos', 'public');
        }
        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Pegawai diupdate');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo_path) {
            Storage::disk('public')->delete($employee->photo_path);
        }
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function print(Request $req)
    {
        $q = Employee::with(['unit', 'position', 'rank', 'religion']);

        if ($req->unit_id) $q->where('unit_id', $req->unit_id);
        if ($req->search) $q->where('first_name', 'like', "%{$req->search}%");

        $employees = $q->orderBy('first_name')->get();

        $pdf = Pdf::loadView('employees.print', [
            'employees' => $employees,
            'printedAt' => now()->format('d F Y, H:i')
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('daftar_pegawai.pdf');
    }
}
