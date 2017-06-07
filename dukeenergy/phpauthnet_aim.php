<?php

/*************************************************
// Program: PHPAUTHNET AIM
// Version: 2.0
// Author: Hasan Robinson 
// Copyright (c) 2002,2003 AuthnetScripts.com
// All rights reserved.
//
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
// "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
// LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
// FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
// REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
// INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
// (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
// SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
// HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
// STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
// OF THE POSSIBILITY OF SUCH DAMAGE.
//
//------------------------------------------------------------------------

Support for PHPAUTHNET AIM:
support@authnetscripts.com

Or, write to:
Sound Commerce
318 W7TH ST. Suite 109
Kansas City, MO 64105

The latest version of PHPAUTHNET AIM can be obtained from:
http://www.authnetscripts.com

*************************************************/

//Include Configuration File

require('./config.inc.php'); 




/**** Authorizenet Login Information ****/

$data .= "x_login=$authnet[login]&";
#$data .= "x_password=$authnet[password]&";
$data .= "x_tran_key=$authnet[trankey]&";


/**** Contact Information ****/

$data .= "x_first_name=$authnet[firstname]&";
$data .= "x_last_name=$authnet[lastname]&";
$data .= "x_phone=$authnet[phone]&";
$data .= "x_fax=$authnet[fax]&";
$data .= "x_address=$authnet[address]&";
$data .= "x_city=$authnet[city]&";
$data .= "x_state=$authnet[state]&";
$data .= "x_zip=$authnet[zip]&";
$data .= "x_country=$authnet[country]&";
$data .= "x_company=$authnet[company]&";
$data .= "x_email=$authnet[email]&";
$data .= "x_customer_ip=$authnet[customer_ip]&"; 
$data .= "x_customer_tax_id=$authnet[customer_ssn]&";


/**** Order Information ****/ 

$data .= "x_card_num=$authnet[cardnum]&";
$data .= "x_exp_date=$authnet[expdate]&";
$data .= "x_card_code=$authnet[card_code]&";
$data .= "x_amount=$authnet[amount]&";
$data .= "x_cust_id=$authnet[custid]&";
$data .= "x_invoice_num=$authnet[invoice_num]&";
$data .= "x_description=$authnet[description]&";
$data .= "x_trans_id=$authnet[transid]&";




/**** Shipping Information ****/ 

$data .= "x_ship_to_company=$authnet[ship_company]&";
$data .= "x_ship_to_first_name=$authnet[ship_firstname]&";
$data .= "x_ship_to_last_name=$authnet[ship_lastname]&";
$data .= "x_ship_to_address=$authnet[ship_address]&";
$data .= "x_ship_to_city=$authnet[ship_city]&";
$data .= "x_ship_to_state=$authnet[ship_state]&";
$data .= "x_ship_to_zip=$authnet[ship_zip]&";
$data .= "x_ship_to_country=$authnet[ship_country]&";



/**** Authorizenet Configuration Defaults ****/ 

$data .= "x_delim_data=true&";
$data .= "x_delim_char=,&";
$data .= "x_adc_delim_data=true&";
$data .= "x_adc_delim_character=,&";
$data .= "x_adc_url=false&";
$data .= "x_relay_response=false&"; 
$data .= "x_version=$authnet[version]&";
$data .= "x_method=$authnet[method]&";
$data .= "x_type=$authnet[type]&";
$data .= "x_test_request=$authnet[test]&";

/**** Email Receipt Configuration ****/

$data .= "x_header_email_receipt=$authnet[email_header]&"; 
$data .= "x_footer_email_receipt=$authnet[email_footer]&"; 
$data .= "x_merchant_email=$authnet[email_merchant]&"; 
$data .= "x_email_customer=$authnet[email_customer]&";

/**** eCheck Information ****/ 

$data .="x_bank_aba_code=$authnet[check_aba_code]&"; 
$data .="x_bank_acct_num=$authnet[check_acct_num]&"; 
$data .="x_bank_acct_type=$authnet[check_acct_type]&"; 
$data .="x_bank_name=$authnet[check_bank_name]&"; 
$data .="x_bank_acct_name=$authnet[check_acct_name]&"; 
$data .="x_echeck_type=$authnet[check_type]&"; 


