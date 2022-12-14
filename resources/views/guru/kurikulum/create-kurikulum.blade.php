@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Kurikulum</h2>
                </div>
                <form action="{{ route("guru.kurikulum.store") }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        type="number"
                        name="kelas"
                        title="kelas"
                        id="kelas-input"
                        min="1"
                        max="12"
                        required="required"
                        />

                    <x-text-input
                        name="tahun_ajaran"
                        title="Tahun Ajaran"
                        id="tahun-ajaran-input"
                        info="Contoh nya: 2019/2020"
                        />

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection