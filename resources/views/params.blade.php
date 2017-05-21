@extends("app")

@section("content")

    @foreach($params as $param)
        <H3>{{$param->name}} <span class="delete-button"></span> <br>---------------------</H3>
    @endforeach

    <br />
    <form id="new_param_form">
        <H3>Новый параметр <span class="add-button"></span></H3>
        {{csrf_field()}}

        <div class="class-param">
            <b>Имя параметра:</b> <input type="text" name="param_name" placeholder="введите название параметра">
        </div>

        <input type="submit" value="Добавить" id="submit-param-button">
        <input type="submit" value="Удалить" id="delete-param-button">
    </form>


    <div class="links" id="results">
        Result
    </div>
@endsection()