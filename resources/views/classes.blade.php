@extends("app")

@section("content")
    @foreach($classes as $class)
        <H3>{{$class[0]->_class->name}} <span class="delete-button"></span></H3>
        @foreach($class as $param)
            <div class="class-param">
                <form class="edit-class-param">
                    {{ csrf_field() }}
                    <input type="hidden" name="class_id" value="{{$param->_class->id}}">
                    <input type="hidden" name="param_id" value="{{$param->param->id}}">
                    <input type="hidden" name="value_id" value="{{$param->value->id}}">

                    <b>{{$param->param->name}}:</b>
                    <input class="editing-value" type="number" name="min" value="{{$param->value->min}}">
                    <b>...</b>
                    <input class="editing-value" type="number" name="max" value="{{$param->value->max}}">
                    <input class="little-button submit-class-param-button" type="submit" value="UPDATE" style="visibility: hidden">
                </form>
            </div>
        @endforeach
        <br /><br />
        ---------------------
    @endforeach

    <form id="new_class_form">
        <H3>Новый класс <span class="add-button"></span></H3>
        {{csrf_field()}}

        <div class="class-param">
            <b>Имя класса</b> <input type="text" name="class_name" placeholder="введите название класса">
        </div>

        <input type="submit" value="Добавить" id="submit-class-button">
        <br /><br />
        <input type="submit" value="Удалить" id="delete-class-button">
    </form>


    <div class="links" id="results">
        Result
    </div>
@endsection()