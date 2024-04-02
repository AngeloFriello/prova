<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index() {
        $user = Auth::user();
        if($user){
            $payments = Payment::where('user_id', $user->id)->get();
        }
        return view('admin.payment.index', compact('payments'));
    }

    public function show(Payment $payment) {
        return view('admin.payment.show', compact('payment'));
    }

    public function create(){
        return view('admin.payment.create');
    }

    public function store(){
        
        return view();
    }
}
