@extends('layouts.layout')
@section('title', 'Appointments')
@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-12 col-lg-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header"><i class="fas fa-book-medical text-primary"></i> <b>Appointment form</b>
                    </div>
                    <div class="card-body">
                        <form id="frm-appointment">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="document" id="document"
                                    placeholder="Id person">
                                <label for="document">Document person</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="name" placeholder="name person">
                                <label for="name">Name person</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="lastName" id="lastName"
                                    placeholder="lastName">
                                <label for="lastName">Last Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="pet" id="pet" placeholder="pet name">
                                <label for="pet">Pet name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select id="typePet" class="form-select">
                                    <option value="Cat">Cat</option>
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Bird</option>
                                    <option value="Cat">Rabbit</option>
                                    <option value="Cat">Guinea pig</option>
                                    <option value="Cat">Fish</option>
                                </select>
                                <label for="pet">Type of pet</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="date" id="date" placeholder="pet name">
                                <label for="pet">Appointment date</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control" name="time" id="time" placeholder="pet name">
                                <label for="pet">Appointment time</label>
                            </div>

                            <div class="d-grid">
                                <button id="btnAdd" type="submit" class="btn btn-outline-primary">Add appointment</button>
                            </div>

                            <div class=" d-flex justify-content-center">
                                <div id="spinnerInsert">
                                    <div class="sk-circle animate__animated animate__fadeIn">
                                        <div class="sk-circle1 sk-child"></div>
                                        <div class="sk-circle2 sk-child"></div>
                                        <div class="sk-circle3 sk-child"></div>
                                        <div class="sk-circle4 sk-child"></div>
                                        <div class="sk-circle5 sk-child"></div>
                                        <div class="sk-circle6 sk-child"></div>
                                        <div class="sk-circle7 sk-child"></div>
                                        <div class="sk-circle8 sk-child"></div>
                                        <div class="sk-circle9 sk-child"></div>
                                        <div class="sk-circle10 sk-child"></div>
                                        <div class="sk-circle11 sk-child"></div>
                                        <div class="sk-circle12 sk-child"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card mb-3 shadow-sm">
                    <div class="card-header"><i class="fas fa-search text-primary"></i> <b>Search appointment</b>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="date" class="form-control" id="dateAppointment">
                            <button class="btn btn-outline-primary" type="button" id="search-appointment"> <i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header"><i class="fas fa-calendar-check text-primary"></i> <b>List of
                            appointments</b></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tableAppointment">
                                <thead>
                                    <tr>
                                        <th>Person</th>
                                        <th>Document</th>
                                        <th>Pet</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($appointmentList as $item)
                                    <tr>
                                        <td>{{ $item->fullName }}</td>
                                        <td>{{ $item->document }}</td>
                                        <td>{{ $item->petName }}</td>
                                        <td class="text-center">{{ $item->appointmentDate }}</td>
                                        <td class="text-center">{{ $item->appointmentTime }}</td>
                                        <td class="text-center">
                                            <button id="btn-edit" value="{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"
                                                    style="pointer-events: none;"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer pb-3 text-center">
                        <span>{{ $appointmentList->links('vendor/pagination/bootstrap-5', ['paginator' => $appointmentList]) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/appointment/appointment.js') }}"></script>
@endsection
