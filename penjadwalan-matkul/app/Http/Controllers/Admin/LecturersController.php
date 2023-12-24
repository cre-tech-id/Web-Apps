<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturersController extends Controller
{    

    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $lecturers = Lecturer::orderBy('id', 'Asc');

        if (!empty($request->searchname))
        {
            $lecturers = $lecturers->where('name', 'LIKE', '%' . $request->searchname . '%');
        }

        if (!empty($request->searchnidn))
        {
            $lecturers = $lecturers->where('nidn', 'LIKE', '%' . $request->searchnidn . '%');
        }

        $lecturers = $lecturers->paginate(10);

        return view('admin.lecturer.index', compact('lecturers'));
    }
    public function create(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        return view('admin.lecturer.create');
    }
    public function store(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            // 'code_lecturers' => 'unique:lecturers,code_lecturers|required',
            // 'nidnlecturer'   => 'required',
            'name'           => 'required',
            'emaillecturer'  => 'required',

        ]);        

        $data = [
            'name'           => $request->input('name'),
            'email'          => $request->input('emaillecturer'),
            'password'       => bcrypt($request->input('emaillecturer')),
            'role'           => 'dosen',
        ];

        $user = User::create($data);

        $params = [
            'code_lecturers' => date('dmyhis').rand(0,9999),
            'nidn'           => date('dmyhis').rand(0,9999),
            'name'           => $request->input('name'),
            'email'          => $request->input('emaillecturer'),
            'user_id'        => $user->id,
        ];

        $lecturers = Lecturer::create($params);

        return redirect()->route('admin.lecturers');
    }

    public function edit($id)
    {

        $role = Auth::user()->role;
        Checking::check($role);

        $lecturers = Lecturer::find($id);

        if ($lecturers == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.lecturer.edit', compact('lecturers'));
    }

    public function update(Request $request, $id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        
        $this->validate($request, [
            // 'code_lecturers' => 'unique:lecturers,code_lecturers,' . $id . '|required',
            // 'nidnlecturer'   => 'required',
            'name'           => 'required',
            'emaillecturer'  => 'required',

        ]);

        $cek = Lecturer::whereId($id)->first()->user_id;

        if($cek == null){
            $data = [
                'name'           => $request->input('name'),
                'email'          => $request->input('emaillecturer'),
                'password'       => bcrypt($request->input('emaillecturer')),
                'role'           => 'dosen',
            ];
            $user = User::create($data);

            $params = [            
                'name'           => $request->input('name'),
                'email'          => $request->input('emaillecturer'),
                'user_id'        => $user->id,
            ];
    
            $lecturers = Lecturer::whereId($id)->update($params);
        }else{
            

            $lecturers                 = Lecturer::find($id);            
            $lecturers->name           = $request->input('name');
            $lecturers->email          = $request->input('emaillecturer');
            $lecturers->save();

            $data = [
                'name'           => $request->input('name'),
                'email'          => $request->input('emaillecturer'),                                
            ];
            User::whereId($cek)->update($data);

        }        

        return redirect()->route('admin.lecturers');
    }

    public function destroy($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        Lecturer::find($id)->delete();

        return redirect()->route('admin.lecturers')->with('success', 'Dosen berhasil dihapus');
    }

}
