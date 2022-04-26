@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Media</h2>
                </div>
                <form action="{{ route("guru.kurikulum.resources.store", ["kurikulum_id" => $kurikulum->id]) }}" method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="file-input" class="form-label">Default file input example</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file-input">

                        @error('file')
                            <div class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection