
        function actionSend(aValue, aDest) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //var myJsonString = JSON.stringify(aValue);
        console.log(aValue)
        switch (aDest) {
        	case './devoir_index.php':
        		xmlhttp.onreadystatechange = respondShowTodo;
        		break;
        	default :
        		xmlhttp.onreadystatechange = respond;
        		break;
        }
        xmlhttp.open("POST", aDest, true);
    	xmlhttp.send(aValue);
        
    }
    
    function respondShowTodo() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	//document.getElementById('result').innerHTML = xmlhttp.responseText;
        	respondPhp = JSON.parse(xmlhttp.responseText);
        	let toReturn = "<section class='special-area bg-white section_padding_100' id='about'>\
        						<div class='container'>\
            						<div class='row'>"
        	for (var i = 0; i < respondPhp.length; i++) {
        	toReturn += "<div class='col-12 col-md-4'>\
                    <div class='single-special text-center wow fadeInUp' data-wow-delay='0.4s'>\
                        <div class='single-icon'>\
                            <i aria-hidden='true'>" + respondPhp[i].matiere + "</i>\
                        </div>\
                        <h4>"+ respondPhp[i].date +"</h4>\
                        <p>" + respondPhp[i].contenu + "</p>\
                        <p>" + respondPhp[i].id + "</p>\
                    </div>\
                </div>"
        	}
        	toReturn += "</div></div></section>"
        	
            document.getElementById('result').innerHTML = toReturn;
        }
    }
    
    function respond() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	//document.getElementById('result').innerHTML = xmlhttp.responseText;
        	respondPhp = JSON.parse(xmlhttp.responseText);
            envoiApi(1)
        }
    }
    
    