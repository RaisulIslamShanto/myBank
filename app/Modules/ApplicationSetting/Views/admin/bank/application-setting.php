<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>

<!--  new design-->
<form id="applicationsetting">
 
  <?php foreach ($settingdata as $value2): ?>
	 	 <div class="card mb-4">
			<div class="card-body"> 
        <input type="text" id="settingId" value="<?=$value2['id']?>">
				<h5>General <span>Settings</span></h5>
				 <div class="row">
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="companyName" id="companyName" value="<?=$value2['company_name']; ?>"  placeholder="Company Name" >
						  <label for="CompanyName">Company Name</label>
              <span style="color:red;" id="nameErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="site"  id="site" placeholder="Site Title" value="<?=$value2['site']; ?>">
						  <label for="SiteTitle">Site Title</label>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="phone" id="phone" placeholder="Company Phone" value="<?=$value2['company_phone']; ?>" >
						  <label for="CompanyPhone">Company Phone</label>
              <span style="color:red;" id="phoneErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="email" class="form-control" name="email"  id="email" value="<?=$value2['email']; ?>" placeholder="Company Email" >
						  <label for="CompanyEmail">Company Email</label>
              <span style="color:red;" id="siteErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <select class="form-control " name="timezone" id="timezone">
							  <option value="">-- Select One --</option>
								<option value="Asia/Dhaka" <?php echo ($value2['timezone']=='Asia/Dhaka' ?'selected':'' ) ?>>GMT +06:00 Asia/Dhaka</option>
								<option value="Africa/Abidjan" <?php echo ($value2['timezone']=='Africa/Abidjan' ?'selected':'' ) ?>>GMT +00:00 Africa/Abidjan</option>
							  <option value="Africa/Abidjan">GMT +00:00 Africa/Abidjan</option>
							  <option value="Africa/Accra">GMT +00:00 Africa/Accra</option>
							  <option value="Africa/Addis_Ababa">GMT +03:00 Africa/Addis_Ababa</option>
							  <option value="Africa/Algiers">GMT +01:00 Africa/Algiers</option>
							  <option value="Africa/Asmara">GMT +03:00 Africa/Asmara</option>
							  <option value="Africa/Bamako">GMT +00:00 Africa/Bamako</option>
							  <option value="Africa/Bangui">GMT +01:00 Africa/Bangui</option>
							  <option value="Africa/Banjul">GMT +00:00 Africa/Banjul</option>
							  <option value="Africa/Bissau">GMT +00:00 Africa/Bissau</option>
							  <option value="Africa/Blantyre">GMT +02:00 Africa/Blantyre</option>
							  <option value="Africa/Brazzaville">GMT +01:00 Africa/Brazzaville</option>
							  <option value="Africa/Bujumbura">GMT +02:00 Africa/Bujumbura</option>
							  <option value="Africa/Cairo">GMT +03:00 Africa/Cairo</option>
							  <option value="Africa/Casablanca">GMT +01:00 Africa/Casablanca</option>
							  <option value="Africa/Ceuta">GMT +02:00 Africa/Ceuta</option>
							  <option value="Africa/Conakry">GMT +00:00 Africa/Conakry</option>
							  <option value="Africa/Dakar">GMT +00:00 Africa/Dakar</option>
							  <option value="Africa/Dar_es_Salaam">GMT +03:00 Africa/Dar_es_Salaam</option>
							  <option value="Africa/Djibouti">GMT +03:00 Africa/Djibouti</option>
							  <option value="Africa/Douala">GMT +01:00 Africa/Douala</option>
							  <option value="Africa/El_Aaiun">GMT +01:00 Africa/El_Aaiun</option>
							  <option value="Africa/Freetown">GMT +00:00 Africa/Freetown</option>
							  <option value="Africa/Gaborone">GMT +02:00 Africa/Gaborone</option>
							  <option value="Africa/Harare">GMT +02:00 Africa/Harare</option>
							  <option value="Africa/Johannesburg">GMT +02:00 Africa/Johannesburg</option>
							  <option value="Africa/Juba">GMT +02:00 Africa/Juba</option>
							  <option value="Africa/Kampala">GMT +03:00 Africa/Kampala</option>
							  <option value="Africa/Khartoum">GMT +02:00 Africa/Khartoum</option>
							  <option value="Africa/Kigali">GMT +02:00 Africa/Kigali</option>
							  <option value="Africa/Kinshasa">GMT +01:00 Africa/Kinshasa</option>
							  <option value="Africa/Lagos">GMT +01:00 Africa/Lagos</option>
							  <option value="Africa/Libreville">GMT +01:00 Africa/Libreville</option>
							  <option value="Africa/Lome">GMT +00:00 Africa/Lome</option>
							  <option value="Africa/Luanda">GMT +01:00 Africa/Luanda</option>
							  <option value="Africa/Lubumbashi">GMT +02:00 Africa/Lubumbashi</option>
							  <option value="Africa/Lusaka">GMT +02:00 Africa/Lusaka</option>
							  <option value="Africa/Malabo">GMT +01:00 Africa/Malabo</option>
							  <option value="Africa/Maputo">GMT +02:00 Africa/Maputo</option>
							  <option value="Africa/Maseru">GMT +02:00 Africa/Maseru</option>
							  <option value="Africa/Mbabane">GMT +02:00 Africa/Mbabane</option>
							  <option value="Africa/Mogadishu">GMT +03:00 Africa/Mogadishu</option>
							  <option value="Africa/Monrovia">GMT +00:00 Africa/Monrovia</option>
							  <option value="Africa/Nairobi">GMT +03:00 Africa/Nairobi</option>
							  <option value="Africa/Ndjamena">GMT +01:00 Africa/Ndjamena</option>
							  <option value="Africa/Niamey">GMT +01:00 Africa/Niamey</option>
							  <option value="Africa/Nouakchott">GMT +00:00 Africa/Nouakchott</option>
							  <option value="Africa/Ouagadougou">GMT +00:00 Africa/Ouagadougou</option>
							  <option value="Africa/Porto-Novo">GMT +01:00 Africa/Porto-Novo</option>
							  <option value="Africa/Sao_Tome">GMT +00:00 Africa/Sao_Tome</option>
							  <option value="Africa/Tripoli">GMT +02:00 Africa/Tripoli</option>
							  <option value="Africa/Tunis">GMT +01:00 Africa/Tunis</option>
							  <option value="Africa/Windhoek">GMT +02:00 Africa/Windhoek</option>
							  <option value="America/Adak">GMT -09:00 America/Adak</option>
							  <option value="America/Anchorage">GMT -08:00 America/Anchorage</option>
							  <option value="America/Anguilla">GMT -04:00 America/Anguilla</option>
							  <option value="America/Antigua">GMT -04:00 America/Antigua</option>
							  <option value="America/Araguaina">GMT -03:00 America/Araguaina</option>
							  <option value="America/Argentina/Buenos_Aires">GMT -03:00 America/Argentina/Buenos_Aires</option>
							  <option value="America/Argentina/Catamarca">GMT -03:00 America/Argentina/Catamarca</option>
							  <option value="America/Argentina/Cordoba">GMT -03:00 America/Argentina/Cordoba</option>
							  <option value="America/Argentina/Jujuy">GMT -03:00 America/Argentina/Jujuy</option>
							  <option value="America/Argentina/La_Rioja">GMT -03:00 America/Argentina/La_Rioja</option>
							  <option value="America/Argentina/Mendoza">GMT -03:00 America/Argentina/Mendoza</option>
							  <option value="America/Argentina/Rio_Gallegos">GMT -03:00 America/Argentina/Rio_Gallegos</option>
							  <option value="America/Argentina/Salta">GMT -03:00 America/Argentina/Salta</option>
							  <option value="America/Argentina/San_Juan">GMT -03:00 America/Argentina/San_Juan</option>
							  <option value="America/Argentina/San_Luis">GMT -03:00 America/Argentina/San_Luis</option>
							  <option value="America/Argentina/Tucuman">GMT -03:00 America/Argentina/Tucuman</option>
							  <option value="America/Argentina/Ushuaia">GMT -03:00 America/Argentina/Ushuaia</option>
							  <option value="America/Aruba">GMT -04:00 America/Aruba</option>
							  <option value="America/Asuncion">GMT -04:00 America/Asuncion</option>
							  <option value="America/Atikokan">GMT -05:00 America/Atikokan</option>
							  <option value="America/Bahia">GMT -03:00 America/Bahia</option>
							  <option value="America/Bahia_Banderas">GMT -06:00 America/Bahia_Banderas</option>
							  <option value="America/Barbados">GMT -04:00 America/Barbados</option>
							  <option value="America/Belem">GMT -03:00 America/Belem</option>
							  <option value="America/Belize">GMT -06:00 America/Belize</option>
							  <option value="America/Blanc-Sablon">GMT -04:00 America/Blanc-Sablon</option>
							  <option value="America/Boa_Vista">GMT -04:00 America/Boa_Vista</option>
							  <option value="America/Bogota">GMT -05:00 America/Bogota</option>
							  <option value="America/Boise">GMT -06:00 America/Boise</option>
							  <option value="America/Cambridge_Bay">GMT -06:00 America/Cambridge_Bay</option>
							  <option value="America/Campo_Grande">GMT -04:00 America/Campo_Grande</option>
							  <option value="America/Cancun">GMT -05:00 America/Cancun</option>
							  <option value="America/Caracas">GMT -04:00 America/Caracas</option>
							  <option value="America/Cayenne">GMT -03:00 America/Cayenne</option>
							  <option value="America/Cayman">GMT -05:00 America/Cayman</option>
							  <option value="America/Chicago">GMT -05:00 America/Chicago</option>
							  <option value="America/Chihuahua">GMT -06:00 America/Chihuahua</option>
							  <option value="America/Ciudad_Juarez">GMT -06:00 America/Ciudad_Juarez</option>
							  <option value="America/Costa_Rica">GMT -06:00 America/Costa_Rica</option>
							  <option value="America/Creston">GMT -07:00 America/Creston</option>
							  <option value="America/Cuiaba">GMT -04:00 America/Cuiaba</option>
							  <option value="America/Curacao">GMT -04:00 America/Curacao</option>
							  <option value="America/Danmarkshavn">GMT +00:00 America/Danmarkshavn</option>
							  <option value="America/Dawson">GMT -07:00 America/Dawson</option>
							  <option value="America/Dawson_Creek">GMT -07:00 America/Dawson_Creek</option>
							  <option value="America/Denver">GMT -06:00 America/Denver</option>
							  <option value="America/Detroit">GMT -04:00 America/Detroit</option>
							  <option value="America/Dominica">GMT -04:00 America/Dominica</option>
							  <option value="America/Edmonton">GMT -06:00 America/Edmonton</option>
							  <option value="America/Eirunepe">GMT -05:00 America/Eirunepe</option>
							  <option value="America/El_Salvador">GMT -06:00 America/El_Salvador</option>
							  <option value="America/Fort_Nelson">GMT -07:00 America/Fort_Nelson</option>
							  <option value="America/Fortaleza">GMT -03:00 America/Fortaleza</option>
							  <option value="America/Glace_Bay">GMT -03:00 America/Glace_Bay</option>
							  <option value="America/Goose_Bay">GMT -03:00 America/Goose_Bay</option>
							  <option value="America/Grand_Turk">GMT -04:00 America/Grand_Turk</option>
							  <option value="America/Grenada">GMT -04:00 America/Grenada</option>
							  <option value="America/Guadeloupe">GMT -04:00 America/Guadeloupe</option>
							  <option value="America/Guatemala">GMT -06:00 America/Guatemala</option>
							  <option value="America/Guayaquil">GMT -05:00 America/Guayaquil</option>
							  <option value="America/Guyana">GMT -04:00 America/Guyana</option>
							  <option value="America/Halifax">GMT -03:00 America/Halifax</option>
							  <option value="America/Havana">GMT -04:00 America/Havana</option>
							  <option value="America/Hermosillo">GMT -07:00 America/Hermosillo</option>
							  <option value="America/Indiana/Indianapolis">GMT -04:00 America/Indiana/Indianapolis</option>
							  <option value="America/Indiana/Knox">GMT -05:00 America/Indiana/Knox</option>
							  <option value="America/Indiana/Marengo">GMT -04:00 America/Indiana/Marengo</option>
							  <option value="America/Indiana/Petersburg">GMT -04:00 America/Indiana/Petersburg</option>
							  <option value="America/Indiana/Tell_City">GMT -05:00 America/Indiana/Tell_City</option>
							  <option value="America/Indiana/Vevay">GMT -04:00 America/Indiana/Vevay</option>
							  <option value="America/Indiana/Vincennes">GMT -04:00 America/Indiana/Vincennes</option>
							  <option value="America/Indiana/Winamac">GMT -04:00 America/Indiana/Winamac</option>
							  <option value="America/Inuvik">GMT -06:00 America/Inuvik</option>
							  <option value="America/Iqaluit">GMT -04:00 America/Iqaluit</option>
							  <option value="America/Jamaica">GMT -05:00 America/Jamaica</option>
							  <option value="America/Juneau">GMT -08:00 America/Juneau</option>
							  <option value="America/Kentucky/Louisville">GMT -04:00 America/Kentucky/Louisville</option>
							  <option value="America/Kentucky/Monticello">GMT -04:00 America/Kentucky/Monticello</option>
							  <option value="America/Kralendijk">GMT -04:00 America/Kralendijk</option>
							  <option value="America/La_Paz">GMT -04:00 America/La_Paz</option>
							  <option value="America/Lima">GMT -05:00 America/Lima</option>
							  <option value="America/Los_Angeles">GMT -07:00 America/Los_Angeles</option>
							  <option value="America/Lower_Princes">GMT -04:00 America/Lower_Princes</option>
							  <option value="America/Maceio">GMT -03:00 America/Maceio</option>
							  <option value="America/Managua">GMT -06:00 America/Managua</option>
							  <option value="America/Manaus">GMT -04:00 America/Manaus</option>
							  <option value="America/Marigot">GMT -04:00 America/Marigot</option>
							  <option value="America/Martinique">GMT -04:00 America/Martinique</option>
							  <option value="America/Matamoros">GMT -05:00 America/Matamoros</option>
							  <option value="America/Mazatlan">GMT -07:00 America/Mazatlan</option>
							  <option value="America/Menominee">GMT -05:00 America/Menominee</option>
							  <option value="America/Merida">GMT -06:00 America/Merida</option>
							  <option value="America/Metlakatla">GMT -08:00 America/Metlakatla</option>
							  <option value="America/Mexico_City">GMT -06:00 America/Mexico_City</option>
							  <option value="America/Miquelon">GMT -02:00 America/Miquelon</option>
							  <option value="America/Moncton">GMT -03:00 America/Moncton</option>
							  <option value="America/Monterrey">GMT -06:00 America/Monterrey</option>
							  <option value="America/Montevideo">GMT -03:00 America/Montevideo</option>
							  <option value="America/Montserrat">GMT -04:00 America/Montserrat</option>
							  <option value="America/Nassau">GMT -04:00 America/Nassau</option>
							  <option value="America/New_York">GMT -04:00 America/New_York</option>
							  <option value="America/Nome">GMT -08:00 America/Nome</option>
							  <option value="America/Noronha">GMT -02:00 America/Noronha</option>
							  <option value="America/North_Dakota/Beulah">GMT -05:00 America/North_Dakota/Beulah</option>
							  <option value="America/North_Dakota/Center">GMT -05:00 America/North_Dakota/Center</option>
							  <option value="America/North_Dakota/New_Salem">GMT -05:00 America/North_Dakota/New_Salem</option>
							  <option value="America/Nuuk">GMT -02:00 America/Nuuk</option>
							  <option value="America/Ojinaga">GMT -05:00 America/Ojinaga</option>
							  <option value="America/Panama">GMT -05:00 America/Panama</option>
							  <option value="America/Paramaribo">GMT -03:00 America/Paramaribo</option>
							  <option value="America/Phoenix">GMT -07:00 America/Phoenix</option>
							  <option value="America/Port-au-Prince">GMT -04:00 America/Port-au-Prince</option>
							  <option value="America/Port_of_Spain">GMT -04:00 America/Port_of_Spain</option>
							  <option value="America/Porto_Velho">GMT -04:00 America/Porto_Velho</option>
							  <option value="America/Puerto_Rico">GMT -04:00 America/Puerto_Rico</option>
							  <option value="America/Punta_Arenas">GMT -03:00 America/Punta_Arenas</option>
							  <option value="America/Rankin_Inlet">GMT -05:00 America/Rankin_Inlet</option>
							  <option value="America/Recife">GMT -03:00 America/Recife</option>
							  <option value="America/Regina">GMT -06:00 America/Regina</option>
							  <option value="America/Resolute">GMT -05:00 America/Resolute</option>
							  <option value="America/Rio_Branco">GMT -05:00 America/Rio_Branco</option>
							  <option value="America/Santarem">GMT -03:00 America/Santarem</option>
							  <option value="America/Santiago">GMT -04:00 America/Santiago</option>
							  <option value="America/Santo_Domingo">GMT -04:00 America/Santo_Domingo</option>
							  <option value="America/Sao_Paulo">GMT -03:00 America/Sao_Paulo</option>
							  <option value="America/Scoresbysund">GMT +00:00 America/Scoresbysund</option>
							  <option value="America/Sitka">GMT -08:00 America/Sitka</option>
							  <option value="America/St_Barthelemy">GMT -04:00 America/St_Barthelemy</option>
							  <option value="America/St_Johns">GMT -02:30 America/St_Johns</option>
							  <option value="America/St_Kitts">GMT -04:00 America/St_Kitts</option>
							  <option value="America/St_Lucia">GMT -04:00 America/St_Lucia</option>
							  <option value="America/St_Thomas">GMT -04:00 America/St_Thomas</option>
							  <option value="America/St_Vincent">GMT -04:00 America/St_Vincent</option>
							  <option value="America/Swift_Current">GMT -06:00 America/Swift_Current</option>
							  <option value="America/Tegucigalpa">GMT -06:00 America/Tegucigalpa</option>
							  <option value="America/Thule">GMT -03:00 America/Thule</option>
							  <option value="America/Tijuana">GMT -07:00 America/Tijuana</option>
							  <option value="America/Toronto">GMT -04:00 America/Toronto</option>
							  <option value="America/Tortola">GMT -04:00 America/Tortola</option>
							  <option value="America/Vancouver">GMT -07:00 America/Vancouver</option>
							  <option value="America/Whitehorse">GMT -07:00 America/Whitehorse</option>
							  <option value="America/Winnipeg">GMT -05:00 America/Winnipeg</option>
							  <option value="America/Yakutat">GMT -08:00 America/Yakutat</option>
							  <option value="Antarctica/Casey">GMT +11:00 Antarctica/Casey</option>
							  <option value="Antarctica/Davis">GMT +07:00 Antarctica/Davis</option>
							  <option value="Antarctica/DumontDUrville">GMT +10:00 Antarctica/DumontDUrville</option>
							  <option value="Antarctica/Macquarie">GMT +10:00 Antarctica/Macquarie</option>
							  <option value="Antarctica/Mawson">GMT +05:00 Antarctica/Mawson</option>
							  <option value="Antarctica/McMurdo">GMT +12:00 Antarctica/McMurdo</option>
							  <option value="Antarctica/Palmer">GMT -03:00 Antarctica/Palmer</option>
							  <option value="Antarctica/Rothera">GMT -03:00 Antarctica/Rothera</option>
							  <option value="Antarctica/Syowa">GMT +03:00 Antarctica/Syowa</option>
							  <option value="Antarctica/Troll">GMT +02:00 Antarctica/Troll</option>
							  <option value="Antarctica/Vostok">GMT +06:00 Antarctica/Vostok</option>
							  <option value="Arctic/Longyearbyen">GMT +02:00 Arctic/Longyearbyen</option>
							  <option value="Asia/Aden">GMT +03:00 Asia/Aden</option>
							  <option value="Asia/Almaty">GMT +06:00 Asia/Almaty</option>
							  <option value="Asia/Amman">GMT +03:00 Asia/Amman</option>
							  <option value="Asia/Anadyr">GMT +12:00 Asia/Anadyr</option>
							  <option value="Asia/Aqtau">GMT +05:00 Asia/Aqtau</option>
							  <option value="Asia/Aqtobe">GMT +05:00 Asia/Aqtobe</option>
							  <option value="Asia/Ashgabat">GMT +05:00 Asia/Ashgabat</option>
							  <option value="Asia/Atyrau">GMT +05:00 Asia/Atyrau</option>
							  <option value="Asia/Baghdad">GMT +03:00 Asia/Baghdad</option>
							  <option value="Asia/Bahrain">GMT +03:00 Asia/Bahrain</option>
							  <option value="Asia/Baku">GMT +04:00 Asia/Baku</option>
							  <option value="Asia/Bangkok">GMT +07:00 Asia/Bangkok</option>
							  <option value="Asia/Barnaul">GMT +07:00 Asia/Barnaul</option>
							  <option value="Asia/Beirut">GMT +03:00 Asia/Beirut</option>
							  <option value="Asia/Bishkek">GMT +06:00 Asia/Bishkek</option>
							  <option value="Asia/Brunei">GMT +08:00 Asia/Brunei</option>
							  <option value="Asia/Chita">GMT +09:00 Asia/Chita</option>
							  <option value="Asia/Choibalsan">GMT +08:00 Asia/Choibalsan</option>
							  <option value="Asia/Colombo">GMT +05:30 Asia/Colombo</option>
							  <option value="Asia/Damascus">GMT +03:00 Asia/Damascus</option>
							  <option value="Asia/Dhaka" selected="">GMT +06:00 Asia/Dhaka</option>
							  <option value="Asia/Dili">GMT +09:00 Asia/Dili</option>
							  <option value="Asia/Dubai">GMT +04:00 Asia/Dubai</option>
							  <option value="Asia/Dushanbe">GMT +05:00 Asia/Dushanbe</option>
							  <option value="Asia/Famagusta">GMT +03:00 Asia/Famagusta</option>
							  <option value="Asia/Gaza">GMT +03:00 Asia/Gaza</option>
							  <option value="Asia/Hebron">GMT +03:00 Asia/Hebron</option>
							  <option value="Asia/Ho_Chi_Minh">GMT +07:00 Asia/Ho_Chi_Minh</option>
							  <option value="Asia/Hong_Kong">GMT +08:00 Asia/Hong_Kong</option>
							  <option value="Asia/Hovd">GMT +07:00 Asia/Hovd</option>
							  <option value="Asia/Irkutsk">GMT +08:00 Asia/Irkutsk</option>
							  <option value="Asia/Jakarta">GMT +07:00 Asia/Jakarta</option>
							  <option value="Asia/Jayapura">GMT +09:00 Asia/Jayapura</option>
							  <option value="Asia/Jerusalem">GMT +03:00 Asia/Jerusalem</option>
							  <option value="Asia/Kabul">GMT +04:30 Asia/Kabul</option>
							  <option value="Asia/Kamchatka">GMT +12:00 Asia/Kamchatka</option>
							  <option value="Asia/Karachi">GMT +05:00 Asia/Karachi</option>
							  <option value="Asia/Kathmandu">GMT +05:45 Asia/Kathmandu</option>
							  <option value="Asia/Khandyga">GMT +09:00 Asia/Khandyga</option>
							  <option value="Asia/Kolkata">GMT +05:30 Asia/Kolkata</option>
							  <option value="Asia/Krasnoyarsk">GMT +07:00 Asia/Krasnoyarsk</option>
							  <option value="Asia/Kuala_Lumpur">GMT +08:00 Asia/Kuala_Lumpur</option>
							  <option value="Asia/Kuching">GMT +08:00 Asia/Kuching</option>
							  <option value="Asia/Kuwait">GMT +03:00 Asia/Kuwait</option>
							  <option value="Asia/Macau">GMT +08:00 Asia/Macau</option>
							  <option value="Asia/Magadan">GMT +11:00 Asia/Magadan</option>
							  <option value="Asia/Makassar">GMT +08:00 Asia/Makassar</option>
							  <option value="Asia/Manila">GMT +08:00 Asia/Manila</option>
							  <option value="Asia/Muscat">GMT +04:00 Asia/Muscat</option>
							  <option value="Asia/Nicosia">GMT +03:00 Asia/Nicosia</option>
							  <option value="Asia/Novokuznetsk">GMT +07:00 Asia/Novokuznetsk</option>
							  <option value="Asia/Novosibirsk">GMT +07:00 Asia/Novosibirsk</option>
							  <option value="Asia/Omsk">GMT +06:00 Asia/Omsk</option>
							  <option value="Asia/Oral">GMT +05:00 Asia/Oral</option>
							  <option value="Asia/Phnom_Penh">GMT +07:00 Asia/Phnom_Penh</option>
							  <option value="Asia/Pontianak">GMT +07:00 Asia/Pontianak</option>
							  <option value="Asia/Pyongyang">GMT +09:00 Asia/Pyongyang</option>
							  <option value="Asia/Qatar">GMT +03:00 Asia/Qatar</option>
							  <option value="Asia/Qostanay">GMT +06:00 Asia/Qostanay</option>
							  <option value="Asia/Qyzylorda">GMT +05:00 Asia/Qyzylorda</option>
							  <option value="Asia/Riyadh">GMT +03:00 Asia/Riyadh</option>
							  <option value="Asia/Sakhalin">GMT +11:00 Asia/Sakhalin</option>
							  <option value="Asia/Samarkand">GMT +05:00 Asia/Samarkand</option>
							  <option value="Asia/Seoul">GMT +09:00 Asia/Seoul</option>
							  <option value="Asia/Shanghai">GMT +08:00 Asia/Shanghai</option>
							  <option value="Asia/Singapore">GMT +08:00 Asia/Singapore</option>
							  <option value="Asia/Srednekolymsk">GMT +11:00 Asia/Srednekolymsk</option>
							  <option value="Asia/Taipei">GMT +08:00 Asia/Taipei</option>
							  <option value="Asia/Tashkent">GMT +05:00 Asia/Tashkent</option>
							  <option value="Asia/Tbilisi">GMT +04:00 Asia/Tbilisi</option>
							  <option value="Asia/Tehran">GMT +03:30 Asia/Tehran</option>
							  <option value="Asia/Thimphu">GMT +06:00 Asia/Thimphu</option>
							  <option value="Asia/Tokyo">GMT +09:00 Asia/Tokyo</option>
							  <option value="Asia/Tomsk">GMT +07:00 Asia/Tomsk</option>
							  <option value="Asia/Ulaanbaatar">GMT +08:00 Asia/Ulaanbaatar</option>
							  <option value="Asia/Urumqi">GMT +06:00 Asia/Urumqi</option>
							  <option value="Asia/Ust-Nera">GMT +10:00 Asia/Ust-Nera</option>
							  <option value="Asia/Vientiane">GMT +07:00 Asia/Vientiane</option>
							  <option value="Asia/Vladivostok">GMT +10:00 Asia/Vladivostok</option>
							  <option value="Asia/Yakutsk">GMT +09:00 Asia/Yakutsk</option>
							  <option value="Asia/Yangon">GMT +06:30 Asia/Yangon</option>
							  <option value="Asia/Yekaterinburg">GMT +05:00 Asia/Yekaterinburg</option>
							  <option value="Asia/Yerevan">GMT +04:00 Asia/Yerevan</option>
							  <option value="Atlantic/Azores">GMT +00:00 Atlantic/Azores</option>
							  <option value="Atlantic/Bermuda">GMT -03:00 Atlantic/Bermuda</option>
							  <option value="Atlantic/Canary">GMT +01:00 Atlantic/Canary</option>
							  <option value="Atlantic/Cape_Verde">GMT -01:00 Atlantic/Cape_Verde</option>
							  <option value="Atlantic/Faroe">GMT +01:00 Atlantic/Faroe</option>
							  <option value="Atlantic/Madeira">GMT +01:00 Atlantic/Madeira</option>
							  <option value="Atlantic/Reykjavik">GMT +00:00 Atlantic/Reykjavik</option>
							  <option value="Atlantic/South_Georgia">GMT -02:00 Atlantic/South_Georgia</option>
							  <option value="Atlantic/St_Helena">GMT +00:00 Atlantic/St_Helena</option>
							  <option value="Atlantic/Stanley">GMT -03:00 Atlantic/Stanley</option>
							  <option value="Australia/Adelaide">GMT +09:30 Australia/Adelaide</option>
							  <option value="Australia/Brisbane">GMT +10:00 Australia/Brisbane</option>
							  <option value="Australia/Broken_Hill">GMT +09:30 Australia/Broken_Hill</option>
							  <option value="Australia/Darwin">GMT +09:30 Australia/Darwin</option>
							  <option value="Australia/Eucla">GMT +08:45 Australia/Eucla</option>
							  <option value="Australia/Hobart">GMT +10:00 Australia/Hobart</option>
							  <option value="Australia/Lindeman">GMT +10:00 Australia/Lindeman</option>
							  <option value="Australia/Lord_Howe">GMT +10:30 Australia/Lord_Howe</option>
							  <option value="Australia/Melbourne">GMT +10:00 Australia/Melbourne</option>
							  <option value="Australia/Perth">GMT +08:00 Australia/Perth</option>
							  <option value="Australia/Sydney">GMT +10:00 Australia/Sydney</option>
							  <option value="Europe/Amsterdam">GMT +02:00 Europe/Amsterdam</option>
							  <option value="Europe/Andorra">GMT +02:00 Europe/Andorra</option>
							  <option value="Europe/Astrakhan">GMT +04:00 Europe/Astrakhan</option>
							  <option value="Europe/Athens">GMT +03:00 Europe/Athens</option>
							  <option value="Europe/Belgrade">GMT +02:00 Europe/Belgrade</option>
							  <option value="Europe/Berlin">GMT +02:00 Europe/Berlin</option>
							  <option value="Europe/Bratislava">GMT +02:00 Europe/Bratislava</option>
							  <option value="Europe/Brussels">GMT +02:00 Europe/Brussels</option>
							  <option value="Europe/Bucharest">GMT +03:00 Europe/Bucharest</option>
							  <option value="Europe/Budapest">GMT +02:00 Europe/Budapest</option>
							  <option value="Europe/Busingen">GMT +02:00 Europe/Busingen</option>
							  <option value="Europe/Chisinau">GMT +03:00 Europe/Chisinau</option>
							  <option value="Europe/Copenhagen">GMT +02:00 Europe/Copenhagen</option>
							  <option value="Europe/Dublin">GMT +01:00 Europe/Dublin</option>
							  <option value="Europe/Gibraltar">GMT +02:00 Europe/Gibraltar</option>
							  <option value="Europe/Guernsey">GMT +01:00 Europe/Guernsey</option>
							  <option value="Europe/Helsinki">GMT +03:00 Europe/Helsinki</option>
							  <option value="Europe/Isle_of_Man">GMT +01:00 Europe/Isle_of_Man</option>
							  <option value="Europe/Istanbul">GMT +03:00 Europe/Istanbul</option>
							  <option value="Europe/Jersey">GMT +01:00 Europe/Jersey</option>
							  <option value="Europe/Kaliningrad">GMT +02:00 Europe/Kaliningrad</option>
							  <option value="Europe/Kirov">GMT +03:00 Europe/Kirov</option>
							  <option value="Europe/Kyiv">GMT +03:00 Europe/Kyiv</option>
							  <option value="Europe/Lisbon">GMT +01:00 Europe/Lisbon</option>
							  <option value="Europe/Ljubljana">GMT +02:00 Europe/Ljubljana</option>
							  <option value="Europe/London">GMT +01:00 Europe/London</option>
							  <option value="Europe/Luxembourg">GMT +02:00 Europe/Luxembourg</option>
							  <option value="Europe/Madrid">GMT +02:00 Europe/Madrid</option>
							  <option value="Europe/Malta">GMT +02:00 Europe/Malta</option>
							  <option value="Europe/Mariehamn">GMT +03:00 Europe/Mariehamn</option>
							  <option value="Europe/Minsk">GMT +03:00 Europe/Minsk</option>
							  <option value="Europe/Monaco">GMT +02:00 Europe/Monaco</option>
							  <option value="Europe/Moscow">GMT +03:00 Europe/Moscow</option>
							  <option value="Europe/Oslo">GMT +02:00 Europe/Oslo</option>
							  <option value="Europe/Paris">GMT +02:00 Europe/Paris</option>
							  <option value="Europe/Podgorica">GMT +02:00 Europe/Podgorica</option>
							  <option value="Europe/Prague">GMT +02:00 Europe/Prague</option>
							  <option value="Europe/Riga">GMT +03:00 Europe/Riga</option>
							  <option value="Europe/Rome">GMT +02:00 Europe/Rome</option>
							  <option value="Europe/Samara">GMT +04:00 Europe/Samara</option>
							  <option value="Europe/San_Marino">GMT +02:00 Europe/San_Marino</option>
							  <option value="Europe/Sarajevo">GMT +02:00 Europe/Sarajevo</option>
							  <option value="Europe/Saratov">GMT +04:00 Europe/Saratov</option>
							  <option value="Europe/Simferopol">GMT +03:00 Europe/Simferopol</option>
							  <option value="Europe/Skopje">GMT +02:00 Europe/Skopje</option>
							  <option value="Europe/Sofia">GMT +03:00 Europe/Sofia</option>
							  <option value="Europe/Stockholm">GMT +02:00 Europe/Stockholm</option>
							  <option value="Europe/Tallinn">GMT +03:00 Europe/Tallinn</option>
							  <option value="Europe/Tirane">GMT +02:00 Europe/Tirane</option>
							  <option value="Europe/Ulyanovsk">GMT +04:00 Europe/Ulyanovsk</option>
							  <option value="Europe/Vaduz">GMT +02:00 Europe/Vaduz</option>
							  <option value="Europe/Vatican">GMT +02:00 Europe/Vatican</option>
							  <option value="Europe/Vienna">GMT +02:00 Europe/Vienna</option>
							  <option value="Europe/Vilnius">GMT +03:00 Europe/Vilnius</option>
							  <option value="Europe/Volgograd">GMT +03:00 Europe/Volgograd</option>
							  <option value="Europe/Warsaw">GMT +02:00 Europe/Warsaw</option>
							  <option value="Europe/Zagreb">GMT +02:00 Europe/Zagreb</option>
							  <option value="Europe/Zurich">GMT +02:00 Europe/Zurich</option>
							  <option value="Indian/Antananarivo">GMT +03:00 Indian/Antananarivo</option>
							  <option value="Indian/Chagos">GMT +06:00 Indian/Chagos</option>
							  <option value="Indian/Christmas">GMT +07:00 Indian/Christmas</option>
							  <option value="Indian/Cocos">GMT +06:30 Indian/Cocos</option>
							  <option value="Indian/Comoro">GMT +03:00 Indian/Comoro</option>
							  <option value="Indian/Kerguelen">GMT +05:00 Indian/Kerguelen</option>
							  <option value="Indian/Mahe">GMT +04:00 Indian/Mahe</option>
							  <option value="Indian/Maldives">GMT +05:00 Indian/Maldives</option>
							  <option value="Indian/Mauritius">GMT +04:00 Indian/Mauritius</option>
							  <option value="Indian/Mayotte">GMT +03:00 Indian/Mayotte</option>
							  <option value="Indian/Reunion">GMT +04:00 Indian/Reunion</option>
							  <option value="Pacific/Apia">GMT +13:00 Pacific/Apia</option>
							  <option value="Pacific/Auckland">GMT +12:00 Pacific/Auckland</option>
							  <option value="Pacific/Bougainville">GMT +11:00 Pacific/Bougainville</option>
							  <option value="Pacific/Chatham">GMT +12:45 Pacific/Chatham</option>
							  <option value="Pacific/Chuuk">GMT +10:00 Pacific/Chuuk</option>
							  <option value="Pacific/Easter">GMT -06:00 Pacific/Easter</option>
							  <option value="Pacific/Efate">GMT +11:00 Pacific/Efate</option>
							  <option value="Pacific/Fakaofo">GMT +13:00 Pacific/Fakaofo</option>
							  <option value="Pacific/Fiji">GMT +12:00 Pacific/Fiji</option>
							  <option value="Pacific/Funafuti">GMT +12:00 Pacific/Funafuti</option>
							  <option value="Pacific/Galapagos">GMT -06:00 Pacific/Galapagos</option>
							  <option value="Pacific/Gambier">GMT -09:00 Pacific/Gambier</option>
							  <option value="Pacific/Guadalcanal">GMT +11:00 Pacific/Guadalcanal</option>
							  <option value="Pacific/Guam">GMT +10:00 Pacific/Guam</option>
							  <option value="Pacific/Honolulu">GMT -10:00 Pacific/Honolulu</option>
							  <option value="Pacific/Kanton">GMT +13:00 Pacific/Kanton</option>
							  <option value="Pacific/Kiritimati">GMT +14:00 Pacific/Kiritimati</option>
							  <option value="Pacific/Kosrae">GMT +11:00 Pacific/Kosrae</option>
							  <option value="Pacific/Kwajalein">GMT +12:00 Pacific/Kwajalein</option>
							  <option value="Pacific/Majuro">GMT +12:00 Pacific/Majuro</option>
							  <option value="Pacific/Marquesas">GMT -09:30 Pacific/Marquesas</option>
							  <option value="Pacific/Midway">GMT -11:00 Pacific/Midway</option>
							  <option value="Pacific/Nauru">GMT +12:00 Pacific/Nauru</option>
							  <option value="Pacific/Niue">GMT -11:00 Pacific/Niue</option>
							  <option value="Pacific/Norfolk">GMT +11:00 Pacific/Norfolk</option>
							  <option value="Pacific/Noumea">GMT +11:00 Pacific/Noumea</option>
							  <option value="Pacific/Pago_Pago">GMT -11:00 Pacific/Pago_Pago</option>
							  <option value="Pacific/Palau">GMT +09:00 Pacific/Palau</option>
							  <option value="Pacific/Pitcairn">GMT -08:00 Pacific/Pitcairn</option>
							  <option value="Pacific/Pohnpei">GMT +11:00 Pacific/Pohnpei</option>
							  <option value="Pacific/Port_Moresby">GMT +10:00 Pacific/Port_Moresby</option>
							  <option value="Pacific/Rarotonga">GMT -10:00 Pacific/Rarotonga</option>
							  <option value="Pacific/Saipan">GMT +10:00 Pacific/Saipan</option>
							  <option value="Pacific/Tahiti">GMT -10:00 Pacific/Tahiti</option>
							  <option value="Pacific/Tarawa">GMT +12:00 Pacific/Tarawa</option>
							  <option value="Pacific/Tongatapu">GMT +13:00 Pacific/Tongatapu</option>
							  <option value="Pacific/Wake">GMT +12:00 Pacific/Wake</option>
							  <option value="Pacific/Wallis">GMT +12:00 Pacific/Wallis</option>
							  <option value="UTC">GMT +00:00 UTC</option>
							</select>
						  <label for="Timezone">Timezone</label>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <select class="form-control " name="language" id="language" >
							  <option value="">-- Select One --</option>
								<option value="English" <?php echo ($value2['language']=='English' ?'selected':'' ) ?>>English</option>
								<option value="Bengali" <?php echo ($value2['language']=='Bengali' ?'selected':'' ) ?>>Bengali</option>
							  <option value="Ar">Ar</option>
							  <option value="Arabic">Arabic</option>
							  <option value="Arbic">Arbic</option>
							  <option value="Bengali">Bengali</option>
							  <option value="Chinese">Chinese</option>
							  <option value="English" selected="">English</option>
							  <option value="Español">Español</option>
							  <option value="Greek">Greek</option>
							  <option value="Gujrati">Gujrati</option>
							  <option value="Hebrew">Hebrew</option>
							  <option value="Indonesia">Indonesia</option>
							  <option value="Kannada">Kannada</option>
							  <option value="Khmer">Khmer</option>
							  <option value="Mk">Mk</option>
							  <option value="Romana">Romana</option>
							  <option value="Spanish">Spanish</option>
							  <option value="Srpski">Srpski</option>
							  <option value="Tamil">Tamil</option>
							  <option value="Thai">Thai</option>
							  <option value="Thailand">Thailand</option>
							  <option value="ar">ar</option>
							  <option value="as">as</option>
							  <option value="bangla">bangla</option>
							  <option value="czech">czech</option>
							  <option value="de">de</option>
							  <option value="fa">fa</option>
							  <option value="fghfgkjh">fghfgkjh</option>
							  <option value="français">français</option>
							  <option value="nepali">nepali</option>
							  <option value="peepee">peepee</option>
							  <option value="portuguese">portuguese</option>
							  <option value="português">português</option>
							  <option value="rom">rom</option>
							  <option value="tr">tr</option>
							  <option value="türkish">türkish</option>
							  <option value="Рус">Рус</option>
							  <option value="ខែ្មរ">ខែ្មរ</option>
							</select>
						  <label for="WebSite">Language</label>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <select class="form-control" name="direction" id="direction" >
							  <option value="">-- Select Direction --</option>
                <option value="ltr" <?php echo ($value2['direction']=='ltr' ?'selected':'' ) ?>>LTR</option>
                <option value="rtl" <?php echo ($value2['direction']=='rtl' ?'selected':'' ) ?>>RTL</option>
							  
							</select>
						  <label for="WebSite">Backend Direction</label>
						</div>
				 	</div>
 
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="address"  id="address" value="<?=$value2['company_address']; ?>" placeholder="Company Address" >
						  <label for="CompanyAddress">Company Address</label>
              <span style="color:red;" id="addressErr"></span>
						</div>
				 	</div>
		 
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="page"  id="page" value="<?=$value2['Number_of_data_per_page']; ?>"placeholder="Number of data per page" >
						  <label for="DefaultCurrency">Number of data per page</label>
              <span style="color:red;" id="pageErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <select class="form-control" id="type" name="type">
						  	<option>Select Registration Type</option>
						  	<option value="free" <?php echo ($value2['registration_type']=='free' ?'selected':'' ) ?>>Free</option>
                <option value="Monthly_Subscription" <?php echo ($value2['registration_type']=='Monthly_Subscription' ?'selected':'' ) ?>>Monthly Subscription</option>
						  </select>
						  <label for="RegistrationType">Registration Type</label>
              <span style="color:red;" id="typeErr"></span>
						</div>
				 	</div> 
				 </div>
			</div>
		</div> 
		<div class="card mb-4">
			<div class="card-body">
				<h5>Currency <span>Settings</span></h5>
				<div class="row">
					<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="currency" id="currency" value="$">
						  <label for="RegistrationType">Currency symbol</label>
              <span style="color:red;" id="currencyErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="code" id="code" value="usd">
						  <label for="RegistrationType">Currency code</label>
              <span style="color:red;" id="codeErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="text" class="form-control" name="seperator" id="seperator" value=",">
						  <label for="RegistrationType">Decimal separator</label>
              <span style="color:red;" id="seperatorErr"></span>
						</div>
				 	</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h5>Logo and <span>Favicon</span></h5>
				<div class="row">
					<div class="col-md-4">
				 		<div class="form-floating mb-3">
             
             
						  <input type="file" class="dropify form-control" name="logo" id="logo" data-default-file="<?php echo base_url('Settingphotos/logosPhotos/').$value2['logo'];  ?>">
						  <label for="RegistrationType">Upload Logo</label>
              <span style="color:red;" id="logoErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="file" class="dropify form-control" name="logoLight" id="logoLight" data-default-file="<?php echo base_url('Settingphotos/logosPhotos/').$value2['logoLight'];  ?>">
						  <label for="RegistrationType">Upload Logo (Light)</label>
              <span style="color:red;" id="logoLightErr"></span>
						</div>
				 	</div>
				 	<div class="col-md-4">
				 		<div class="form-floating mb-3">
						  <input type="file" class="dropify form-control" name="favicon" id="favicon" data-default-file="<?php echo base_url('Settingphotos/logosPhotos/').$value2['favicon'];  ?>">
						  <label for="RegistrationType">Upload Favicon (PNG)</label>
              <span style="color:red;" id="faviconErr"></span>

						</div>
				 	</div>
				 	
				</div>
			</div>
		</div>
		<div class=" my-4">
	 		<button type="submit" name="submit" id="submit" class="btn btn-primary rounded-pill">Update</button>
	 	</div>
     <?php endforeach; ?> 
	 </form>



