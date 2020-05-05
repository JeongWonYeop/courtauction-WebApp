<?php
$conn = mysqli_connect("localhost","root","apmsetup","courtauction");

$sql = "select * from item_info";
$result = mysqli_query($conn,$sql);
$list = '';
while($row = mysqli_fetch_array($result)){
	if($row['lowest_price'] > 0 && $row['lowest_price'] <= 20000000){
	$list = $list."<li class=\"leftClear filterDiv navbar1\">
	  <a href=\"i_detail_item.php?id={$row['id']}\">
		  <div class=\"titlestyle\" style = \"font-size:1.2em\";>{$row['title']}</div>
		  <div class=\"leftFloat\">
			<img src=\"image\\{$row['imgurl']}\" width=\"150\" height=\"150\" alt=\"\" />
		  </div>
		  <div class=\"leftFloat leftMargin\">
			매각기일 <p style=\"display: inline\">{$row['deadline_date']}</p><br>
			사건번호 <p style=\"display: inline\">{$row['number']}</p><br>
			감정가 <p style=\"display: inline\">{$row['appraisal_price']}</p><br>
			최저가 <p style=\"display: inline\">{$row['lowest_price']}</p><br>
			용도 <p style=\"display: inline\">{$row['use_sort']}</p><br>
			건물면적 <p style=\"display: inline\">{$row['building_area']}</p><br>
			토지면적 <p style=\"display: inline\">{$row['land_area']}</p><br>
		  </div>
	  </a>
  </li>";
  

}

	else if($row['lowest_price'] > 20000000 && $row['lowest_price'] <= 50000000){
	$list = $list."<li class=\"leftClear filterDiv navbar2\">
	  <a href=\"i_detail_item.php?id={$row['id']}\">
		  <div class=\"titlestyle\" style = \"font-size:1.2em\";>{$row['title']}</div>
		  <div class=\"leftFloat\">
			<img src=\"image\\{$row['imgurl']}\" width=\"150\" height=\"150\" alt=\"\" />
		  </div>
		  <div class=\"leftFloat leftMargin\">
			매각기일 <p style=\"display: inline\">{$row['deadline_date']}</p><br>
			사건번호 <p style=\"display: inline\">{$row['number']}</p><br>
			감정가 <p style=\"display: inline\">{$row['appraisal_price']}</p><br>
			최저가 <p style=\"display: inline\">{$row['lowest_price']}</p><br>
			용도 <p style=\"display: inline\">{$row['use_sort']}</p><br>
			건물면적 <p style=\"display: inline\">{$row['building_area']}</p><br>
			토지면적 <p style=\"display: inline\">{$row['land_area']}</p><br>
		  </div>
	  </a>
  </li>";
  

}
	else if($row['lowest_price'] > 50000000 && $row['lowest_price'] <= 100000000){
	$list = $list."<li class=\"leftClear filterDiv navbar3\">
	  <a href=\"i_detail_item.php?id={$row['id']}\">
		  <div class=\"titlestyle\" style = \"font-size:1.2em\";>{$row['title']}</div>
		  <div class=\"leftFloat\">
			<img src=\"image\\{$row['imgurl']}\" width=\"150\" height=\"150\" alt=\"\" />
		  </div>
		  <div class=\"leftFloat leftMargin\">
			매각기일 <p style=\"display: inline\">{$row['deadline_date']}</p><br>
			사건번호 <p style=\"display: inline\">{$row['number']}</p><br>
			감정가 <p style=\"display: inline\">{$row['appraisal_price']}</p><br>
			최저가 <p style=\"display: inline\">{$row['lowest_price']}</p><br>
			용도 <p style=\"display: inline\">{$row['use_sort']}</p><br>
			건물면적 <p style=\"display: inline\">{$row['building_area']}</p><br>
			토지면적 <p style=\"display: inline\">{$row['land_area']}</p><br>
		  </div>
	  </a>
  </li>";
  

}
	else if($row['lowest_price'] > 1000000000 ){
	$list = $list."<li class=\"leftClear filterDiv navbar4\">
	  <a href=\"i_detail_item.php?id={$row['id']}\">
		  <div class=\"titlestyle\" style = \"font-size:1.2em\";>{$row['title']}</div>
		  <div class=\"leftFloat\">
			<img src=\"image\\{$row['imgurl']}\" width=\"150\" height=\"150\" alt=\"\" />
		  </div>
		  <div class=\"leftFloat leftMargin\">
			매각기일 <p style=\"display: inline\">{$row['deadline_date']}</p><br>
			사건번호 <p style=\"display: inline\">{$row['number']}</p><br>
			감정가 <p style=\"display: inline\">{$row['appraisal_price']}</p><br>
			최저가 <p style=\"display: inline\">{$row['lowest_price']}</p><br>
			용도 <p style=\"display: inline\">{$row['use_sort']}</p><br>
			건물면적 <p style=\"display: inline\">{$row['building_area']}</p><br>
			토지면적 <p style=\"display: inline\">{$row['land_area']}</p><br>
		  </div>
	  </a>
  </li>";
  

}
	


}
?>


<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>매물보기</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<style>
	
.filterDiv {

  display: none;
}

.show {
  display: block;
}


	</style>
</head>

<body>
	<div data-role="page" id="i_item_list">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image/로고.png" alt="" width="50" height="50" margin="0"/>매물보기</h1>
			<a href="i_menu.html" data-icon="back">back</a>
			<a href="i_menu.html" data-icon="grid" data-transition="slide">menu</a>
			<div data-role="navbar">
				<ul>
					<li onclick="filterSelection('all')"><a href="#">모든 매물</a></li>
					<li onclick="filterSelection('navbar1')"><a href="#">0~2천만원</a></li>
					<li onclick="filterSelection('navbar2')"><a href="#">2천~5천만원</a></li>
					<li onclick="filterSelection('navbar3')"><a href="#">5천~1억</a></li>
					<li onclick="filterSelection('navbar4')"><a href="#">1억 이상</a></li>
				</ul>
			</div>
    </div>
    <div data-role="content" class="center">
	
	
	<?=$list?>

	  
    </div>
    <div data-role="footer" data-position="fixed">
    </div>
  </div>
  
  

<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>

  
</body>
</html>
