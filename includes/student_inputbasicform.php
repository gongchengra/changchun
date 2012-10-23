<div id="inputstudent">
  <div style="text-align: center">
    <h1>输入学员基本信息</h1>
	</div>
  <p>
    如果是Link1学员，所有*为必填内容。<br />
    如果是SSA学员，只用填写姓名和IC。<br />
    如果是changchun学员，姓名，IC，电话必填，其他选填。
  </p>
  <form name="inputstudentform" id="inputstudentform" action="" method="POST">
    <fieldset>
      <div style="text-align: center">
        <h3>
          是否为SSA学员*：
          <select name="SSA" id="SSA">
            <option value="1" <?php if(isset($_POST['SSA']))
            {echo ($_POST['SSA'] == '1')?"selected='selected'":"";}?>>SSA</option>
            <option value="2" <?php if(isset($_POST['SSA']))
            {echo ($_POST['SSA'] == '2')?"selected='selected'":"";}
            else echo "selected='selected'"; ?>>Link1</option>
            <option value="3" <?php if(isset($_POST['SSA']))
            {echo ($_POST['SSA'] == '3')?"selected='selected'":"";}
             ?>>Changchun</option>
          </select>
        </h3>
      </div>
      NRIC/Fin No*.<input type="text" name="ic" id="ic" value="<?php if (isset($_POST['ic'])) 
      {print stripslashes($_POST['ic']);}else {print "";} ?>"/>
      <input type="button" name="searchic" id="searchic" value="搜索"/>
      ID type*：
      <select name="idtype" id="idtype">
      <option value="0">请选择</option>
      <option value="1" <?php if(isset($_POST['idtype']))
  		{echo ($_POST['idtype'] == '1')?"selected='selected'":"";}?>>NRIC</option>
      <option value="2" <?php if(isset($_POST['idtype']))
  		{echo ($_POST['idtype'] == '2')?"selected='selected'":"";}?>>FIN</option>
      <option value="3" <?php if(isset($_POST['idtype']))
  		{echo ($_POST['idtype'] == '3')?"selected='selected'":"";}?>>Passport</option>
      <option value="4" <?php if(isset($_POST['idtype']))
  		{echo ($_POST['idtype'] == '4')?"selected='selected'":"";}?>>Workpermit</option>
      </select>
      Gender*：
      <select name="gender" id="gender">
      <option value="0">请选择</option>
      <option value="M" <?php if(isset($_POST['gender']))
  		{echo ($_POST['gender'] == 'M')?"selected='selected'":"";}?>>男</option>
      <option value="F" <?php if(isset($_POST['gender']))
  		{echo ($_POST['gender'] == 'F')?"selected='selected'":"";}?>>女</option>
      </select><br />
      SurName*：
      <input type="text" name="surname" id="surname" value="<?php if (isset($_POST['surname'])) 
      {print stripslashes($_POST['surname']);}else {print "";} ?>"/>
      GivenName*：
      <input type="text" name="givename" id="givename" value="<?php if (isset($_POST['givename'])) 
      {print stripslashes($_POST['givename']);}else {print "";} ?>"/><br />
      Name(Name on IC)*：
      <input type="text" name="studentname" id="studentname" value="<?php if (isset($_POST['studentname'])) 
      {print stripslashes($_POST['studentname']);}else {print "";} ?>"/>
      Other names：
      <input type="text" name="othername" id="othername" value="<?php if (isset($_POST['othername'])) 
      {print stripslashes($_POST['othername']);}else {print "";} ?>"/><br />
      Mobile*：
      <input type="text" name="tel" id="tel" value="<?php if (isset($_POST['tel'])) 
      {print stripslashes($_POST['tel']);}else {print "";} ?>"/>
      Telephone：
      <input type="text" name="tel_home" id="tel_home" value="<?php if (isset($_POST['tel_home'])) 
      {print stripslashes($_POST['tel_home']);}else {print "";} ?>"/><br />
      Salutation*：
      <select name="salutation" id="salutation">
      <option>请选择</option>
      <option value="0" <?php if(isset($_POST['salutation']))
  		{echo ($_POST['salutation'] == '0')?"selected='selected'":"";}?>>先生</option>
      <option value="1" <?php if(isset($_POST['salutation']))
  		{echo ($_POST['salutation'] == '1')?"selected='selected'":"";}?>>太太</option>
      <option value="2" <?php if(isset($_POST['salutation']))
  		{echo ($_POST['salutation'] == '2')?"selected='selected'":"";}?>>女士</option>
      <option value="3" <?php if(isset($_POST['salutation']))
  		{echo ($_POST['salutation'] == '3')?"selected='selected'":"";}?>>夫人</option>
      <option value="4" <?php if(isset($_POST['salutation']))
  		{echo ($_POST['salutation'] == '4')?"selected='selected'":"";}?>>博士</option>
      <option value="5" <?php if(isset($_POST['salutation']))
  		{echo ($_POST['salutation'] == '5')?"selected='selected'":"";}?>>教授</option>
      </select>
      DOB*：
      DD <input type="text" name="dobday" id="dobday" class='inputid' value="<?php if (isset($_POST['dobday'])) 
      {print stripslashes($_POST['dobday']);}else {print "";} ?>"/>
      MM <input type="text" name="dobmonth" id="dobmonth" class='inputid' value="<?php if (isset($_POST['dobmonth'])) 
      {print stripslashes($_POST['dobmonth']);}else {print "";} ?>"/>
      YYYY <input type="text" name="dobyear" id="dobyear" class='inputid' value="<?php if (isset($_POST['dobyear'])) 
      {print stripslashes($_POST['dobyear']);}else {print "";} ?>"/>
      <br />
      Address*：BLK*: <input type="text" name="block" id="block" value="<?php if (isset($_POST['block'])) {
      print stripslashes($_POST['block']);}else {print "";} ?>" class="short"/>
        Street*：<input type="text" name="street" id="street" value="<?php if (isset($_POST['street'])) {
      print stripslashes($_POST['street']);}else {print "";} ?>"/>
         # Floor - Unit No*：#<input type="text" name="floorno1" id="floorno1" value="<?php if (isset($_POST['floorno1'])) {
      print stripslashes($_POST['floorno1']);}else {print "";} ?>" class="short"/>-
      <input type="text" name="floorno2" id="floorno2" value="<?php if (isset($_POST['floorno2'])) {
      print stripslashes($_POST['floorno2']);}else {print "";} ?>" class="short"/>
      <br />
         Building Name*：<input type="text" name="building" id="building" value="<?php if (isset($_POST['building'])) {
      print stripslashes($_POST['building']);}else {print "NA";} ?>"/>
         Postal Code*：<input type="text" name="postcode" id="postcode" value="<?php if (isset($_POST['postcode'])) {
      print stripslashes($_POST['postcode']);}else {print "";} ?>"/><br />
      Citizenship*：<select name="citizenship" id="citizenship">
                  <option value="0">请选择</option>
                  <option value="SG" <?php if(isset($_POST['citizenship']))
  		{echo ($_POST['citizenship'] == 'SG')?"selected='selected'":"";}?>>新加坡公民</option>
                  <option value="PR" <?php if(isset($_POST['citizenship']))
  		{echo ($_POST['citizenship'] == 'PR')?"selected='selected'":"";}?>>新加坡PR</option>
                  <option value="EP" <?php if(isset($_POST['citizenship']))
  		{echo ($_POST['citizenship'] == 'EP')?"selected='selected'":"";}?>>Employment pass</option>
                  <option value="WP" <?php if(isset($_POST['citizenship']))
  		{echo ($_POST['citizenship'] == 'WP')?"selected='selected'":"";}?>>Work permit</option>
                  <option value="SP" <?php if(isset($_POST['citizenship']))
  		{echo ($_POST['citizenship'] == 'SP')?"selected='selected'":"";}?>>Student pass</option>
                  <option value="XX" <?php if(isset($_POST['citizenship']))
  		{echo ($_POST['citizenship'] == 'XX')?"selected='selected'":"";}?>>其他</option>
                  </select>
      Nationality*：<select name="nationality" id="nationality">
            <option value="0">请选择</option>
            <option value="SG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SG')?"selected='selected'":"";}?>>Singapore Citizen </option>
            <option value="CN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CN')?"selected='selected'":"";}?>>Chinese </option>
            <option value="MY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MY')?"selected='selected'":"";}?>>Malaysian </option>
            <option value="IN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'IN')?"selected='selected'":"";}?>>Indian </option>
            <option value="ID" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ID')?"selected='selected'":"";}?>>Indonesian </option>
            <option value="AF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AF')?"selected='selected'":"";}?>>Afghan </option>
            <option value="AL" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AL')?"selected='selected'":"";}?>>Albanian </option>
            <option value="DZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DZ')?"selected='selected'":"";}?>>Algerian </option>
            <option value="US" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'US')?"selected='selected'":"";}?>>American </option>
            <option value="AS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AS')?"selected='selected'":"";}?>>American Samoa </option>
            <option value="AD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AD')?"selected='selected'":"";}?>>Andorran </option>
            <option value="AO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AO')?"selected='selected'":"";}?>>Angolan  </option>
            <option value="AG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AG')?"selected='selected'":"";}?>>Antigua </option>
            <option value="AR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AR')?"selected='selected'":"";}?>>Argentinian </option>
            <option value="AM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AM')?"selected='selected'":"";}?>>Armenian </option>
            <option value="AU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AU')?"selected='selected'":"";}?>>Australian  </option>
            <option value="AT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AT')?"selected='selected'":"";}?>>Austrian </option>
            <option value="AZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AZ')?"selected='selected'":"";}?>>Azerbaijani </option>
            <option value="BS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BS')?"selected='selected'":"";}?>>Bahamas </option>
            <option value="BH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BH')?"selected='selected'":"";}?>>Bahraini  </option>
            <option value="BD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BD')?"selected='selected'":"";}?>>Bangladeshi </option>
            <option value="BB" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BB')?"selected='selected'":"";}?>>Barbados </option>
            <option value="BL" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BL')?"selected='selected'":"";}?>>Belarussian </option>
            <option value="BE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BE')?"selected='selected'":"";}?>>Belgian  </option>
            <option value="BZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BZ')?"selected='selected'":"";}?>>Belize </option>
            <option value="BJ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BJ')?"selected='selected'":"";}?>>Benin </option>
            <option value="BT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BT')?"selected='selected'":"";}?>>Bhutan </option>
            <option value="BO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BO')?"selected='selected'":"";}?>>Bolivian </option>
            <option value="BA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BA')?"selected='selected'":"";}?>>Bosnian  </option>
            <option value="BW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BW')?"selected='selected'":"";}?>>Botswana </option>
            <option value="GC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GC')?"selected='selected'":"";}?>>Br Dep Ter Citizen </option>
            <option value="GG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GG')?"selected='selected'":"";}?>>Br Nat. Overseas </option>
            <option value="GE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GE')?"selected='selected'":"";}?>>Br Overseas Cit.  </option>
            <option value="GJ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GJ')?"selected='selected'":"";}?>>Br Protected Pers. </option>
            <option value="BR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BR')?"selected='selected'":"";}?>>Brazilian </option>
            <option value="GB" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GB')?"selected='selected'":"";}?>>British </option>
            <option value="UK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'UK')?"selected='selected'":"";}?>>British Subject  </option>
            <option value="BN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BN')?"selected='selected'":"";}?>>Bruneian </option>
            <option value="BG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BG')?"selected='selected'":"";}?>>Bulgarian </option>
            <option value="BF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BF')?"selected='selected'":"";}?>>Burkina Faso </option>
            <option value="BI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BI')?"selected='selected'":"";}?>>Burundi </option>
            <option value="CF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CF')?"selected='selected'":"";}?>>C`Tral African Rep </option>
            <option value="KA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KA')?"selected='selected'":"";}?>>Cambodian </option>
            <option value="CM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CM')?"selected='selected'":"";}?>>Cameroon </option>
            <option value="CA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CA')?"selected='selected'":"";}?>>Canadian </option>
            <option value="CV" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CV')?"selected='selected'":"";}?>>Cape Verde  </option>
            <option value="TD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TD')?"selected='selected'":"";}?>>Chadian </option>
            <option value="CL" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CL')?"selected='selected'":"";}?>>Chilean </option>
            <option value="CO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CO')?"selected='selected'":"";}?>>Colombian  </option>
            <option value="KM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KM')?"selected='selected'":"";}?>>Comoros </option>
            <option value="CG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CG')?"selected='selected'":"";}?>>Congo </option>
            <option value="CK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CK')?"selected='selected'":"";}?>>Cook Islands </option>
            <option value="CR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CR')?"selected='selected'":"";}?>>Costa Rican  </option>
            <option value="CB" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CB')?"selected='selected'":"";}?>>Croatian </option>
            <option value="CU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CU')?"selected='selected'":"";}?>>Cuban </option>
            <option value="CY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CY')?"selected='selected'":"";}?>>Cypriot </option>
            <option value="CZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CZ')?"selected='selected'":"";}?>>Czech  </option>
            <option value="CS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CS')?"selected='selected'":"";}?>>Czechoslovak </option>
            <option value="DK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DK')?"selected='selected'":"";}?>>Danish </option>
            <option value="DJ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DJ')?"selected='selected'":"";}?>>Djibouti </option>
            <option value="DM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DM')?"selected='selected'":"";}?>>Dominica </option>
            <option value="DO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DO')?"selected='selected'":"";}?>>Dominican Republic </option>
            <option value="NL" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NL')?"selected='selected'":"";}?>>Dutch </option>
            <option value="TP" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TP')?"selected='selected'":"";}?>>East Timorese </option>
            <option value="EC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'EC')?"selected='selected'":"";}?>>Ecuadorian </option>
            <option value="EG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'EG')?"selected='selected'":"";}?>>Egyptian  </option>
            <option value="GQ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GQ')?"selected='selected'":"";}?>>Equatorial Guinea </option>
            <option value="ER" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ER')?"selected='selected'":"";}?>>Eritrean </option>
            <option value="EN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'EN')?"selected='selected'":"";}?>>Estonian </option>
            <option value="ET" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ET')?"selected='selected'":"";}?>>Ethiopian  </option>
            <option value="FJ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'FJ')?"selected='selected'":"";}?>>Fijian </option>
            <option value="PH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PH')?"selected='selected'":"";}?>>Filipino </option>
            <option value="FI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'FI')?"selected='selected'":"";}?>>Finnish </option>
            <option value="FR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'FR')?"selected='selected'":"";}?>>French </option>
            <option value="GF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GF')?"selected='selected'":"";}?>>French Guiana  </option>
            <option value="PF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PF')?"selected='selected'":"";}?>>French Polynesia </option>
            <option value="GA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GA')?"selected='selected'":"";}?>>Gabon </option>
            <option value="GM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GM')?"selected='selected'":"";}?>>Gambian </option>
            <option value="GO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GO')?"selected='selected'":"";}?>>Georgian  </option>
            <option value="DG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DG')?"selected='selected'":"";}?>>German </option>
            <option value="DD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DD')?"selected='selected'":"";}?>>German, East </option>
            <option value="DE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'DE')?"selected='selected'":"";}?>>German, West </option>
            <option value="GH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GH')?"selected='selected'":"";}?>>Ghanaian  </option>
            <option value="GD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GD')?"selected='selected'":"";}?>>Grenadian </option>
            <option value="GP" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GP')?"selected='selected'":"";}?>>Guadeloupe </option>
            <option value="GU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GU')?"selected='selected'":"";}?>>Guam </option>
            <option value="GT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GT')?"selected='selected'":"";}?>>Guatemala  </option>
            <option value="GN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GN')?"selected='selected'":"";}?>>Guinea </option>
            <option value="GW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GW')?"selected='selected'":"";}?>>Guinea-Bissau </option>
            <option value="GY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'GY')?"selected='selected'":"";}?>>Guyana </option>
            <option value="HN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'HN')?"selected='selected'":"";}?>>Honduran </option>
            <option value="HK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'HK')?"selected='selected'":"";}?>>Hong Kong </option>
            <option value="IS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'IS')?"selected='selected'":"";}?>>Iceland </option>
            <option value="IR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'IR')?"selected='selected'":"";}?>>Iranian  </option>
            <option value="IQ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'IQ')?"selected='selected'":"";}?>>Iraqi </option>
            <option value="IE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'IE')?"selected='selected'":"";}?>>Irish </option>
            <option value="IL" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'IL')?"selected='selected'":"";}?>>Israeli </option>
            <option value="IT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'IT')?"selected='selected'":"";}?>>Italian </option>
            <option value="CI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CI')?"selected='selected'":"";}?>>Ivory Coast  </option>
            <option value="JM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'JM')?"selected='selected'":"";}?>>Jamaican </option>
            <option value="JP" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'JP')?"selected='selected'":"";}?>>Japanese </option>
            <option value="JO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'JO')?"selected='selected'":"";}?>>Jordanian </option>
            <option value="KH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KH')?"selected='selected'":"";}?>>Kampuchean  </option>
            <option value="KZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KZ')?"selected='selected'":"";}?>>Kazakh </option>
            <option value="KE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KE')?"selected='selected'":"";}?>>Kenyan </option>
            <option value="KG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KG')?"selected='selected'":"";}?>>Kirghiz </option>
            <option value="KI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KI')?"selected='selected'":"";}?>>Kiribati </option>
            <option value="KP" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KP')?"selected='selected'":"";}?>>Korean, North  </option>
            <option value="KR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KR')?"selected='selected'":"";}?>>Korean, South </option>
            <option value="KW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KW')?"selected='selected'":"";}?>>Kuwaiti </option>
            <option value="KS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KS')?"selected='selected'":"";}?>>Kyrghis </option>
            <option value="KY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'KY')?"selected='selected'":"";}?>>Kyrgyzstan  </option>
            <option value="LA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LA')?"selected='selected'":"";}?>>Laotian </option>
            <option value="LV" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LV')?"selected='selected'":"";}?>>Latvian </option>
            <option value="LB" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LB')?"selected='selected'":"";}?>>Lebanese </option>
            <option value="LS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LS')?"selected='selected'":"";}?>>Lesotho </option>
            <option value="LR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LR')?"selected='selected'":"";}?>>Liberian  </option>
            <option value="LY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LY')?"selected='selected'":"";}?>>Libyan </option>
            <option value="LI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LI')?"selected='selected'":"";}?>>Liechtenstein </option>
            <option value="LH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LH')?"selected='selected'":"";}?>>Lithuanian </option>
            <option value="LU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LU')?"selected='selected'":"";}?>>Luxembourg  </option>
            <option value="MO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MO')?"selected='selected'":"";}?>>Macao </option>
            <option value="MB" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MB')?"selected='selected'":"";}?>>Macedonia </option>
            <option value="MG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MG')?"selected='selected'":"";}?>>Madagascar </option>
            <option value="MW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MW')?"selected='selected'":"";}?>>Malawi  </option>
            <option value="MV" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MV')?"selected='selected'":"";}?>>Maldivian </option>
            <option value="ML" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ML')?"selected='selected'":"";}?>>Mali </option>
            <option value="MT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MT')?"selected='selected'":"";}?>>Maltese  </option>
            <option value="MH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MH')?"selected='selected'":"";}?>>Marshallese </option>
            <option value="MQ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MQ')?"selected='selected'":"";}?>>Martinique </option>
            <option value="MR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MR')?"selected='selected'":"";}?>>Mauritanean </option>
            <option value="MU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MU')?"selected='selected'":"";}?>>Mauritian  </option>
            <option value="MX" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MX')?"selected='selected'":"";}?>>Mexican </option>
            <option value="MF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MF')?"selected='selected'":"";}?>>Micronesian </option>
            <option value="MD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MD')?"selected='selected'":"";}?>>Moldavian </option>
            <option value="MC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MC')?"selected='selected'":"";}?>>Monaco  </option>
            <option value="MN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MN')?"selected='selected'":"";}?>>Mongolian </option>
            <option value="MA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MA')?"selected='selected'":"";}?>>Moroccan </option>
            <option value="MZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'MZ')?"selected='selected'":"";}?>>Mozambique </option>
            <option value="BU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'BU')?"selected='selected'":"";}?>>Myanmar  </option>
            <option value="NA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NA')?"selected='selected'":"";}?>>Namibia </option>
            <option value="NR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NR')?"selected='selected'":"";}?>>Nauruan </option>
            <option value="NP" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NP')?"selected='selected'":"";}?>>Nepalese </option>
            <option value="NT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NT')?"selected='selected'":"";}?>>Netherlands </option>
            <option value="AN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AN')?"selected='selected'":"";}?>>Netherlands Antil. </option>
            <option value="NC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NC')?"selected='selected'":"";}?>>New Caledonia </option>
            <option value="NZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NZ')?"selected='selected'":"";}?>>New Zealander </option>
            <option value="NI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NI')?"selected='selected'":"";}?>>Nicaraguan </option>
            <option value="NE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NE')?"selected='selected'":"";}?>>Niger  </option>
            <option value="NG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NG')?"selected='selected'":"";}?>>Nigerian </option>
            <option value="NU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NU')?"selected='selected'":"";}?>>Niue Island </option>
            <option value="NS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NS')?"selected='selected'":"";}?>>Non-S`Pore Citizen </option>
            <option value="NO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'NO')?"selected='selected'":"";}?>>Norwegian  </option>
            <option value="OM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'OM')?"selected='selected'":"";}?>>Oman </option>
            <option value="PC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PC')?"selected='selected'":"";}?>>Pacific Is Trust T </option>
            <option value="PK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PK')?"selected='selected'":"";}?>>Pakistani </option>
            <option value="PW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PW')?"selected='selected'":"";}?>>Palauan  </option>
            <option value="PN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PN')?"selected='selected'":"";}?>>Palestinian </option>
            <option value="PA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PA')?"selected='selected'":"";}?>>Panamanian </option>
            <option value="PG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PG')?"selected='selected'":"";}?>>Papua New Guinea </option>
            <option value="PY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PY')?"selected='selected'":"";}?>>Paraguay  </option>
            <option value="PE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PE')?"selected='selected'":"";}?>>Peruvian </option>
            <option value="PI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PI')?"selected='selected'":"";}?>>Pitcairn </option>
            <option value="PL" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PL')?"selected='selected'":"";}?>>Polish </option>
            <option value="PT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PT')?"selected='selected'":"";}?>>Portuguese </option>
            <option value="PR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'PR')?"selected='selected'":"";}?>>Puerto Rican </option>
            <option value="QA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'QA')?"selected='selected'":"";}?>>Qatar </option>
            <option value="RE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'RE')?"selected='selected'":"";}?>>Reunion </option>
            <option value="RO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'RO')?"selected='selected'":"";}?>>Romanian </option>
            <option value="SU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SU')?"selected='selected'":"";}?>>Russian  </option>
            <option value="RF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'RF')?"selected='selected'":"";}?>>Russian </option>
            <option value="RW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'RW')?"selected='selected'":"";}?>>Rwanda </option>
            <option value="SV" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SV')?"selected='selected'":"";}?>>Salvadoran </option>
            <option value="WS" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'WS')?"selected='selected'":"";}?>>Samoan </option>
            <option value="ST" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ST')?"selected='selected'":"";}?>>Sao Tome & Princi. </option>
            <option value="SA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SA')?"selected='selected'":"";}?>>Saudi Arabian </option>
            <option value="SN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SN')?"selected='selected'":"";}?>>Senegalese </option>
            <option value="SC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SC')?"selected='selected'":"";}?>>Seychelles </option>
            <option value="SL" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SL')?"selected='selected'":"";}?>>Sierra Leone </option>
            <option value="SK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SK')?"selected='selected'":"";}?>>Slovak </option>
            <option value="SI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SI')?"selected='selected'":"";}?>>Slovenian </option>
            <option value="SB" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SB')?"selected='selected'":"";}?>>Solomon Islands </option>
            <option value="SO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SO')?"selected='selected'":"";}?>>Somali </option>
            <option value="ZA" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ZA')?"selected='selected'":"";}?>>South African </option>
            <option value="ES" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ES')?"selected='selected'":"";}?>>Spanish </option>
            <option value="LK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LK')?"selected='selected'":"";}?>>Sri Lankan  </option>
            <option value="SW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SW')?"selected='selected'":"";}?>>St Kitts & Nevis </option>
            <option value="LC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'LC')?"selected='selected'":"";}?>>St. Lucia </option>
            <option value="VC" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'VC')?"selected='selected'":"";}?>>St. Vincent </option>
            <option value="SD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SD')?"selected='selected'":"";}?>>Sudanese  </option>
            <option value="SR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SR')?"selected='selected'":"";}?>>Suriname </option>
            <option value="SZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SZ')?"selected='selected'":"";}?>>Swazi </option>
            <option value="SE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SE')?"selected='selected'":"";}?>>Swedish </option>
            <option value="CH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'CH')?"selected='selected'":"";}?>>Swiss </option>
            <option value="SY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'SY')?"selected='selected'":"";}?>>Syrian  </option>
            <option value="TJ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TJ')?"selected='selected'":"";}?>>Tadzhik </option>
            <option value="TW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TW')?"selected='selected'":"";}?>>Taiwanese </option>
            <option value="TI" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TI')?"selected='selected'":"";}?>>Tajikistani </option>
            <option value="TZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TZ')?"selected='selected'":"";}?>>Tanzanian  </option>
            <option value="TH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TH')?"selected='selected'":"";}?>>Thai </option>
            <option value="TE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TE')?"selected='selected'":"";}?>>Timorense </option>
            <option value="TG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TG')?"selected='selected'":"";}?>>Togo </option>
            <option value="TK" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TK')?"selected='selected'":"";}?>>Tokelau Islands  </option>
            <option value="TO" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TO')?"selected='selected'":"";}?>>Tonga </option>
            <option value="TT" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TT')?"selected='selected'":"";}?>>Trinidad & Tobago </option>
            <option value="TN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TN')?"selected='selected'":"";}?>>Tunisia</option>
            <option value="TR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TR')?"selected='selected'":"";}?>>Turk  </option>
            <option value="TM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TM')?"selected='selected'":"";}?>>Turkmen </option>
            <option value="TV" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'TV')?"selected='selected'":"";}?>>Tuvalu </option>
            <option value="UG" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'UG')?"selected='selected'":"";}?>>Ugandian </option>
            <option value="UR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'UR')?"selected='selected'":"";}?>>Ukrainian </option>
            <option value="AE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'AE')?"selected='selected'":"";}?>>United Arab Em. </option>
            <option value="UN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'UN')?"selected='selected'":"";}?>>Unknown </option>
            <option value="HV" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'HV')?"selected='selected'":"";}?>>Upper Volta </option>
            <option value="UY" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'UY')?"selected='selected'":"";}?>>Uruguay </option>
            <option value="UZ" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'UZ')?"selected='selected'":"";}?>>Uzbek  </option>
            <option value="VU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'VU')?"selected='selected'":"";}?>>Vanuatu </option>
            <option value="VE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'VE')?"selected='selected'":"";}?>>Venezuelan </option>
            <option value="VN" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'VN')?"selected='selected'":"";}?>>Vietnamese </option>
            <option value="WF" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'WF')?"selected='selected'":"";}?>>Wallis And Futuna  </option>
            <option value="EH" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'EH')?"selected='selected'":"";}?>>Western Sahara </option>
            <option value="YE" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'YE')?"selected='selected'":"";}?>>Yemen Arab Rep </option>
            <option value="YD" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'YD')?"selected='selected'":"";}?>>Yemen, South </option>
            <option value="YM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'YM')?"selected='selected'":"";}?>>Yemeni  </option>
            <option value="YU" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'YU')?"selected='selected'":"";}?>>Yugoslav </option>
            <option value="ZR" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ZR')?"selected='selected'":"";}?>>Zairan </option>
            <option value="ZM" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ZM')?"selected='selected'":"";}?>>Zambian </option>
            <option value="ZW" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'ZW')?"selected='selected'":"";}?>>Zimbabwean </option>
            <option value="XX" <?php if(isset($_POST['nationality']))
  	{echo ($_POST['nationality'] == 'XX')?"selected='selected'":"";}?>>Other </option>
            </select><br />
      Expiry Date:
      DD <input type="text" name="expireday" id="expireday" class='inputid' value="<?php if (isset($_POST['expireday'])) 
      {print stripslashes($_POST['expireday']);}else {print "";} ?>"/>
      MM <input type="text" name="expiremonth" id="expiremonth" class='inputid' value="<?php if (isset($_POST['expiremonth'])) 
      {print stripslashes($_POST['expiremonth']);}else {print "";} ?>"/>
      YYYY <input type="text" name="expireyear" id="expireyear" class='inputid' value="<?php if (isset($_POST['expireyear'])) 
      {print stripslashes($_POST['expireyear']);}else {print "";} ?>"/><br />
      
      Ethnic Group*：<select name="race" id="race">
            <option value="0">请选择</option>
            <option value="CN" <?php if(isset($_POST['race']))
    {echo ($_POST['race'] == 'CN')?"selected='selected'":"";}?>>Chinese(华人)</option>
            <option value="MY" <?php if(isset($_POST['race']))
    {echo ($_POST['race'] == 'MY')?"selected='selected'":"";}?>>Malay(马来)</option>
            <option value="IN" <?php if(isset($_POST['race']))
    {echo ($_POST['race'] == 'IN')?"selected='selected'":"";}?>>Indian(印度)</option>
            <option value="EU" <?php if(isset($_POST['race']))
    {echo ($_POST['race'] == 'EU')?"selected='selected'":"";}?>>Eurasian(欧洲)</option>
            <option value="XX" <?php if(isset($_POST['race']))
    {echo ($_POST['race'] == 'XX')?"selected='selected'":"";}?>>Other(其他)</option>
            </select>
      Language Proficiency*：<select name="lang" id="lang">
            <option value="0">请选择</option>
            <option value="CHI" <?php if(isset($_POST['lang']))
    {echo ($_POST['lang'] == 'CHI')?"selected='selected'":"";}?>>Chinese(中文)</option>
            <option value="ENG" <?php if(isset($_POST['lang']))
    {echo ($_POST['lang'] == 'ENG')?"selected='selected'":"";}?>>English(英语)</option>
            <option value="M" <?php if(isset($_POST['lang']))
    {echo ($_POST['lang'] == 'M')?"selected='selected'":"";}?>>Malay(马来语)</option>
            <option value="T" <?php if(isset($_POST['lang']))
    {echo ($_POST['lang'] == 'T')?"selected='selected'":"";}?>>Tamil(泰米尔语)</option>
            <option value="O" <?php if(isset($_POST['lang']))
    {echo ($_POST['lang'] == 'O')?"selected='selected'":"";}?>>Others(其他)</option>
            </select><br />
      Highest Chinese Education Level*：<select name="cnlevel" id="cnlevel">
            <option value="0">请选择</option>
            <option value="01" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '01')?"selected='selected'":"";}?>>No Formal Qualification & Lowe</option>
            <option value="11" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '11')?"selected='selected'":"";}?>>Primary PSLE</option>
            <option value="20" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '20')?"selected='selected'":"";}?>>Lower Secondary</option>
            <option value="31" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '31')?"selected='selected'":"";}?>>'N' Level or equivalent</option>
            <option value="32" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '32')?"selected='selected'":"";}?>>'O' Level or equivalent</option>
            <option value="41" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '41')?"selected='selected'":"";}?>>'A' Level or equivalent</option>
            <option value="70" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '70')?"selected='selected'":"";}?>>Professional Qualification & O</option>
            <option value="80" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '80')?"selected='selected'":"";}?>>University First Degree</option>
            <option value="90" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == '90')?"selected='selected'":"";}?>>University Post-graduate Diplo</option>
            <option value="XX" <?php if(isset($_POST['cnlevel']))
    {echo ($_POST['cnlevel'] == 'XX')?"selected='selected'":"";}?>>Not Reported</option>
            </select><br />
      Highest Education Level*：<select name="edulevel" id="edulevel">
            <option value="0">请选择</option>
            <option value="01" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '01')?"selected='selected'":"";}?>>No Formal Qualification & Lower Primary </option>
            <option value="11" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '11')?"selected='selected'":"";}?>>Primary PSLE</option>
            <option value="20" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '20')?"selected='selected'":"";}?>>Lower Secondary</option>
            <option value="35" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '35')?"selected='selected'":"";}?>>ITE Skills Certification (ISC)</option>
            <option value="31" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '31')?"selected='selected'":"";}?>>'N' Level or equivalent</option>
            <option value="32" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '32')?"selected='selected'":"";}?>>'O' Level or equivalent</option>
            <option value="41" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '41')?"selected='selected'":"";}?>>'A' Level or equivalent</option>
            <option value="51" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '51')?"selected='selected'":"";}?>>NITEC/Post Nitec</option>
            <option value="54" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '54')?"selected='selected'":"";}?>>WSQ Certificate</option>
            <option value="52" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '52')?"selected='selected'":"";}?>>Higher NITEC</option>
            <option value="55" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '55')?"selected='selected'":"";}?>>WSQ Higher Certificate</option>
            <option value="53" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '53')?"selected='selected'":"";}?>>Master NITEC</option>
            <option value="61" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '61')?"selected='selected'":"";}?>>Polytechnic Diploma</option>
            <option value="73" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '73')?"selected='selected'":"";}?>>WSQ Advance Certificate</option>
            <option value="74" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '74')?"selected='selected'":"";}?>>WSQ Diploma</option>
            <option value="75" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '75')?"selected='selected'":"";}?>>WSQ Specialist Diploma</option>
            <option value="70" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '70')?"selected='selected'":"";}?>>Professional Qualification & Other Diploma</option>
            <option value="80" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '80')?"selected='selected'":"";}?>>University First Degree</option>
            <option value="92" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '92')?"selected='selected'":"";}?>>WSQ Graduate Certificate</option>
            <option value="93" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '93')?"selected='selected'":"";}?>>WSQ Graduate Diploma</option>
            <option value="90" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == '90')?"selected='selected'":"";}?>>University Post-graduate Diploma & Degree/Master/Doctorate</option>
            <option value="XX" <?php if(isset($_POST['edulevel']))
    {echo ($_POST['edulevel'] == 'XX')?"selected='selected'":"";}?>>Not Reported</option>
            </select><br />
      With or without government letter*：<select name="gov_letter" id="gov_letter">
            <option value="0">请选择</option>
            <option value="NO" <?php if(isset($_POST['gov_letter']))
    {echo ($_POST['gov_letter'] == 'NO')?"selected='selected'":"";}?>>没有</option>
            <option value="YES" <?php if(isset($_POST['gov_letter']))
    {echo ($_POST['gov_letter'] == 'YES')?"selected='selected'":"";}?>>有</option>
          </select><br />
      Employment Status*：<select id="employstatus" name="employstatus">
            <option value="0">请选择</option>
            <option value="EMP001"  <?php if(isset($_POST['employstatus']))
    {echo ($_POST['employstatus'] == 'EMP001')?"selected='selected'":"";}?>>Employed</option>
            <option value="EMP002"  <?php if(isset($_POST['employstatus']))
    {echo ($_POST['employstatus'] == 'EMP002')?"selected='selected'":"";}?>>Unemployed</option>
          </select>
      Salary Range*：<select name="salaryrange" id="salaryrange">
                <option>请选择</option>
                <option value="00" selected='selected' <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '00')?"selected='selected'":"";}?>>Unemployed</option>
                <option value="01" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '01')?"selected='selected'":"";}?>>Below $1,000</option>
                <option value="02" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '02')?"selected='selected'":"";}?>>$1,000 - $1,400</option>
                <option value="03a" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '03a')?"selected='selected'":"";}?>>$1,401 - $1,700</option>
                <option value="03b" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '03b')?"selected='selected'":"";}?>>$1,701 - $2,000</option>
                <option value="04" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '04')?"selected='selected'":"";}?>>$2,000 - $2,499</option>
                <option value="05" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '05')?"selected='selected'":"";}?>>$2,500 - $2,999</option>
                <option value="06" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '06')?"selected='selected'":"";}?>>$3,000 - $3,499</option>
                <option value="07" <?php if(isset($_POST['salaryrange']))
      {echo ($_POST['salaryrange'] == '07')?"selected='selected'":"";}?>>$3,500 and above</option>
            </select><br />
            <div id='companydetail'>
      Company Name: <input type="text" name="companyname" id="companyname" value="<?php if (isset($_POST['companyname'])) {
              print stripslashes($_POST['companyname']);}else {print "NA";} ?>"/><br />
      Company Registration Type：<select name="companystatus" id="companystatus">
                <option value="0">请选择</option>
                <option value="ROC" <?php if(isset($_POST['companystatus']))
  	  {echo ($_POST['companystatus'] == 'ROC')?"selected='selected'":"";}?>>Registry of Company</option>
                <option value="ROB" <?php if(isset($_POST['companystatus']))
  	  {echo ($_POST['companystatus'] == 'ROB')?"selected='selected'":"";}?>>Registry of Business</option>
                <option value="UENO" <?php if(isset($_POST['companystatus']))
  	  {echo ($_POST['companystatus'] == 'UENO')?"selected='selected'":"";}?>>Other Unique Establishments (UENO)</option>
                <option value="OTHERS" selected='selected' <?php if(isset($_POST['companystatus']))
  	  {echo ($_POST['companystatus'] == 'OTHERS')?"selected='selected'":"";}?>>Others - None of the Above</option>
            </select><br />
      Company Registration No：<input type="text" name="companyregno" id="companyregno" value="<?php if (isset($_POST['companyregno'])) {
              print stripslashes($_POST['companyregno']);}else {print "NA";} ?>"/><br />
      Industry Sector：<select name="industry" id="industry">
                <option value="0">请选择</option>
                <option value="1" selected='selected' <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '1')?"selected='selected'":"";}?>>Others</option>
                <option value="2" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '2')?"selected='selected'":"";}?>>Aerospace</option>
                <option value="3" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '3')?"selected='selected'":"";}?>>Bio-Medical Sciences</option>
                <option value="4" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '4')?"selected='selected'":"";}?>>Business Process Outsourcing</option>
                <option value="5" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '5')?"selected='selected'":"";}?>>Chemicals</option>
                <option value="6" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '6')?"selected='selected'":"";}?>>Creative</option>
                <option value="7" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '7')?"selected='selected'":"";}?>>Construction</option>
                <option value="8" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '8')?"selected='selected'":"";}?>>Electronics</option>
                <option value="9" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '9')?"selected='selected'":"";}?>>Environment</option>
                <option value="10" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '10')?"selected='selected'":"";}?>>Finance</option>
                <option value="11" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '11')?"selected='selected'":"";}?>>Food Mfg & Processing</option>
                <option value="12" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '12')?"selected='selected'":"";}?>>Government / Public Services</option>
                <option value="13" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '13')?"selected='selected'":"";}?>>Healthcare</option>
                <option value="14" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '14')?"selected='selected'":"";}?>>Horticulture</option>
                <option value="15" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '15')?"selected='selected'":"";}?>>Hospitality</option>
                <option value="16" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '16')?"selected='selected'":"";}?>>Infocomm Technology</option>
                <option value="17" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '17')?"selected='selected'":"";}?>>Logistics and Transportation</option>
                <option value="18" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '18')?"selected='selected'":"";}?>>Marine</option>
                <option value="19" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '19')?"selected='selected'":"";}?>>Maritime</option>
                <option value="20" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '20')?"selected='selected'":"";}?>>Precision ?Engineering</option>
                <option value="21" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '21')?"selected='selected'":"";}?>>Printing</option>
                <option value="22" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '22')?"selected='selected'":"";}?>>Professional Services</option>
                <option value="23" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '23')?"selected='selected'":"";}?>>Process</option>
                <option value="24" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '24')?"selected='selected'":"";}?>>Repair and Servicing</option>
                <option value="25" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '25')?"selected='selected'":"";}?>>Retail</option>
                <option value="26" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '26')?"selected='selected'":"";}?>>Security</option>
                <option value="27" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '27')?"selected='selected'":"";}?>>Social & Community Services</option>
                <option value="28" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '28')?"selected='selected'":"";}?>>Sports and Recreation</option>
                <option value="29" <?php if(isset($_POST['industry']))
  	  {echo ($_POST['industry'] == '29')?"selected='selected'":"";}?>>Textile</option>
            </select><br />
      Designation：<select name="designation" id="designation">
                <option value="0">请选择</option>
                <option value="01" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '01')?"selected='selected'":"";}?>>Legislators, Senior Officials and Mangers</option>
                <option value="02" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '02')?"selected='selected'":"";}?>>Professionals</option>
                <option value="03" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '03')?"selected='selected'":"";}?>>Associate Professionals and Technicians</option>
                <option value="04" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '04')?"selected='selected'":"";}?>>Clerical Workers</option>
                <option value="05" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '05')?"selected='selected'":"";}?>>Service Works and Shop and Market Sales Workers</option>
                <option value="06" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '06')?"selected='selected'":"";}?>>Agricultural and Fishery Workers</option>
                <option value="07" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '07')?"selected='selected'":"";}?>>Production Craftsmen & Related Workers</option>
                <option value="08" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '08')?"selected='selected'":"";}?>>Plan and Machine Operators and Assemblers</option>
                <option value="09" <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '09')?"selected='selected'":"";}?>>Cleaners, Laborers and Related Workers</option>
                <option value="10" selected='selected' <?php if(isset($_POST['designation']))
  	  {echo ($_POST['designation'] == '10')?"selected='selected'":"";}?>>Workers not classified by Occupation</option>
            </select><br />
            </div>
      Remarks： <input type='text' name='intro' id='intro' class='longtext' value="<?php if (isset($_POST['intro'])) {
              print stripslashes($_POST['intro']);}else {print "";} ?>" /><br /><br /><br />
      上课时间：
      <input type="checkbox" name="availabletime1" id="availabletime1" value="1">平时早
      <input type="checkbox" name="availabletime2" id="availabletime2" value="2">平时下午
      <input type="checkbox" name="availabletime3" id="availabletime3" value="3">平时晚
      <input type="checkbox" name="availabletime4" id="availabletime4" value="4">拜六日早
      <input type="checkbox" name="availabletime5" id="availabletime5" value="5">拜六日下午
      <input type="checkbox" name="availabletime6" id="availabletime6" value="6">拜六日晚
      <input type="checkbox" name="availabletime7" id="availabletime7" checked="checked" value="7">任意时间
    <input type='hidden' name='hiddenbranch' 
      value='<?php echo $_SESSION['branch'];?>'/>
      <input type='hidden' name='hiddenbranchop' 
      value='<?php echo $_SESSION['username'];?>'/>
      <div style="text-align: center">
      <h2>
        提交：<input type="button" name="inputbasic" id="inputbasic" value="保存">
        <input type="button" class="clear" name="clearbasic" id="clearbasic" value="清空">
      </h2>
      </div>
    </fieldset>
  </form>
  <div id="resultsbasic">
    <div id='basicerr'>
    </div>
  </div>
</div>


