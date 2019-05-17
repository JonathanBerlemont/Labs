@if ($activity->subject_type() == 'Newsletter')
    <p>({{$activity->created_at->format('d M y, G:i')}}) <strong>Removed</strong> a user from the newsletter: {{\Illuminate\Support\Str::words($activity->subject_name, $word=4, $end='...')}}</p>
@else
    <p>({{$activity->created_at->format('d M y, G:i')}}) <strong>{{ucfirst($activity->description)}}</strong> a {{$activity->subject_type()}}: {{\Illuminate\Support\Str::words($activity->subject_name, $word=4, $end='...')}}</p>
@endif