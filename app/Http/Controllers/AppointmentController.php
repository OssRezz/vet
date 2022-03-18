<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\Modal;
use App\Models\appointments;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function viewAppointment()
    {
        $date = date('Y-m-d');
        $appointmentList = appointments::select("appointments.*", DB::raw("CONCAT(name,' ',lastName) as fullName"))
            ->Where('appointmentDate', ">=", $date)
            ->orderBy('appointmentDate', 'ASC')
            ->orderBy('appointmentTime', 'ASC')->paginate(6);

        return view('appointments.appointment', compact('appointmentList', 'date'));
    }

    public function create(Modal $modal, Request $request, appointments $citas)
    {


        if (
            empty($request->document) != 1 && empty($request->name) != 1 &&
            empty($request->lastName) != 1 && empty($request->pet) != 1 &&
            empty($request->date) != 1 && empty($request->time) != 1
        ) {

            $appointmentList = appointments::Where('appointmentDate', $request->date)
                ->where('appointmentTime', $request->time)->first();

            if ($appointmentList === null) {
                $citas->document = $request->document;
                $citas->name = $request->name;
                $citas->lastName = $request->lastName;
                $citas->petName = $request->pet;
                $citas->petType = $request->typePet;
                $citas->appointmentDate = $request->date;
                $citas->appointmentTime = $request->time;

                if ($citas->save()) {
                    $modal->modalAlerta('text-primary', 'Informacion', "Appointment has been create successfully");
                }
            } else {
                $modal->modalInformativa('text-warning', 'Informacion', "There is already an appointment registered on that date and time");
            }
        } else {
            $modal->modalInformativa('text-warning', 'Informacion', "All fields are required");
        }
    }

    public function searchByDate(Request $request, Modal $modal)
    {
        if (empty($request->date) != 1) {
            $appointmentList = appointments::select("appointments.*", DB::raw("CONCAT(name,' ',lastName) as fullName"))
                ->Where('appointmentDate', "=", $request->date)
                ->orderBy('appointmentDate', 'ASC')
                ->orderBy('appointmentTime', 'ASC')->get();

            $contenidoModal = "<tbody>";

            foreach ($appointmentList as $key => $value) {
                $name = $value['fullName'];
                $document = $value['document'];
                $petName = $value['petName'];
                $appointmentDate = $value['appointmentDate'];
                $appointmentTime = $value['appointmentTime'];
                $id = $value['id'];

                $contenidoModal .= "<tr>";
                $contenidoModal .= "<td>$name</td>";
                $contenidoModal .= "<td>$document</td>";
                $contenidoModal .= "<td>$petName</td>";
                $contenidoModal .= "<td class='text-center'>$appointmentDate</td>";
                $contenidoModal .= "<td class='text-center'>$appointmentTime</td>";
                $contenidoModal .= "<td class='text-center'>";
                $contenidoModal .= "<button value='$id' class='btn btn-outline-primary btn-sm'><i class='fas fa-edit'></i></button>";
                $contenidoModal .= "</td>";
                $contenidoModal .= "</tr>";
            }

            $contenidoModal .= "</tbody>";

            $modal->table("text-primary", "Informacion", $contenidoModal);
        } else {
            $modal->modalInformativa('text-warning', 'Informacion', "Select a date");
        }
    }

    public function modalUpdate(Modal $modal, Request $request)
    {
        $listAppointmentById = appointments::where('id', "=", $request->id)->get();
        foreach ($listAppointmentById as $value) {
            $fechaCita = $value['appointmentDate'];
            $horaCita = $value['appointmentTime'];
        }
        //
        $contenidoModal = "                <div class='row g-3'>";
        $contenidoModal .= "                  <div class='col-12'>";
        $contenidoModal .= "                    <div class='form-floating'>";
        $contenidoModal .= "                      <input  id='appointmentDate' type='date' value='$fechaCita' class='form-control' placeholder='Appointment time'>";
        $contenidoModal .= "                      <label for=''>Appointment date <b class='text-danger'>*</b></label>";
        $contenidoModal .= "                    </div>";
        $contenidoModal .= "                  </div>";
        $contenidoModal .= "                  <div class='col-12'>";
        $contenidoModal .= "                    <div class='form-floating'>";
        $contenidoModal .= "                      <input id='appointmentTime' type='time' value='$horaCita' class='form-control' placeholder='Appointment time'>";
        $contenidoModal .= "                      <label for=''>Appointment time <b class='text-danger'>*</b></label>";
        $contenidoModal .= "                    </div>";
        $contenidoModal .= "                  </div>";
        //
        $contenidoModal .= "                <div class='d-grid'>";
        $contenidoModal .= "                <button class='btn btn-outline-primary' value='$request->id' id='btn-update-appointment'>Update appointment</button>";
        $contenidoModal .= "                </div>";
        $contenidoModal .= "                </div>";

        $modal->modalAlerta("text-primary", "Information", $contenidoModal);
    }

    public function update(Request $request, Modal $modal, appointments $cita)
    {
        $actualTime = date('h:i'); //hora actual
        $listAppointmentById = appointments::where('id', $request->id)->get();
        foreach ($listAppointmentById as $value) {
            $name = $value['name'];
            $lastName = $value['lastName'];
            $petName = $value['petName'];
            $petType = $value['petType'];
            $document = $value['document'];
            $horaCita = $value['appointmentTime'];
        }

        //Hora de la cita a minutos
        $horaCitaArray = explode(":", $horaCita);
        $minutosCita = ($horaCitaArray[0] * 60) + $horaCitaArray[1];

        //Hora actual a minutos
        $horaActualArray = explode(":", $actualTime);
        $minutosActual = ($horaActualArray[0] * 60) + $horaActualArray[1];

        //Tiempo restante para la cita
        $timeToUpdate = $minutosCita - $minutosActual;

        $cita = appointments::find($request->id);
        $cita->document = $document;
        $cita->name = $name;
        $cita->lastName = $lastName;
        $cita->petName = $petName;
        $cita->petType = $petType;
        $cita->appointmentDate = $request->date;
        $cita->appointmentTime = $request->time;

        if ($minutosCita < $minutosActual) { //Si la hora de la cita es menor a la hora actual no permitira modificarla
            $modal->modalAlerta("text-warning", "Information", "This appointment has been done and it can't be modify");
        } else if ($timeToUpdate <= 120) { //Si falta menos de dos horas para la cita, no permitira modificarla
            $modal->modalAlerta("text-warning", "Information", "Is less than two hours for the appointment, it can't be modify");
        } else { //De resto permitira modificar la cita
            if ($cita->update()) {
                $modal->modalAlerta("text-primary", "Information", "Appointment modified successfully");
            }
        }
    }
}
