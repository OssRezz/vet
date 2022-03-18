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
            $modal->modalInformativa('text-warning', 'Informacion', "Date input is required");
        }
    }
}
