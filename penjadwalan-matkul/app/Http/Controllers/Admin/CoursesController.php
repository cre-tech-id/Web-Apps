<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\Course;
use App\Models\Teach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        $courses = Course::orderBy('id', 'Asc');

        if (!empty($request->searchcode))
        {
            $courses = $courses->where('code_courses', 'LIKE', '%' . $request->searchcode . '%');
        }

        if (!empty($request->searchname))
        {
            $courses = $courses->where('name', 'LIKE', '%' . $request->searchname . '%');
        }

        $courses = $courses->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function create(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        $type = [
            'Teori'     => 'Teori',
            'Praktikum' => 'Praktikum',
        ];

        return view('admin.courses.create', compact('type'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            'code_courses' => 'unique:courses,code_courses|required',
            'namecourses'  => 'required',
            'sks'          => 'required',
            'semester'     => 'required',

        ]);

        $params = [
            'code_courses' => $request->input('code_courses'),
            'name'         => $request->input('namecourses'),
            'sks'          => $request->input('sks'),
            'semester'     => $request->input('semester'),
            'type'         => $request->input('type'),
        ];

        $courses = Course::create($params);

        return redirect()->route('admin.courses');
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $courses = Course::find($id);

        if ($courses == null)
        {
            return view('admin.layouts.404');
        }

        $type = array(
            'Teori'     => 'Teori',
            'Praktikum' => 'Praktikum');

        return view('admin.courses.edit', compact('courses', 'type'));
    }

    public function update(Request $request, $id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            'code_courses' => 'unique:courses,code_courses,' . $id . '|required',
            'namecourses'  => 'required',
            'sks'          => 'required',
            'semester'     => 'required',

        ]);

        $courses               = Course::find($id);
        $courses->code_courses = $request->input('code_courses');
        $courses->name         = $request->input('namecourses');
        $courses->sks          = $request->input('sks');
        $courses->semester     = $request->input('semester');
        $courses->type         = $request->input('type');
        $courses->save();

        return redirect()->route('admin.courses');
    }

    public function destroy($id)
    {

        $role = Auth::user()->role;
        Checking::check($role);
        
        $teachs = Teach::where('courses_id', $id)->first();

        if (!empty($teachs))
        {
            return redirect()->route('admin.courses')->with('danger', 'Anda Harus Menghapus Data Pengampu yang Berhubungan Dengan Mata Kuliah Ini Terlebih Dahulu');
        }
        else
        {
            Course::find($id)->delete();
        }

        return redirect()->route('admin.courses')->with('success', 'Mata Kuliah Berhasil Dihapus');
    }
}
