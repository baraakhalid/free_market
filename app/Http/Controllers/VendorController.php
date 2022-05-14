<?php

namespace App\Http\Controllers;

use App\Mail\VendorWelcomeEmail;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\City;
use App\Notifications\NewVendorNotification;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;


class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->authorizeResource(Vendor::class, 'vendor', ['except' => [ 'store']]);
    }
    public function index()
    {
        $vendors = Vendor::withcount('permissions')->get();
        return response()->view('cms.vendors.index', ['vendors' => $vendors]);
    }
    public function editvendorPermissions(Request $request, vendor $vendor)
    {
        $permissions = Permission::where('guard_name', '=', 'vendor')->get();
        $vendorPermissions = $vendor->permissions;
        if (count($vendorPermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('assigned', false);
                foreach ($vendorPermissions as $vendorPermission) {
                    if ($permission->id == $vendorPermission->id) {
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }
        return response()->view('cms.vendors.vendor_permission', ['vendor' => $vendor, 'permissions' => $permissions]);
    }

    // /**
    //  * Update vendor permissions.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function updatevendorPermissions(Request $request, Vendor $vendor)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);

        if (!$validator->fails()) {
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($vendor->hasPermissionTo($permission)) {
                $vendor->revokePermissionTo($permission);
            } else {
                $vendor->givePermissionTo($permission);
            }
            return response()->json(
                ['message' => 'vendor updated successfully'],
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
        
        $cities = City::all();

        return response()->view('cms.Vendors.create', ['cities' => $cities]);
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
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'city_id' => 'required|numeric|exists:cities,id',

            'address' => 'required|string|min:3',
            'email' => 'required|email|unique:Vendors,email',
        ]);

        if (!$validator->fails()) {
            $vendor = new Vendor();
            $vendor->name = $request->input('name');
            $vendor->mobile = $request->input('mobile');
            $vendor->telephone = $request->input('telephone');
            $vendor->city_id = $request->input('city_id');
            $vendor->address = $request->input('address');
            $vendor->password = Hash::make('12345');
            $vendor->email = $request->input('email');


            $isSaved = $vendor->save();
            if ($isSaved) {
                Mail::to($vendor)->send(new VendorWelcomeEmail($vendor));
                $admin = Admin::first();
                $admin->notify(new NewVendorNotification($vendor));
            }
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
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $cities = City::all();
        return response()->view('cms.vendors.edit',['vendor' => $vendor ,'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'address'=>'required|string|min:3',
            'email' => 'required|email|unique:vendors,email,' . $vendor->id,
            'city_id' => 'required|numeric|exists:cities,id',



        ]);

        if (!$validator->fails()) {
            $vendor->name = $request->input('name');
           
            $vendor->mobile = $request->input('mobile');
            $vendor->telephone = $request->input('telephone');
            $vendor->address = $request->input('address');
            $vendor->email = $request->input('email');
            $vendor->password = Hash::make('password');
            $vendor->city_id = $request->input('city_id');

            $isSaved = $vendor->save();
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $deleted = $vendor->delete();
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'User deleted successfully' : 'User deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
