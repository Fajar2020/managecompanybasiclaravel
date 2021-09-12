<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use Image;


class CompanyController extends Controller
{
    //

    public function allActiveCompanies(){
        $companies=Company::paginate(5);
        return view('content/company.index', compact('companies'));
    }

    public function addCompany(){
        return view('content/company.add');
    }

    public function storeCompany(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2',
            'logo'=> 'mimes:jpg,jpeg,png',
            'email'=> 'nullable|email',
            'website'=> 'nullable|url'
        ],
        [
            'name.required' => 'Please Fill in Company Name',
            'name.min' => 'Company name has at least two characters',
            'logo.mimes' => 'Please choose file with type jpg, jpeg, or png',
            'email.email' => 'Company email is invalid, Please choose valid email',
            'website.url' => 'Company website is invalid, Please fill in with valid url'
        ]);


        $logo=$request->file('logo');
        $last_img='';
        if($logo){
            $name_gen=hexdec(uniqid()).'.'.$logo->getClientOriginalExtension();
            $last_img='storage/app/public/'.$name_gen;
            Image::make($logo)->resize(300, 200)->save($last_img);
        }

        
        $company=new Company;
        $company->name=$request->name;
        $company->email=$request->email?$request->email:'';
        $company->website=$request->website?$request->website:'';
        $company->logo=$last_img;
        $company->save();

        $notification=array(
            'message'=>'New Company is inserted successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.company')->with($notification);
    }

    public function editCompany($id){
        $company=Company::findOrFail($id);
        return view('content/company.edit', compact('company'));
    }

    public function updateCompany(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2',
            'logo'=> 'mimes:jpg,jpeg,png',
            'email'=> 'nullable|email',
            'website'=> 'nullable|url'
        ],
        [
            'name.required' => 'Please Fill in Company Name',
            'name.min' => 'Company name has at least four characters',
            'logo.mimes' => 'Please choose file with type jpg, jpeg, or png',
            'email.email' => 'Company email is invalid, Please choose valid email',
            'website.url' => 'Company website is invalid, Please fill in with valid url'
        ]);

        $old_image=$request->old_image;
        $logo=$request->file('logo');

        $last_img=$old_image?$old_image:'';
        
        if($logo){
            $name_gen=hexdec(uniqid()).'.'.$logo->getClientOriginalExtension();
            $last_img='storage/app/public/'.$name_gen;
            Image::make($logo)->resize(300, 200)->save($last_img);
            if($old_image){
                unlink($old_image); 
            }
        }

        $company=Company::findOrFail($request->id);
        $company->name=$request->name;
        $company->email=$request->email?$request->email:'';
        $company->website=$request->website?$request->website:'';
        $company->logo=$last_img;
        $company->save();

        $notification=array(
            'message'=>'The Company data is updated successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.company')->with($notification);
    }

    public function softDeleteCompany($id){
        $delete = Company::findOrFail($id)->delete();
        $notification=array(
            'message'=>'The company move to recycle bin successfully',
            'alert-type'=>'warning'
        );
        return Redirect()->route('reycle.all.company')->with($notification);
    }

    public function allSoftDelCompanies(){
        // deleted companies
        $softDelCompanies= Company::onlyTrashed()->latest()->paginate(5);
        return view('content/company.soft_del_index', compact('softDelCompanies'));
    }

    public function restoreCompany($id){
        $delete = Company::withTrashed()->find($id)->restore();
        $notification=array(
            'message'=>'The company has been restore successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('all.company')->with($notification);
    }

    public function forceDeleteCompany($id){
        $delete = Company::onlyTrashed()->find($id)->forceDelete();
        $notification=array(
            'message'=>'Company data has fully deleted',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }
}
