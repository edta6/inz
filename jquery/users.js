/*
 * Skrypt zawierający validację oraz ustawienia zachowania okna modalnego
 * do wprowadzania danych i zakładania kont użytkowników.
*/

// Funkcja pokazująca okno oraz resetująca ustawienia formularza
function reset() {
	document.getElementById('id01').style.display='block';
	document.getElementById("regForm").reset();
	
	document.getElementsByName("imie")[0].className = "";
	document.getElementsByName("nazwisko")[0].className = "";
	document.getElementsByName("nick")[0].className = "";
	document.getElementsByName("pass")[0].className = "";
	document.getElementsByName("pass_re")[0].className = "";
		
	temp_two = 0;
	temp = 0;
	
	document.getElementById("Uname").style.display='none';
	document.getElementById("Lname").style.display='none';
	document.getElementById("Fname").style.display='none';
	document.getElementById("pass_eror2").style.display='none';
	document.getElementById("pass_eror1").style.display='none';
	document.getElementById("pass_eror").style.display='none';
	document.getElementById("Upr").style.display='none';
    document.getElementById("UprBox").className ="box_input box_margin";
	document.getElementById("Dos").style.display='none';
    document.getElementById("DosBox").className ="box_input box_margin";
}

// Funkcja sprawdzająca wstępnie wprowadzone dane
function validate() {
	
	temp_two = 0;
	temp = 0;
	
	var flag = true;
	
	var x = document.getElementsByName("imie")[0];
	var a = document.getElementsByName("nazwisko")[0];
	var b = document.getElementsByName("nick")[0];
	var c = document.getElementsByName("pass")[0];
	var d = document.getElementsByName("pass_re")[0];
	
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
	
	if(b.value==""){
		b.className = "invalid";
		document.getElementById("Uname").className ="error error_margin";
		document.getElementById("Uname").style.display='block';
		flag = false;
	}
	
	if(c.value==""){
		c.className = "invalid";
		flag = false;
	}
	
	if(d.value==""){
		d.className = "invalid";;
		flag = false;
	}
	
	if(c.value.length<8 || d.value.length<8){
		c.className = "invalid";
		d.className = "invalid";
		flag = false;
		temp = 1;
	}
	
	if(c.value!=d.value){
		c.className = "invalid";
		d.className = "invalid";
		flag = false;
		temp_two = 1;
	}
	
	if(temp == 1 && temp_two == 1) {
		document.getElementById("pass_eror1").style.display='none';
		document.getElementById("pass_eror").style.display='none';
		document.getElementById("pass_eror2").className ="error error_margin error_text";
		document.getElementById("pass_eror2").style.display='block';
	}
	else { 
		if (temp == 1) {
			document.getElementById("pass_eror2").style.display='none';
			document.getElementById("pass_eror1").style.display='none';
			document.getElementById("pass_eror").className ="error error_margin error_text";
			document.getElementById("pass_eror").style.display='block';
		}
		
		if(temp_two == 1){	
			document.getElementById("pass_eror2").style.display='none';
			document.getElementById("pass_eror").style.display='none';
			document.getElementById("pass_eror1").className ="error error_margin error_text";
			document.getElementById("pass_eror1").style.display='block';
		}
	}
	
// 	Sprawdzenie radio button
	var uOne = document.getElementById("uOne").checked;
	var uTwo = document.getElementById("uTwo").checked;
	
	var dOne = document.getElementById("dOne").checked;
	var dTwo = document.getElementById("dTwo").checked;
	
	if(uOne == false && uTwo == false) {
		flag = false
		document.getElementById("Upr").style.display='block';
		document.getElementById("Upr").className ="error error_margin error_text";
		document.getElementById("UprBox").className ="box_input box_margin invalid";
	}
	
	if(dOne == false && dTwo == false) {
		flag = false
		document.getElementById("Dos").style.display='block';
		document.getElementById("Dos").className ="error error_margin error_text";
		document.getElementById("DosBox").className ="box_input box_margin invalid";
	}
	
	return flag;
}

//Funkcja usuwająca alert jeżeli hasła są poprawne
function pas_val(){

	var c = document.getElementsByName("pass")[0];
	var d = document.getElementsByName("pass_re")[0];
	
	temp_two = 0;
	temp = 0;
	
	if(c.value.length>8 && d.value.length>8 && c.value===d.value){
		c.className = "";
		d.className = "";
		document.getElementById("pass_eror2").style.display='none';
		document.getElementById("pass_eror1").style.display='none';
		document.getElementById("pass_eror").style.display='none';
	}
}

// Funkcja sprawdza jakie symbole są wprowadzone do input i w razie konieczności zamienia je	
// oraz usuwa alerty jeżeli dane są poprawne
function validate_two() {
	
	var name = document.getElementsByName("imie")[0];
	var lastname = document.getElementsByName("nazwisko")[0];
	var nick = document.getElementsByName("nick")[0];

	name.value = name.value.replace(/[^a-ząśżźćęółń]/i,'');
	lastname.value = lastname.value.replace(/[^a-ząśżźćęółń\-]/i,'');
	nick.value = nick.value.replace(/[^a-z0-9]/i,'');
	
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
	
	if(!nick.value == ""){
		nick.className = "";
		document.getElementById("Uname").style.display='none';
	}
}

// Funkcja podpowiadająca nick dla użytkownika
// 4 pierwsze litery nazwiska + 2 litery imienia + losowa liczba z przedziału 0-99
function prepernick() {

	var x = document.getElementsByName("imie")[0].value;
	var y = document.getElementsByName("nazwisko")[0].value;
	
	var num = Math.floor((Math.random() * 100));
	
	if (num < 10){
		var zero = "0"
		
		num = zero + num;
	}
	
	var temp = y.substr(0, 4).toLowerCase() + x.substr(0, 2).toLowerCase() + num;
	
	if(!(x == "") && !(y =="")){
		document.getElementsByName("nick")[0].value	= temp;
	}
	
	document.getElementById("Uname").style.display='none';
	document.getElementsByName("nick")[0].className="";
}

// Funkcje zmieniające klasę po zaznaczeniu radio button pod koniec okna modalnego.
function upr_val() {
	document.getElementById("Upr").style.display='none';
	document.getElementById("UprBox").className="box_input box_margin";
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
		document.getElementById("Fname").className ="error error_spl";;
	}
}

function zamknij(p1) {
	document.getElementById(p1).style.display='none';
}
