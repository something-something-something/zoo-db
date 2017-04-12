<?php
namespace Fancy{
	function printHeader($db,$title='',$type='home',$subNav='none',$injectHeadHtml=''){
	$headHtml=<<<HEADHTML
	<!doctype html>
	<html>
	<head>
	<title>$title</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="/fancy/css.css" type="text/css" rel="stylesheet">
	$injectHeadHtml
	</head>
HEADHTML;

	$mainNavArr=[];
	if($type==='employee'&&$_SESSION['EMPLID']!==NULL){
		$statmentE=$db->prepare("select position from Employee where employeeID=?");
		$statmentE->bind_param('i',$_SESSION['EMPLID']);
		$statmentE->execute();
		$statmentE->bind_result($emplPos);
		if(!$statmentE->fetch()){
			die('You are not a real employee');
		}
		if($emplPos==='superUser'){
			$mainNavArr=[
			['/employee/index.php','Home'],
			['/employee/animallist.php','Animals'],
			['/employee/employeelist.php','Employees'],
			['/employee/memberslist.php','Members'],
			['/employee/tickets.php','Tickets'],
			['/employee/viewinfo.php','Self'],
			['/loginform.php','Log Out']
			];
		}
	}
	else if($type==='member'){
		$mainNavArr=[
		['/member/index.php','Home'],
		['/member/editmemberform.php','Edit'],
		['/member/getmembershipform.php','Membership'],
		['/member/membershipinfo.php','Purchase History'],
		];
	}
	else{
		$mainNavArr=[['/employee/index.php','Employee'],
		['/member/index.php','Member'],
		['/memregisterform.php','Register']
		];
	}
	$mainNavHtml=navArrToHtml($mainNavArr);
	$bodyHtmlA=<<<BODYHTMLA
	<body>
		<header><div class="headerLogo"><a href="/index.php"><img src="/fancy/logo.png"></a></div><nav>$mainNavHtml</nav></header>
		
BODYHTMLA;

if($subNav!=='none'){
	$bodyHtmlA.='<div class="secondNav">';
	$subNavArr=[];
	if($subNav==='animal'&&$emplPos==='superUser'){
		$subNavArr=[['/employee/animallist.php','Animals'],
		['/employee/createanimalform.php','Create Animal']
		];
	}




	$subNavHtml=navArrToHtml($subNavArr);
	$bodyHtmlA.=$subNavHtml;
	$bodyHtmlA.='</div>';
}

$bodyHtmlB=<<<BODYHTMLB

		<main>
			<h1>$title</h1>
BODYHTMLB;

$bodyHtml=$bodyHtmlA.$bodyHtmlB;
		echo $headHtml.$bodyHtml;
	}

	function printFooter(){
		$footerHtml=<<<FOOTERHTML
				</main>
				<footer>
					&copy; 2017
				</footer>
			</body>
		</html>
FOOTERHTML;
		echo $footerHtml;

	}
	function navArrToHtml($arr){
		$html='';
		foreach($arr as $i){
			$html.='<a href="'.$i[0].'">'.$i[1].'</a>';
		}
		return $html;
	}
	
}

?>