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
			['/employee/deptlist.php','Departments'],
			['/employee/employeelist.php','Employees'],
			['/employee/memberlist.php','Members'],
			['/employee/tickets.php','Tickets'],
			['/employee/hablist.php','Habitats'],
			['/employee/supplieslist.php','Supplies'],
			['/employee/vendorlist.php','Vendor'],
			['/employee/salesreportform.php','Finance'],
			['/employee/viewinfo.php','Self'],
			['/loginform.php','Log Out']
			];
		}
		else if($emplPos==='zooKeeper'){
			$mainNavArr=[
			['/employee/index.php','Home'],
			['/employee/deptanimallist.php','Animals'],
			['/employee/deptsupplieslist.php','Supplies'],
			['/employee/viewinfo.php','Self'],
			['/loginform.php','Log Out']
			];

		}
		else if($emplPos==='ticketSeller'){
			$mainNavArr=[
			['/employee/index.php','Home'],
			['/employee/tickets.php','Tickets'],
			['/employee/viewinfo.php','Self'],
			['/loginform.php','Log Out']
			];
		}
		else{
			$mainNavArr=[
			['/employee/index.php','Home'],
			['/employee/viewinfo.php','Self'],
			['/loginform.php','Log Out']
			];
		}
	}
	else if($type==='member'){
		$mainNavArr=[
		['/member/index.php','Home'],
		['/member/membershipchangepassform.php', 'Change Password'],
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
	else if($subNav==='employee'&&$emplPos==='superUser'){
		$subNavArr=[
		['/employee/employeelist.php','Employees'],
		['/employee/createuserform.php','Create Employee'],
		['/employee/delemployeelist.php','Deleted Employees']
		];
	}
	else if($subNav==='member'&&$emplPos==='superUser'){
		$subNavArr=[
		['/employee/memberlist.php','Members'],
		['/employee/delmemberlist.php','Deleted Members']
		];
	}
	else if($subNav==='hab'&&$emplPos==='superUser'){
		$subNavArr=[
		['/employee/hablist.php','Habitats'],
		['/employee/createhabform.php','Create Habitat']
		];
	}
	else if($subNav==='sup'&&$emplPos==='superUser'){
		$subNavArr=[
		['/employee/supplieslist.php','Supplies'],
		['/employee/createsupplyform.php','Create Supply']
		];
	}	
	else if($subNav==='dept'&&$emplPos==='superUser'){
		$subNavArr=[
		['/employee/deptlist.php','Departments'],
		['/employee/createdepartmentform.php','Create Department']
		];
	}	
	else if($subNav==='vendor'&&$emplPos==='superUser'){
		$subNavArr=[
		['/employee/vendorlist.php','Vendor'],
		['/employee/createvendorform.php','Create Vendor'],
		['/employee/grossvendorsalesform.php','Add Vendor Sale'],
		['/employee/vendorsaleslist.php','View Vendor Sales']
		];
	}
	else if($subNav==='ticket'){
		$subNavArr=[
		['/employee/tickets.php','Ticket'],
		['/employee/membervisits.php','Member visits']
		];
	}	
	else if($subNav==='self'){
		$subNavArr=[['/employee/viewinfo.php','Info'],
		['/employee/editinfoform.php','Edit Info'],
		['/employee/employeechangepassform.php','Change Password'],
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
