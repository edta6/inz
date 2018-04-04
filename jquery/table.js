$(document).ready(function () {
	 
		// Dwie linijki ustawiają prawidłowy rozmiar nagłówka tabeli.

		var actualHeight = 0;
		var actualHeight = $("#users_body").width();

		if(actualHeight>2) {
			$("#users_head").css('max-width',actualHeight+1+'px');
		}
		else {
			$("#users_head").css('max-width','100%');
		}
		
		//Linijki odpowiednie za wyszukiwanie danych.
    var $s = $('#clmn_name').on('change', filter);
	  var $i = $("#kwd_search").on('keyup', filter);
	  var $rows = $("#users_body tbody > tr");
	 
    function filter() {
			
			var index;
		 
			if ($s.prop('selectedIndex')==0) {
				index=1;
			}
			else if ($s.prop('selectedIndex')==1) {
				index = 3;
			}	
			else if ($s.prop('selectedIndex')==2) {
				index = 6;
			}	
		 
			var term = $.trim($i.val().toLowerCase());
			
			if (term.length === 0) {
				$rows.show();
				return;
			}
			
			$rows.hide().filter(function () {
				return this.cells[index].textContent.toLowerCase().indexOf(term) > -1;
			}).show();
		
    };
		
});

// Funkcja, która zmienia placeholder na stronie z wypisami.
function change_placeholder_search() {
			var x = $('#clmn_name').val();
			
			if (x=="Nazwisko i imię") {
				$("#kwd_search").attr("placeholder", "Nazwisko i imię"); 
			}
			else if(x=="Wyjście" || x=="Powrót") {
				$("#kwd_search").attr("placeholder", "RRRR-MM-DD"); 
			}
}

function show_timepicker(p1,p2) {
	if($(p1).is(':checked')) {
		$(p2).show();
	}
	else {
		$(p2).hide();
	}
}

function hide_timepicker() {
		$('#timeId').hide();
		$('#timeId2').hide();
}

function show_hide_raport() {
	
	var raptemp = $('#menu_button6').text();
	
	if(raptemp=="Ukryj") {
		$('#box_raport').hide();
		$('#menu_button6').text("Pokaż");
	}
	else {
		$('#box_raport').show();
		$('#menu_button6').text("Ukryj");
	}
	
}

function calendar() {
	$('#example').glDatePicker(
		{
			onClick: function(target, cell, date, data) {
				
				if((date.getMonth()+1)<10) {
					var tempmonth = '0' + (date.getMonth()+1) + '-';
				}
				else {
					var tempmonth = (date.getMonth()+1) + '-';
				}	
					
				if(date.getDate()<10) {
					var tempDate = '0' + (date.getDate());
				} 
				else var tempDate = date.getDate();
					
				target.val(date.getFullYear() + '-' + tempmonth + tempDate);
					
				if(data != null) {
					alert(data.message + '\n' + date);
				}
			}            
		}
	);
}

function calendar2() {
	$('#example2').glDatePicker(
		{
			onClick: function(target, cell, date, data) {
				
				if((date.getMonth()+1)<10) {
					var tempmonth = '0' + (date.getMonth()+1) + '-';
				}
				else {
					var tempmonth = (date.getMonth()+1) + '-';
				}	
					
				if(date.getDate()<10) {
					var tempDate = '0' + (date.getDate());
				} 
				else var tempDate = date.getDate();
					
				target.val(date.getFullYear() + '-' + tempmonth + tempDate);
					
				if(data != null) {
					alert(data.message + '\n' + date);
				}
			}            
		}
	);
}

function time_raport_start() {
	$('input.timepicker').timepicker({
			timeFormat: 'HH:mm'
	});
}

$(document).ready(function() {
		$('#wpis_time').timepicker({
			timeFormat: 'HH:mm'
    });
});

$(document).ready(function() {
		$('#wpis_time2').timepicker({
			timeFormat: 'HH:mm'
    });
});