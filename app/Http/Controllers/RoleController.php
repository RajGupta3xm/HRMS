<?php

namespace App\Http\Controllers;

use App\Models\module;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class RoleController extends Controller
{
    public function allRolesView()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $permissions = [];

        $userType =  Auth::user()->role_id;
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

        return view('allRolesView', [
            'modules' => $modules,  'processedData' => $processedData

        ]);
    }
    public function delete($name)
    {
        $role = Role::where('name', $name)->delete();

        if ($role) {
            $status = "Permission deleted successfully!";
            return redirect()->back()->with('status', $status);
        } else {
            $status = "Failed to delete permission!";
            return redirect()->back()->with('status', $status);
        }
    }

    public function allRolesDetails()
    {
        $modules = Session::get('user_modules_' . auth()->id());


        return view('allRolesDetails', ['modules' => $modules]);
    }
    public function allRolesDetailsStore(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name cannot exceed 255 characters.',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $name = $request->input('name');
        $roleNames = $request->input('groupname');
        $permissions = $request->input('permissions');
        $rolePermissions = [];

        foreach ($permissions as $permission) {
            foreach ($roleNames as $role) {
                if (strpos($permission, $role) !== false) {
                    $rolePermissions[] = [
                        'name' => $name,
                        'role' => $role,
                        'description' => $permission,
                    ];
                }
            }
        }
        Role::insert($rolePermissions);
        return redirect()->route('allRolesView')->with('status', 'Role Created Successfully');
    }
    public function editRoles($userName)
    {
        $modules = Session::get('user_modules_' . auth()->id());

        $role = Role::where('name', $userName)->first();

        if (!$role) {
            abort(404);
        }

        $permissions = Role::where('name', $userName)->pluck('description')->toArray();

        return view('editroles', compact('role', 'modules', 'permissions'));
    }

    public function updateRoles(Request $request, $userName)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name cannot exceed 255 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $roleNames = $request->input('groupname');
        $permissions = $request->input('permissions');

        $rolePermissions = [];

        if (!is_null($permissions)) {
            foreach ($permissions as $permission) {
                foreach ($roleNames as $role) {
                    if (strpos($permission, $role) !== false) {
                        $rolePermissions[] = [
                            'name' => $name,
                            'role' => $role,
                            'description' => $permission,
                        ];
                    }
                }
            }
        }

        Role::where('name', $userName)->delete();
        Role::insert($rolePermissions);

        return redirect()->route('allRolesView')->with('status', 'Role Updated Successfully');
    }
}
