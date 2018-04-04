$(document).ready(function () {
	
		//Linijki odnośnie zegarka w wypisach.
		var options = {
			twentyFour: true, //Display 24 hour format, defaults to false
			upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS
			downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
			close: 'wickedpicker__close', //The close class selector to use, for custom CSS
			hoverState: 'hover-state', //The hover state class to use, for custom CSS
			title: 'Ustaw Czas', //The Wickedpicker's title,
			minutesInterval: 1, //Change interval for minutes, defaults to 1
			beforeShow: null, //A function to be called before the Wickedpicker is shown
			show: null, //A function to be called when the Wickedpicker is shown
			clearable: false, //Make the picker's input clearable (has clickable "x")
		}; 
		
		$('.timepicker').wickedpicker(options);
		$('.timepicker2').wickedpicker(options);
		$('.timepicker3').wickedpicker(options);
});