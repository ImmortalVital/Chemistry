@extends("app")

@section("content")

    @foreach($params as $param)
        <H3>{{$param->name}} <span class="delete-button">[X]</span></H3>
    @endforeach

    <br />

    <form id="new_param_form">
        <H3>New param <span class="add-button">[+]</span></H3>
        {{csrf_field()}}

        <div class="class-param">
            <b>Param name:</b> <input type="text" name="param_name" placeholder="type new param name">
        </div>

        <input type="submit" value="Add param!" id="submit-param-button">
    </form>


    <div class="links" id="results">
        Result
    </div>
@endsection()