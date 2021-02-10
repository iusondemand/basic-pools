<?php

include("config.php");

$fields = array(

	"data" 									=> "date",
	"buy/sell"								=> "text",
	"wallet (app o exchanger)" 				=> "text",
	"valuta (eur/dollar/crypto)"			=> "text",
	"pagamento (carta/bonifico)" 	=> "text",
	"exchanger" 							=> "text",
	"commissioni exchanger" 				=> "number",
	"fee miners"							=> "number",
	"conversione di mercato"				=> "number",
	"conversione applicata" 				=> "number",
	"note utili" 							=> "textarea"

);


$fields = array(

	"data" 									=> "date",
	"azione (buy/sell/send/receive)"		=> "radio",
	"wallet (app/exchanger)" 				=> "radio",
	"valuta (eur/dollar/crypto)"			=> "radio",
	"nome carta, nome wallet o bonifico" 			=> "text",
	"exchanger" 							=> "text",
	"costi e commissioni"					=> "text",
	"note utili" 							=> "textarea"

);


if (mastrolindo("data") == "") {
	$_REQUEST["data"] = date("Y-m-d");
}

$form = <<<CIAO
	<form method='post' name='pollwallet' id='pollwallet' class='pollwallet'>
	<div class='row'>
	
CIAO;

foreach($fields as $key => $value) {

	$key				= trim($key);
	$req_key 			= str_replace(" ", "_", $key);
	$req_val[$req_key] 	= mastrolindo($req_key);
	
	
	$form.="
		<div class='col s12 m4 l3'>
			<div class='boxblock'>
				<div class='white black-text'>
			
	";
			
	if ($value=="textarea") {

		$form.="
				<label for='$req_key'>$key:</label>
				<textarea name='$req_key' id='$req_key' type=\"$value\">".$req_val[$req_key]."</textarea>
				";
		
		
		
	} elseif ($value=="radio") {

		preg_match('#\((.*?)\)#', $key, $match);
		$form.="
				<label for='$req_key'>$key:</label>
				<br>
				";
		foreach ( explode('/',$match[1]) as $item) {
			$tmp = "";
			if ($req_val[$req_key] == $item) {
				$tmp = " checked ";
			}
			$form.="
				<label><input name='$req_key' type=\"$value\" $tmp value=\"$item\"/><span>$item</span></label>
			";
		}
		
		
		
	} else {

		$form.="
				<label for='$req_key'>$key:</label>
				<input name='$req_key' id='$req_key' type=\"$value\"  value=\"".$req_val[$req_key]."\" />
				";
		
	}
	
	$form.="
			
				</div>
			</div>
		</div>
	";

}

$form.="
	</div>
	<div class='row'>
		<div class='col s12 m4 l3'>
			<div class='boxblock'>
			<div class='amber black-text center'>
			<br>
			<button class=submit>Send</button>
			<br>
			<br>
			</div>
			</div>
		</div>
	</div>

	</form>
";



$style=<<<CIAO

<style>
	.boxblock{padding:5px;min-height:70px;}
	input{margin:0px !important;}
	input[type="radio"]{opacity:1 !important;position:relative !important;left:0px !important;margin:0 3px 0 5px !important;}
	input[type="text"]{background-color:#ddd !important;}
	input[type="date"]{height:40px !important;width:auto !important;}
	label{color:#000000 !important;font-style:italic;}
</style>

CIAO;





$bdy.=<<<CIAO

$style

$form

test

$list

CIAO;



 
$tmptit="Raccolta info su wallet, exchanger, costi, funzionalità";

pubblica ($tmptit,$bdy,"","");


function mastrolindo($key) {
	return trim( strip_tags( stripslashes( $_REQUEST[$key] ) ) );
}

?>