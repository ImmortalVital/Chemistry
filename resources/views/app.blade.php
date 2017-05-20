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
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        #results {
            margin-top: 2vw;
            color: #636b6f;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.3s;
        }

        #results.expanded {
            height: 300px;
            opacity: 1;
        }

        input[type="submit"] {
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
            width: 100px;
        }

        input[type="number"] {
            width: 75px;
        }

        input[type="text"] {
            width: 260px;
        }

        .delete-button {
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
                                var resultHtml = "Suitable classes: <br /><br />";

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
                                var resultHtml = "Adding result: <br /><br />";

                                resultHtml += "Success! Param \""+result+"\" created!";
                                resultHtml += "<br />";
                                resultHtml += "<a href=\"/classes\">Click here to set this param to all existing classes!</a>";

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
                                var resultHtml = "Adding result: <br /><br />";

                                resultHtml += "Success! Class \""+result+"\" created!";
                                resultHtml += "<br />";
                                resultHtml += "<a href=\"/classes\">Do not forget to set all class params! Click here!</a>";

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
                                var resultHtml = "Delete result: <br /><br />";

                                resultHtml += "Success! Class \""+result+"\" deleted!";
                                resultHtml += "<br />";
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
                        var resultHtml = "Delete result: <br /><br />";

                        resultHtml += "Success! Param \""+result+"\" deleted!";
                        resultHtml += "<br />";
                        $(resultBlock).html(resultHtml);
                        $(resultBlock).addClass("expanded");
                        // }
                        //}
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
            Tanks classificatory
        </div>

        <div class="links">
            <a href="/">Home</a>
            <a href="/classes">Manage classes</a>
            <a href="/params">Manage params</a>
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
