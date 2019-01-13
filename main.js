function envoiApi(aValue) {
            var values = new Object();
            //Mettre un case ici
            if (aValue == 1) {
            	values.classe = document.getElementById("classe").value
            	actionSend(values, "./devoir_index.php");
            } else if (aValue == 2) {
            	values.subjects = document.getElementById("matiereajout").value
        		values.date = document.getElementById("dateajout").value
    			values.contents = document.getElementById("devoirajout").value
        		values.classe = document.getElementById("classeajout").value
        		actionSend(values, "./ajout_devoir.php");
            } else if (aValue == 3) {
            	values.pseudo = document.getElementById("pseudoinscri").value
            	values.email = document.getElementById("emailinscri").value
            	values.pass1 = document.getElementById("pass1inscri").value
            	values.pass2 = document.getElementById("pass2inscri").value
            	values.classe = document.getElementById("classeinscri").value
            	actionSend(values, "./inscription_json.php");
            } else if (aValue == 4) {
            	values.pseudo = document.getElementById("pseudoco").value
            	values.pass1 = document.getElementById("passco").value
            	actionSend(values, "./connexion_json.php");
            } else if (aValue == 5) {
            	values.id = document.getElementById("iddel").value
            	actionSend(values, "./suppression_devoir.php")
            }
        }
        document.getElementById('ajoutdevoir').style.display = 'none';
        document.getElementById('inscription').style.display = 'none';
        document.getElementById('connexion').style.display = 'none';
        document.getElementById('supdevoir').style.display = 'none';

        function dispNewDevoir() {
            document.getElementById('listedevoir').style.display = 'none';
            document.getElementById('ajoutdevoir').style.display = 'inline';
            document.getElementById('inscription').style.display = 'none';
            document.getElementById('connexion').style.display = 'none';
            document.getElementById('supdevoir').style.display = 'none';
        }

        function dispConnexion() {
            document.getElementById('listedevoir').style.display = 'none';
            document.getElementById('ajoutdevoir').style.display = 'none';
            document.getElementById('inscription').style.display = 'none';
            document.getElementById('connexion').style.display = 'inline';
            document.getElementById('supdevoir').style.display = 'none';
        }

        function dispInscription() {
            document.getElementById('listedevoir').style.display = 'none';
            document.getElementById('ajoutdevoir').style.display = 'none';
            document.getElementById('inscription').style.display = 'inline';
            document.getElementById('connexion').style.display = 'none';
            document.getElementById('supdevoir').style.display = 'none';
        }

        function dispListeDevoir() {
            document.getElementById('listedevoir').style.display = 'inline';
            document.getElementById('ajoutdevoir').style.display = 'none';
            document.getElementById('inscription').style.display = 'none';
            document.getElementById('connexion').style.display = 'none';
            document.getElementById('supdevoir').style.display = 'none';
        }

        function dispDelDevoir() {
            document.getElementById('listedevoir').style.display = 'none';
            document.getElementById('ajoutdevoir').style.display = 'none';
            document.getElementById('inscription').style.display = 'none';
            document.getElementById('connexion').style.display = 'none';
            document.getElementById('supdevoir').style.display = 'inline';
        }