<?php
	include 'Database.php';
	if (isset($_GET['SortBy'])){
		GetDBSayuran($_GET['SortBy']);}
	else{
		GetDBSayuran();}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Masukkan Judul Dokumen</title>
	<link rel="stylesheet" type="text/css" href="res/css/style.css" media="all"/>
	<script language="javascript" type="text/javascript">
	function AddToCart(IdBarang){
		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				alert("Pesanan sedang diproses");
				if (xmlhttp.responseText.trim()=="Betul"){
					alert("Pesanan Diterima");}
				else{
					alert("Jumlah Barang : "+xmlhttp.responseText);}
			}
		}
		var JumlahStr=""+IdBarang;
		var Jumlah=document.getElementById(JumlahStr).value;
		alert("AddToCart.php?action=add&id="+IdBarang+"&Jumlah="+Jumlah+"&Kategori=Sayuran");
		xmlhttp.open("GET","AddToCart.php?action=add&id="+IdBarang+"&Jumlah="+Jumlah+"&Kategori=Sayuran",true);
		xmlhttp.send();
	}
	</script>
</head>
<body>
	
	<div id="container">
		
		<?php include 'header.php'; ?>
		
		
		<!-- Sort Combo Box -->
		<div id="sort-bar" class="frame">
			<div class="kolom-4">&nbsp;</div>
			<button type="button" onClick="location.href='Sayuran.php?SortBy=Nama&f=1&l=10'">Nama</button>
			<button type="button" onClick="location.href='Sayuran.php?SortBy=Harga&f=1&l=10'">Harga</button>
		</div>
		<div id="pagination">
			<ul>
				<?php $n = $_GET["f"];
				  $m = $_GET["l"];
				 $o = $_GET["f"];
				 $p = $_GET["l"];
				  if ($_GET["f"]>10){
					  $o = $_GET["f"]-10;
					  $p = $_GET["l"]-10;
				   ?>
					   
				 <?php }
				 if ($_GET["l"]<count($_SESSION['Search'])){
					   $n = $_GET["f"]+10;
					   $m = $_GET["l"]+10;
				  ?>
				  	
				 <?php }?>
				 <li><a href="search.php?src=<?php echo $SearchQuery ?>&amp;f=<?php echo $o;?>&amp;l=<?php echo $p?>">&laquo;Previous</a></li>
				 <li><a href="search.php?src=<?php echo $SearchQuery ?>&amp;f=<?php echo $n;?>&amp;l=<?php echo $m?>">Next&raquo;</a></li>
				
				
			
			</ul>
		</div>
		<div id="dagangan">
			<!-- Dagangan Baris 1 -->
			<div class="frame">
			<?php $i=0;foreach($_SESSION['Sayuran'] as $Barang) { ?>
				<div class="kolom-6 product">					
					<div class="frame">
						<div class="kolom-6">
							<img class="gambar" src="res/img/product/<?php echo $Barang->GetNamaBarang()?>.jpg" alt=""/>
						</div>
						<div class="kolom-6">
							<p class="nama-produk-b"><a href="detail-barang.php?id=<?php echo $i?>&Kategori=<?php echo $Barang->GetKategori()?>"><?php echo $Barang->GetNamaBarang()?></a></p>
							<p class="harga">Harga: <?php echo $Barang->GetHarga()?> /kg</p>
							<div class="frame buy-bar">
								<input class="kolom-9 buy-box" type="text" id='<?php echo $i?>' name="buy" value="Banyaknya barang.." onfocus="checkclear(this)" onblur="checkempty(this, 'Banyaknya barang..')"> 
								<button class="kolom-1 buy-button" type="button" onClick=AddToCart(<?php echo $i?>)></button>
							</div>
						</div>
					</div>
				</div>
			<?php $i++;
			
				
			
			} ?> 	
			</div>
		</div>
		
	</div>
	
	<!-- Javascript -->
	<script src="res/js/common.js" type="text/javascript"></script>
	
</body>
</html>