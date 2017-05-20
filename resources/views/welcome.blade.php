@extends("app")

@section("content")
    <form id="compute_form">
        <H3>Find suitable classes</H3>
        {{csrf_field()}}

        @foreach ($params as $param)
            <div class="class-param">
                <b>{{$param->name}}:</b> <input type="number" name="{{$param->name}}">
            </div>
        @endforeach
        <br />
        <br />
        <br />
        <br />
        <br />
        <input type="submit" value="Check class!" id="submit-suitable-button">
    </form>


    <div class="links" id="results">
        Result
    </div>
@endsection()