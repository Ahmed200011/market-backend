<?php

namespace App\Http\Controllers\User;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::paginate(5);

        return view('dashboarda.users.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('dashboarda.users.add', compact(['roles', 'permissions']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->hasFile('image'));
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
            // 'permissions' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();
            $image_name = uniqid() . $name;
            //   $storing=  $file->store('image','public');
            //   $storing=$file->move(public_path('storage/image/user_Image'),$image_name);
            $storing = $file->move(public_path('dashboard/assets/images/user_image'), $image_name);
        }
        //   dd(User::all());

        $request->except('_token', 'permissions', 'role');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //اللي حصل ان ($storage)  بتجيب كامل المسار اللي موجود في الكمبيوتر عشان كدا عدلتها الي ($getfilename)
            'image' => $storing->getFilename(),
        ]);


        if ($request->permissions) {

            $user->syncPermissions($request->permissions);
        }
        $user->syncRoles([$request->role]);
        // if([$request->role]||$request->permissions){
        //     $user->syncRoles([$request->role]);

        //     $user->syncPermissions($request->permissions);
        // }else{
        //     $user->addRole('user');
        // }

        return redirect()->route('dashboard.user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,)
    {
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();

        return view('dashboarda.users.edit', compact(['user', 'roles', 'permissions']));


        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->hasFile('image'));
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'permissions' => 'required'
        ]);
        $request->except('_token', 'permissions', 'role',);
        // if($request->password !=''){
        //     $requested_data['password']=Hash::make($request->password);
        // }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();
            $image_name = uniqid() . $name;
            //   $storing=  $file->store('image','public');
            $storing = $file->move(public_path('dashboard/assets/images/user_image'), $image_name);
            // if ($user->image) {
            //     unlink(public_path('dashboard/assets/images/user_image/' . $user->image));
            // }
            unlink(public_path('dashboard/assets/images/user_image/' . $user->image));
            //   dd($storing);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //اللي حصل ان ($storage)  بتجيب كامل المسار اللي موجود في الكمبيوتر عشان كدا عدلتها الي ($getfilename)
            'image' => $storing->getFilename(),
        ]);


        // $user->roles()->detach();
        // dd($request->role);
        // $user->syncRoles([$request->role]);
        // $user->permissions()->detach();
        // $user->syncPermissions([$request->permissions]);

        //syncRoles delete all roles and add new role
        $user->syncRoles([$request->role]);
        //syncPermissions delete all permissions and add new permissions
        $user->syncPermissions($request->permissions);

        return redirect()->route('dashboard.user.index')->with('success', 'User edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $user = User::find($id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        unlink(public_path('dashboard/assets/images/user_image/' . $user->image));

        return redirect()->route('dashboard.user.index')->with('success', 'User deleted successfully');
    }
}
