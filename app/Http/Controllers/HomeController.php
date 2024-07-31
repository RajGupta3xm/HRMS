<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\AddProjects;
use App\Models\submit_invoices;
use App\Models\add_on;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\mileStone;
use App\Models\addworkesEmployee;
use Illuminate\Support\Facades\Redirect;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\projectsuploadsfile;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceEmail;
use Kwn\NumberToWords\NumberTransformer\NumberTransformer as NumberToWordsTransformer;
use App\Mail\ProjectAdded;
use App\Models\employees;





class HomeController  extends Controller
{
   public function showLoginForm()
   {
      return view('auth.login');
   }


   public function adminLogin(Request $request)
   {
      $email = $request->input('email');
      $password = $request->input('password');
      $users = User::where('email', $email)->first();
      // dd($users);

      if (Auth::attempt(['email' => $email, 'password' => $password])) {
         $userType = Auth::user()->role_id;
         $userDepartment = Auth::user()->userDepartment;
         $roles = Role::where('name', $userType)->get();
         $descriptions = $roles->pluck('description')->toArray();
         $allowedDescriptions = [];
         $modules = Module::get()->toArray();
         $requiredPermission = $descriptions;
         $permissionGetCondition = ['name' => $userType];
         $rolePermissions = Role::where($permissionGetCondition)->whereIn('description', $requiredPermission)->get()->toArray();
         $permissionArray = [];
         $descriptions = array_column($rolePermissions, 'description');
         foreach ($modules as &$module) {
            $modulePermissions = [];
            $hasViewPermission = false;

            foreach ($rolePermissions as $permission) {
               if ('/' . $permission['role'] === $module['url']) {
                  $modulePermissions[$permission['description']] = 1;

                  if (strpos($permission['description'], '.view') !== false) {
                     $hasViewPermission = true;
                     $modulePermissions['rolePermission'] = 1;
                  }
               }
            }
            if (!$hasViewPermission && isset($modulePermissions[$module['url'] . '.view'])) {
               unset($modulePermissions[$module['url'] . '.view']);
            }
            $module = array_merge($module, $modulePermissions);
         }
         unset($module);
         Session::put('user_modules_' . auth()->id(), $modules);




         if ($userDepartment === 'Admin' || $userDepartment === 'Delivery Head') {

            return redirect('/dashboard');
         } else {
            return redirect()->route('loginpage')->with('error', 'You are Not Authroized');
         }
      }

      return redirect()->route('loginpage')->with('error', 'Invalid email or password');
   }
   private function hasPermission($user, $permission)
   {
      $userPermissions = $user->permissions()->pluck('name')->toArray();
      return in_array($permission, $userPermissions);
   }
   public function logout(Request $request)
   {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return redirect('/login');
   }
   public function dashboard()
   {
      $modules = Session::get('user_modules_' . auth()->id());

      return view('dashboard', ['modules' => $modules]);
   }
   public function add_projects()
   {
      $modules = Session::get('user_modules_' . auth()->id());
      $userDesignation = 'Project Manager';
      $projectManagers  = employees::Where('designation', $userDesignation)->get();
      // dd($projectManagers);

      return view('add-project',  ['modules' => $modules, 'projectManagers' => $projectManagers]);
   }
   public function checkAllocationProjectManager(Request $request)
   {
      $request->validate([
         'employee_id' => 'required|exists:employees,id',
         'allocation_percentage' => 'required|numeric|between:1,100',
      ]);

      $employeeId = $request->input('employee_id');
      $allocationPercentage = $request->input('allocation_percentage');

      $currentAllocation = AddworkesEmployee::where('employee_id', $employeeId)->sum('allocationpercentage');

      if ($currentAllocation + $allocationPercentage > 100) {
         return response()->json([
            'error' => true,
            'message' => 'Total allocation percentage for this employee exceeds 100%.',
         ]);
      }

      return response()->json([
         'error' => false,
         'message' => 'Allocation percentage is within limits.',
      ]);
   }


public function insertProject(Request $request)
{
    $loginId = Auth::user()->id;
    $projectId = $request->input('projectId');

    $validator = Validator::make($request->all(), [
        'projectcompany' => 'required|string',
        'projectname' => 'required|string',
        'currency' => 'required',
        'projectbudget' => 'required|numeric',
        'projecttype' => 'required|array',
        'pmEmployeeName' => 'required|exists:employees,id',
        'pmallocation' => 'required|numeric|between:1,100',
        'csm' => 'required|string',
        'tags' => 'required|string',
        'sc' => 'required|string',
        'cilentname' => 'required|string',
        'cilentemail' => 'required|email|unique:projects,cilentemail',
        'companyname' => 'required|string',
        'cilentphone' => 'required|numeric',
        'country' => 'required|string',
        'city' => 'required|string',
        'projectstartdate' => 'required|date',
        'projectenddate' => 'required|date|after:projectstartdate',
        'status' => 'required|string',
    ], [
        'projectcompany.required' => 'The project company field is required.',
        'projectname.required' => 'The project name field is required.',
        'currency.required' => 'The Currency name field is required.',
        'projectbudget.required' => 'The project budget field is required.',
        'projecttype.required' => 'The project type field is required.',
        'pmEmployeeName.required' => 'The project manager field is required.',
        'pmEmployeeName.exists' => 'The selected project manager is invalid.',
        'pmallocation.required' => 'The allocation percentage field is required.',
        'pmallocation.numeric' => 'The allocation percentage must be a number.',
        'pmallocation.between' => 'The allocation percentage must be between 1 and 100.',
        'csm.required' => 'The CSM field is required.',
        'tags.required' => 'The tags field is required.',
        'sc.required' => 'The Service Type field is required.',
        'cilentname.required' => 'The client name field is required.',
        'cilentemail.required' => 'The client email field is required.',
        'cilentemail.email' => 'Please enter a valid email address.',
        'cilentemail.unique' => 'The client email has already been taken.',
        'companyname.required' => 'The company name field is required.',
        'cilentphone.required' => 'The client phone field is required.',
        'cilentphone.numeric' => 'The client phone must be a number.',
        'country.required' => 'The country field is required.',
        'city.required' => 'The city field is required.',
        'projectstartdate.required' => 'The project start date field is required.',
        'projectstartdate.date' => 'Please enter a valid date for the project start date.',
        'projectenddate.required' => 'The project end date field is required.',
        'projectenddate.date' => 'Please enter a valid date for the project end date.',
        'projectenddate.after' => 'The project end date must be after the project start date.',
        'status.required' => 'The status field is required.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $projectData = [
        'userId' => $loginId,
        'projectcompany' => $request->input('projectcompany'),
        'projectname' => $request->input('projectname'),
        'currency' => $request->input('currency'),
        'projectbudget' => $request->input('projectbudget'),
        'projecttype' => json_encode($request->input('projecttype')),
        'pmemployeeId' => $request->input('pmEmployeeName'),
        'pmallocation' => $request->input('pmallocation'),
        'csm' => $request->input('csm'),
        'tags' => $request->input('tags'),
        'sc' => $request->input('sc'),
        'cilentname' => $request->input('cilentname'),
        'cilentemail' => $request->input('cilentemail'),
        'companyname' => $request->input('companyname'),
        'cilentphone' => $request->input('cilentphone'),
        'country' => $request->input('country'),
        'city' => $request->input('city'),
        'projectstartdate' => $request->input('projectstartdate'),
        'projectenddate' => $request->input('projectenddate'),
        'status' => $request->input('status'),
    ];

    $existingProject = AddProjects::find($projectId);
    if ($existingProject) {
        $existingProject->fill($projectData)->save();
        $projectId = $existingProject->id;
        $message = 'Project Updated Successfully';
    } else {
        $project = AddProjects::create($projectData);
        if ($project) {
            $projectId = $project->id;
            $message = 'Project Added Successfully';

            $pmemployeeId = $request->input('pmEmployeeName');
            $projectManager = employees::where('id', $pmemployeeId)->first();
            $admin = User::where('role_id', 'admin')->first(); 
        
            if ($projectManager && $admin) {
                Mail::to([$projectManager->officialemail, $admin->email])->send(new ProjectAdded($project, $projectManager, $admin));
            } elseif ($projectManager) {
                Mail::to($projectManager->officialemail)->send(new ProjectAdded($project, $projectManager, null));
            } elseif ($admin) {
                Mail::to($admin->email)->send(new ProjectAdded($project, null, $admin));
            }
        } else {
            return redirect()->back()->with('status', 'Failed to Create New Project');
        }
    }

    $additionalData = [
        'project_id' => $projectId,
        'userDepartment' => '0',
        'userDesignation' => 'Project Manager',
        'employee_Id' => $request->input('pmEmployeeName'),
        'allocationpercentage' => $request->input('pmallocation'),
        'status' => '0',
        'startdate' => $request->input('projectstartdate'),
        'enddate' => $request->input('projectenddate'),
      ];
      addworkesEmployee::create($additionalData);
      
      return redirect('/project')->with('status', $message);
   }
   
   
   public function projectEdit($id)
   {
      $modules = Session::get('user_modules_' . auth()->id());
      $project = AddProjects::find($id);
      $userDesignation = 'Project Manager';
   
      $projectManagers  = employees::Where('designation', $userDesignation)->get();
   
      $employeeIds = $project->pluck('pmemployeeId');
      // $employeeDetails = employees::where('id',$employeeIds)->get();
      $employeeDetails = employees::whereIn('id', explode(',', $employeeIds))->get();
      $employeeName = $employeeDetails->pluck('name');
   
   // dd($employeeName);
      if (!$project) {
         abort(404);
      }
      // dd($project);
      return view('edit_manage_project', [
   
         'project' => $project,
         'modules' => $modules,
         'projectManagers' =>$projectManagers,
         'employeeName' => $employeeName,
      ]);
   }
   public function projectUpdate(Request $request)
   {
      $loginId = Auth::user()->id;
      $projectId = $request->input('projectId');

      $validator = Validator::make($request->all(), [
         'projectcompany' => 'required|string',
         'projectname' => 'required|string',
         'projectbudget' => 'required|numeric',
         'projecttype' => 'required|array',
         'csm' => 'required|string',
         'tags' => 'required|string',
         'sc' => 'required|string',
         'cilentname' => 'required|string',
         'cilentemail' => [
            'required',
            'email',
            Rule::unique('projects')->ignore($projectId),
         ],
         'companyname' => 'required|string',
         'cilentphone' => 'required|numeric',
         'country' => 'required|string',
         'city' => 'required|string',
         'projectstartdate' => 'required|date',
         'projectenddate' => 'required|date|after:projectstartdate',
         'status' => 'required|string',
      ], [
         'projectcompany.required' => 'The project company field is required.',
         'projectname.required' => 'The project name field is required.',
         'projectbudget.required' => 'The project budget field is required.',
         'projecttype.required' => 'The project type field is required.',
         'csm.required' => 'The CSM field is required.',
         'tags.required' => 'The tags field is required.',
         'sc.required' => 'The Service Type field is required.',
         'cilentname.required' => 'The client name field is required.',
         'cilentemail.required' => 'The client email field is required.',
         'cilentemail.email' => 'Please enter a valid email address.',
         'companyname.required' => 'The company name field is required.',
         'cilentphone.required' => 'The client phone field is required.',
         'cilentphone.numeric' => 'The client phone must be a number.',
         'country.required' => 'The country field is required.',
         'city.required' => 'The city field is required.',
         'projectstartdate.required' => 'The project start date field is required.',
         'projectstartdate.date' => 'Please enter a valid date for the project start date.',
         'projectenddate.required' => 'The project end date field is required.',
         'projectenddate.date' => 'Please enter a valid date for the project end date.',
         'projectenddate.after' => 'The project end date must be after the project start date.',
         'status.required' => 'The status field is required.',
      ]);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator)->withInput();
      }

