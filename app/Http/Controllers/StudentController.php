<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $title = "Sistem Sekolah - Daftar Siswa";

        $search = $request->query('search');
        $class = $request->query('class');
        $major = $request->query('major');

        $students = Student::select('id', 'nis', 'name', 'class', 'major')
            ->when($search, function ($query, $search){
                $query->where(function ($query) use ($search) {
                    $query->where('nis', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->when($class, fn($query, $class) => $query->where('class', '=', $class))
            ->when($major, fn($query, $major) => $query->where('major', '=', $major))
            ->paginate(10)
            ->withQueryString();

        $schoolClasses = ['10 AKL', '11 AKL', '11 TKJ 1', '11 TKJ 2', '10 BiD', '12 TKJ 1', '12 TKJ 2', '12 TKJ 3'];
        $majors = ['AKL', 'TKJ', 'BiD'];
        
        return view('students.index', [
            'title' => $title,
            'students' => $students,
            'schoolClasses' => $schoolClasses, // Perbaikan: key disesuaikan dengan variabel di Blade ($schoolClasses)
            'majors' => $majors
        ]);
    }

    public function show(Student $student)
    {
        $title = "Sistem Sekolah - Detail Siswa";
        
        return view('students.show', [
            'title' => $title,
            'student' => $student
        ]);
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Siswa";
        
        return view('students.create', [
            'title' => $title,
        ]);
    }

    public function edit(Student $student)
    {
        $title = "Sistem Sekolah - Edit Siswa";
        
        return view('students.edit', [
            'title' => $title,
            'student' => $student   
        ]);
    }

    public function store(StoreRequest $request)
    {
        // Perbaikan: gunakan validated() bukan validate() pada Form Request
        $validatedRequest = $request->validated();

        // Tambahkan Data ke Database
        Student::create($validatedRequest);

        // Handle if success
        return redirect()->route('students.index');
    }

    public function update(Student $student, UpdateRequest $request)
    {
        // Validasi
        $validatedRequest = $request->validated();

        // Update data
        $student->update($validatedRequest);

        // Handle if success
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        // Delete data
        $student->delete();

        // Handle if success
        return redirect()->route('students.index');
    }
}