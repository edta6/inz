/*
 * Skrypt zawierający validację oraz ustawienia zachowania okna modalnego
 * do wprowadzania danych wychowanków.
*/

// Funkcja pokazująca okno oraz resetująca ustawienia formularza
function reset(p1) {
	document.getElementById(p1).style.display='block';
	document.getElementById("regForm").reset();
	
	document.getElementsByName("imie")[0].className = "";
	document.getElementsByName("nazwisko")[0].className = "";
	
	document.getElementById("Lname").style.display='none';
	document.getElementById("Fname").style.display='none';
	document.getElementById("Dos").style.display='none';
	document.getElementById("DosBox").className ="box_input box_margin";
}

// Funkcja sprawdzająca wstępnie wprowadzone dane
function validate() {
	
	var flag = true;
	
	var x = document.getElementsByName("imie")[0];
	var a = document.getElementsByName("nazwisko")[0];
	
	if(x.value==""){
		x.className = "invalid";
		document.getElementById("Fname").className ="error error_spl";
		document.getElementById("Fname").style.display='block';
		flag = false;
	}
	
	if(a.value==""){
		a.className = "invalid";
		document.getElementById("Lname").className ="error error_lpl";
		document.getElementById("Lname").style.display='block';
		flag = false;
	}
	
	if(x.value=="" && a.value==""){
		a.className = "invalid";
		x.className = "invalid";
		document.getElementById("Lname").className ="error error_margin";
		document.getElementById("Fname").className ="error error_margin";;
		document.getElementById("Lname").style.display='block';
		document.getElementById("Fname").style.display='block';
		flag = false;
	}	

	var dOne = document.getElementById("dOne").checked;
	var dTwo = document.getElementById("dTwo").checked;
	
	if(dOne == false && dTwo == false) {
		flag = false
		document.getElementById("Dos").style.display='block';
		document.getElementById("Dos").className ="error error_margin error_text";
		document.getElementById("DosBox").className ="box_input box_margin invalid";
	}
	
	return flag;
}

// Funkcja sprawdza jakie symbole są wprowadzone do input i w razie konieczności zamienia je	
// oraz usuwa alerty jeżeli dane są poprawne
function validate_two() {
	
	var name = document.getElementsByName("imie")[0];
	var lastname = document.getElementsByName("nazwisko")[0];

	name.value = name.value.replace(/[^a-ząśżźćęółń]/i,'');
	lastname.value = lastname.value.replace(/[^a-ząśżźćęółń\-]/i,'');
	
	if(!name.value == ""){
		name.className = "";
		document.getElementById("Fname").style.display='none';
		document.getElementById("Lname").className ="error error_lpl";;
	}
	
	if(!lastname.value == ""){
		lastname.className = "";
		document.getElementById("Lname").style.display='none';
		document.getElementById("Fname").className ="error error_spl";;
	}
	
}

// Funkcje zmieniające klasę po zaznaczeniu radio button pod koniec okna modalnego.
function dos_val() {
	document.getElementById("Dos").style.display='none';
	document.getElementById("DosBox").className="box_input box_margin";
}

// Funkcja usuwająca alert jeżeli w polu imie nastąpiła zmiana i jest jakiś tekst
function nam_val() {
	
	var name = document.getElementsByName("imie")[0];
	
	if(!name.value == ""){
		name.className = "";
		document.getElementById("Fname").style.display='none';
		document.getElementById("Lname").className ="error error_lpl";;
	}
}

// Funkcja usuwająca alert jeżeli w polu nazwisko nastąpiła zmiana i jest jakiś tekst
function nazw_val() {
	
	var lastname = document.getElementsByName("nazwisko")[0];
	
	if(!lastname.value == ""){
		lastname.className = "";
		document.getElementById("Lname").style.display='none';
		document.getElementById("Fname").className ="error error_spl";
	}
}

function zamknij(p1) {
	document.getElementById(p1).style.display='none';
}

function validate_wypis() {
	
	var flag = true;
	
	var pupil = document.getElementById("pupils").value;
	var target = document.getElementById("targets").value;
	var place = document.getElementById("place").value;
	
	if(pupil == "wybierz" || target == "wybierz" || place == "wybierz"){
		flag = false;
		
		if(pupil == "wybierz") {
			document.getElementById("box_pup").className ="box_input_sel error_wyp";
		}
		
	}
	return flag;
}