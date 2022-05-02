@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Soal</h2>
                </div>
                <form action="{{ route("guru.soal.store") }}" method="post" class="card-body">
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
                        name="soal"
                        title="soal"
                        id="soal-id"
                        required="required"
                        />
                    
                    <x-text-input
                        name="pilihan_a"
                        title="pilihan a"
                        id="pilihan-a-id"
                        required="required"
                        />

                    <x-text-input
                        name="pilihan_b"
                        title="pilihan b"
                        id="pilihan-b-id"
                        required="required"
                        />

                    <x-text-input
                        name="pilihan_c"
                        title="pilihan c"
                        id="pilihan-c-id"
                        required="required"
                        />

                    <x-text-input
                        name="pilihan_d"
                        title="pilihan d"
                        id="pilihan-d-id"
                        required="required"
                        />

                    <x-select-input
                        name="jawaban"
                        title="jawaban"
                        id="jawaban-id"
                        required="required" >
                        <option value="a" @if(old("jawaban") == "a") selected @endif>A</option>
                        <option value="b" @if(old("jawaban") == "b") selected @endif>B</option>
                        <option value="c" @if(old("jawaban") == "c") selected @endif>C</option>
                        <option value="d" @if(old("jawaban") == "d") selected @endif>D</option>
                    </x-select-input>

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection