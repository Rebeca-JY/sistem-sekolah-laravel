<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $title = "Sistem Sekolah - Daftar Siswa";
        $students = [
            [
                'id' => 1,
                'nis' => '1001',
                'name' => 'Andi',
                'class' => 'XII TKJ 2',
                'major' => 'TKJ',
            ],
            [
                'id' => 2,
                'nis' => '1002',
                'name' => 'Budi',
                'class' => 'XII TKJ 1',
                'major' => 'TKJ',
            ]
        ];

        return view('students.index', [
            'title' => $title,
            'students' => $students
        ]);
    }

    public function show(string $id)
    {
        $title = "Sistem Sekolah - Detail Siswa";
        
        return view('students.show', [
            'title' => $title,
        ]);
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Siswa";
        
        return view('students.create', [
            'title' => $title,
        ]);
    }


    public function edit(string $id)
    {
        $title = "Sistem Sekolah - Ubah Siswa";
        
        return view('students.edit', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        //validsai
        $request -> validate([
            'nis' => ['required', 'string','size:4', 'unique:students,nis'],
            'name' => ['required', 'string'],
            'gender' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'major' => ['required', 'string', 'in:AKL,TKJ,BID'],
            'class' => ['required', 'string'],
            ]);

            //Tambahkan Data ke Database
            $student = new Student();
            $student->nis = $request->nis;
            $student->name = $request->name;
            $student->gender = $request->gender;
            $student->major = $request->major;
            $student->class = $request->class;
            $student->save();

            //Handle if success
            return redirect()->route('students.index');
    }

    public function update(string $id)
    {
        return "Melakukan perubahan data siswa";
    }

    public function destroy(string $id)
    {
        return "Menghapus data siswa";
    }
}
