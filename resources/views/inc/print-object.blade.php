@foreach($product as $prop=>$value) data-{{$prop}}="{{is_object($value) || is_array($value)?json_encode($value):$value}}"@endforeach