      $projectData = [
         'userId' => $loginId,
         'projectcompany' => $request->input('projectcompany'),
         'projectname' => $request->input('projectname'),
         'projectbudget' => $request->input('projectbudget'),
         'projecttype' => json_encode($request->input('projecttype')),
         'csm' => $request->input('csm'),
         'tags' => $request->input('tags'),
         'sc' => $request->input('sc'),
         'cilentname' => $request->input('cilentname'),
         'cilentemail' => $request->input('cilentemail'),
         'companyname' => $request->input('companyname'),
         'cilentphone' => $request->input('cilentphone'),
         'country' => $request->input('country'),
         'city' => $request->input('city'),
         'projectstartdate' => $request->input('projectstartdate'),
         'projectenddate' => $request->input('projectenddate'),
         'status' => $request->input('status'),
         'pmemployeeId' => $request->input('pmEmployeeName'),
         'pmallocation' => $request->input('pmallocation'),
      ];
      // dd($projectData);
      $existingProject = AddProjects::find($projectId);
      if ($existingProject) {
         //  $existingProject->fill($projectData)->save();
         // dd($projectData);
         $existingProject->update($projectData);
         // dd($projectData);
         
         $message = 'Project Updated Successfully';
  
          $additionalData = [
              'userDepartment' => '0',
              'userDesignation' => 'Project Manager',
              'employee_Id' => $request->input('pmEmployeeName'),
              'allocationpercentage' => $request->input('pmallocation'),
              'startdate' => $request->input('projectstartdate'),
              'enddate' => $request->input('projectenddate'),
              'status' =>0,
          ];
  
          $allocationDataUpdate = addworkesEmployee::where('project_id', $projectId)
              ->where('userDesignation', 'Project Manager')
              ->first();
  
          if ($allocationDataUpdate) {
              $allocationDataUpdate->update($additionalData);
          } else {
              addworkesEmployee::create(array_merge($additionalData, ['project_id' => $projectId]));
          }
  
          // Redirect back with success message
          return redirect('/project')->with('status', $message);
      } else {
          return redirect()->back()->with('status', 'Project not found.');
      }
     
   }

   public function manage_project()
   {
      $projects = AddProjects::paginate(15);

      if (Auth::user()->status == 0) {

         $modules = Session::get('user_modules_' . auth()->id());
         return view("manage-project", ['users' => $projects], ['modules' => $modules]);
      } elseif (Auth::user()->status == 1) {
         if (Auth::user()->userDesignation == 'Project Manager') {
            $userAssignedProject = Auth::user()->employee_Id;
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userAssignedProject)
               ->pluck('project_id')
               ->toArray();
            $projects = AddProjects::whereIn('id', $assignedProjects)->get();
            return view("users.projectManageProject", ['users' => $projects]);
         } else {
            return redirect()->back()->with('error', 'You are Not Authriozed');
         }
      }
   }
   public function show($id)
   {
      $project = AddProjects::find($id);
      if (Auth::user()->status == 0) {
         $modules = Session::get('user_modules_' . auth()->id());
         $invoices = submit_invoices::where('project_id', $id)->paginate(10);
         return view('project-invoices', ['projectData' => $project, 'invoicesData' => $invoices, 'modules' => $modules]);
      } elseif (Auth::user()->status == 1) {
         $invoices = submit_invoices::where('project_id', $id)->paginate(10);
         return view('users.projectInvoicesProjectManager', ['projectData' => $project, 'invoicesData' => $invoices]);
      }
   }
   public function projectDetails($id)
   {
      $projects = AddProjects::find($id);
      $modules = Session::get('user_modules_' . auth()->id());
      return view("projectDeatils", ['projects' => $projects], ['modules' => $modules]);
   }

   public function projectsUploadFile($id)
   {
      $projects = AddProjects::find($id);
      if (!$projects) {
         return redirect()->back()->with('error', 'Project not found');
      }
      $projectId = $projects->id;
      $fileUploads = ProjectsUploadsFile::where('project_id', $projectId)->get();
      $modules = Session::get('user_modules_' . auth()->id());
      return view('fileUpload', ['modules' => $modules, 'projectId' => $projectId, 'fileUploads' => $fileUploads]);
   }
   // public function projectUploadsStore(Request $request)
   // {

   //    $validator = Validator::make(
   //       $request->all(),
   //       [
   //          'project_id' => 'required',
   //          'category' => 'required',
   //          'contract' => 'required|array',
   //          'contract.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
   //       ],
   //       [
   //          'category.required' => 'The category is required.',
   //          'contract.required' => 'At least one contract file is required.',
   //          'contract.*.image' => 'Each contract file must be an image.',
   //          'contract.*.mimes' => 'Each contract file must be a valid image format (jpeg, png, jpg, gif, svg).',
   //          'contract.*.max' => 'Each contract file must not exceed 2048 kilobytes (2MB).',

   //       ]
   //    );

   //    if ($validator->fails()) {
   //       return redirect()->back()->withErrors($validator)->withInput();
   //    }
   //    $projectData = [
   //       'project_id' => $request->input('project_id'),
   //       'category' => $request->input('category'),
   //    ];

   //    if ($request->hasFile('contract')) {
   //       $images = $request->file('contract');
   //       $imagePaths = [];

   //       foreach ($images as $key => $image) {
   //          $profileImage = date('YmdHis') . '_' . $key . '.' . $image->getClientOriginalExtension();
   //          $image->move(public_path('images'), $profileImage);
   //          $imagePaths[] = $profileImage;
   //       }

   //       $projectData['contract'] = json_encode($imagePaths);
   //    }
   //    $projectData = projectsuploadsfile::create($projectData);

   //    return redirect()->back()->with('success', 'Project uploads successfully.');

   //    return redirect()->back()->with('error', 'Failed to upload project files.');
   // }


   public function projectUploadsStore(Request $request)
   {
       // Validate the request
       $validator = Validator::make(
           $request->all(),
           [
               'project_id' => 'required',
               'category' => 'required',
               'contract' => 'required|array',
               'contract.*' => 'required|file|mimes:pdf,doc,docx,jpeg,png|max:2048',
           ],
           [
               'category.required' => 'The category is required.',
               'contract.required' => 'At least one contract file is required.',
               'contract.*.file' => 'Each contract file must be a valid file.',
               'contract.*.mimes' => 'Each contract file must be a valid format (pdf, doc, docx).',
               'contract.*.max' => 'Each contract file must not exceed 2048 kilobytes (2MB).',
           ]
       );

       if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
       }

       // Prepare project data
       $projectData = [
           'project_id' => $request->input('project_id'),
           'category' => $request->input('category'),
       ];

       // Handle file uploads
       if ($request->hasFile('contract')) {
           $files = $request->file('contract');
           $filePaths = [];

           foreach ($files as $key => $file) {
               $fileName = date('YmdHis') . '_' . $key . '.' . $file->getClientOriginalExtension();
               $file->move(public_path('images'), $fileName); // Ensure the directory exists
               $filePaths[] = $fileName;
           }

           $projectData['contract'] = json_encode($filePaths);
       }

       // Save project data to the database
       $uploadedFile = projectsuploadsfile::create($projectData);

       // Check if saving was successful
       if ($uploadedFile) {
           return redirect()->back()->with('success', 'Project uploaded successfully.');
       }

       return redirect()->back()->with('error', 'Failed to upload project files.');
   }

   public function projectUploadsView($id)
   {
      $modules = Session::get('user_modules_' . auth()->id());

      $fileUploads = projectsuploadsfile::Where('id', $id)->get();
      return view('viewPageUploads', ['modules' => $modules, 'fileUploads' => $fileUploads]);
   }
   public function projectUploadsDownloads($id)
   {
      $fileUploads = projectsuploadsfile::where('id', $id)->get();

      $pdf = new Dompdf();
      $pdf->setPaper('A4', 'portrait');

      $html = view('uploads', ['fileUploads' => $fileUploads])->render();

      $pdf->loadHtml($html);
      $pdf->render();

      $pdfContent = $pdf->output();

      return response()->stream(
         function () use ($pdfContent) {
            echo $pdfContent;
         },
         200,
         [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="uploads.pdf"',
         ]
      );
   }
   public function projectUploadsdelete($id)
   {

      $deleteUploadsFile = projectsuploadsfile::find($id);
      if ($deleteUploadsFile) {
         $deleteUploadsFile->delete();
         return redirect()->back()->with('success', 'Upload file Delected successfully.');
      } else {
         return redirect()->back()->with('error', 'Upload File not found or already deleted.');
      }
   }

   public function deleteProject($id)
   {
      $project = AddProjects::find($id);

      if ($project) {
         $project->delete();
         return redirect()->back()->with('success', 'Project deleted successfully.');
      } else {
         return redirect()->back()->with('error', 'Project not found or already deleted.');
      }
   }

   public function addinvoices($id)
   {
      $modules = Session::get('user_modules_' . auth()->id());
      $projectData = AddProjects::find($id);

      if (Auth::user()->status == 0) {
         return view('add-invoice', ['projectData' => $projectData], ['modules' => $modules]);
      } elseif (Auth::user()->status == 1) {
         return view('users.addInvoiceUser', ['projectData' => $projectData]);
      }
   }
   public function submit_invoice(Request $request)
   {

      $userId = Auth::user()->id;
      $validatedData = $request->validate([
         'date' => 'required|date',
         'due_date' => 'required|date',
         'Description' => 'required|string',
         'Quantity' => 'required|numeric',
         'Price' => 'required|numeric',
         'Amount' => 'required|numeric',
         'Total' => 'required|numeric',
         'Comments' => 'required|string',
      ]);


      $submitinvoice = [
         'project_id' => $request->input('project_id'),
         'Bill_Genrate_Date' => $request->input('date'),
         'DueDate' => $request->input('due_date'),
         'Description' => $request->input('Description'),
         'Quantity' => $request->input('Quantity'),
         'Price' => $request->input('Price'),
         'Amount' => $request->input('Amount'),
         'Total' => $request->input('Total'),
         'Comments' => $request->input('Comments'),
         'PaymentOption' => $request->input('flexRadioDefault'),
         'status' => 0,
         'usersId' => $userId,
      ];

      $submitInvoiceId = DB::table('submit_invoices')->insertGetId($submitinvoice);

      $projectId = $request->input('project_id');
      $invoice = AddProjects::find($projectId);
      $projectArray = $invoice->toArray();

      $projectTotalAmount = $submitinvoice['Total'];
      $TotalAmountInWord = $this->numberToWord($projectTotalAmount);

      $submitinvoice['TotalAmountInWord'] = $TotalAmountInWord;

      $submitInvoicesMergedArray = array_merge($submitinvoice, $projectArray);
      $clientEmailAsProject = $submitInvoicesMergedArray['cilentemail'];
      
      $cilentNameAsProject = $submitInvoicesMergedArray['cilentname'];
      
      $pdf = new Dompdf();
      $pdf->setPaper('A4', 'portrait');
      
      $html = view('invoice', $submitInvoicesMergedArray)->render();
      $pdf->loadHtml($html);
      
      $pdf->render();
      $pdfOutput = $pdf->output();

      $clientEmail = $clientEmailAsProject; 
        $clientName = $cilentNameAsProject; 
        Mail::to($clientEmail)->send(new InvoiceEmail($submitInvoicesMergedArray, $pdfOutput));

        return back()->with('status', 'Invoice sent to client successfully!');

   }
  

   public function invoiceUpdate(Request $request)
   {
      $userId = Auth::user()->id;
      $invoiceId = $request->input('invoiceId');
      $validatedData = $request->validate([
         'date' => 'required|date',
         'due_date' => 'required|date',
         'Description' => 'required|string',
         'Quantity' => 'required|numeric',
         'Price' => 'required|numeric',
         'Amount' => 'required|numeric',
         'Total' => 'required|numeric',
         'Comments' => 'required|string',
      ]);

      $submitInvoiceData = [
         'project_id' => $request->input('project_id'),
         'Bill_Genrate_Date' => $request->input('date'),
         'DueDate' => $request->input('due_date'),
         'Description' => $request->input('Description'),
         'Quantity' => $request->input('Quantity'),
         'Price' => $request->input('Price'),
         'Amount' => $request->input('Amount'),
         'Total' => $request->input('Total'),
         'Comments' => $request->input('Comments'),
         'PaymentOption' => $request->input('flexRadioDefault'),
         'status' => 0,
         'usersId' => $userId,
      ];

      if ($invoiceId) {
         $invoice = submit_invoices::find($invoiceId);
         if ($invoice) {
            $invoice->update($submitInvoiceData);
         } else {

            return response()->json(['error' => 'Invoice not found'], 404);
         }
      }
      $submitInvoiceId = DB::table('submit_invoices')->find($invoiceId);
      $projectId = $request->input('project_id');
      $invoice = AddProjects::find($projectId);
      $projectArray = $invoice->toArray();
      $projectTotalAmount = $submitInvoiceData['Total'];
      $TotalAmountInWord = $this->numberToWord($projectTotalAmount);

      $submitInvoiceData['TotalAmountInWord'] = $TotalAmountInWord;

      $submitInvoicesMergedArray = array_merge($submitInvoiceData, $projectArray);
      $pdf = new Dompdf();
      $pdf->setPaper('A4', 'portrait');
      $html = view('invoice', $submitInvoicesMergedArray)->render();
      $pdf->loadHtml($html);
      $pdf->render();
      return $pdf->stream('invoice.pdf');
   }



   public function numberToWord($num = '')
   {
      $num    = (string) ((int) $num);

      if ((int) ($num) && ctype_digit($num)) {
         $words  = array();

         $num    = str_replace(array(',', ' '), '', trim($num));

         $list1  = array(
            '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
            'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
            'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
         );

         $list2  = array(
            '', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
            'seventy', 'eighty', 'ninety', 'hundred'
         );

         $list3  = array(
            '', 'thousand', 'million', 'billion', 'trillion',
            'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion',
            'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion',
            'octodecillion', 'novemdecillion', 'vigintillion'
         );

         $num_length = strlen($num);
         $levels = (int) (($num_length + 2) / 3);
         $max_length = $levels * 3;
         $num    = substr('00' . $num, -$max_length);
         $num_levels = str_split($num, 3);

         foreach ($num_levels as $num_part) {
            $levels--;
            $hundreds   = (int) ($num_part / 100);
            $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
            $tens       = (int) ($num_part % 100);
            $singles    = '';

            if ($tens < 20) {
               $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
               $tens = (int) ($tens / 10);
               $tens = ' ' . $list2[$tens] . ' ';
               $singles = (int) ($num_part % 10);
               $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
         }
         $commas = count($words);
         if ($commas > 1) {
            $commas = $commas - 1;
         }

         $words  = implode(', ', $words);

         $words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');
         if ($commas) {
            $words  = str_replace(',', ' and', $words);
         }

         return $words;
      } else if (!((int) $num)) {
         return 'Zero';
      }
      return '';
   }
   public function editInvoices($id)
   {
      $modules = Session::get('user_modules_' . auth()->id());

      $invoice = submit_invoices::findOrFail($id);
      $projectData = $invoice->project;
      if (Auth::user()->status == 0) {
         return view('invoices_edit', compact('invoice', 'modules', 'projectData'));
      } elseif (Auth::user()->status == 1) {
         return view('users.invoiceEditUser', compact('invoice', 'projectData'));
      }
   }

   public function updateStatus(Request $request, submit_invoices $invoice)
   {
      $newStatus = $request->input('status');

      $invoice->update(['status' => $newStatus]);

      return redirect()->back();
   }

   public function deleteinvoice($id)
   {
      $invoice = submit_invoices::find($id);

      if ($invoice) {
         $invoice->delete();
         Session::flash('success', 'Invoice record deleted successfully.');
      } else {
         Session::flash('error', 'Failed to delete invoice record.');
      }

      return redirect()->back();
   }

   public function addmilestone($id)
   {
      $modules = Session::get('user_modules_' . auth()->id());
      $projectData = AddProjects::find($id);
      if (Auth::user()->status == 0) {
         if ($projectData) {
            $data = mileStone::where('project_id', $projectData->id)->get();
            $projectId = $projectData->id;
            return view('add_Milestone', [
               'modules' => $modules,
               'projectId' => $projectId,
               'data' => $data,
            ]);
         }
      } elseif (Auth::user()->status == 1) {
         $data = mileStone::where('project_id', $projectData->id)->get();
         $projectId = $projectData->id;
         return view('users.addMilestoneUser', [

            'projectId' => $projectId,
            'data' => $data,
         ]);
      }
   }
   public function addmilestoneForm($id)
   {
      $modules = Session::get('user_modules_' . auth()->id());

      $projectData = AddProjects::find($id);
      if (Auth::user()->status == 0) {

         if ($projectData) {

            $data = mileStone::where('project_id', $projectData->id)->get();

            return view('add_MilestoneView', [
               'modules' => $modules,
               'projectData' => $projectData,
               'data' => $data,
            ]);
         }
      } elseif (Auth::user()->status == 1) {
         if ($projectData) {

            $data = mileStone::where('project_id', $projectData->id)->get();

            return view('users.addMilestoneViewFormUser', [

               'projectData' => $projectData,
               'data' => $data,
            ]);
         }
      }
   }
   public function validatMileStone(Request $request)
   {
      $validatedData = $request->validate([
         'Name' => 'required|string|max:255',
         'targetComplectionDate' => 'required',
         'StartDate' => 'required',
         'time' => 'required',
         'description' => 'required|string',
      ], [
         'Name.required' => 'Name is required.',
         'Name.string' => 'Name must be a string.',
         'Name.max' => 'Name cannot exceed 255 characters.',
         'targetComplectionDate.required' => 'TargetComplectionDate is required',
         'time.required' => 'Time is required',
         'StartDate.required' => 'StartDate is required',
         'description.required' => 'Description is required.',
         'description.string' => 'Description must be a string.',
      ]);

      $project_id = $request->input('projectId');

      $AddMilestoneDetails = [
         'project_id' => $project_id,
         'name' => $request->input('Name'),
         'targetComplectionDate' => $request->input('targetComplectionDate'),
         'StartDate' => $request->input('StartDate'),
         'hours' => $request->input('time'),
         'description' => $request->input('description'),
      ];

      milestone::create($AddMilestoneDetails);


      return redirect()->route('addmilestone.id', ['id' => $project_id])->with('status', 'MileStone Updated Successfully');
   }



   public function deleteMilestone($id)
   {
      $milestone = Milestone::find($id);

      if ($milestone) {
         $milestone->delete();
         return redirect()->back()->with('success', 'Milestone deleted successfully.');
      } else {
         return redirect()->back()->with('error', 'Milestone not found or already deleted.');
      }
   }
   public function addMilestoneEdit($id)
   {
      $modules = Session::get('user_modules_' . auth()->id());
      $mileStoneDetails = mileStone::find($id);
      if (Auth::user()->status == 0) {

         return view('mileStoneEdit', ['mileStoneDetails' => $mileStoneDetails, 'modules' => $modules]);
      } elseif (Auth::user()->status == 1) {
         return view('users.mileStoneEditUser', ['mileStoneDetails' => $mileStoneDetails]);
      }
   }
   public function mileStoneEditStore(Request $request)
   {
      $modules = Session::get('user_modules_' . auth()->id());

      $validatedData = $request->validate([
         'name' => 'required|string|max:255',
         'targetComplectionDate' => 'required',
         'StartDate' => 'required',
         'hours' => 'required',
         'description' => 'required|string',
      ], [
         'name.required' => 'Name is required.',
         'name.string' => 'Name must be a string.',
         'name.max' => 'Name cannot exceed 255 characters.',
         'targetComplectionDate.required' => 'TargetComplectionDate is required',
         'hours.required' => 'Hours is required',
         'StartDate.required' => 'StartDate is required',
         'description.required' => 'Description is required.',
         'description.string' => 'Description must be a string.',
      ]);

      $milestoneId = $request->input('milestoneId');

      $project_id = $request->input('project_id');


      if ($milestoneId) {
         $milestone = Milestone::find($milestoneId);

         if ($milestone) {
            $milestone->update([
               'name' => $request->input('name'),
               'status' => $request->input('status'),
               'StartDate' => $request->input('StartDate'),
               'hours' => $request->input('hours'),
               'description' => $request->input('description'),
            ]);

            return redirect()->route('addmilestone.id', ['id' => $project_id])->with('status', 'Milestone Updated Successfully');
         } else {
            return redirect()->back()->with('status', 'Failed to Update Milestone: Milestone not found');
         }
      } else {
         return redirect()->back()->with('status', 'Failed to Update Milestone: Milestone ID not provided');
      }
   }

   public function add_on(Request $request)
   {
      $add_onDetails = [
         'project_id' => $request->input('project_id'),
         'Name' => $request->input('Name'),
         'Description' => $request->input('Description'),
         'Price' => $request->input('Price'),
      ];

      $add_on = Add_On::create($add_onDetails);

      $project_id = $add_onDetails['project_id'];
      $projectDetails = AddProjects::find($project_id);

      if ($projectDetails) {
         $new_price = $projectDetails->ProjectBudget + $add_onDetails['Price'];
         $projectDetails->update(['ProjectBudget' => $new_price]);
      }

      return redirect()->back()->with('status', 'Add On Added Successfully');
   }

   public function updateStatusMileStone(Request $request, User $user)
   {
      $newStatus = $request->input('status');
      $user->update(['status' => $newStatus]);
      return redirect()->back();
   }


   public function addUsers()
   {
      $user  = Auth::user()->status;
      $modules = Session::get('user_modules_' . auth()->id());
      $role = Role::all()->toArray();
      $processedData = [];

      foreach ($role as $item) {
         $name = $item['name'];

         if (!isset($processedData[$name]['role'])) {
            $processedData[$name]['role'] = [];
         }
         $processedData[$name]['role'][] = $item['role'];

         if (!isset($processedData[$name]['description'])) {
            $processedData[$name]['description'] = [];
         }
         $processedData[$name]['description'][] = $item['description'];
      }
      return view('add_Users', ['modules' => $modules, 'processedData' => $processedData]);
   }

   public function addUsersStore(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:255',
         'email' => 'required|email|unique:users,email',
         'userDepartment' => 'required|numeric',
         'userDesignation' => 'required|string',
         'password' => 'required|string|min:8',
         'role_id' => 'required',
         'userstatus' => 'required|string',
      ], [
         'name.required' => 'The name field is required.',
         'email.required' => 'The email field is required.',
         'email.email' => 'Please enter a valid email address.',
         'email.unique' => 'The email has already been taken.',
         'userDepartment.required' => 'The user department field is required.',
         'userDepartment.numeric' => 'The user department must be a number.',
         'userDesignation.required' => 'The user designation field is required.',
         'password.required' => 'The password field is required.',
         'password.min' => 'The password must be at least :min characters.',
         'role_id.required' => 'The role ID field is required.',
         'userstatus.required' => 'The user status field is required.',
      ]);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator)->withInput();
      }
      $usersStore = [
         'name' => $request->input('name'),
         'email' => $request->input('email'),
         'userDepartment' => $request->input('userDepartment'),
         'userDesignation' => $request->input('userDesignation'),
         'employee_Id' => $request->input('employeeId'),
         'password' => Hash::make($request->input('password')),
         'role_id' => $request->input('role_id'),
         'status' => $request->input('userstatus'),

      ];

      $user = User::create($usersStore);
      if ($user) {
         $status = "User added successfully!";
         return redirect('/user')->with('status', 'User Sucessfully Added');
      } else {
         $status = "Failed to add user!";
         return redirect()->back()->with('status', $status);
      }
   }

   public function addUsersUpdateStore(Request $request, $id)
   {
      // dd($request->all());
   //    $validatedData = $request->validate([
   //       'name' => 'required|string',
   //       'email' => 'required|email|unique:users,email,' . $id,
   //       'password' => 'nullable|string|min:8', // Password is nullable as it's optional
   //       'userDepartment' => 'required|string',
   //       'userDesignation' => 'required|string',
   //       'status' => 'required|boolean',
   //   ]);
 
     $user = User::findOrFail($id);

     $user->name = $request->input('name');
     $user->email = $request->input('email');
     $user->userDepartment = $request->input('userDepartment');
     $user->userDesignation = $request->input('userDesignation');
     $user->status = $request->input('userstatus');

     if ($request->filled('password')) {
         $user->password = Hash::make($request->input('password'));
     }
 
     $user->save();

     return redirect()->route('user', ['userId' => $id])->with('status', 'User updated successfully');
   }

   public function mannageUser()
   {
      $userId = Auth::id();
      $modules = Session::get('user_modules_' . auth()->id());
      $allUsers = User::paginate(15);
      return view('mannage_user', ['modules' => $modules], ['allUsers' => $allUsers]);
   }



   public function deleteUser($id)
   {
      $user = User::find($id);

      if ($user) {
         $user->delete();
         $status = "User deleted successfully!";
         return redirect()->back()->with('error', $status);
      } else {
         $status = "Failed to delete user!";
         return redirect()->back()->with('status', $status);
      }
   }
   public function editUsers($userId)
   {
      
      $user = User::findOrFail($userId);

      $modules = Session::get('user_modules_' . auth()->id());

      $role = Role::all()->toArray();
      $processedData = [];

      foreach ($role as $item) {
         $name = $item['name'];

         if (!isset($processedData[$name]['role'])) {
            $processedData[$name]['role'] = [];
         }
         $processedData[$name]['role'][] = $item['role'];

         if (!isset($processedData[$name]['description'])) {
            $processedData[$name]['description'] = [];
         }
         $processedData[$name]['description'][] = $item['description'];
      }

      return view('editUser', ['user' => $user, 'processedData' => $processedData, 'modules' => $modules]);
   }


   public function projectList()
   {
      $modules = Session::get('user_modules_' . auth()->id());
      $userId = auth()->id();
      $users = AddProjects::where('userId', $userId)->get();
      $userDetails = User::where('id', $userId)->get();
      $usersWorks = AddWorkesEmployee::where('userId', $userId)->get();
      return view('projectListOfSalesManager', [
         'usersWorks' => $usersWorks,
         'modules' => $modules,
         'users' => $users,
         'userDetails' => $userDetails,
      ]);
   }
   public function PojectManagerList()
   {
      $modules = Session::get('user_modules_' . auth()->id());
      $userId = auth()->id();
      $users = addworkesEmployee::where('userId', $userId)->get();
      $projectIds = $users->pluck('project_id')->toArray();
      $projectDetails = AddProjects::whereIn('id', $projectIds)->get();
      $userDetails = User::where('id', $userId)->get();
      return view('projectListManager', [
         'projectDetails' => $projectDetails,
         'modules' => $modules,
         'users' => $users,
         'userDetails' => $userDetails,
      ]);
   }
}
