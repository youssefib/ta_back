id,intitule
@foreach ($deplacements as $deplacement)
{{$deplacement->id}},{{$deplacement->intitule}}
@endforeach
