<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Student;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StudentCollection(Student::all());
    }

    public function rss()
    {
        $students = Student::all();
        return response()->view('rest_rss', compact('students'))->header('Content-Type', 'application/xml');
    }

    public function rdf()
    {
        $students = Student::all();
        $nTriples = '';
        $URI = 'http://www.praktikum.com/maranatha';

        $nrp = '';
        foreach ($students as $student) {
            foreach ($student->toArray() as $key => $value) {
                if ($key != 'nrp') {
                  echo $value;
                  $nTriples .= '<'. $URI .'/'. $student->nrp .'>';
                  $nTriples .= ' <'. $URI .'#has'. ucwords($key) .'>';
                  $nTriples .= ' "'. $value .'" .' ."\n";
                }
            }
            $nTriples .= "\n";
        }

        file_put_contents("rdf.txt", $nTriples);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new StudentResource(Student::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        return new StudentResource(Student::find($student->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return json_encode(['message' => 'Student berhasil dihapus']);
    }
}
