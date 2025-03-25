<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Attendance;

class StudentController extends Controller
{
    public function registerForm(){
        return view('auth.registerform');
    }
    public function register(Request $request){
        $request->validate([
            'student_name' => 'required',
            'mssv' => 'required|unique:student,mssv',
            'email' => 'required|email|unique:student,email',
            'password' => 'required|min:6',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
//dd($request);
       
        $imageName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->move(public_path('uploads'), $imageName);

        $student = new Student();
        $student->studentname = $request->student_name;
        $student->mssv = $request->mssv;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->profile_image = 'uploads/' . $imageName;
        $student->role = 1;
        $student->status = 1;
        $student->save();

        return redirect('/login')->with('success', 'Đăng ký thành công!');
    }
    public function showLoginForm()
    {
        return view('auth.loginform');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('student')->attempt($credentials)) {
            $student = Auth::guard('student')->user();

            if ($student->role == 2) {
                return redirect()->route('admin.admindashboard')->with('success', 'Đăng nhập thành công!');
            }
            elseif ($student->role == 1) {
                $attendances = Attendance::where('student_id', Auth::guard('student')->user()->id)->get();

                return view('user.studentdashboard', compact('attendances'))->with('success', 'Đăng nhập thành công!');
            }
            else {
                Auth::guard('student')->logout();
                return back()->withErrors(['email' => 'Bạn không có quyền truy cập.']);
            }
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect('/login');
    }
    public function index(){
        $students = Student::all();
        return view('admin.student.index', compact('students'));
    }
    public function create(){
        return view('admin.student.create');
    }


    public function store(Request $request) {
        $request->all();
//dd($request);
       
        $imageName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->move(public_path('uploads'), $imageName);

        $student = new Student();
        $student->studentname = $request->student_name;
        $student->mssv = $request->mssv;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->profile_image = 'uploads/' . $imageName;
        $student->role = 1;
        $student->status = 1;
        $student->save();
        return redirect()->route('students.index')->with('success', 'Thêm sinh viên thành công!');
    }

    public function destroy($id)
{
    $student = Student::find($id);

    if (!$student) {
        return redirect()->route('students.index')->with('error', 'Sinh viên không tồn tại.');
    }

    // Xóa tất cả attendance liên quan đến student
    Attendance::where('student_id', $id)->delete();

    // Xóa ảnh đại diện nếu tồn tại
    $imagePath = public_path('uploads/' . $student->profile_image);
    if (File::exists($imagePath)) {
        File::delete($imagePath);
    }

    // Xóa sinh viên
    $student->delete();

    return redirect()->route('students.index')->with('success', 'Sinh viên và toàn bộ điểm danh liên quan đã bị xóa!');
}

}
