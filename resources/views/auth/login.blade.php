@extends('layouts.app')

@section('content')
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">{{ __('Login') }}</h2>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#sekolah">Sekolah</a>
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
                                    />
        
                                <x-text-input
                                    type="password"
                                    name="password"
                                    title="password"
                                    id="password-input"
                                    required="required"
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
        
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
            
                        <div class="tab-pane fade" id="sekolah" role="tabpanel">
                            <table class="table table-rounded table-striped border gy-7 gs-7">
                                <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800">
                                        <th>Nama Sekolah</th>
                                        <th>Deskripsi</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Sekolah::all() as $sekolah)
                                        <tr>
                                            <td>{{ $sekolah->nama }}</td>
                                            <td>{{ substr($sekolah->deskripsi, 0, 100) }}</td>
                                            <td>{{ $sekolah->nomor_telepon }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
@endsection
