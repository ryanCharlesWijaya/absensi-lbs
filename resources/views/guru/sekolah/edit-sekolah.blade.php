@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Sekolah</h2>
                </div>
                <form action="{{ route("guru.sekolah.store") }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        type="text"
                        name="nama"
                        title="nama"
                        id="nama-input"
                        :value="$sekolah->nama"
                        required="required"
                        />
                    
                    <x-text-input
                        name="deskripsi"
                        title="deskripsi"
                        id="deskripsi-input"
                        :value="$sekolah->deskripsi"
                        required="required"
                        />

                    <x-text-input
                        type="text"
                        name="alamat"
                        title="alamat"
                        id="alamat-input"
                        :value="$sekolah->alamat"
                        required="required"
                        />
                    
                    <x-text-input
                        type="text"
                        name="nomor_telepon"
                        title="nomor telepon"
                        id="nomor-telepon-input"
                        :value="$sekolah->nomor_telepon"
                        required="required"
                        />

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection