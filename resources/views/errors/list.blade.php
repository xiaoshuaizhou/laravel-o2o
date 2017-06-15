@if($errors->any())
    <ul class="list-group">
        @foreach($errors->all() as $error)
            <li class="list">{{$error}}</li>
        @endforeach
    </ul>
@endif