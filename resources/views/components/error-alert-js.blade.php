@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <script>alert( '{{ $error }}' )</script>
            @endforeach
        </ul>
    </div>
@endif
