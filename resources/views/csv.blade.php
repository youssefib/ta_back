intitule,date,peage,gasoil,nb_km,t_km,f_divers,infos,nb_repas,m_repas,m_hotel
@foreach ($deplacements as $deplacement)
{{$deplacement->intitule}},{{$deplacement->date}},{{$deplacement->peage}},{{$deplacement->gasoil}},{{$deplacement->nb_km}},{{$deplacement->t_km}},{{$deplacement->f_divers}},{{$deplacement->infos}},{{$deplacement->nb_repas}},{{$deplacement->m_repas}},{{$deplacement->m_hotel}}
@endforeach
