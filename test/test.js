$(document).ready(function(){
  $('#r2').hide();
  $('#r3').hide();
  $('#r4').hide();
  $('#r1b').click(function(){
    alert('Right');
  });
  $('#r2c').click(function(){
    alert('Right');
  });
  $('#r3b').click(function(){
    alert('Right');
  });
  $('#r4a').click(function(){
    alert('Right');
  });
  $('.cr1').click(function () {
    $("#resultr1").append('Answer: B');
    $('#r1').delay(1000).hide(10, function(){
    $('#r2').show();
    });
  });
  $('.cr2').click(function () {
    $("#resultr2").append('Answer: B');
    $('#r2').delay(1000).hide(1, function(){
    $('#r3').show();
    });
  });
  $('.cr3').click(function () {
    $("#resultr3").append('Answer: B');
    $('#r3').delay(1000).hide(1, function(){
    $('#r4').show();
    });
  });
  $('.cr4').click(function () {
    $("#resultr4").append('Answer: B');
    $('#r4').delay(1000).hide(1, function(){
    $('#r4').html('Finished');
    });
  });
});
function clear_form_elements(ele) {
    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}

