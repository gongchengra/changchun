$(document).ready(function(){
  $('#searchic').click(function (){
   $.post(
      'includes/searchbasic.php',
      "ic=" + $("#ic").val(),
      function (data) 
      {
        // alert(data);
        var error='';
        var available='';
        $.each(data, function(key, val) {
          $("#"+key).val(val);
          // if(key=='availabletime1') $('#availabletime1').attr('checked');
          // if(key=='availabletime2') $('#availabletime2').attr('checked');
          // if(key=='availabletime3') $('#availabletime3').attr('checked');
          // if(key=='availabletime4') $('#availabletime4').attr('checked');
          // if(key=='availabletime5') $('#availabletime5').attr('checked');
          // if(key=='availabletime6') $('#availabletime6').attr('checked');
          // if(key=='availabletime7') $('#availabletime7').attr('checked');
          if(key=='availabletime') available=val;
          if(key=='err') error=val;
          });
        if(error!='')
        {
          alert(error);
        }
        if(available!='')
        {
          for(i=1;i<8;i++)
          {
            // alert(avail[i]);
            $('#availabletime'+i).attr("checked",false);
          }
          // $('#availabletime6').attr("checked",true);;
          avail=available.split("");
          for(i=0;i<avail.length;i++)
          {
            // alert(avail[i]);
            $('#availabletime'+avail[i]).attr("checked",true);
          }
        }
      },
    "json"
    );
   });
  $("#receipt_type").change(function () {
    if($("#receipt_type").val()=='2')
       $("#receipt_no").val('B00');
    if($("#receipt_type").val()=='1')
       $("#receipt_no").val('');
  });
  $("#salutation").change(function () {
    if($("#salutation").val()=='0')
       $("#gender").val('M');
    else if(($("#salutation").val()=='1')
      ||($("#salutation").val()=='2')
      ||($("#salutation").val()=='3'))
       $("#gender").val('F');
    else $("#gender").val('F');
  });
  $("#citizenship").change(function () {
    if($("#citizenship").val()=='SG')
       {$("#nationality").val('SG');
        $("#idtype").val('1');}
    else if($("#citizenship").val()=='PR')
       {$("#nationality").val('0');
        $("#idtype").val('1');}
    else if(($("#citizenship").val()=='EP')
      ||($("#citizenship").val()=='SP')
      ||($("#citizenship").val()=='WP'))
       {$("#nationality").val('0');
        $("#idtype").val('2');}
    else {$("#nationality").val('0');
          $("#idtype").val('0');}
  });
  $("#race").change(function () {
    if($("#race").val()=='CN')
       {$("#lang").val('CHI');}
    else if($("#race").val()=='MY')
       {$("#lang").val('M');}
    else if($("#race").val()=='IN')
       {$("#lang").val('T');}
    else $("#lang").val('0');
  });
  $('#inputbasic').click(function (){
   $.post(
      'includes/inputbasic.php',
      $('#inputstudentform').serialize(),
      function (data) 
      {
      $('#resultsbasic').html(data);
      },
    "text"
    );
   // alert($('#inputstudentform').serialize());
   });
  $('#clearbasic').click(function (){
    $('#resultsbasic').html('');
      clear_form_elements('#inputstudentform');
      $('#SSA').val('2');
      $('#building').val('NA');
      $('#salaryrange').val('00');
      $('#companyname').val('NA');
      $('#companystatus').val('OTHERS');
      $('#companyregno').val('NA');
      $('#industry').val('1');
      $('#designation').val('10');
   });
  $('#searchregid').click(function (){
   $.post(
      'includes/searchregid.php',
      "regid=" + $("#regid").val(),
      function (data) 
      {
        var error='';
        $.each(data, function(key, val) {
          $("#"+key).val(val);
          if(key=='err') error=val;
          if(key=='reg_date') $("#datepicker").val(val);
          });
        if(error!='')
        {
          $('#regid').val('');
          $('#regic').val('');
          $('#reg_no').val('');
          alert(error);
        }
      },
    "json"
    );
   });
  $("#searchallreg").click(function () {
    $("#allregtable").load('Retrieving...');
    $.ajax({
      type: "POST",
      data: "regic=" + $("#regic").val(),
      url: "includes/searchallreg.php",
      success: function(msg){
        $("#allregtable").html(msg)
      }
    });
  });
  $('#inputregbtn').click(function (){
   $.post(
      'includes/inputreg.php',
      $('#inputregform').serialize(),
      function (data) 
      {
      $('#resultsreg').html(data);
      },
    "text"
    );
   });
  $('#clearreg').click(function (){
    $('#resultsreg').html('');
      $('#regid').val('');
      $('#regic').val('');
      $('#reg_no').val('');
   });
  $('#delreg').click(function (){
    if(confirm('Are you sure you want to delete?')){
      $.post(
      'includes/delreg.php',
      $('#inputregform').serialize(),
      function (data) 
      {
      $('#resultsreg').html(data);
      },
      "text"
      );
    }
   });
  $('#searchreginfo').click(function (){
      $.post(
      'includes/searchreginfo.php',
      $('#searchregform').serialize(),
      function (data) 
      {
      $('#allreg').html(data);
      },
      "text"
      );
   });
  // $('#searchreginfo').click();
  $('#searchreceiptid').click(function (){
   $.post(
      'includes/searchreceiptid.php',
      "receiptid=" + $("#receiptid").val(),
      function (data) 
      {
        $("#allreceiptable").html('');
        // alert("success");
        // $('#resultreceipt').html(data);
        var error='';
        $.each(data, function(key, val) {
          $("#"+key).val(val);
          if(key=='err') error=val;
          if(key=='receipt_date') $("#datepicker3").val(val);
          });
        if(error!='')
        {
          clear_form_elements('#inputreceiptform');
          $('#receipt_type').val('1');
          alert(error);
        }
      },
    "json"
    );
   });
  $("#searchallreceipt").click(function () {
    $("#allreceiptable").load('Retrieving...');
    $.ajax({
      type: "POST",
      data: "receiptic=" + $("#receiptic").val(),
      url: "includes/searchallreceipt.php",
      success: function(msg){
        $("#allreceiptable").html(msg)
        $('#receiptid').val('');
        $('#receiptname').val('');
        $('#receiptel').val('');
        $('#receipt_no').val('');
        $('#receiptop').val('');
        $('#amount').val('');
        $('#secondornot').val('');
        $('#course_type').val('');
        $('#coursecode').val('');
        $('#relatedreceipt').val('');
        $('#relatedamount').val('');
        $('#remarks').val('');
        $.post(
          'includes/searchreceiptname.php',
          "receiptic=" + $("#receiptic").val(),
          function (data) 
          {
            // alert(data);
            // $("#allreceiptable").html(data);
            // alert("success");
            // $('#resultreceipt').html(data);
            var error='';
            $.each(data, function(key, val) {
              $("#"+key).val(val);
              if(key=='err') error=val;
              });
            if(error!='')
            {
              alert(error);
            }
          },
        "json"
        );
      }
    });

  });
  $('#searchreceiptno').click(function (){
   $.post(
      'includes/searchreceiptno.php',
      "receipt_no=" + $("#receipt_no").val(),
      function (data) 
      {
        $("#allreceiptable").html('');
        // alert("success");
        // $('#resultreceipt').html(data);
        var error='';
        $.each(data, function(key, val) {
          $("#"+key).val(val);
          if(key=='err') error=val;
          if(key=='receipt_date') $("#datepicker3").val(val);
          });
        if(error!='')
        {
          clear_form_elements('#inputreceiptform');
          $('#receipt_type').val('1');
          alert(error);
        }
      },
    "json"
    );
   });
  $("#invalid").click(function () {
    $("#receiptic").val('S0000000J');
    $("#receiptname").val('Void');
    $("#receiptel").val('00000000');
    $("#amount").val('0');
    $("#secondornot").val('N');
  });
  $('#searchreceiptinfo').click(function (){
      $.post(
      'includes/searchreceiptinfo.php',
      $('#searchreceiptform').serialize(),
      function (data) 
      {
      $('#allreceipt').html(data);
      },
      "text"
      );
   });
  // $('#searchreceiptinfo').click();
  $('#inputreceiptbtn').click(function (){
    $.post(
      'includes/inputreceipt.php',
      $('#inputreceiptform').serialize(),
      function (data) 
      {
      $('#resultreceipt').html(data);
      },
      "text"
    );
    if($('#reg_no1').val()!='')
    {
      $.post(
      'includes/inputreg.php',
      {
        regic:$('#receiptic').val(),
        reg_date:$('#datepicker3').val(),
        reg_location:$('#hiddenbranch').val(),
        reg_no:$('#reg_no1').val(),
        reg_op:$('#receiptop').val(),
        hiddenbranch:$('#hiddenbranch').val(),
        hiddenbranchop:$('#hiddenbranchop').val()
      },
      function (data) 
      {
      $('#resultreceipt').html(data);
      },
      "text"
      );
    }
    $('#searchreceiptinfo').click();
  });
  $('#inputreceipt1').click(function (){
    $('#debitype').val('10');
     $.post(
        'includes/inputreceipt1.php',
        $('#inputreceiptform').serialize(),
        function (data) 
        {
        $('#resultreceipt').html(data);
        },
      "text"
      );
    $('#searchreceiptinfo').click();
   });
  $('#inputreceipt2').click(function (){
     $.post(
        'includes/inputreceipt2.php',
        $('#inputreceiptform').serialize(),
        function (data) 
        {
        $('#resultreceipt').html(data);
        },
      "text"
      );
    $('#searchreceiptinfo').click();
   });
  $('#clearreceipt').click(function (){
    $('#resultreceipt').html('');
    $('#receiptid').val('');
    $('#receiptic').val('');
    $('#receiptname').val('');
    $('#receiptel').val('');
    $('#receipt_no').val('');
    $('#receiptop').val('');
    $('#amount').val('');
    $('#secondornot').val('');
    $('#course_type').val('');
    $('#lettertype').val('');
    $('#coursecode').val('');
    $('#relatedreceipt').val('');
    $('#relatedamount').val('');
    $('#remarks').val('');
    $('#reg_no1').val('');
   });
  $('#delreceipt').click(function (){
    if(confirm('Are you sure you want to delete?')){
      $.post(
      'includes/delreceipt.php',
      $('#inputreceiptform').serialize(),
      function (data) 
      {
      $('#resultreceipt').html(data);
      },
      "text"
      );
      $('#searchreceiptinfo').click();
    }
   });
  $('#searchatoid').click(function (){
    $("#allatotable").html('');
    $("#resultato").html('');
   $.post(
      'includes/searchatoid.php',
      "atoid=" + $("#atoid").val(),
      function (data) 
      {
        $("#allatotable").html('');
        // alert("success");
        // $('#resultreceipt').html(data);
        var error='';
        $.each(data, function(key, val) {
          $("#"+key).val(val);
          if(key=='err') error=val;
          if(key=='start_date') $("#datepicker4").val(val);
          if(key=='end_date') $("#datepicker5").val(val);
          if(key=='atodate') $("#datepicker6").val(val);
          });
        if(error!='')
        {
          clear_form_elements('#inputatoform');
          alert(error);
        }
      },
    "json"
    );
   });
  $("#searchallato").click(function () {
    $("#allatotable").load('Retrieving...');
    $.ajax({
      type: "POST",
      data: "atoic=" + $("#atoic").val(),
      url: "includes/searchallato.php",
      success: function(msg){
        $("#allatotable").html(msg)
      }
    });
  });
  $('#inputatobtn').click(function (){
   $.post(
      'includes/inputato.php',
      $('#inputatoform').serialize(),
      function (data) 
      {
      $('#resultato').html(data);
      },
    "text"
    );
   });
  $('#clearato').click(function (){
    $("#allatotable").html('');
    $("#resultato").html('');
    clear_form_elements('#inputatoform');
   });
  $('#delato').click(function (){
    if(confirm('Are you sure you want to delete?')){
      $.post(
      'includes/delato.php',
      $('#inputatoform').serialize(),
      function (data) 
      {
      $('#resultato').html(data);
      },
      "text"
      );
    }
  });
  $('#generateato').click(function (){
      $.post(
      'includes/generateato.php',
      $('#exportatoform').serialize(),
      function (data) 
      {
      $('#exportato').html(data);
      },
      "text"
      );
   });
  $('#searchatoinfo').click(function (){
    $.post(
    'includes/searchatoinfo.php',
    $('#searchatoform').serialize(),
    function (data) 
    {
    $('#allatoinfo').html(data);
    },
    "text"
    );
  });
  // $('#searchatoinfo').click();
  $('#searchallic').click(function (){
    $.post(
    'includes/searchallic.php',
    $('#searchallform').serialize(),
    function (data) 
    {
    $('#searchall').html(data);
    },
    "text"
    );
  });
  $('#searchatorecord').click(function (){
    $.post(
      'includes/searchatorecord.php',
      "recordic=" + $("#recordic").val(),
      function (data) 
      {
        var error='';
        $.each(data, function(key, val) {
          $("#"+key).val(val);
          if(key=='err') error=val;
          if(key=='rlupdated_at') $("#datepicker15").val(val);
          });
        if(error!='')
        {
          clear_form_elements('#inputatorecform');
          alert(error);
        }
      },
      "json"
      );
  });
  $('#inputrecordbtn').click(function (){
   $.post(
      'includes/inputatorecord.php',
      $('#inputatorecform').serialize(),
      function (data) 
      {
      $('#resultrec').html(data);
      },
    "text"
    );
  });
  $('#clearrec').click(function (){
    $("#resultrec").html('');
    clear_form_elements('#inputatorecform');
  });
  $('#searchbranch').click(function (){
    $("#resultrec").html('');
    $.post(
      'includes/searchbranch.php',
      "branchic=" + $("#branchic").val(),
      function (data) 
      {
        var error='';
        $.each(data, function(key, val) {
          $("#"+key).val(val);
          if(key=='err') error=val;
          });
        if(error!='')
        {
          alert(error);
        }
      },
      "json"
      );
  });
  $('#inputbranchbtn').click(function (){
   $.post(
      'includes/inputbranch.php',
      $('#inputbranchform').serialize(),
      function (data) 
      {
      $('#resultrec').html(data);
      },
    "text"
    );
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
$(function(){
  // Datepicker
  $('#datepicker').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
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
  $('#datepicker7').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker8').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker9').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker10').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker11').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker12').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker13').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker14').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#datepicker15').datepicker({
      dateFormat: 'yy-mm-dd', inline: true, 
      changeMonth: true, changeYear: true
  });
  $('#tabs').tabs();
});

