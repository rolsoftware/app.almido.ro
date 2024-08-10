<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Exports\UserExport;
use App\Http\Requests\Base\StoreUserRequest;
use App\Http\Requests\Base\UpdateUserRequest;
use App\Jobs\SendUserInvitationEmail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->title = "Utilizatori";

        parent::__construct("app:user");
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $where = [];

        $user    = new User();

        if(!empty($filter)){

            if(isset($filter['username']) && strlen($filter['username']) >= 3) {
                $user = $user->where('username','LIKE',$filter['username'].'%');
            }

            if(isset($filter['name']) && strlen($filter['name']) >= 3) {
                $user = $user->where('name','LIKE',$filter['name'].'%');
            }

            if(isset($filter['email']) && strlen($filter['email']) >= 3) {
                $user = $user->where('email','LIKE',$filter['email'].'%');
            }

            if(isset($filter['role']) && $filter['role'] != 0) {
                $user = $user->role($filter['role']);
            }

            if(isset($filter['active']) && $filter['active'] != 0) {
                $user = $user->where('active',$filter['active']);
            }

        }else{
            $filter['active'] = 'Yes';
            $user = $user->where('active',$filter['active']);
        }

        $rows = $user->sortable()->paginate(15);
        $roles= Role::pluck('name','name')->all();

        $filter_page = "base.user.filter";
        return view('base.user.index',compact('filter_page','filter','rows','roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('base.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->validated();

        # Generate password if empty or use the one provided
        $password = (empty($input['password']) ? Str::random(16) : $input['password']);

        $input['password'] = bcrypt($password);
        $input['active'] = 'Yes';
        $input['avatar'] = "";
        $user = User::create($input);

        # Assign role
        $user->assignRole($request->input('roles'));

        # Send email with password
        // SendUserInvitationEmail::dispatch($user->name, $user->email, $password);

        return redirect(route('user.index'))->with('alert',['type'=>'alert-success','message'=>'Utilizatorul a fost adaugat cu succes!']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(User $user)
    {
        return view('base.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {
        $roles          = Role::pluck('name','name')->all();
        $userRole       = $user->roles->pluck('name','name')->all();

        return view('base.user.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->validated();
        $input['active'] = 'Yes';
        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect(route('user.index'))->with('alert',['type'=>'alert-success','message'=>'Utilizatorul '.$user->name.' a fost actualizat cu succes!']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $user)
    {
        $user->update(['active'=>'No']);
        return redirect(route('user.index'))->with('alert',['type'=>'alert-success','message'=>'Utilizatorul '.$user->name.' a fost dezactivat cu succes!']);
    }

    public function password(User $user)
    {
        return view('base.user.password',compact('user'));
    }

    public function updatePassword(Request $request, User $user): RedirectResponse
    {

        $this->validate($request, [
            'password' => 'same:confirm_password|string|min:6',
        ]);

        $user->update(['password'=>bcrypt($request->get('password'))]);

        return redirect(route('user.index'))->with('alert',['type'=>'alert-success','message'=>'Parola pentru utilizatorul '.$user->name.' a fost schimbata cu succes!']);
    }

    public function export(Request $request){
        $where = [];
        return Excel::download(new UserExport(), 'lista_utilizatori_'.date('Y-m-d').'.xlsx');
    }
}
