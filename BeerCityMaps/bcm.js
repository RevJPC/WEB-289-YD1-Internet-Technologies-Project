  $( function() {
    $( "#datepicker" ).datepicker({
      defaultDate: '6/30/1970',
      maxDate: '+21y',
      showOn: "button",
      buttonText: "Select date",
      changeDay: true,
      changeMonth: true,
      changeYear: true
    });
  } );