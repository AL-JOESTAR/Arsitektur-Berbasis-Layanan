@extends('layouts_dashboard.app')

@section('konten')

<form action="{{ route('perpanjang.store',$penyewaan['id']) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Perpanjang Berapa Bulan?</label>
        
        <select name="periode" class="form-select">
            @for($i=1;$i<=12;$i++)
            <option value="{{ $i }}">
                {{ $i }} Bulan
            </option>
            @endfor
        </select>
    </div>
    
    <button class="btn btn-primary">
        Bayar Perpanjangan
    </button>
    
</form>

@if(session('snapToken'))

@section('script')
<script
    type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.clientKey') }}">
</script>

<script>

window.onload = function(){

    snap.pay("{{ session('snapToken') }}",{

        onSuccess: function(result){
            window.location.href="/kamar";
        },

        onPending: function(result){
            window.location.href="/kamar";
        },

        onError: function(result){
            alert("Pembayaran gagal");
        }

    });

}

</script>

@endif
@endsection