/**** Level 2 Data Support ****/ 

$data .= "x_po_num=$authnet[purchase_order_num]&";
$data .= "x_tax=$authnet[tax]&";
$data .= "x_tax_exempt=$authnet[tax_exempt]&";
$data .= "x_freight=$authnet[freight]&";
$data .= "x_duty=$authnet[duty]&";


/**** Merchant Defined Fields ****/ 

$data .= "md1=$authnet[md1]&";
$data .= "md2=$authnet[md2]&";
$data .= "md3=$authnet[md3]&";
$data .= "md4=$authnet[md4]&";
$data .= "md5=$authnet[md5]";

//Check to see if the curl extension is loaded 

if(eregi("true",$authnet[useLibCurl])) {


$ch=curl_init(); 

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch,CURLOPT_URL,$authnet['url']); 
curl_setopt($ch,CURLOPT_POST,1); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$data); 

//Start ob to prevent curl_exec from displaying stuff. 
ob_start(); 
curl_exec($ch);

//Get contents of output buffer into the authnet_array. 
$authnet_array=ob_get_contents(); 
curl_close($ch);

//End ob and erase contents.  
ob_end_clean(); 

$authnet_array=split(",",$authnet_array); 

  }
  


  
 

else { 

//If PHP isn't compiled with the curl  library, execute curl via the command line. 

exec("$authnet[curl_location] -d \"$data\" $authnet[url]", $authnet_array);

$authnet_array=explode(",",$authnet_array[0]);

} 


//Split the contents into an array 



$authnet_results=array(
"md5_org"=>"",
"x_response_code"=>"$authnet_array[0]",
"x_response_subcode"=>"$authnet_array[1]",
"x_response_reason_code"=>"$authnet_array[2]",
"x_response_reason_text"=>"$authnet_array[3]",
"x_auth_code"=>"$authnet_array[4]",
"x_avs_code"=>"$authnet_array[5]",
"x_trans_id"=>"$authnet_array[6]",
"x_invoice_num"=>"$authnet_array[7]",
"x_description"=>"$authnet_array[8]",
"x_amount"=>"$authnet_array[9]",
"x_method"=>"$authnet_array[10]",
"x_type"=>"$authnet_array[11]",
"x_cust_id"=>"$authnet_array[12]",
"x_first_name"=>"$authnet_array[13]",
"x_last_name"=>"$authnet_array[14]",
"x_company"=>"$authnet_array[15]",
"x_address"=>"$authnet_array[16]",
"x_city"=>"$authnet_array[17]",
"x_state"=>"$authnet_array[18]",
"x_zip"=>"$authnet_array[19]",
"x_country"=>"$authnet_array[20]",
"x_phone"=>"$authnet_array[21]",
"x_fax"=>"$authnet_array[22]",
"x_email"=>"$authnet_array[23]",
"x_ship_to_first_name"=>"$authnet_array[24]",
"x_ship_to_last_name"=>"$authnet_array[25]",
"x_ship_to_company"=>"$authnet_array[26]",
"x_ship_to_address"=>"$authnet_array[27]",
"x_ship_to_city"=>"$authnet_array[28]",
"x_ship_to_state"=>"$authnet_array[29]",
"x_ship_to_zip"=>"$authnet_array[30]",
"x_ship_to_country"=>"$authnet_array[31]",
"x_tax"=>"$authnet_array[32]",
"x_duty"=>"$authnet_array[33]",
"x_freight"=>"$authnet_array[34]",
"x_tax_exempt"=>"$authnet_array[35]",
"x_po_num"=>"$authnet_array[36]",
"x_md5_hash"=>"$authnet_array[37]",
"x_card_code"=>"$authnet_array[38]",
"x_md1"=>"$authnet_array[68]",
"x_md2"=>"$authnet_array[69]",
"x_md3"=>"$authnet_array[70]",
"x_md4"=>"$authnet_array[71]",
"x_md5"=>"$authnet_array[72]");



/**** Generate MD5 HASH ****/

$authnet_results['md5']=strtoupper(md5("$authnet[md5hash]$authnet[login]$authnet_results[x_trans_id]$authnet[amount]"));


?>


