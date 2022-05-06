<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;
// use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->authorizeResource(Admin::class, 'admin');
    }
     public function index()
    {
        $admins=Admin::withcount('permissions')->get();
        return response()->view('cms.admins.index',['admins'=> $admins]);
    }
    
    public function editAdminPermissions(Request $request, Admin $admin)
    {

        //  $this->authorize('viewpermission', Admin::class);
        $permissions = Permission::where('guard_name', '=', 'admin')->get();
        $adminPermissions = $admin->permissions;
        if (count($adminPermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('assigned', false);
                foreach ($adminPermissions as $adminPermission) {
                    if ($permission->id == $adminPermission->id) {
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }

        return response()->view('cms.admins.admin_permission', ['admin' => $admin, 'permissions' => $permissions]);
    }
    public function updateAdminPermissions(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);

        if (!$validator->fails()) {
            //SELECT * FROM permissions WHERE id = 1 AND guard_name = 'admin';
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($admin->hasPermissionTo($permission)) {
                $admin->revokePermissionTo($permission);
            } else {
                $admin->givePermissionTo($permission);
            }
            return response()->json(
                ['message' => 'Role updated successfully'],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.admins.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email|unique:admins,email',

        ]);

        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->mobile = $request->input('mobile');
            $admin->email = $request->input('email');

            $admin->password = hash::make(12345);

            $isSaved = $admin->save();
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return response()->view('cms.admins.edit', ['admin' => $admin]);  
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email|unique:admins,email,'. $admin->id,


        ]);

        if (!$validator->fails()) {
            $admin->name = $request->input('name');
            $admin->mobile = $request->input('mobile');
            $admin->email = $request->input('email');


            $isSaved = $admin->save();
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        } 
       }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $deleted = $admin->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );  
      }
}
