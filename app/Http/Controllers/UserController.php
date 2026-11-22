<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\MembershipPaymentRequest;
use App\Http\Requests\UserMembershipRequest;
use App\Models\Chapter;
use App\Models\MembershipPayment;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use App\Models\UserMembership;
use App\Mail\MembershipRegisterNotification;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        // if ($request->file('photo') == null) {
        //     $data['photo'] = $user->photo;
        // } else {
        //     $data['photo'] = $request->file('photo')->store('assets/users', 'public');
        // }

        $user->update($data);

        Session::flash('success', "Profile Successfully Update!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getImageProfile()
    {
        $user = Auth::user();

        return response()->json($user->photos);
    }

    public function changeImageProfile(Request $request)
    {
        $user = Auth::user();

        $photo = Storage::disk('s3')->put('images', $request->photos);
        $user['photos'] = Storage::disk('s3')->url($photo);

        $user->save();

        Session::flash('success', 'Profile Picture Successfully Update!');
        return redirect()->back();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches

            Session::flash('error', "Your current password does not matches with the password.");
            return redirect()->back();
        }

        if (strcmp($request->get('old_password'), $request->get('password')) == 0) {
            // Current password and new password same

            Session::flash('error', "New Password cannot be same as your current password.");
            return redirect()->back();
        }

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success', "Password Successfully Changed!");
        return redirect()->route('home');
    }

    public function profilePage()
    {
        $membership = UserMembership::where('users_id', auth()->user()->id)->first();
        $provinces = Province::all();

        return view('pages.dashboard.profile', [
            'membership' => $membership,
            'provinces' => $provinces
        ]);
    }

    public function getProvince(){
        $provinces= Province::all();

        return response()->json($provinces);
    }

    public function getCities($id){
        $cities = City::where('province_id', $id)->get();

        return response()->json($cities);
    }

    public function membershipPage()
    {
        $membership = UserMembership::where('users_id', auth()->user()->id)->first();

        return view('pages.membership.infomation-membership', [
            'membership' => $membership,
        ]);
    }

    public function registerPage()
    {
        $chapters = Chapter::all();

        return view('pages.membership.register-membership', [
            'chapters' => $chapters,
        ]);
    }

    public function registerMembership(UserMembershipRequest $request)
    {
        $membership = UserMembership::where('users_id', auth()->user()->id)->first();

        if ($membership == null) {
            $user = Auth::user();
            $data = $request->all();

            $data['users_id'] = $user->id;
            // $data['id_member'] = 'PI-' . mt_rand(0000, 9999) . '-' . $data['alias'];
            $photo_car = Storage::disk('s3')->put('images', $request->photo_car);
            $photo_identity = Storage::disk('s3')->put('images', $request->photo_identity);
            $photo_license = Storage::disk('s3')->put('images', $request->photo_license);
            $data['photo_car'] = Storage::disk('s3')->url($photo_car);
            $data['photo_identity'] = Storage::disk('s3')->url($photo_identity);
            $data['photo_license'] = Storage::disk('s3')->url($photo_license);

            UserMembership::create($data);

            Mail::to($user->email)->send(new MembershipRegisterNotification([
                'email' => $user->email,
                'name' => $user->name,
            ]));
            Session::flash('success', "Berhasil Daftar Sebagai Member, Silahkan Cek Email Anda Untuk mengetahui Tahap Selanjutnya");
        } else {
            Session::flash('error', "Anda Sudah Mendaftarkan Diri menjadi Membership. Harap Melanjutkan Proses Dengan Melakukan Cek Email");
        }

        return redirect()->route('membership');
    }

    public function editMembership()
    {
        $membership = userMembership::where('users_id', auth()->user()->id)->first();
        $chapters = Chapter::all();

        return view('pages.membership.edit-membership', [
            'membership' => $membership,
            'chapters' => $chapters,
        ]);
    }

    public function updateMembership(UserMembershipRequest $request)
    {
        $user = Auth::user();
        $membership = userMembership::where('users_id', auth()->user()->id)->first();
        $data = $request->all();

        if ($request->file('photo_car') == null) {
            $data['photo_car'] = $membership->photo_car;
        } else {
            $photo_car = Storage::disk('s3')->put('images', $request->photo_car);
            $data['photo_car'] = Storage::disk('s3')->url($photo_car);
        }

        if ($request->file('photo_license') == null) {
            $data['photo_license'] = $membership->photo_license;
        } else {
            $photo_license = Storage::disk('s3')->put('images', $request->photo_license);
            $data['photo_license'] = Storage::disk('s3')->url($photo_license);
        }

        if ($request->file('photo_identity') == null) {
            $data['photo_identity'] = $membership->photo_identity;
        } else {
            $photo_identity = Storage::disk('s3')->put('images', $request->photo_identity);
            $data['photo_identity'] = Storage::disk('s3')->url($photo_identity);
        }

        $membership->update($data);

        Session::flash('success', "Berhasil Update Data Membership");
        return redirect()->route('membership');
    }
    public function userMembership()
    {
        $membership = UserMembership::where('users_id', auth()->user()->id)->first();
        return view('pages.membership.membership', [
            'membership' => $membership,
        ]);
    }

    public function payMembership()
    {
        $membership = UserMembership::where('users_id', auth()->user()->id)->first();
        return view('pages.membership.pay-membership', [
            'membership' => $membership,
        ]);
    }

    public function paymentMembership(MembershipPaymentRequest $request)
    {
        $data = $request->all();

        $photo = Storage::disk('s3')->put('images', $request->photo);
        $data['photo'] = Storage::disk('s3')->url($photo);
        MembershipPayment::create($data);

        Session::flash('success', "Berhasil Mengirimkan Bukti Pembayaran");
        return redirect()->route('membership');
    }

    public function historyPayment(){
        $user = Auth::user();
        $membership = UserMembership::where('users_id', $user->id)->first();
        $histories = MembershipPayment::where('membership_id', $membership->id)->get();

        return view('pages.membership.historypayment', [
            'histories' => $histories
        ]);
    }
}
