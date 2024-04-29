<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\Auth\GoogleController;





Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::any('/dashboard', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
    Route::any('/premisons', 'App\Http\Controllers\HomeController@premisons')->name('premisons');
    Route::get('/premisons', 'App\Http\Controllers\HomeController@premisonsDetails')->name('premisonsDetails');
    Route::get('/timesheet', 'App\Http\Controllers\EmployeeWorkedHours@AllProjectedFetch')->name('AllProjectedFetch');
    Route::any('/addPremissionPage', 'App\Http\Controllers\HomeController@PremisonPageValidate')->name('PremisonPageValidate');
    Route::any('/project', 'App\Http\Controllers\HomeController@manage_project')->name('manage_project');
    Route::any('/projectDetails/{id}', 'App\Http\Controllers\HomeController@projectDetails')->name('projectDetails');
    Route::any('/projects/{id}/edit', 'App\Http\Controllers\HomeController@projectEdit')->name('project.edit');
    Route::any('/projects/{id}/project_view_with_hours', 'App\Http\Controllers\EmployeeWorkedHours@projectHours')->name('project.hours');
    Route::any('/projects/{id}/employee_Hours/', 'App\Http\Controllers\EmployeeWorkedHours@employeHours')->name('employee.hours');
    Route::delete('/project/{id}', 'App\Http\Controllers\HomeController@deleteProject')->name('deleteProject');
    Route::any('/projectsUploadFile/{id}', 'App\Http\Controllers\HomeController@projectsUploadFile')->name('projectsUploadFile');
    Route::any('/projectUploadsStore', 'App\Http\Controllers\HomeController@projectUploadsStore')->name('projectUploadsStore');
    Route::any('/projectUploadsView/{id}', 'App\Http\Controllers\HomeController@projectUploadsView')->name('uploadsFile.details');
    Route::any('/projectUploadsDownloads/{id}', 'App\Http\Controllers\HomeController@projectUploadsDownloads')->name('projectUploadsDownloads');
    Route::any('/projectUploadsdelete/{id}', 'App\Http\Controllers\HomeController@projectUploadsdelete')->name('projectUploadsdelete');
    Route::any('/add-projects', 'App\Http\Controllers\HomeController@add_projects')->name('add_projects');
    Route::post('/insert-project', 'App\Http\Controllers\HomeController@insertProject')->name('insertProject');
    Route::post('/projectUpdate', 'App\Http\Controllers\HomeController@projectUpdate')->name('Project.update');
    Route::any('/projects/{id}', 'App\Http\Controllers\HomeController@show')->name('project.detail');
    Route::put('/update-status/{invoice}', 'App\Http\Controllers\HomeController@updateStatus')->name('update_status');
    Route::get('/invoices/{id}/edit', 'App\Http\Controllers\HomeController@editInvoices')->name('invoices.edit');
    Route::get('/add-invoice/{id}', 'App\Http\Controllers\HomeController@addinvoices')->name('addinvoices.id');
    Route::delete('/invoice/{id}', 'App\Http\Controllers\HomeController@deleteinvoice')->name('deleteInvoice');
    Route::delete('/milestone/{id}', 'App\Http\Controllers\HomeController@deleteMilestone')->name('deleteMilestone');
    Route::get('/add-milestone/{id}', 'App\Http\Controllers\HomeController@addmilestone')->name('addmilestone.id');
    Route::get('/add-milestonePage/{id}', 'App\Http\Controllers\HomeController@addmilestonenew')->name('addmilestone.idNew');
    Route::any('/add_mileStone', 'App\Http\Controllers\HomeController@validatMileStone')->name('add_mileStone');
    Route::get('/add-milestone/{id}/addMilestoneEdit', 'App\Http\Controllers\HomeController@addMilestoneEdit')->name('addmilestone.Edit');
    Route::post('/editMileStore', 'App\Http\Controllers\HomeController@mileStoneEditStore')->name('mileStoneEditStore');
    Route::get('/add-workesEmployee/{id}', 'App\Http\Controllers\AddworkemployeeController@addWorksEmployee')->name('addWorksEmployee.id');
    Route::any('/submit-invoice', 'App\Http\Controllers\HomeController@submit_invoice')->name('submit_invoice');
    Route::any('/add-on', 'App\Http\Controllers\HomeController@add_on')->name('add_on');
    Route::get('/Salesmanager', 'App\Http\Controllers\HomeController@Salesmanager')->name('Salesmanager');
    Route::put('/update_status_milestone/{user}', 'App\Http\Controllers\HomeController@updateStatusMileStone')
        ->name('update_statusMileStone');
    Route::any('/add_Salesmanager', 'App\Http\Controllers\HomeController@add_Salesmanager')->name('add_Salesmanager');
    Route::any('/add_SalesmanagerStore', 'App\Http\Controllers\HomeController@validatSalesmanager')->name('add_SalesmanagerStore');
    Route::any('/user', 'App\Http\Controllers\HomeController@mannageUser')->name('user');
    Route::any('/userAllocationList', 'App\Http\Controllers\HomeController@userAllocationList')->name('userAllocationList');
    Route::any('/addUsers', 'App\Http\Controllers\HomeController@addUsers')->name('addUsers');
    Route::any('/addUsersStore', 'App\Http\Controllers\HomeController@addUsersStore')->name('addUsersStore');
    Route::any('/addUsersUpdateStore/{id}', 'App\Http\Controllers\HomeController@addUsersUpdateStore')->name('addUsersUpdateStore');
    Route::delete('/users/{id}', 'App\Http\Controllers\HomeController@deleteUser')->name('deleteUser');
    Route::any('/users/{userId}/edit', 'App\Http\Controllers\HomeController@editUsers')->name('users.edit');
    Route::any('/ListOfProject', 'App\Http\Controllers\HomeController@projectList')->name('projectList');
    Route::any('/ListOfPojectManager', 'App\Http\Controllers\HomeController@PojectManagerList')->name('PojectManagerList');
    Route::get('/fetch-users/{userDesignation}', 'App\Http\Controllers\UserController@fetchUsersByDesignation');
    Route::get('/fetch-users/{designation}', 'App\Http\Controllers\AddworkemployeeController@fetchUsersByDesignation');
    Route::get('/fetch-employee-details/{employeeName}', 'App\Http\Controllers\UserController@fetchEmployeeDetails');
    Route::any('/role', 'App\Http\Controllers\RoleController@allRolesView')->name('allRolesView');
    Route::any('/allRolesDetails', 'App\Http\Controllers\RoleController@allRolesDetails')->name('allRolesDetails');
    Route::any('/allRolesDetailsStore', 'App\Http\Controllers\RoleController@allRolesDetailsStore')->name('allRolesDetailsStore');
    Route::any('/roles/{userName}', 'App\Http\Controllers\RoleController@delete')->name('roles.delete');
    Route::any('/roles/{userName}/edit', 'App\Http\Controllers\RoleController@allRolesEdit')->name('roles.edit');
    Route::get('/add-workesEmployee/{id}', 'App\Http\Controllers\AddworkemployeeController@addWorksEmployee')->name('addWorksEmployee.id');
    Route::get('/fetch-users/{type}', 'App\Http\Controllers\AddworkemployeeController@getUsersByType');
    Route::get('/employees/{id}/edit', 'App\Http\Controllers\AddworkemployeeController@editEmployeeWork')->name('editEmployee');
    Route::delete('/employee/{id}', 'App\Http\Controllers\AddworkemployeeController@deleteEmployee')->name('deleteEmployee');
    Route::any('/add-workesEmployeeStore', 'App\Http\Controllers\AddworkemployeeController@addworkesEmployeeStore')->name('add-workesEmployeeStore');
    Route::any('/ListOfDesigner', 'App\Http\Controllers\DesignerController@DesignerList')->name('DesignerList');
    Route::any('/projectViewAllocations', 'App\Http\Controllers\HomeController@projectAllocations')->name('projectallocations');
    Route::any('/addEmployee', 'App\Http\Controllers\EmployeeController@employeeManagement')->name('employeeManagement');
    Route::any('/employeeManagementStore', 'App\Http\Controllers\EmployeeController@employeeStore')->name('employeeStore');
    Route::any('/employeeView', 'App\Http\Controllers\EmployeeController@employeeView')->name('employeeView');
    Route::delete('/employees/delete', 'App\Http\Controllers\EmployeeController@deleteSelected')->name('employee.deleteSelected');
    Route::any('employeeManagementUpdate/{id}', 'App\Http\Controllers\EmployeeController@employeeupdate')->name('employeeupdate');
    Route::any('/employeeManagementUpdateStore', 'App\Http\Controllers\EmployeeController@employeeUpdateStore')->name('employeeUpdateStore');
    Route::get('employeeManagementSearch', 'App\Http\Controllers\EmployeeController@employeeSearch')->name('employeeSearch');
    Route::get('find', 'App\Http\Controllers\EmployeeController@employeeFind')->name('employeeFind');
    Route::any('employeeManagementFindEmployee', 'App\Http\Controllers\EmployeeController@FindEmployee')->name('FindEmployee');
    Route::any('employeeManagementViewDetails/{id}', 'App\Http\Controllers\EmployeeController@ViewDetailsEmployee')->name('ViewDetailsEmployee.id');
    Route::any('employeeExportCSV', 'App\Http\Controllers\EmployeeController@employeeExportCSV')->name('employeeExportCSV');
    Route::any('employeeimportCSV', 'App\Http\Controllers\EmployeeController@employeeimportCSV')->name('employeeimportCSV');
    Route::any('/logout', [HomeController::class, 'logout'])->name('logout');




    #users Route

    Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
    Route::any('/user/userView', [UsersController::class, 'userView'])->name('user.userView');
    Route::any('/user/user.timeSheet', [TimesheetController::class, 'Timesheet'])->name('user.timeSheet');
    Route::any('/user/user.enterDateInProject', [TimesheetController::class, 'enterDateInProject'])->name('user.enterDateInProject');
    Route::any('/user/user.enterTimeInProject', [TimesheetController::class, 'enterTimeInProject'])->name('user.enterTimeInProject');
    Route::any('/user/user.enterDateInProjectUpdate', [TimesheetController::class, 'enterTimeInProjectUpdate'])->name('user.enterTimeInProjectUpdate');
    Route::any('/user/user.enterDateInProjectTempSave', [TimesheetController::class, 'enterDateInProjectTempSave'])->name('user.enterDateInProjectTempSave');
    Route::any('/user/user.submitedTimesheet', [TimesheetController::class, 'submitedTimesheet'])->name('user.submitedTimesheet');
    Route::get('/check-data-exists', [TimesheetController::class, 'checkDataExists'])->name('check.data.exists');
    Route::any('/showTimeEntriesByDateAndDay', [TimesheetController::class, 'showTimeEntriesByDateAndDay']);
});

Route::get('/login', [HomeController::class, 'showLoginForm'])->name('loginpage');
Route::post('/login', [HomeController::class, 'adminLogin'])->name('admin.login');

Route::post('/userlogin', [UsersController::class, 'usersLogin'])->name('user.login');
