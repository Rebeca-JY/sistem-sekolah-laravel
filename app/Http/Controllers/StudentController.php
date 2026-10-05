<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;

class StudentController extends Controller
{
    public function index()
    {
        $title = "Sistem Sekolah - Daftar Siswa";
        $students = Student::select('id', 'nis', 'name', 'class', 'major')->get();
       
        return view('students.index', [
            'title' => $title,
            'students' => $students
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
        //validsai
        $validatedRequest = $request -> validate();

            //Tambahkan Data ke Database
            Student::create($validatedRequest);

            //Handle if success
            return redirect()->route('students.index');
    }

    public function update(Student $student, UpdateRequest $request)
    {
        //validsai
        $validatedRequest =  $request->validated();

        // update data
        $student->update($validatedRequest);

        //Handle if success
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        ///delete data
        $student->delete();

        //Handle if success
        return redirect()->route('students.index');
    }
}
