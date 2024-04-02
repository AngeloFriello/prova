<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\PaymentUpdateRequest;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $payments = Payment::where('user_id', $user->id)->get();
        }
        return view('admin.payment.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('admin.payment.show', compact('payment'));
    }

    public function create()
    {
        return view('admin.payment.create');
    }

    public function store(PaymentStoreRequest $request)
    {

        $data = $request->validated();

        $userID = auth()->user()->id;


        $new_payment = Payment::create([
            'client_name' => $data['client_name'],
            'total_price' => $data['total_price'],
            'description' => $data['description'],
            'user_id' => $userID,
        ]);
        
        $payment_id = $new_payment->id;
       
        foreach ($data['product_name'] as $key => $productName) {
            // Verifica se il nome del prodotto è vuoto (potrebbe non essere necessario)
            if (!empty($productName)) {
                // Creazione di un nuovo oggetto Cart per ogni prodotto
                $cartData = [
                    'payment_id' => $payment_id, // Utilizza $payment->id anziché $product-id
                    'product_name' => $productName,
                    'quantity' => $data['quantity'][$key],
                    'product_price' => $data['product_price'][$key],
                ];
                // Salva il prodotto nel carrello
                Cart::create($cartData);
            }
        }
        return redirect()->route('admin.payment.show', $new_payment->id);
    }

    public function edit( Payment $payment){
        
        return view('admin.payment.edit', compact('payment'));
    }

    public function update(PaymentUpdateRequest $request,Payment $payment){

        $data = $request->validate($request->rules());

        $payment->update($data);

        $payment->cart()->sync($request->get('cart_id'));

        return redirect()->route('admin.payment.show', $payment->id);
    }
}
