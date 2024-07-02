@extends('layouts.app')

@section('title', 'Buat Pembayaran')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Buat Pembayaran</h3>
        </div>
        <div class="container mt-5">
            <h3 class="text-center"><strong>Pilih Metode Pembayaran</strong></h3>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-5 payment-method">
                    <h4>Transfer Bank</h4>
                    <br>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/logo_bank/bri.png') }}" alt="BRI Logo" width="50">
                        <div class="ml-5">
                            <p>3676 7647 9857 6743</p>
                            <p>Ensa Course</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/logo_bank/bni.png') }}" alt="BNI Logo" width="50">
                        <div class="ml-5">
                            <p>14426327718</p>
                            <p>Ensa Course</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/logo_bank/bca.png') }}" alt="BCA Logo" width="50">
                        <div class="ml-5">
                            <p>53437623736</p>
                            <p>Ensa Course</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 payment-method">
                    <h4>E-Wallet</h4>
                    <br>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/logo_bank/dana.png') }}" alt="Dana Logo" width="50">
                        <div class="ml-5">
                            <p>085694582312</p>
                            <p>Ensa Course</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pembayaran.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="id_user">Pengguna</label>
                    <select name="id_user" id="id_user" class="form-control">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_kursus">Kursus</label>
                    <select name="id_kursus" id="id_kursus" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                    <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
