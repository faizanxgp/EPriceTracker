<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;
use Session;
use Redirect;

use App\User;
use App\Package;
use App\UserPackage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function getAccount()
    {

        $user = Auth::user();
        $user_id = $user->id;

        //$account = User::findOrFail($user_id);

        return view('admin.account', ['user' => $user]);

    }

    public function getLoginUser($id) {

        return Redirect::route('login-by-admin', $id);

    }

    public function postAccount(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $rules = array('name' => 'required', 'email' => 'required');

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('admin.dashboard')->withErrors($validator)->withInput();

        } else {

            $user->name = $request['name'];
            $user->email = $request['email'];
            if ($request->password != null and $request->password_confirmation != null
                and strlen($request->password) >= 6 and $request->password == $request->password_confirmation
            ) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            Session::flash('flash_message', 'Account successfully updated!');
        }
        return redirect()->route('admin.dashboard');
    }

    public function getUsers()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $users = User::orderBy('id')->paginate(10);

        return view('admin.users', ['users' => $users]);
    }

    public function getUser($id = 0)
    {

        $user = Auth::user();
        $user_id = $user->id;

        if ($id == 0) {
            $user = new User();
        } else {
            $user = User::findOrFail($id);
        }

        $packages = Package::orderBy('id')->pluck('package', 'id');
        $userpackages = UserPackage::where('user_id', $id)->get();

        return view('admin.user', ['user' => $user, 'packages' => $packages, 'userpackages' => $userpackages]);
    }

    public function postUser(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $rules = array('package_id' => 'required', 'price' => 'required|numeric');

        //, 'connects' => 'required|numeric',);

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('admin.user', $request->user_id)->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {

                $userpackage = new UserPackage();

            } else {
                $userpackage = UserPackage::findOrFail($id);
            }

            $userpackage->user_id = $request["user_id"];
            $userpackage->package_id = $request["package_id"];
            $userpackage->price = $request["price"];
            $userpackage->fromdate = $request["fromdate"];
            $userpackage->uptodate = $request["uptodate"];
            $userpackage->comments = $request["comments"];
            $userpackage->save();

//

            Session::flash('flash_message', 'Package successfully updated!');

        }

        return redirect()->route('admin.user', $request->user_id);

    }


    public function getUserSuspend($id = 0)
    {

        $user = User::findOrFail($id);

        if ($user->verified == 1)
            $user->verified = 0;
        else
            $user->verified = 1;

        $user->save();

        return redirect()->route('admin.users');
    }


    public function getPackages()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $packages = Package::orderBy('id')->paginate(10);

        return view('admin.packages', ['packages' => $packages]);
    }

    public function getPackage($id = 0)
    {


        if ($id == 0) {
            $package = new Package();

        } else {
            $package = Package::findOrFail($id);
        }

        return view('admin.package', ['package' => $package]);
    }

    public function postPackage(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $rules = array('package' => 'required', 'price' => 'required|numeric', 'connects' => 'required|numeric',);

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('admin.package', $request->id)->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {

                $package = new Package();

            } else {
                $package = Package::findOrFail($id);
            }
            $package->package = $request["package"];
            $package->price = $request["price"];
            $package->connects = $request["connects"];
            $package->save();

//

            Session::flash('flash_message', 'Package successfully updated!');

        }

        return redirect()->route('admin.packages');

    }
}