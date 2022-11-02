@extends('layouts.admin')
@section('title', 'event')
@section('page1', 'event')
@section('page2', 'event Product')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table">
                            <div class="row">
                                <div class="col-6 align-items-center">
                                    <h2 class="mb-0">Detail Event</h2>
                                </div>
                                <div class="col-6 text-end align-items-center">
                                    <a class="btn bg-gradient-warning mb-0" href="/myevent"><i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back</a>
                                </div>
                            </div>
                            <br>  

                            <div class="row">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label class="form-control-label">Judul</label>
                                            <input type="text" id="" class="form-control" value="{{ $events->title }}" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Tanggal Mulai</label>
                                            <input type="text" id="" class="form-control" value="{{ $events->date_start }}" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Tanggal Berakhir</label>
                                            <input type="text" id="" class="form-control" value="{{ $events->date_end }}" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Lokasi</label>
                                            <input type="text" id="" class="form-control" value="{{ $events->location }}" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Deskripsi</label>
                                            <input type="text" id="" class="form-control" value="{{ $events->desc }}" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection