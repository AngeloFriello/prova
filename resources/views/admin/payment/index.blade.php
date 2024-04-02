<x-app-layout>
    @foreach($payments as $payment)
        <ul class="btn btn-primary">
            <li><a href="{{route('admin.payment.show', $payment->id)}}">{{$payment->client_name}}</a></li>
        </ul>
    @endforeach

    <div>
        <a href="{{route('admin.payment.create')}}">crea un nuovo pagamento</a>
    </div>
</x-app-layout>