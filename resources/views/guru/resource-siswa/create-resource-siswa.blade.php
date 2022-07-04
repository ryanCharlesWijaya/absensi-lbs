@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-stretch">
                    <h3 class="card-title">Tambah Resource</h3>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_7">File</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8">URL</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_tab_pane_7" role="tabpanel">
                        <form action="{{ route("guru.resourceSiswa.store") }}" method="POST" enctype="multipart/form-data" class="card-body">
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
        
                    <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                        <form action="{{ route("guru.resourceSiswa.store") }}" method="POST" enctype="multipart/form-data" class="card-body">
                            @csrf
                            <div class="mb-3">
                                <x-text-input
                                    type="url"
                                    name="url"
                                    title="url"
                                    id="url-input"
                                    required="required"
                                    />
                            </div>
        
                            <div class="mb-3">
                                <button class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection