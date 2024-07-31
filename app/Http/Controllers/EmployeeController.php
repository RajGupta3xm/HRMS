<?php

namespace App\Http\Controllers;

use App\Models\module;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class EmployeeController extends Controller
{
    public function employeeManagement()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        return view('add_employee', ['modules' => $modules]);
    }
    public function employeeStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'empId' => 'required|unique:employees|max:255',
                'emergencycontact' => 'required|numeric',
                'pannumber' => 'required',
                'name' => 'required|string|max:255',
                'currentaddress' => 'required|max:255',
                'userDepartment' => 'required',
                'permanentaddress' => 'required|string|max:255',
                'comnpanyexperience' => 'required|numeric',
                'userDesignation' => 'required',
                'city' => 'required|string|max:255',
                'employeestatus' => 'required|string|in:active,inactive',
                'reportingmanager' => 'required|string|max:255',
                'dob' => 'required|date',
                'lastworkingday' => 'required|date',
                'officialemail' => 'required|email|max:255',
                'joiningdate' => 'required|date',
                'personalemail' => 'required|email|max:255',
                'higestqualification' => 'required|string|max:255',
                'contactdetails' => 'required|string|max:255',
                'aadharnumber' => 'required|string|max:255',
            ],
            [
                'empId.required' => 'Employee ID is required.',
                'empId.unique' => 'Employee ID must be unique.',
                'empId.max' => 'Employee ID must not exceed 255 characters.',
                'emergencycontact.required' => 'Emergency contact is required.',
                'emergencycontact.numeric' => 'Emergency contact must be a numeric value.',
                'pannumber.required' => 'PAN number is required.',
                'name.required' => 'Name is required.',
                'name.max' => 'Name must not exceed 255 characters.',
                'currentaddress.required' => 'Current address is required.',
                'currentaddress.max' => 'Current address must not exceed 255 characters.',
                'trainingcompletion.max' => 'Training completion must not exceed 255 characters.',
                'userDepartment.required' => 'Department is required.',
                'permanentaddress.required' => 'Permanent address is required.',
                'permanentaddress.max' => 'Permanent address must not exceed 255 characters.',
                'comnpanyexperience.required' => 'Company experience is required.',
                'comnpanyexperience.numeric' => 'Company experience must be a numeric value.',
                'userDesignation.required' => 'Designation is required.',
                'city.required' => 'City is required.',
                'city.max' => 'City must not exceed 255 characters.',
                'employeestatus.required' => 'Employee status is required.',
                'employeestatus.in' => 'Employee status must be either active or inactive.',
                'reportingmanager.required' => 'Reporting manager is required.',
                'reportingmanager.max' => 'Reporting manager must not exceed 255 characters.',
                'dob.required' => 'Date of birth is required.',
                'dob.date' => 'Date of birth must be a valid date.',
                'lastworkingday.required' => 'Last working day is required.',
                'lastworkingday.date' => 'Last working day must be a valid date.',
                'officialemail.required' => 'Official email is required.',
                'officialemail.email' => 'Official email must be a valid email address.',
                'officialemail.max' => 'Official email must not exceed 255 characters.',
                'joiningdate.required' => 'Joining date is required.',
                'joiningdate.date' => 'Joining date must be a valid date.',
                'personalemail.required' => 'Personal email is required.',
                'personalemail.email' => 'Personal email must be a valid email address.',
                'personalemail.max' => 'Personal email must not exceed 255 characters.',
                'higestqualification.required' => 'Highest qualification is required.',
                'higestqualification.max' => 'Highest qualification must not exceed 255 characters.',
                'contactdetails.required' => 'Contact details is required.',
                'contactdetails.max' => 'Contact details must not exceed 255 characters.',
                'aadharnumber.required' => 'Aadhar number is required.',
                'aadharnumber.max' => 'Aadhar number must not exceed 255 characters.',

            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $empId = $request->input('empId');
        $emergencycontact = $request->input('emergencycontact');
        $pannumber = $request->input('pannumber');
        $name = $request->input('name');
        $currentaddress = $request->input('currentaddress');
        $trainingcompletion = $request->input('trainingcompletion');
        $department = $request->input('userDepartment');
        $permanentaddress = $request->input('permanentaddress');
        $comnpanyexperience = $request->input('comnpanyexperience');
        $designation = $request->input('userDesignation');
        $city = $request->input('city');
        $employeestatus = $request->input('employeestatus');
        $reportingmanager = $request->input('reportingmanager');
        $dob = $request->input('dob');
        $lastworkingday = $request->input('lastworkingday');
        $officialemail = $request->input('officialemail');
        $joiningdate = $request->input('joiningdate');
        $personalemail = $request->input('personalemail');
        $higestqualification = $request->input('higestqualification');
        $contactdetails = $request->input('contactdetails');
        $aadharnumber = $request->input('aadharnumber');


        $addEmployee = employees::create([
            'empId' => $empId,
            'emergencycontact' => $emergencycontact,
            'pannumber' => $pannumber,
            'name' => $name,
            'currentaddress' => $currentaddress,
            'trainingcompletion' => $trainingcompletion,
            'department' => $department,
            'permanentaddress' => $permanentaddress,
            'comnpanyexperience' => $comnpanyexperience,
            'designation' => $designation,
            'city' => $city,
            'employeestatus' => $employeestatus,
            'reportingmanager' => $reportingmanager,
            'dob' => $dob,
            'lastworkingday' => $lastworkingday,
            'officialemail' => $officialemail,
            'joiningdate' => $joiningdate,
            'personalemail' => $personalemail,
            'higestqualification' => $higestqualification,
            'contactdetails' => $contactdetails,
            'aadharnumber' => $aadharnumber,
        ]);


        if ($addEmployee) {
            $status = "Employee added successfully!";
            return redirect('/employeeView')->with('status', $status);
        } else {
            $status = "Failed to add Employee!";
            return redirect()->back()->with('status', $status);
        }
    }

    public function employeeView()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $employeeData = employees::paginate(15);
        return view('Employee-view', ['modules' => $modules, 'employeeData' => $employeeData]);
    }
    public function employeeSearch(Request $request)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $search = $request->input('search');
        $filterData = employees::where('empId', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('designation', 'LIKE', '%' . $search . '%')
            ->get();

        return view('Employee-searchView', ['modules' => $modules, 'filterData' => $filterData]);
    }
    public function deleteSelected(Request $request)
    {
        $selectedEmployeeIds = explode(',', $request->input('selectedEmployeeIds'));
        employees::whereIn('id', $selectedEmployeeIds)->delete();
        return redirect()->back()->with('success', 'Selected employees have been deleted successfully.');
    }


    public function employeeFind()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        return view('Findemployee', ['modules' => $modules]);
    }
    public function FindEmployee(Request $request)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $search = $request->input('search');
        $employees = employees::where('empId', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('designation', 'LIKE', '%' . $search . '%')
            ->paginate(15);

        return view('searchView', ['employees' => $employees, 'modules' => $modules]);
    }

    public function ViewDetailsEmployee($id)
    {
        $employeeData = employees::find($id);
        $modules = Session::get('user_modules_' . auth()->id());
        return view('viewDetailsEmployee', ['modules' => $modules, 'employeeData' => $employeeData]);
    }

    public function employeeUpdate($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $updateId = $id;
        $employeeData =   employees::where('id', $updateId)->get();
        return view('employeeDataUpdate', ['modules' => $modules, 'employeeData' => $employeeData]);
    }
    public function employeeUpdateStore(Request $request)
    {

        $EmployeeId = $request->input('id');
        $validator = Validator::make(
            $request->all(),
            [
                'empId' => 'required|max:255|unique:employees,empId,' . $EmployeeId,
                'emergencycontact' => 'required|numeric',
                'pannumber' => 'required',
                'name' => 'required|string|max:255',
                'currentaddress' => 'required|max:255',
                'userDepartment' => 'required|string|max:255',
                'permanentaddress' => 'required|string|max:255',
                'comnpanyexperience' => 'required|numeric',
                'userDesignation' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'employeestatus' => 'required|string|in:active,inactive',
                'reportingmanager' => 'required|string|max:255',
                'dob' => 'required|date',
                'lastworkingday' => 'required|date',
                'officialemail' => 'required|email|max:255',
                'joiningdate' => 'required|date',
                'personalemail' => 'required|email|max:255',
                'higestqualification' => 'required|string|max:255',
                'contactdetails' => 'required|string|max:255',
                'aadharnumber' => 'required|string|max:255',
            ],
            [
                'empId.required' => 'Employee ID is required.',
                'empId.unique' => 'Employee ID must be unique.',
                'empId.max' => 'Employee ID must not exceed 255 characters.',
                'emergencycontact.required' => 'Emergency contact is required.',
                'emergencycontact.numeric' => 'Emergency contact must be a numeric value.',
                'pannumber.required' => 'PAN number is required.',
                'name.required' => 'Name is required.',
                'name.max' => 'Name must not exceed 255 characters.',
                'currentaddress.required' => 'Current address is required.',
                'currentaddress.max' => 'Current address must not exceed 255 characters.',
                'trainingcompletion.max' => 'Training completion must not exceed 255 characters.',
                'userDepartment.required' => 'Department is required.',
                'permanentaddress.required' => 'Permanent address is required.',
                'permanentaddress.max' => 'Permanent address must not exceed 255 characters.',
                'comnpanyexperience.required' => 'Company experience is required.',
                'comnpanyexperience.numeric' => 'Company experience must be a numeric value.',
                'userDesignation.required' => 'Designation is required.',
                'city.required' => 'City is required.',
                'city.max' => 'City must not exceed 255 characters.',
                'employeestatus.required' => 'Employee status is required.',
                'employeestatus.in' => 'Employee status must be either active or inactive.',
                'reportingmanager.required' => 'Reporting manager is required.',
                'reportingmanager.max' => 'Reporting manager must not exceed 255 characters.',
                'dob.required' => 'Date of birth is required.',
                'dob.date' => 'Date of birth must be a valid date.',
                'lastworkingday.required' => 'Last working day is required.',
                'lastworkingday.date' => 'Last working day must be a valid date.',
                'officialemail.required' => 'Official email is required.',
                'officialemail.email' => 'Official email must be a valid email address.',
                'officialemail.max' => 'Official email must not exceed 255 characters.',
                'joiningdate.required' => 'Joining date is required.',
                'joiningdate.date' => 'Joining date must be a valid date.',
                'personalemail.required' => 'Personal email is required.',
                'personalemail.email' => 'Personal email must be a valid email address.',
                'personalemail.max' => 'Personal email must not exceed 255 characters.',
                'higestqualification.required' => 'Highest qualification is required.',
                'higestqualification.max' => 'Highest qualification must not exceed 255 characters.',
                'contactdetails.required' => 'Contact details is required.',
                'contactdetails.max' => 'Contact details must not exceed 255 characters.',
                'aadharnumber.required' => 'Aadhar number is required.',
                'aadharnumber.max' => 'Aadhar number must not exceed 255 characters.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $EmployeeId = $request->input('id');
        $empId = $request->input('empId');
        $emergencycontact = $request->input('emergencycontact');
        $pannumber = $request->input('pannumber');
        $name = $request->input('name');
        $currentaddress = $request->input('currentaddress');
        $trainingcompletion = $request->input('trainingcompletion');
        $department = $request->input('userDepartment');
        $permanentaddress = $request->input('permanentaddress');
        $comnpanyexperience = $request->input('comnpanyexperience');
        $designation = $request->input('userDesignation');
        $city = $request->input('city');
        $employeestatus = $request->input('employeestatus');
        $reportingmanager = $request->input('reportingmanager');
        $dob = $request->input('dob');
        $lastworkingday = $request->input('lastworkingday');
        $officialemail = $request->input('officialemail');
        $joiningdate = $request->input('joiningdate');
        $personalemail = $request->input('personalemail');
        $higestqualification = $request->input('higestqualification');
        $contactdetails = $request->input('contactdetails');
        $aadharnumber = $request->input('aadharnumber');
        $employee = employees::findOrFail($EmployeeId);
        $employee->update([
            'empId' => $empId,
            'emergencycontact' => $emergencycontact,
            'pannumber' => $pannumber,
            'name' => $name,
            'currentaddress' => $currentaddress,
            'trainingcompletion' => $trainingcompletion,
            'department' => $department,
            'permanentaddress' => $permanentaddress,
            'comnpanyexperience' => $comnpanyexperience,
            'designation' => $designation,
            'city' => $city,
            'employeestatus' => $employeestatus,
            'reportingmanager' => $reportingmanager,
            'dob' => $dob,
            'lastworkingday' => $lastworkingday,
            'officialemail' => $officialemail,
            'joiningdate' => $joiningdate,
            'personalemail' => $personalemail,
            'higestqualification' => $higestqualification,
            'contactdetails' => $contactdetails,
            'aadharnumber' => $aadharnumber,
        ]);

        return redirect()->route('employeeView')->with('success', 'Employee data updated successfully.');
    }
    public function employeeimportCSV(Request $request)
    {

        $departmentMap = [
            'Delivery' => 0,
            
        ];

        $file = $request->file('file')->getClientOriginalName();
        $filetempName  = $request->file('file')->getPathname();
        $fileSize  = $request->file('file')->getSize();

        $skipHeader = true;

        $checkColumns = explode(".", $file);
        if ($checkColumns[1] == 'csv') {
            $handle = fopen($filetempName, "r");

            while (($line = fgetcsv($handle)) !== false) {
                if (empty($line)) {
                    continue;
                } elseif ($skipHeader) {
                    $skipHeader = false;
                    continue;
                }

                $dob = date('Y-m-d', strtotime(str_replace('-', '/', $line[13])));
                $lastWorkingDay = date('Y-m-d', strtotime(str_replace('-', '/', $line[14])));
                $joiningDate = date('Y-m-d', strtotime(str_replace('-', '/', $line[16])));
                $aadharnumber = $line[20];

                employees::create([
                    'empId' => !empty($line[0]) ? $line[0] : '',
                    'emergencycontact' => $line[1],
                    'pannumber' => $line[2],
                    'name' => $line[3],
                    'currentaddress' => $line[4],
                    'trainingcompletion' => $line[5],
                    'department' => $line[6],
                    'permanentaddress' => $line[7],
                    'comnpanyexperience' => (int) $line[8],
                    'designation' => $line[9],
                    'city' => $line[10],
                    'employeestatus' => $line[11],
                    'reportingmanager' => $line[12],
                    'dob' => $dob,
                    'lastworkingday' => $lastWorkingDay,
                    'officialemail' => $line[15],
                    'joiningdate' => $joiningDate,
                    'personalemail' => $line[17],
                    'higestqualification' => $line[18],
                    'contactdetails' => $line[19],
                    'aadharnumber' => $aadharnumber,
                ]);
            }


            fclose($handle);
        }




        return redirect()->back()->with('success', 'Employees imported successfully.');
    }






    // public function employeeExportCSV()
    // {
    //     header("Content-type: text/csv");
    //     header("Content-Disposition: attachment; filename=employees.csv");
    //     header("Pragma: no-cache");
    //     header("Expires: 0");

    //     $departmentMapping = [
    //         0 => 'Delivery',
            
    //     ];

    //     $allUsers = Employees::all();
    //     error_log("Total records fetched: " . count($allUsers));

    //     $columns = array(
    //         'empId', 'emergencycontact', 'pannumber', 'name', 'currentaddress',
    //         'trainingcompletion', 'department', 'permanentaddress', 'comnpanyexperience',
    //         'designation', 'city', 'employeestatus', 'reportingmanager', 'dob',
    //         'lastworkingday', 'officialemail', 'joiningdate', 'personalemail',
    //         'higestqualification', 'contactdetails', 'aadharnumber'
    //     );

    //     $file = fopen('php://output', 'w');
    //     fputcsv($file, $columns);

    //     foreach ($allUsers as $employee) {
    //         $department = isset($departmentMapping[$employee->department]) ? $departmentMapping[$employee->department] : '';

    //         fputcsv($file, [
    //             $employee->empId,
    //             $employee->emergencycontact,
    //             $employee->pannumber,
    //             $employee->name,
    //             $employee->currentaddress,
    //             $employee->trainingcompletion,
    //             $department,
    //             $employee->permanentaddress,
    //             $employee->comnpanyexperience,
    //             $employee->designation,
    //             $employee->city,
    //             $employee->employeestatus,
    //             $employee->reportingmanager,
    //             $employee->dob,
    //             $employee->lastworkingday,
    //             $employee->officialemail,
    //             $employee->joiningdate,
    //             $employee->personalemail,
    //             $employee->higestqualification,
    //             $employee->contactdetails,
    //             $employee->aadharnumber,
    //         ]);
    //     }
    //     fclose($file);
    //     exit();
    // }
    public function employeeExportCSV()
{
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=employees.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $departmentMapping = [
        0 => 'Delivery',
    ];

    $allUsers = Employees::all();
    error_log("Total records fetched: " . count($allUsers));

    $columns = [
        'empId', 'emergencycontact', 'pannumber', 'name', 'currentaddress',
        'trainingcompletion', 'department', 'permanentaddress', 'comnpanyexperience',
        'designation', 'city', 'employeestatus', 'reportingmanager', 'dob',
        'lastworkingday', 'officialemail', 'joiningdate', 'personalemail',
        'higestqualification', 'contactdetails', 'aadharnumber'
    ];

    $file = fopen('php://output', 'w');
    fputcsv($file, $columns);

    foreach ($allUsers as $employee) {
        $department = isset($departmentMapping[$employee->department]) ? $departmentMapping[$employee->department] : '';

        // Check if department is empty or 0, then default to 'Delivery'
        if (empty($department)) {
            $department = 'Delivery';
        }

        fputcsv($file, [
            $employee->empId,
            $employee->emergencycontact,
            $employee->pannumber,
            $employee->name,
            $employee->currentaddress,
            $employee->trainingcompletion,
            $department,
            $employee->permanentaddress,
            $employee->comnpanyexperience,
            $employee->designation,
            $employee->city,
            $employee->employeestatus,
            $employee->reportingmanager,
            $employee->dob,
            $employee->lastworkingday,
            $employee->officialemail,
            $employee->joiningdate,
            $employee->personalemail,
            $employee->higestqualification,
            $employee->contactdetails,
            $employee->aadharnumber,
        ]);
    }

    fclose($file);
    exit();
}

}
