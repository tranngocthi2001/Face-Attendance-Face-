<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;


class AttendanceController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $students = Student::all();
        return view('admin.attendance.index', compact('subjects', 'students'));
    }
    public function create($id)
    {
        $subject = Subject::find($id);
        $attendances = Attendance::where('subject_id', $id)->get();
        $students = Student::all();
        return view('admin.attendance.create', compact('subject', 'attendances', 'students'));
    }
    public function store(Request $request)
    {
        $request->all();
        //dd($request);
        $image = $request->image;
        //dump($image); 
        
        $subject_id = $request->subject_id;
        
        $validatedData = $request->validate([
            'subject_id' => 'required|exists:subject,id',
            'image' => 'required|string'
        ]);

        // Lấy ds public/anh
        $imageDirectory = public_path('uploads'); // Đường dẫn uploads
        $studentImages = File::files($imageDirectory); // Lấy tất cả file 
        //dump($studentImages);
        //log::info('Student Images:', ['images' => $studentImages]);

        // Chuyển đổi tất cả ảnh sinh viên sang base64
        $studentImageBase64List = [];
        $studentImageNames = [];
        foreach ($studentImages as $studentImage) {
            $imageData = file_get_contents($studentImage->getPathname());//chuyển ảnh thành nhị phân
//dd($imageData);
            $studentImageBase64List[] = base64_encode($imageData); // Chuyển thành base64
            $studentImageNames[] = $studentImage->getFilename(); // Lưu tên file
        }

//dd($studentImageNames);
        // Face++ API Keys
        $api_key = "GKue9GEL_tgEcHYKqGL7tGGbeMhTaaEj";
        $api_secret = "zOS14Y29mX65ksNVRPY2xJydtoJntmzU";
        $face_api_url = "https://api-us.faceplusplus.com/facepp/v3/compare";

        //dump($studentImageNames);
        foreach ($studentImageBase64List as $index => $base64image) {
            //dump($base64image);
            $response = Http::asForm()->withOptions(['verify' => false])->post($face_api_url, [
                'api_key' => $api_key,
                'api_secret' => $api_secret,
                'image_base64_1' => $image,
                'image_base64_2' => $base64image 
            ]);
            $result = $response->json();
            //dd($result);
            //Log::info('Face++ API response', ['response' => $result]);
            if (isset($result['confidence']) && $result['confidence'] > 80) {
                $matchedStudentImage = $studentImageNames[$index];
                //dd($matchedStudentImage);
                //log::info('Matched student image:', ['image' => $matchedStudentImage]);
                $student= Student::where('profile_image', 'LIKE', "%/$matchedStudentImage")->first();
                //dd($student);
                $student_id = $student->id;
                //dd($student_id);
                //log::info('Student ID:', ['id' => $student_id]);
                //dd($student_id);
                $attendance_befor= Attendance::where('subject_id', $subject_id)
                ->where('student_id', $student_id )->first();
                //dd($subject_id);
                if($attendance_befor){
                    return redirect()->back() ->with('error', 'Người tham dự đã điểm danh!');;
                }
                $attendance = Attendance::create([
                    'time' => now(),
                    'status' => 1,
                    'capture_image' => $matchedStudentImage,
                    'subject_id' => $subject_id,
                    'student_id' =>$student_id,
                ]);
                return redirect()->back() ->with('success', 'Điểm danh thành công!');
            }
        }
        $attendances = Attendance::where('subject_id', $subject_id)->get();
        //dd($result);
        return redirect()->back();
    }
}
