<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tanks classificatory</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            /*display: flex;*/
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
        }

        .m-b-md {
            margin-bottom: 30px;
            font-size: 40px;
            font-weight: 600;
        }

        #results {
            color: #636b6f;
            font-size: 30px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.3s;
        }

        #results.expanded {
            height: 200px;
            opacity: 1;
        }

        #formula {
            color: #636b6f;
            font-size: 40px;
            font-weight: 100;
            margin: 0;
        }

        #close-button {
            width: 100px;
            height: 20px;
            background-color: #EEEEEE;
            color: #333333;
            font-family: 'Raleway', sans-serif;
            font-weight: 300;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border: 1px solid #aaa;
            transition: all 0.3s;
            cursor: pointer;
            display: none;
            margin: 10px;
        }
        .furmula-form {
            width:  550px;
            margin: 0 auto;
        }

        .furmula-form > div:hover{
            box-shadow: 0 0px 20px rgba(38, 128, 162, 0.52);
        }

        .furmula-form > div{
            text-align: center;

            display: table-cell;
            vertical-align: top;

            padding: 0px;
            padding-bottom: 0px;
        }

        button[type="button"] {
            background-color: #EEEEEE;
            color: #333333;
            font-family: 'Raleway', sans-serif;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border: 1px solid #aaa;
            transition: all 0.3s;
            cursor: pointer;
        }

        button[type="button"]:hover {
            background-color: #CCC;
            border: 4px solid #AAA;
        }

        button[type="reset"] {
            width: 150px;
            height: 50px;
            background-color: #EEEEEE;
            color: #333333;
            font-family: 'Raleway', sans-serif;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border: 1px solid #aaa;
            transition: all 0.3s;
            cursor: pointer;
        }

        button[type="reset"]:hover {
            background-color: #CCC;
            border: 15px solid #AAA;
        }

        input[type="string"] {
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            border: 1px solid #aaa;
            transition: all 0.3s;
            cursor: pointer;
        }

        input[type="submit"] {
            width: 200px;
            height: 50px;
            background-color: #EEEEEE;
            color: #333333;
            font-family: 'Raleway', sans-serif;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border: 1px solid #aaa;
            transition: all 0.3s;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #CCC;
            border: 15px solid #AAA;
        }

        H3 {
            color: #333333;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .class-param {
            margin: 15px;

            color: #333333;
            font-weight: 400;
            text-transform: uppercase;
            font-size: 12px;
        }

        .class-param b {
            display: inline-block;
            width: 200px;
        }

        input[type="number"] {
            width: 75px;
        }


        .close-button {
            color: #c40000;
            cursor: pointer;
        }

        .add-button {
            color: green;
            cursor: pointer;
        }

        .little-button {
            height: 21px !important;
            width: 75px !important;
        }


        .little-button:hover {
            border: 1px solid #AAA !important;
        }
    </style>

    <script>

        $(document).ready(function(){
            $("#erase-button").removeClass("button");

            $(".editing-value").change(function(){
                var parent = $(this).closest("form");
                var button = $(parent).find("input[type='submit']");
                button.css("visibility", "visible");
            });

            $(".editing-value").keydown(function(){
                var parent = $(this).closest("form");
                var button = $(parent).find("input[type='submit']");
                button.css("visibility", "visible");
            });

            $("#submit-suitable-button").click(function(e){
                e.preventDefault();

                var resultBlock = $("#results");

                $(resultBlock).removeClass("expanded");
                setTimeout(function(){

                    var formData = new FormData(document.getElementById("compute_form"));
                    var r = new XMLHttpRequest();

                    r.open("POST", '/classificate');
                    r.setRequestHeader("ContentType", 'multipart/form-data');
                    r.onreadystatechange = function () {
                        if (r.readyState == 4) {
                            if (r.status != 200) {
                                alert(r.responseText);
                            } else {
                                var result = JSON.parse(r.responseText);
                                var resultHtml = "Подходящие классы: <br /><br />";

                                for(var i = 0; i < result.length; i++) {
                                    resultHtml += result[i] + "<br />";
                                    if (i != result.length-1)
                                        resultHtml += "&<br />";
                                }

                                $(resultBlock).html(resultHtml);
                                $(resultBlock).addClass("expanded");
                            }
                        }
                    };
                    r.send(formData);
                }, 300);
            });

            $("#submit-param-button").click(function(e){
                e.preventDefault();

                var resultBlock = $("#results");

                $(resultBlock).removeClass("expanded");

                setTimeout(function(){

                    var formData = new FormData(document.getElementById("new_param_form"));
                    var r = new XMLHttpRequest();

                    r.open("POST", '/addparam');
                    r.setRequestHeader("ContentType", 'multipart/form-data');
                    r.onreadystatechange = function () {
                        if (r.readyState == 4) {
                            if (r.status != 200) {
                                alert(r.responseText);
                            } else {
                                var result = r.responseText;
                                var resultHtml = "Результат добавления: <br /><br />";

                                resultHtml += "Параметр \""+result+"\" создан!";
                                resultHtml += "<br />";
                                resultHtml += "<a href=\"/params\">Нажмите чтобы обновить список параметров!</a>";


                                $(resultBlock).html(resultHtml);
                                $(resultBlock).addClass("expanded");
                            }
                        }
                    };
                    r.send(formData);
                }, 300);
            });

            $("#submit-class-button").click(function(e){
                e.preventDefault();

                var resultBlock = $("#results");

                $(resultBlock).removeClass("expanded");

                setTimeout(function(){

                    var formData = new FormData(document.getElementById("new_class_form"));
                    var r = new XMLHttpRequest();

                    r.open("POST", '/addclass');
                    r.setRequestHeader("ContentType", 'multipart/form-data');
                    r.onreadystatechange = function () {
                        if (r.readyState == 4) {
                            if (r.status != 200) {
                                alert(r.responseText);
                            } else {
                                var result = r.responseText;
                                var resultHtml = "Результат добавления: <br /><br />";

                                if (result == '') {
                                    resultHtml+= "Введите название";
                                } else {
                                    resultHtml += "Класс \""+result+"\" создан!";
                                    location.reload(true);
                                }

                                $(resultBlock).html(resultHtml);
                                $(resultBlock).addClass("expanded");
                            }
                        }
                    };
                    r.send(formData);
                }, 300);
            });

            $("#delete-class-button").click(function(e){
                e.preventDefault();

                var resultBlock = $("#results");

                $(resultBlock).removeClass("expanded");
                setTimeout(function(){

                    var formData = new FormData(document.getElementById("new_class_form"));
                    var r = new XMLHttpRequest();

                    r.open("POST", '/delclass');
                    r.setRequestHeader("ContentType", 'multipart/form-data');
                    r.onreadystatechange = function () {
                        //if (r.readyState == 4) {
                           // if (r.status != 200) {
                             //   alert(r.responseText);
                            //} else {
                                var result = r.responseText;
                                var resultHtml = "Результат удаления: <br /><br />";

                                resultHtml += "Класс \""+result+"\" удалён!";
                                resultHtml += "<br />";
                                resultHtml += "<a href=\"/classes\">Нажмите чтобы обновить список классов!</a>";
                                $(resultBlock).html(resultHtml);
                                $(resultBlock).addClass("expanded");
                           // }
                        //}
                    };
                    r.send(formData);
                }, 300);
            });

            $(".submit-class-param-button").click(function(e){
                e.preventDefault();

                var resultBlock = $("#results");

                $(resultBlock).removeClass("expanded");

                setTimeout(function(){

                    var caller = e.target || e.srcElement;
                    var form = $(caller).closest(".edit-class-param");

                    var formData = new FormData($(form)[0]);

                    var r = new XMLHttpRequest();

                    r.open("POST", '/updateclassparam');
                    r.setRequestHeader("ContentType", 'multipart/form-data');
                    r.onreadystatechange = function () {
                        if (r.readyState == 4) {
                            if (r.status != 200) {
                                alert(r.responseText);
                            } else {
                                $(caller).css("visibility", "hidden");
                            }
                        }
                    };
                    r.send(formData);
                }, 300);
            });

            $("#delete-param-button").click(function(e){
                e.preventDefault();

                var resultBlock = $("#results");

                $(resultBlock).removeClass("expanded");
                setTimeout(function(){

                    var formData = new FormData(document.getElementById("new_param_form"));
                    var r = new XMLHttpRequest();

                    r.open("POST", '/delparam');
                    r.setRequestHeader("ContentType", 'multipart/form-data');
                    r.onreadystatechange = function () {
                        //if (r.readyState == 4) {
                        // if (r.status != 200) {
                        //   alert(r.responseText);
                        //} else {
                        var result = r.responseText;
                        var resultHtml = "Результат удаления: <br /><br />";

                        resultHtml += "Параметр \""+result+"\" удалён!";
                        resultHtml += "<br />";
                        resultHtml += "<a href=\"/params\">Нажмите чтобы обновить список параметров!</a>";
                        $(resultBlock).html(resultHtml);
                        $(resultBlock).addClass("expanded");
                        // }
                        //}
                    };
                    r.send(formData);
                }, 300);
            });

            function chekReg(uCode) {
                var isLow = false;
                for (var i = 97; i < 123; i++) {
                    if (uCode == i) {
                        isLow = true;
                    }
                }
                return isLow;
            }

            function eraseLast(str) {
                var resStr = "";
                if (chekReg(str.charCodeAt(str.length-1))) {
                    for (var i = 0; i < str.length-2; i++) {
                        resStr += str[i];
                    }
                    return resStr;
                } else {
                    for (var i = 0; i < str.length-1; i++) {
                        resStr += str[i];
                    }
                    return resStr;
                }
            }

            

            function getCountEl(str) {
                var num = str.length;
                return str.charCodeAt(2);
            }

            function chemSplit ()
            {

            }


            $("#erase-button").click(function(e){
                e.preventDefault();
                var str = document.getElementById('formula').value;

                document.getElementById('formula').value = eraseLast(str);
            });

            $("#close-button").click(function(){
                document.getElementById('results').style.display = 'none';
                document.getElementById('close-button').style.display = 'none';
            });

            $("#hidrogenium-button").click(function(e){
                e.preventDefault();
                if (document.getElementById('formula').value == "Введите формулу")
                {
                    document.getElementById('formula').value = "H";
                } else {
                    document.getElementById('formula').value += "H";
                }

            });

            $("#oxygenium-button").click(function(e){
                e.preventDefault();
                if (document.getElementById('formula').value == "Введите формулу")
                {
                    document.getElementById('formula').value = "O";
                } else {
                    document.getElementById('formula').value += "O";
                }
            });

            $("#natrium-button").click(function(e){
                e.preventDefault();
                if (document.getElementById('formula').value == "Введите формулу")
                {
                    document.getElementById('formula').value = "Na";
                } else {
                    document.getElementById('formula').value += "Na";
                }
            });

            $("#sulfur-button").click(function(e){
                e.preventDefault();
                if (document.getElementById('formula').value == "Введите формулу")
                {
                    document.getElementById('formula').value = "S";
                } else {
                    document.getElementById('formula').value += "S";
                }
            });
            $("#chlorine-button").click(function(e){
                e.preventDefault();
                if (document.getElementById('formula').value == "Введите формулу")
                {
                    document.getElementById('formula').value = "Cl";
                } else {
                    document.getElementById('formula').value += "Cl";
                }
            });




            $("#submit-formula-button").click(function(e){
                e.preventDefault();

                var resultBlock = $("#results");
                var closeButton = $("#close-button");
                document.getElementById('results').style.display = '';
                document.getElementById('close-button').style.display = 'inline';


                $(resultBlock).removeClass("expanded"); // Убирает CSS класс

                setTimeout(function(){

                    var formData = new FormData(document.getElementById("chem_el_form"));
                    var r = new XMLHttpRequest();

                    r.open("POST", '/addSubsPossibleFormula');
                    r.setRequestHeader("ContentType", 'multipart/form-data');// Для загрузки файлов
                    r.onreadystatechange = function () {
                        if (document.getElementById('formula').value != "") {
                            if (r.readyState == 4) {
                                if (r.status != 200) {
                                    alert(r.responseText);
                                } else {
                                    var result = r.responseText;
                                    var num = getCountEl("NaOH");
                                    var isReg = eraseLast("HNa");

                                    var resultHtml = "Результат проверки формулы ";
                                    resultHtml += "<br />";
                                    resultHtml += "\"" + result + "\"" + num + " " + isReg;
                                    resultHtml += "<br />";

                                    resultHtml += "Результат идентификации";
                                    resultHtml += "<br />";
                                    resultHtml += "\"" + result + "\"";
                                    resultHtml += "<br />";


                                    $(resultBlock).html(resultHtml);
                                    $(resultBlock).addClass("expanded");// CSS стиль!
                                }
                            }
                        } else {
                            var resultHtml = "\"" + "Не введена формула" + "\"";
                            resultHtml += "<br />";


                            $(resultBlock).html(resultHtml);
                            $(resultBlock).addClass("expanded");// CSS стиль!
                        }
                    };
                    r.send(formData);
                }, 300);
            });

        });
    </script>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Редактор элементарной формулы химических соединений
        </div>

        <div class="links">
            <a href="/">Задание исходных данных</a>
            <a href="/params">Редактор базы знаний</a>
            <!--<a href="/classes">Редактор классов</a>
            <a href="/params">Редактор параметров</a>-->
            <a href="/classes">How it works</a>
            <a href="/classes">About</a>
        </div>

        <br />
        <br />

        @yield("content")


    </div>
</div>
</body>
</html>
