<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export des frais de déplacement du {{$date}}</title>
    <style>
    table, th, td {
        border: 1px solid;
      }
    th, td, h1 {
        text-align: center;
    }
    table {
    width: 100%;
    }

    </style>
</head>
<body>

    <h1 style="background-color: blue; color:white;">Export des frais de déplacement du {{$date}}</h1>

    <table>
        <thead>
            <th>Date</th>
            <th>Déplacement</th>
            <th>Nb repas</th>
            <th>Repas</th>
            <th>Hôtel</th>
            <th>Libellé divers</th>
            <th>Divers</th>
            <th>Nb Km</th>
            <th>Taux Km</th>
            <th>Mt. Km</th>
            <th>Parking</th>
            <th>Péage</th>
            <th>Gasoil</th>
            <th>Total</th>
        </thead>
        <tbody>
                @php
                    $total = 0;
                    $nb_repas = 0;
                    $repas = 0;
                    $m_hotel = 0;
                    $m_divers = 0;
                    $nb_km = 0;
                    $t_km = 0;
                    $m_km = 0;
                    $ptm = 0;
                    $peage = 0;
                    $gasoil = 0;
                @endphp
            @foreach ($deplacements as $deplacement)
                @php
                    $sous_total = 0;
                    $sous_total = $deplacement->repas + $deplacement->m_hotel + $deplacement->m_divers + ($deplacement->t_km * $deplacement->nb_km) + $deplacement->ptm + $deplacement->peage + $deplacement->gasoil ;
                    $total += $sous_total;
                    $nb_repas +=  $deplacement->nb_repas;
                    $repas +=  $deplacement->repas;
                    $m_hotel +=  $deplacement->m_hotel;
                    $m_divers +=  $deplacement->m_divers;
                    $nb_km +=  $deplacement->nb_km;
                    $t_km += $deplacement->t_km;
                    $m_km +=  $deplacement->m_km;
                    $ptm +=  $deplacement->ptm;
                    $peage +=  $deplacement->peage;
                    $gasoil +=  $deplacement->gasoil;
                @endphp
                <tr>
                    <td>{{$deplacement->date}}</td>
                    <td>{{$deplacement->intitule}}</td>
                    <td>{{$deplacement->nb_repas}}</td>
                    <td>{{$deplacement->repas}}</td>
                    <td>{{$deplacement->m_hotel}}</td>
                    <td>{{$deplacement->infos}}</td>
                    <td>{{$deplacement->m_divers}}</td>
                    <td>{{$deplacement->nb_km}}</td>
                    <td>{{$deplacement->t_km}}</td>
                    <td>{{$deplacement->t_km * $deplacement->nb_km}}</td>
                    <td>{{$deplacement->ptm}}</td>
                    <td>{{$deplacement->peage}}</td>
                    <td>{{$deplacement->gasoil}}</td>
                    <td>{{$sous_total}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="2">Totaux</td>
            <td><b>{{$nb_repas}}</b></td>
            <td><b>{{$repas}}</b></td>
            <td><b>{{$m_hotel}}</b></td>
            <td><b></b></td>
            <td><b>{{$m_divers}}</b></td>
            <td><b>{{$nb_km}}</b></td>
            <td><b>{{$t_km}}</b></td>
            <td><b>{{$m_km}}</b></td>
            <td><b>{{$ptm}}</b></td>
            <td><b>{{$peage}}</b></td>
            <td><b>{{$gasoil}}</b></td>
            <td><b>{{$total}}</b></td>
        </tfoot>

    </table>

</body>
</html>