<!-- end new design-->








          <script>
                  $(document).ready(function() {

                    $('#applicationsetting').submit(function(e){

                      e.preventDefault();

                        var nameErr = $('#nameErr');
                        var phoneErr = $('#phoneErr');
                        var siteErr = $('#siteErr');
                        var addressErr = $('#addressErr');
                        var currencyErr = $('#currencyErr');
                        var pageErr = $('#pageErr');
                        var typeErr = $('#typeErr');

                        var id = $('#settingId').val();
                        console.log(id);
                        alert(id);
                        // data: $('#applicationsetting').serialize(),
                        
                        var formData = new FormData(this);
                        console.log(formData);

                    $.ajax({
                        url: "<?php echo base_url('/admin/setting_update/')?>"+id,
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        contentType:false,
                        processData:false,
                        success: function(response)
                        {
      
                            // nameErr.text(response.companyName ? response.companyName.message : '');
                            // phoneErr.text(response.phone ? response.phone.message : '');
                            // siteErr.text(response.website ? response.website.message : '');
                            // addressErr.text(response.address ? response.address.message : '');
                            // currencyErr.text(response.currency ? response.currency.message : '');
                            // pageErr.text(response.page ? response.page.message : '');
                            // typeErr.text(response.type ? response.type.message : '');

                                  if (response.success) 
                                  {
                                    alert(response.message);
                                    // window.location.reload();
                        
                                  }
                        }
                        });
                    });
                    });
                </script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
  <script type="text/javascript">






    $(document).ready(function() {

		$('#applicationsetting').validate({

				rules: {
					
					companyName: {
						required: true,
						
					},
					site: {
						required: true,
						
					},
					phone: {
						required: true,
						
					},
					email: {
						required: true,
						
					},
					timezone: {
						required: true,
						
					},
					language: {
						required: true,
						
					},
					direction: {
						required: true,
						
					},
					address: {
						required: true,
						
					},
					page: {
						required: true,
						
					},
					type: {
						required: true,
						
					},
					seperator: {
						required: true,
						
					},
					logo: {
						required: true,
						
					},
					logoLight: {
						required: true,
						
					},
					favicon: {
						required: true,
						
					},
					
				},

				messages: {
					
					companyName: {
						required: " Please enter a Category Name",
						
					},
					site: {
						required: "Please enter a Bank Account Name",
						
					},
					phone: {
						required: " Please enter a amount",
						
					},
					email: {
						required: " Please enter a reference",
					
					},
					timezone: {
						required: " Please enter a description",
						
					},
					language: {
						required: " Please enter a note",
						
					},
					direction: {
						required: " Please enter a attachment",
						
					},
					address: {
						required: " Please enter a date",
					
					},
					page: {
						required: " Please enter a date",
					
					},
					type: {
						required: " Please enter a date",
					
					},
					currency: {
						required: " Please enter a date",
					
					},
					seperator: {
						required: " Please enter a date",
					
					},
					logo: {
						required: " Please enter a date",
					
					},
					logoLight: {
						required: " Please enter a date",
					
					},
					favicon: {
						required: " Please enter a date",
					
					},
					
				}

		});





      $('.dropify').dropify();
      $('.select2').select2();
  });
  </script>
<?= $this->endSection() ?>