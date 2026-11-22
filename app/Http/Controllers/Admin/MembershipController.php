<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPayment;
use App\Models\UserMembership;
use App\Mail\ApproveMembershipNotification;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MembershipController extends Controller
{
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
    public function update(Request $request, $id)
    {
        //
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

    public function membershipCandidate(Request $request)
    {
        if (Auth::user()->roles == 'Admin') {
            if (isset($request->search) && $request->search != '') {
                $candidates = UserMembership::where('nickname', 'LIKE', '%' . $request->search . '%')->
                    orWhere('ktp_num', 'LIKE', '%' . $request->search . '%')->
                    orWhere('id_member', 'LIKE', '%' . $request->search . '%')->
                    where('status', 'pending')->latest()->paginate(10);
            } else {
                $candidates = UserMembership::where('status', 'pending')->latest()->paginate(10);
            }
        } else {
            $candidates = UserMembership::where('status', 'accept by chapter')->latest()->paginate(10);
        }

        return view('pages.membership-admin.candidate', [
            'candidates' => $candidates,
        ]);
    }

    public function membershipReal()
    {
        if (Auth::user()->roles == 'Admin') {
            $memberships = UserMembership::where('status', 'accept by chapter')->latest()->get();
        } else {
            $memberships = UserMembership::where('status', 'active')->latest()->get();
        }

        return view('pages.membership-admin.membership', [
            'memberships' => $memberships,
        ]);
    }

    public function changeStatusActive($id)
    {
        if (Auth::user()->roles == 'Admin') {
            $membership = UserMembership::findOrFail($id);

            if ($membership->status == 'pending') {
                $membership->status = 'accept by chapter';

                Mail::to($membership->user->email)->send(new ApproveMembershipNotification([
                    'email' => $membership->user->email,
                    'name' => $membership->user->name,
                ]));
                
                $membership->save();
            } elseif ($membership->status == 'accept by chapter') {
                $membership->status = 'pending';
                $membership->save();
            }
        } elseif (Auth::user()->roles == 'Super Admin') {

            $membership = UserMembership::findOrFail($id);
            if ($membership->status == 'accept by chapter') {
                $membership->status = 'active';
                $membership->save();
            } elseif ($membership->status == 'active') {
                $membership->status = 'accept by chapter';
                $membership->save();
            }
        }

        Session::flash('success', 'Status Membership sudah diupdate');
        return redirect()->back();
    }

    public function paymentList()
    {
        $payments = MembershipPayment::with(['membership'])->get();

        return view('pages.membership-admin.list-transcation', [
            'payments' => $payments,
        ]);
    }
}
