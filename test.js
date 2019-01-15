<div class="col-12 col-md-4">
    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">
        <div class="single-icon">
            <i class="ti-ruler-pencil" aria-hidden="true"></i>
        </div>
        <h4>Powerful Design</h4>
        <p>We build pretty complex tools and this allows us to take designs and turn them into functional quickly and easily</p>
    </div>
</div>

function respond() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        //document.getElementById('result').innerHTML = xmlhttp.responseText;
        respondPhp = JSON.parse(xmlhttp.responseText);
        monArraySeria =  "<div class='col-12 col-md-4'><div class='single-special text-center wow fadeInUp' data-wow-delay='0.4s'><div class='single-icon'><i class='ti-ruler-pencil' aria-hidden='true'></i></div><h4>""</h4><p></p></div></div>"
        document.getElementById('result').innerHTML = monArraySeria;
    }
}