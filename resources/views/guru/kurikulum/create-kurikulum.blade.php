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
                        name="nama"
                        title="nama"
                        id="nama-input"
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