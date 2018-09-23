@if(count($errors) > 0)
    <div class="alert alert-danger mb-4">
        <p><i class="glyphicon glyphicon-remove"></i> There were some errors:</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif
