<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with("students",Student::all());
    }

    public function name(Request $request,$name)
    {
        $students = Student::where("LastName","like","%".$name."%")
            ->orWhere("FirstName","like","%".$name."%")
            ->get();
        return view('home')->with("students",$students);
    }
    public function delete(Request $request,$id)
    {
        Student::destroy($id);
        //return redirect()->route("home");
        return response()->json("OK");
    }
    public function update(Request $request)
    {
        $student = Student::find($request["id"]);
        $student->FirstName = $request["firstName"];
        $student->LastName = $request["lastName"];
        $student->Class = $request["class"];
        $student->City = $request["city"];
        $student->Teacher = $request["teacher"];
        $student->OlympType = $request["olympType"];
        $student->Email = $request["email"];
        $student->PhoneNumber = $request["phone"];
        $student->School = $request["school"];
        $student->save();
    }
    public function GetMarks(Request $request)
    {
        $studentmarks = Student::where("idStudents",$request["id"])
            ->first(["test1","test2","test3","test4","test5","test6","test7","test8","test9","test10"]);
        return response()->json($studentmarks);
    }
    public function UpdateMarks(Request $request)
    {
        $studentmarks =Student::find($request["id"]);
        $studentmarks->test1 = $request["test1"];
        $studentmarks->test2 = $request["test2"];
        $studentmarks->test3 = $request["test3"];
        $studentmarks->test4 = $request["test4"];
        $studentmarks->test5 = $request["test5"];
        $studentmarks->test6 = $request["test6"];
        $studentmarks->test7 = $request["test7"];
        $studentmarks->test8 = $request["test8"];
        $studentmarks->test9 = $request["test9"];
        $studentmarks->test10 = $request["test10"];
        $studentmarks->save();
        return $request->json("OK");
    }
}
