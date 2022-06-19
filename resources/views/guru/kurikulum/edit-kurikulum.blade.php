@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Edit Kurikulum</h2>
                </div>
                <form action="{{ route("guru.kurikulum.update", ["kurikulum_id" => $kurikulum->id]) }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        name="nama"
                        title="nama"
                        id="nama-input"
                        required="required"
                        value="{{ $kurikulum->nama }}"
                        />

                    <div class="mb-3">
                        <button class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection