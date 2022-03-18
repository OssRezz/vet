<?php

namespace App\Custom;

class Modal
{
    public function modalAlerta($color, $tituloModal, $contenido)
    {
        echo "<!-- Modal -->";
        echo "<div class='modal fade' id='modalAlerta' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>";
        echo "  <div class='modal-dialog modal-dialog-centered'>";
        echo "    <div class='modal-content'>";
        echo "      <div class='modal-header  border-0'>";
        echo "        <h5 class='modal-title $color' id='exampleModalLabel'>" . $tituloModal . "</h5>";
        echo "                <button type='button' class='btn-close' id='close' data-bs-dismiss='modal' aria-label='Close'></button>";
        echo "      </div>";
        echo "      <div class='modal-body'>";
        echo        $contenido;
        echo "       </div>";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo "</div>";
        echo "<script>$('#modalAlerta').modal('show')</script>";
        echo "<script>$('#close').click(function(){location.reload()});</script>";
    }

    public function modalInformativa($color, $tituloModal, $contenidoModal)
    {
        echo "<div class='modal fade' id='modalInfo' tabindex='-1' aria-labelledby='modalInfo' aria-hidden='true'>";
        echo "  <div class='modal-dialog modal-dialog-centered'>";
        echo "    <div class='modal-content'>";
        echo "      <div class='modal-header border-0 '>";
        echo "        <h5 class='modal-title $color' id='modalInfo'>" . $tituloModal . "</h5>";
        echo "                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
        echo "      </div>";
        echo "      <div class='modal-body'>";
        echo " $contenidoModal";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo "</div>";
        echo "<script>$('#modalInfo').modal('show')</script>";
    }

    public function table($color, $tituloModal, $contenidoBody)
    {

        echo "<div class='modal fade' id='modalTable' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true' style='display: block;' data-keyboard='false' data-backdrop='static'>";
        echo "  <div class='modal-dialog modal-lg modal-dialog-centered'>";
        echo "    <div class='modal-content'>";
        echo "      <div class='modal-header  border-0'>";
        echo "        <h5 class='modal-title $color' id='exampleModalLabel'>" . $tituloModal . "</h5>";
        echo "                <button type='button' class='btn-close' id='close' data-bs-dismiss='modal' aria-label='Close'></button>";
        echo "      </div>";
        echo "      <div class='modal-body'>";

        echo "      <div class='table-responsive'>";
        echo "<table class='table table-hover table-sm' id='table' class='display' style='width: 100%'>";
        echo  "<thead>";
        echo  "  <tr>";
        echo  "    <th>Person</th>";
        echo  "    <th>Document</th>";
        echo  "    <th>Pet</th>";
        echo  "    <th class='text-center'>Date</th>";
        echo  "    <th class='text-center'>Time</th>";
        echo  "    <th class='text-center'>Action</th>";
        echo  "  </tr>";
        echo  "</thead>";
        echo $contenidoBody;

        echo             "</table>";
        echo "          </div>";
        echo "       </div>";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo "</div>";
        echo "<script>$('#modalTable').modal('show')</script>";
        echo "<script>$('#close').click(function(){location.reload()});</script>";
        echo  "<script>$('#table').DataTable({ responsive: true, order: [[0, 'desc']] });</script>";
    }
}
