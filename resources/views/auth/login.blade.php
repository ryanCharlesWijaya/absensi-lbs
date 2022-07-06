@extends('layouts.app')

@section('content')
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header card-header-stretch">
                    <h2 class="card-title">{{ __('Login') }}</h2>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#sekolah">Sekolah Minggu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#pengumuman">Pengumuman</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
        
                                <x-text-input
                                    type="text"
                                    name="email"
                                    title="email"
                                    id="email-input"
                                    required="required"
                                    maxchar="60"
                                    />
        
                                <x-text-input
                                    type="password"
                                    name="password"
                                    title="password"
                                    id="password-input"
                                    required="required"
                                    maxchar="30"
                                    />
        
        
                                <div class="mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
        
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
        
                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </form>
                        </div>
            
                        <div class="tab-pane fade" id="sekolah" role="tabpanel">
                            @foreach (\App\Models\Sekolah::where("kategori", "sekolah_minggu")->get() as $sekolah)
                                <div class="card card-bordered mb-5">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $sekolah->nama }}</h5>
                                        <div class="card-toolbar">
                                            <span class="badge badge-light">{{ $sekolah->nomor_telepon }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if ($sekolah->getFirstMedia())
                                                <div class="col-md-4 mb-3 mb-md-0">
                                                    <img src="{{ $sekolah->getFirstMedia()->getFullUrl() }}" class="w-100 rounded" alt="">
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="fw-bold" for="">Alamat:</label>
                                                    <p class="card-text">{{ $sekolah->alamat }}</p>
                                                    
                                                    <label class="fw-bold" for="">Deskripsi:</label>
                                                    <p class="card-text">{{ $sekolah->deskripsi }}</p>
                                                </div>
                                            @else
                                            <div class="col-md-12">
                                                <label class="fw-bold" for="">Alamat:</label>
                                                <p class="card-text">{{ $sekolah->alamat }}</p>
                                                
                                                <label class="fw-bold" for="">Deskripsi:</label>
                                                <p class="card-text">{{ $sekolah->deskripsi }}</p>
                                            </div>
                                            @endif                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="pengumuman" role="tabpanel">
                            <div class="row">
                                @foreach (\App\Models\Pengumuman::all() as $pengumuman)
                                    <div class="col-6">
                                        <div class="card overflow-hidden card-bordered mb-5">
                                            <div class="card-body p-0">
                                                @if ($pengumuman->getFirstMedia())
                                                    <img src="{{ $pengumuman->getFirstMedia()->getFullUrl() }}" alt="" class="w-100">
                                                @endif
                                                <div class="p-8">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title">{{ $pengumuman->judul }}</h5>
                                                        <div class="card-toolbar">
                                                            <span class="badge badge-light">{{ $pengumuman->kategori }}</span>
                                                        </div>
                                                    </div>
                                                    <small for="">Ditambahkan pada, {{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $pengumuman->created_at)->format("d M Y") }}</small>
                                                    <p class="card-text">{{ $pengumuman->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
@endsection
