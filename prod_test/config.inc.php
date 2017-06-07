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

Description: 
Configuration file for PHPAUTHNET AIM. This file must be in the same
directory as phpauthnet_aim.php
*/
/*********************************************************************/

//Merchant Configuration

$authnet['login']="100041433882"; //authorize.net Username
$authnet['trankey']="SSQZITABMIS/9OPARU0RUFX.E.0VDXCL";     //authorize.net Password


//Authnet Configuration 

$authnet['version']="3.1"; 
$authnet['method']="CC";   
$authnet['type']="AUTH_CAPTURE"; 
$authnet['test']="true";
//Email Configuration 

$authnet['email_header']=""; 
$authnet['email_footer']="";  
$authnet['email_merchant']="";  
$authnet['email_customer']="True"; 


//Environment Configuration

$authnet['url']="https://secure.bluepay.com/gateway/transact.dll";//live url
#$authnet['url']="https://secure.bluepay.com/interfaces/a.net.test";//test url
$authnet['curl_location']="/usr/bin/curl";   //absolute path to Curl on your system
$authnet['useLibCurl']="True";  //Set this to True, if your version of PHP is compiled with libCURL support. 
$authnet['redirect_thankyou']="thankyou.php"; //Thank you Page
$authnet['redirect_declined']="denied.php";     //Denied Page

//Contact Information

$authnet['firstname']="$_POST[firstName]"; 
$authnet['lastname']="$_POST[lastName]";
$authnet['phone']="$_POST[phone]";
$authnet['fax']="$_POST[fax]";
$authnet['address']="$_POST[address1]";
$authnet['address2']="$_POST[address2]";
$authnet['city']="$_POST[city]"; 
$authnet['state']="$_POST[state]";
$authnet['zip']="$_POST[zip]";
$authnet['country']="$_POST[bill_country]";
$authnet['company']="$_POST[company]";
$authnet['email']="$_POST[email]";
$authnet['phone']="$_POST[phone]";
$authnet['fax']="$_POST[fax]";
$authnet['customer_ip']="$HTTP_SERVER_VARS[REMOTE_ADDR]";
$authnet['customer_ssn']="";  

//Transaction Information 
$comb=$_POST[expDateMonth]."/".$_POST[expDateYear];	
$authnet['cardnum']="$_POST[creditCardNumber]";
$authnet['expdate']="$comb";
$authnet['card_code']="$_POST[cvv2Number]";
$authnet['amount']="$_POST[amount]";
$authnet['custid']="$_POST[userID]";
$authnet['invoice_num']="$_POST[invID]";
$authnet['description']="$_POST[description]";
$authnet['transid']="";

//Shipping Information 

$authnet['ship_company']="";
$authnet['ship_firstname']="$_POST[ship_fname]";
$authnet['ship_lastname']="$_POST[ship_lname]";
$authnet['ship_address']="$_POST[ship_address1]";
$authnet['ship_address2']="$_POST[ship_address2]";
$authnet['ship_city']="$_POST[ship_city]";
$authnet['ship_state']="$_POST[ship_state]";
$authnet['ship_zip']="$_POST[ship_zip]";
$authnet['ship_country']="$_POST[ship_country]"; 


//eCheck Information 

$authnet['check_aba_code']="";  //Routing Number
$authnet['check_acct_num']="";  //Account Number
$authnet['check_acct_type']=""; //Account Type (Checking or Savings)
$authnet['check_bank_name']="";  //Name of Bank
$authnet['check_acct_name']=""; //Account Owner
$authnet['check_type']="";         //Default WEB

//Level 2 Data Support 

$authnet['purchase_order_num']=""; 
$authnet['tax']="$_POST[tax]";
$authnet['tax_exempt']="";
$authnet['freight']="$_POST[ship]";
$authnet['duty']="$_POST[ship]";

//Security 

$authnet['md5hash']=""; 

//Merchant Defined Fields (Additional Fields) 

$authnet['md1']="$_POST[sess]";
$authnet['md2']="$_POST[otsID]";
$authnet['md3']="$_POST[instr]";
$authnet['md4']="$_POST[ordID]";
$authnet['md5']="$_POST[company]";
$authnet['md6']="$_POST[ship_company]";
$authnet['md7']="$_POST[ship]";
$authnet['md8']="$_POST[key1]";
$authnet['md9']="$_POST[cardtype]";
?>
