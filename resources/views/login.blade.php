@extends('layouts.layoutLogin')
@section('title', 'login')
@section('content')
    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-8 d-none d-sm-none d-md-none d-lg-block"></div>
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="card-header text-center bg-light  border-0 mt-2 pb-0">
                            <img src="img/vet.png" class="mb-2" width="120" height="120" class="d-inline-block" />
                            <br />
                        </div>
                        <div class="card-body text-muted pt-3">
                            <div class="form-row mb-4">
                                <div class="form-group col-12 mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white text-dark"><i
                                                class="fas fa-at"></i></span>
                                        <input type="email" class="form-control" id="documento" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white text-dark"><i
                                                class="fas fa-key"></i></span>
                                        <input type="password" class="form-control" id="contraseña"
                                            placeholder="Password" />
                                    </div>
                                </div>
                            </div>

                            <div class="px-1 d-grid">
                                <button type="button" class="btn btn-block btn-outline-dark inicio" id="btn-ingresar">Sign
                                    in</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
