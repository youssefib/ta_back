<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                @endphp
            @foreach ($deplacements as $deplacement)
                @php
                    $sous_total = 0;
                    $sous_total = $deplacement->repas + $deplacement->m_hotel + $deplacement->m_divers + ($deplacement->t_km * $deplacement->nb_km) + $deplacement->ptm + $deplacement->peage + $deplacement->gasoil ;
                    $total += $sous_total;
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
            <td><b>Nb repas</b></td>
            <td><b>Repas</b></td>
            <td><b>Hôtel</b></td>
            <td><b>Libellé divers</b></td>
            <td><b>Divers</b></td>
            <td><b>Nb Km</b></td>
            <td><b>Taux Km</b></td>
            <td><b>Mt. Km</b></td>
            <td><b>Parking</b></td>
            <td><b>Péage</b></td>
            <td><b>Gasoil</b></td>
            <td><b>{{$total}}</b></td>
        </tfoot>

    </table>

</body>
</html>
