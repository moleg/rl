<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Team;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use app\Models;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{

    public function index()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $this->validate($request,[
            "email" =>"email|required|max:50",
            "first_name"=>"required|max:20",
            "last_name"=>"required|max:20",
            "teacher"=>"required|max:50",
            "city"=>"required|max:20",
            "school"=>"required|max:30",
            "phone"=>"required",

        ]);

        $student = new Student();
        $student->IpAdress = request()->ip();
        $student->FirstName = mb_strtoupper($request["first_name"], "utf-8");
        $student->LastName = mb_strtoupper($request["last_name"], "utf-8");
        $student->Class = $request["class_num"];
        $student->City = mb_strtoupper($request["city"], "utf-8");
        $student->LeadSource = $request["lead_source"];
        $student->Teacher = $request["teacher"];
        $student->OlympType = $request["type"];
        $student->Email = $request["email"];
        $student->PhoneNumber = $request["phone"];
        $student->School = $request["school"];
        $student->LeadSource = $request["lead_source"];
        $student->Registration = isset($request["registration"]) ? true : false;
        $student->save();
        $message = "Успешная регистрация";
        $username = array("FirstName"=>$request["first_name"],"LastName"=>$request["last_name"]);

        Mail::send("mail",$username,function ($message) use ($request) {

            $message->to($request["email"])->subject("Test");
        });
        return redirect()->back()->with("message",$message);
    }
    public function registerTeam(Request $request)
    {
        $team = new Team();
        return redirect()->back();
    }
    public function getCities()
    {

        $citylist = File::get("city.json");
        return response($citylist);
    }
}
