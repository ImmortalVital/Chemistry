@extends("app")

@section("content")
    <!--<form id="compute_form">
        <H3>Определить подходящие классы</H3>
        {{csrf_field()}}

        <div class="class-param">
            <input type="string">
        </div>
        <br />
        <br />
        <input type="submit" value="Проверить" id="submit-suitable-button">
        <br><br>
        <br><br>
    </form>-->

    <form id= "chem_el_form">
        {{csrf_field()}}

        <div class="furmula-form">
            <input type="text" name="formula" id="formula">
        </div>
        <br />

        <input type="submit" value="Test" id="submit-formula-button">
        <br />
        <br />
    </form>

    <div class="links" id="results">
        Result
    </div>

    <form>
        <button type="button" id="hidrogenium-button" style="padding:0px 0px;">
            <img src="images/hidrogen-button.jpg" alt="" style="width:100px;height:50px;vertical-align:middle;">
        </button>
        <button type="button" id="oxygenium-button" style="padding:0px 0px;">
            <img src="images/oxygen-button.jpg" alt="" style="width:100px;height:50px;vertical-align:middle">
        </button>
        <button type="button" id="natrium-button" style="padding:0px 0px;">
            <img src="images/natrium-button.jpg" alt="" style="width:100px;height:50px;vertical-align:middle">
        </button>
        <button type="button" id="sulfur-button" style="padding:0px 0px;">
            <img src="images/sulfur-button.jpg" alt="" style="width:100px;height:50px;vertical-align:middle">
        </button>
        <button type="button" id="chlorine-button" style="padding:0px 0px;">
            <img src="images/chlorine-button.jpg" alt="" style="width:100px;height:50px;vertical-align:middle">
        </button>
    </form>


@endsection()