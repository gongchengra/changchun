  $(document).ready(function(){
    $("#searchstudent").click(function () {
      $("#allstudentable").load('Retrieving...');
      $.ajax({
        type: "POST",
        data: "regic=" + $("#ic").val(),
        url: "includes/searchstudentall.php",
        success: function(msg){
          $("#studentall").html(msg)
        }
      });
    });
    $('#inputstudentbtn').click(function (){
      $.post(
        'includes/inputstudent.php',
        $('#inputstudentform').serialize(),
        function (data) 
        {
          $('#resultinputstudent').html(data);
        },
        "text"
        );
    });
    $('#searchrecord').click(function (){
      if($('#classtype1').val()=='encmp'||$('#classtype1').val()=='encon')
      {
        $.post(
        'includes/searchrecord.php',
        $('#searchrecform').serialize(),
        function (data) 
        {
        $('#match').html(data);
        },
        "text"
        );
      }
      else
      {
        $.post(
        'includes/searchrecord1.php',
        $('#searchrecform').serialize(),
        function (data) 
        {
        $('#match').html(data);
        },
        "text"
        );
      }
      
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
$(function()
{
  $.datepicker.formatDate('yy-mm-dd');
  $('#datepicker1').datepicker({
    dateFormat: 'yy-mm-dd', inline: true, 
    changeMonth: true, changeYear: true
  });
  $('#datepicker2').datepicker({
    dateFormat: 'yy-mm-dd', inline: true, 
    changeMonth: true, changeYear: true
  });
  $('#datepicker3').datepicker({
    dateFormat: 'yy-mm-dd', inline: true, 
    changeMonth: true, changeYear: true
  });
  $('#datepicker4').datepicker({
    dateFormat: 'yy-mm-dd', inline: true, 
    changeMonth: true, changeYear: true
  });
  $('#datepicker5').datepicker({
    dateFormat: 'yy-mm-dd', inline: true, 
    changeMonth: true, changeYear: true
  });
  $('#datepicker6').datepicker({
    dateFormat: 'yy-mm-dd', inline: true, 
    changeMonth: true, changeYear: true
  });
  $('#tabs').tabs();
});
