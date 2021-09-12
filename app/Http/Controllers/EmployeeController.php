<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;

use App\Notifications\NewEmployeeNotify;

use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    //

    public function allActiveEmployees(){
        $employees=Employee::paginate(5);
        return view('content/employee.index', compact('employees'));
    }

    public function addEmployee(){
        $companies=Company::get();
        return view('content/employee.add', compact('companies'));
    }

    public function storeEmployee(Request $request){
        $validated = $request->validate([
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'email'=> 'nullable|email',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'company_id' => 'required'
        ],
        [
            'firstName.required' => 'Please Fill in Employee first name',
            'firstName.min' => 'Employee first name has at least two characters',
            'lastName.required' => 'Please Fill in Employee last name',
            'lastName.min' => 'Employee last name has at least two characters',
            'email.email' => 'Employee email is invalid, Please choose valid email',
            'phone.regex' => 'Please fill in with valid phone number',
            'company_id.required' => 'Please choose the company'
        ]);

        
        $Employee=new Employee;
        $Employee->firstName=$request->firstName;
        $Employee->lastName=$request->lastName;
        $Employee->email=$request->email?$request->email:'';
        $Employee->phone=$request->phone?$request->phone:'';
        $Employee->company_id=$request->company_id;
        $Employee->save();

        
        if($request->company_id){
            $company=Company::find($request->company_id);
            Notification::route('mail' , $company->email) //Sending mail to company email
                          ->notify(new NewEmployeeNotify($E));
        }

        $notification=array(
            'message'=>'New Employee is inserted successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.employee')->with($notification);
    }

    public function editEmployee($id){
        $employee=Employee::findOrFail($id);
        $companies=Company::get();
        return view('content/employee.edit', compact('employee','companies'));
    }

    public function updateEmployee(Request $request){
        $validated = $request->validate([
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'email'=> 'nullable|email',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'company_id' => 'required'
        ],
        [
            'firstName.required' => 'Please Fill in Employee first name',
            'firstName.min' => 'Employee first name has at least two characters',
            'lastName.required' => 'Please Fill in Employee last name',
            'lastName.min' => 'Employee last name has at least two characters',
            'email.email' => 'Employee email is invalid, Please choose valid email',
            'phone.regex' => 'Please fill in with valid phone number',
            'company_id.required' => 'Please choose the company'
        ]);

        

        $Employee=Employee::findOrFail($request->id);
        $Employee->firstName=$request->firstName;
        $Employee->lastName=$request->lastName;
        $Employee->email=$request->email?$request->email:'';
        $Employee->phone=$request->phone?$request->phone:'';
        $Employee->company_id=$request->company_id;
        $Employee->save();


        $notification=array(
            'message'=>'The Employee data is updated successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.employee')->with($notification);
    }

    public function softDeleteEmployee($id){
        $delete = Employee::findOrFail($id)->delete();
        $notification=array(
            'message'=>'The Employee move to recycle bin successfully',
            'alert-type'=>'warning'
        );
        return Redirect()->route('reycle.all.employee')->with($notification);
    }

    public function allSoftDelEmployees(){
        // deleted Employees
        $softDelEmployees= Employee::onlyTrashed()->latest()->paginate(5);
        return view('content/employee.soft_del_index', compact('softDelEmployees'));
    }

    public function restoreEmployee($id){
        $delete = Employee::withTrashed()->find($id)->restore();
        $notification=array(
            'message'=>'The Employee has been restore successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('all.employee')->with($notification);
    }

    public function forceDeleteEmployee($id){
        $delete = Employee::onlyTrashed()->find($id)->forceDelete();
        $notification=array(
            'message'=>'Employee data has fully deleted',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }
}
