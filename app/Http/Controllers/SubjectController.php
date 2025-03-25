<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Attendance;
class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::all();
        return view('admin.subject.index', compact('subjects'));
    }
    public function create(){
        return view('admin.subject.create');
    }
    public function store(Request $request){
        $data= $request->all();
        Subject::create($data);
        return redirect()->route('subjects.index')->with('success', 'Thêm môn học thanh cong!');
    }
    public function edit($id){
        $subject = Subject::find($id);
        return view('admin.subject.edit', compact('subject'));
    }
    public function update(Request $request, $id){
        $subject = Subject::find($id);
        $subject->subjectname = $request->subjectname;
        $subject->save();
        return redirect()->route('subjects.index')->with('success', 'Chỉnh sửa môn học thanh cong!');
    }
    public function destroy($id){
        $subject = Subject::find($id);
        
        if (!$subject) {
            return back()->withErrors(['error' => 'Môn học không tồn tại!']);
        }
    
        // Xóa tất cả điểm danh liên quan đến môn học
        Attendance::where('subject_id', $id)->delete();
    
        // Xóa môn học
        $subject->delete();
    
        return redirect()->route('subjects.index')->with('success', 'Môn học và toàn bộ điểm danh liên quan đã bị xóa.');
    }
    
}
