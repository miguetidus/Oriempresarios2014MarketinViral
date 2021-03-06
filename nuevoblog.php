<?php
	session_start();

	$site="localhost";
    $user="root";
    $pass="adriana63506474";
    $base="oriempblog";
    
    
    $conection=mysqli_connect($site, $user, $pass, $base) or die ("No has podido establecer conexión con el servidor".mysql_error());
    
    if(mysqli_connect_errno())
    {
        echo("Muy bien hecho, la cagaste");
    }

	@$entriekey=$_GET['key'];

	echo $entriekey;

	if($entriekey!=0){

		$entrieFind="SELECT * FROM entries WHERE entrie_identifier='$entriekey'";
		$entrieSearch=mysqli_query($conection,$entrieFind);
		$entrieRows=mysqli_num_rows($entrieSearch);
		
		while($entrieResult=mysqli_fetch_array($entrieSearch)){
			$entrada=$entrieResult['entrie_title'];
			@$text=$entrieResult['entrie_text'];
			$entrieState=$entrieResult['entrie_state'];
		}

		mysqli_free_result($entrieSearch);
		mysqli_close($conection);
	}	

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1" >
	<title>Sistema Entrada Artículos</title>
	<script src="js/jquery-2.1.1.min.js"></script>
	<link rel="stylesheet" href="nuevoblog.css">
</head>
<body>
	<h1>Sistema Entrada Artículos Blog OriEmpresarios.com</h1>

	<section id="formBlog">
		<form method="POST" id="formBlog" name="formblog" action="uploadblog.php">
			<div id="datosBlog">
				<div>
					<label for="titulo">Entrada</label>
					<input type="text" name="tituloEntrada" id="titulo" maxlength="100" placeholder="Titulo de la Entrada..." value="<?php $entriekey!=0 ? print $entrada:print ""; ?>" >
				</div>				
				<div>
					<label for="articuloDate">Fecha:</label>
					<input type="text" name="articuloDate" id="articuloDate" max-length="31" placeholder="Fecha creación..."/>
				</div>
				
			</div>
			<div id="hiddenInputs">
				<textarea id="hiddenCopyEditable" name="hiddenCopyEditable" style="display:none;"></textarea>
				<input type="hidden" name="entrieIdentifier" id="entrieIdentifier" size="24" value="<?php $entriekey!=0 ? print $entriekey:print ""; ?>" />	
				<input type="hidden" name="entrieState" id="typePub" value="<?php $entriekey!=0 ? print $entrieState:print ""; ?>" />
			</div>
			<div id="datosButtons">	
				<input type="submit" name="pubButton" id="pubButton" value="Publicar" />
				<div id="saveButton">Guardar</div>
			</div>
			
		</form>
	</section>
	<div id="wrapEditor">
	<section id="textFormat">
		<table>
			<tbody>
				<tr>
					<td>
						<button id="backButton" class="genStyle" type="button" title="Cambia el color de fondo"></button>
					</td>
					<td>
						<button id="forwButton" class="genStyle" type="button" title="Cambia el color de fondo"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="buttonSize" title="Cambiar Tamaño de Fuente"></button>
					</td>
					<td>
						<button id="fuente" title="Cambiar Tipo de Fuente"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="colorButton" title="Cambiar Color de Fuente" style="font-family:Comic Sans MS;font-size:1em;color:#B40431;"></button>
					</td>
					<td>
						<button type="button" id="buttonBold" title="Colocar Negrilla Texto Seleccionado"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="buttonStyle" title="Cambiar estilo al texto" style="font-style:italic;font-size:1em;"></button>
					</td>
					<td>
						<button type="button" id="buttonFormat" title="Tipo de parrafo"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="justifyI" title="Justificar a la Izquierda"></button>
					</td>
					<td>
						<button type="button" id="justifyC" title="Justificar al Centro"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="justifyD" title="Justificar a la Derecha"></button>
					</td>
					<td>
						<button type="button" id="buttonIndent" title="Indentar Linea"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="buttonOutdent" title="Quitar Indentación"></button>
					</td>
					<td>
						<button type="button" id="buttonUnderline" title="Subrayar Selección"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="buttonOrder" title="Lista Ordenada"></button>
					</td>
					<td>
						<button type="button" id="buttonUnorder" title="Lista Con Viñetas"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="buttonSup" title="Colocar Exponencial"></button>
					</td>
					<td>
						<button type="button" id="buttonSub" title="Colocar Base"></button>
					</td>
				</tr>
				<tr>
					<td>
						<button type="button" id="buttonLink" title="Insertar Hipervinculo"></button>
					</td>
					<td>
						<button type="button" id="showBoxUp" title="Insertar Imagenes"></button>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	<section id="parentEditor">
		<div id="editor" contenteditable="true" spellcheck="true" designmode="on">
			<?php
				if($entriekey!=0){
					$replaceBrakt=array("<",">");
					$replaceLine=array("[","]");
					$replace=str_replace($replaceLine,$replaceBrakt,$text);
					
					echo "$replace";
				}
			?>
			<p>
				<br />
			</p>
		
		</div>
	</section>
	</div>
	<section id="tableOptions">
		<table>
			<tbody>
				<tr>
					<td>
						<ul id="selFontSize">
						<li><a href="#" id="1">1</a></li>
						<li><a href="#" id="2">2</a></li>
						<li><a href="#" id="3">3</a></li>
						<li><a href="#" id="4">4</a></li>
						<li><a href="#" id="5">5</a></li>
						<li><a href="#" id="6">6</a></li>
						<li><a href="#" id="7">7</a></li>
					</ul>
					</td>
					<td>
					<ul id="selFont">
						<li><a href="#">Georgia</a></li>
						<li><a href="#">Palatino Linotype</a></li>
						<li><a href="#">Book Old Style</a></li>
						<li><a href="#">Times New Roman</a></li>
						<li><a href="#">Garamond</a></li>
						<li><a href="#">Verdana</a></li>
						<li><a href="#">Arial</option>
						<li><a href="#">Arial Black</a></li>
						<li><a href="#">Arial Narrow</a></li>
						<li><a href="#">Comic Sans MS</a></li>
						<li><a href="#">Impact</a></li>
						<li><a href="#">Tahoma</a></li>
						<li><a href="#"> </a></li>
						<li><a href="#">Lucida Sans Unicode</a></li>
						<li><a href="#">Lucida Console</a></li>
						<li><a href="#">Trebuchet MS</a></li>
						<li><a href="#">Courier New</a></li>
					</ul>
				</td>
				<td>
					<div id="fontColor">
						<table>
							<tbody>
								<tr>
									<td bgcolor="#FBEFEF"><img id="#FBEFEF"></td><td bgcolor="#FBF2EF"><img id="#FBF2EF"></td><td bgcolor="#FBF5EF"><img id="#FBF5EF"></td><td bgcolor="#FBF8EF"><img id="#FBF8EF"></td><td bgcolor="#FBFBEF"><img id="#FBFBEF"></td><td bgcolor="#F8FBEF"><img id="#F8FBEF"></td><td bgcolor="#F5FBEF"><img id="#F5FBEF"></td><td bgcolor="#F2FBEF"><img id="#F2FBEF"></td><td bgcolor="#EFFBEF"><img id="#EFFBEF"></td><td bgcolor="#EFFBF2"><img id="#EFFBF2"></td><td bgcolor="#EFFBF5"><img id="#EFFBF5"></td><td bgcolor="#EFFBF8"><img id="#EFFBF8"></td><td bgcolor="#EFFBFB"><img id="#EFFBFB"></td><td bgcolor="#EFF8FB"><img id="#EFF8FB"></td><td bgcolor="#EFF5FB"><img id="#EFF5FB"></td><td bgcolor="#EFF2FB"><img id="#EFF2FB"></td><td bgcolor="#EFEFFB"><img id="#EFEFFB"></td><td bgcolor="#F2EFFB"><img id="#F2EFFB"></td><td bgcolor="#F5EFFB"><img id="#F5EFFB"></td><td bgcolor="#F8EFFB"><img id="#F8EFFB"></td><td bgcolor="#FBEFFB"><img id="#FBEFFB"></td><td bgcolor="#FBEFF8"><img id="#FBEFF8"></td><td bgcolor="#FBEFF5"><img id="#FBEFF5"></td><td bgcolor="#FBEFF2"><img id="#FBEFF2"></td><td bgcolor="#FFFFFF"><img id="#FFFFFF"></td>
								</tr>
								<tr>
									<td bgcolor="#F8E0E0"><img id="#F8E0E0"></td><td bgcolor="#F8E6E0"><img id="#F8E6E0"></td><td bgcolor="#F8ECE0"><img id="#F8ECE0"></td><td bgcolor="#F7F2E0"><img id="#F7F2E0"></td><td bgcolor="#F7F8E0"><img id="#F7F8E0"></td><td bgcolor="#F1F8E0"><img id="#F1F8E0"></td><td bgcolor="#ECF8E0"><img id="#ECF8E0"></td><td bgcolor="#E6F8E0"><img id="#E6F8E0"></td><td bgcolor="#E0F8E0"><img id="#E0F8E0"></td><td bgcolor="#E0F8E6"><img id="#E0F8E6"></td><td bgcolor="#E0F8EC"><img id="#E0F8EC"></td><td bgcolor="#E0F8F1"><img id="#E0F8F1"></td><td bgcolor="#E0F8F7"><img id="#E0F8F7"></td><td bgcolor="#E0F2F7"><img id="#E0F2F7"></td><td bgcolor="#E0ECF8"><img id="#E0ECF8"></td><td bgcolor="#E0E6F8"><img id="#E0E6F8"></td><td bgcolor="#E0E0F8"><img id="#E0E0F8"></td><td bgcolor="#E6E0F8"><img id="#E6E0F8"></td><td bgcolor="#ECE0F8"><img id="#ECE0F8"></td><td bgcolor="#F2E0F7"><img id="#F2E0F7"></td><td bgcolor="#F8E0F7"><img id="#F8E0F7"></td><td bgcolor="#F8E0F1"><img id="#F8E0F1"></td><td bgcolor="#F8E0EC"><img id="#F8E0EC"></td><td bgcolor="#F8E0E6"><img id="#F8E0E6"></td><td bgcolor="#FAFAFA"><img id="#FAFAFA"></td>
								</tr>
								<tr>
									<td bgcolor="#F6CECE"><img id="#F6CECE"></td><td bgcolor="#F6D8CE"><img id="#F6D8CE"></td><td bgcolor="#F6E3CE"><img id="#F6E3CE"></td><td bgcolor="#F5ECCE"><img id="#F5ECCE"></td><td bgcolor="#F5F6CE"><img id="#F5F6CE"></td><td bgcolor="#ECF6CE"><img id="#ECF6CE"></td><td bgcolor="#E3F6CE"><img id="#E3F6CE"></td><td bgcolor="#D8F6CE"><img id="#D8F6CE"></td><td bgcolor="#CEF6CE"><img id="#CEF6CE"></td><td bgcolor="#CEF6D8"><img id="#CEF6D8"></td><td bgcolor="#CEF6E3"><img id="#CEF6E3"></td><td bgcolor="#CEF6EC"><img id="#CEF6EC"></td><td bgcolor="#CEF6F5"><img id="#CEF6F5"></td><td bgcolor="#CEECF5"><img id="#CEECF5"></td><td bgcolor="#CEE3F6"><img id="#CEE3F6"></td><td bgcolor="#CED8F6"><img id="#CED8F6"></td><td bgcolor="#CECEF6"><img id="#CECEF6"></td><td bgcolor="#D8CEF6"><img id="#D8CEF6"></td><td bgcolor="#E3CEF6"><img id="#E3CEF6"></td><td bgcolor="#ECCEF5"><img id="#ECCEF5"></td><td bgcolor="#F6CEF5"><img id="#F6CEF5"></td><td bgcolor="#F6CEEC"><img id="#F6CEEC"></td><td bgcolor="#F6CEE3"><img id="#F6CEE3"></td><td bgcolor="#F6CED8"><img id="#F6CED8"></td><td bgcolor="#F2F2F2"><img id="#F2F2F2"></td>
								</tr>
								<tr>
									<td bgcolor="#F5A9A9"><img id="#F5A9A9"></td><td bgcolor="#F5BCA9"><img id="#F5BCA9"></td><td bgcolor="#F5D0A9"><img id="#F5D0A9"></td><td bgcolor="#F3E2A9"><img id="#F3E2A9"></td><td bgcolor="#F2F5A9"><img id="#F2F5A9"></td><td bgcolor="#E1F5A9"><img id="#E1F5A9"></td><td bgcolor="#D0F5A9"><img id="#D0F5A9"></td><td bgcolor="#BCF5A9"><img id="#BCF5A9"></td><td bgcolor="#A9F5A9"><img id="#A9F5A9"></td><td bgcolor="#A9F5BC"><img id="#A9F5BC"></td><td bgcolor="#A9F5D0"><img id="#A9F5D0"></td><td bgcolor="#A9F5E1"><img id="#A9F5E1"></td><td bgcolor="#A9F5F2"><img id="#A9F5F2"></td><td bgcolor="#A9E2F3"><img id="#A9E2F3"></td><td bgcolor="#A9D0F5"><img id="#A9D0F5"></td><td bgcolor="#A9BCF5"><img id="#A9BCF5"></td><td bgcolor="#A9A9F5"><img id="#A9A9F5"></td><td bgcolor="#BCA9F5"><img id="#BCA9F5"></td><td bgcolor="#D0A9F5"><img id="#D0A9F5"></td><td bgcolor="#E2A9F3"><img id="#E2A9F3"></td><td bgcolor="#F5A9F2"><img id="#F5A9F2"></td><td bgcolor="#F5A9E1"><img id="#F5A9E1"></td><td bgcolor="#F5A9D0"><img id="#F5A9D0"></td><td bgcolor="#F5A9BC"><img id="#F5A9BC"></td><td bgcolor="#E6E6E6"><img id="#E6E6E6"></td>
								</tr>
								<tr>
									<td bgcolor="#F78181"><img id="#F78181"></td><td bgcolor="#F79F81"><img id="#F79F81"></td><td bgcolor="#F7BE81"><img id="#F7BE81"></td><td bgcolor="#F5DA81"><img id="#F5DA81"></td><td bgcolor="#F3F781"><img id="#F3F781"></td><td bgcolor="#D8F781"><img id="#D8F781"></td><td bgcolor="#BEF781"><img id="#BEF781"></td><td bgcolor="#9FF781"><img id="#9FF781"></td><td bgcolor="#81F781"><img id="#81F781"></td><td bgcolor="#81F79F"><img id="#81F79F"></td><td bgcolor="#81F7BE"><img id="#81F7BE"></td><td bgcolor="#81F7D8"><img id="#81F7D8"></td><td bgcolor="#81F7F3"><img id="#81F7F3"></td><td bgcolor="#81DAF5"><img id="#81DAF5"></td><td bgcolor="#81BEF7"><img id="#81BEF7"></td><td bgcolor="#819FF7"><img id="#819FF7"></td><td bgcolor="#8181F7"><img id="#8181F7"></td><td bgcolor="#9F81F7"><img id="#9F81F7"></td><td bgcolor="#BE81F7"><img id="#BE81F7"></td><td bgcolor="#DA81F5"><img id="#DA81F5"></td><td bgcolor="#F781F3"><img id="#F781F3"></td><td bgcolor="#F781D8"><img id="#F781D8"></td><td bgcolor="#F781BE"><img id="#F781BE"></td><td bgcolor="#F7819F"><img id="#F7819F"></td><td bgcolor="#D8D8D8"><img id="#D8D8D8"></td>
								</tr>
								<tr>
									<td bgcolor="#FA5858"><img id="#FA5858"></td><td bgcolor="#FA8258"><img id="#FA8258"></td><td bgcolor="#FAAC58"><img id="#FAAC58"></td><td bgcolor="#F7D358"><img id="#F7D358"></td><td bgcolor="#F4FA58"><img id="#F4FA58"></td><td bgcolor="#D0FA58"><img id="#D0FA58"></td><td bgcolor="#ACFA58"><img id="#ACFA58"></td><td bgcolor="#82FA58"><img id="#82FA58"></td><td bgcolor="#58FA58"><img id="#58FA58"></td><td bgcolor="#58FA82"><img id="#58FA82"></td><td bgcolor="#58FAAC"><img id="#58FAAC"></td><td bgcolor="#58FAD0"><img id="#58FAD0"></td><td bgcolor="#58FAF4"><img id="#58FAF4"></td><td bgcolor="#58D3F7"><img id="#58D3F7"></td><td bgcolor="#58ACFA"><img id="#58ACFA"></td><td bgcolor="#5882FA"><img id="#5882FA"></td><td bgcolor="#5858FA"><img id="#5858FA"></td><td bgcolor="#8258FA"><img id="#8258FA"></td><td bgcolor="#AC58FA"><img id="#AC58FA"></td><td bgcolor="#D358F7"><img id="#D358F7"></td><td bgcolor="#FA58F4"><img id="#FA58F4"></td><td bgcolor="#FA58D0"><img id="#FA58D0"></td><td bgcolor="#FA58AC"><img id="#FA58AC"></td><td bgcolor="#FA5882"><img id="#FA5882"></td><td bgcolor="#BDBDBD"><img id="#BDBDBD"></td>
								</tr>
								<tr>
									<td bgcolor="#FE2E2E"><img id="#FE2E2E"></td><td bgcolor="#FE642E"><img id="#FE642E"></td><td bgcolor="#FE9A2E"><img id="#FE9A2E"></td><td bgcolor="#FACC2E"><img id="#FACC2E"></td><td bgcolor="#F7FE2E"><img id="#F7FE2E"></td><td bgcolor="#C8FE2E"><img id="#C8FE2E"></td><td bgcolor="#9AFE2E"><img id="#9AFE2E"></td><td bgcolor="#64FE2E"><img id="#64FE2E"></td><td bgcolor="#2EFE2E"><img id="#2EFE2E"></td><td bgcolor="#2EFE64"><img id="#2EFE64"></td><td bgcolor="#2EFE9A"><img id="#2EFE9A"></td><td bgcolor="#2EFEC8"><img id="#2EFEC8"></td><td bgcolor="#2EFEF7"><img id="#2EFEF7"></td><td bgcolor="#2ECCFA"><img id="#2ECCFA"></td><td bgcolor="#2E9AFE"><img id="#2E9AFE"></td><td bgcolor="#2E64FE"><img id="#2E64FE"></td><td bgcolor="#2E2EFE"><img id="#2E2EFE"></td><td bgcolor="#642EFE"><img id="#642EFE"></td><td bgcolor="#9A2EFE"><img id="#9A2EFE"></td><td bgcolor="#CC2EFA"><img id="#CC2EFA"></td><td bgcolor="#FE2EF7"><img id="#FE2EF7"></td><td bgcolor="#FE2EC8"><img id="#FE2EC8"></td><td bgcolor="#FE2E9A"><img id="#FE2E9A"></td><td bgcolor="#FE2E64"><img id="#FE2E64"></td><td bgcolor="#A4A4A4"><img id="#A4A4A4"></td>
								</tr>
								<tr>
									<td bgcolor="#FF0000"><img id="#FF0000"></td><td bgcolor="#FF4000"><img id="#FF4000"></td><td bgcolor="#FF8000"><img id="#FF8000"></td><td bgcolor="#FFBF00"><img id="#FFBF00"></td><td bgcolor="#FFFF00"><img id="#FFFF00"></td><td bgcolor="#BFFF00"><img id="#BFFF00"></td><td bgcolor="#80FF00"><img id="#80FF00"></td><td bgcolor="#40FF00"><img id="#40FF00"></td><td bgcolor="#00FF00"><img id="#00FF00"></td><td bgcolor="#00FF40"><img id="#00FF40"></td><td bgcolor="#00FF80"><img id="#00FF80"></td><td bgcolor="#00FFBF"><img id="#00FFBF"></td><td bgcolor="#00FFFF"><img id="#00FFFF"></td><td bgcolor="#00BFFF"><img id="#00BFFF"></td><td bgcolor="#0080FF"><img id="#0080FF"></td><td bgcolor="#0040FF"><img id="#0040FF"></td><td bgcolor="#0000FF"><img id="#0000FF"></td><td bgcolor="#4000FF"><img id="#4000FF"></td><td bgcolor="#8000FF"><img id="#8000FF"></td><td bgcolor="#BF00FF"><img id="#BF00FF"></td><td bgcolor="#FF00FF"><img id="#FF00FF"></td><td bgcolor="#FF00BF"><img id="#FF00BF"></td><td bgcolor="#FF0080"><img id="#FF0080"></td><td bgcolor="#FF0040"><img id="#FF0040"></td><td bgcolor="#848484"><img id="#848484"></td>
								</tr>
								<tr>
									<td bgcolor="#DF0101"><img id="#DF0101"></td><td bgcolor="#DF3A01"><img id="#DF3A01"></td><td bgcolor="#DF7401"><img id="#DF7401"></td><td bgcolor="#DBA901"><img id="#DBA901"></td><td bgcolor="#D7DF01"><img id="#D7DF01"></td><td bgcolor="#A5DF00"><img id="#A5DF00"></td><td bgcolor="#74DF00"><img id="#74DF00"></td><td bgcolor="#3ADF00"><img id="#3ADF00"></td><td bgcolor="#01DF01"><img id="#01DF01"></td><td bgcolor="#01DF3A"><img id="#01DF3A"></td><td bgcolor="#01DF74"><img id="#01DF74"></td><td bgcolor="#01DFA5"><img id="#01DFA5"></td><td bgcolor="#01DFD7"><img id="#01DFD7"></td><td bgcolor="#01A9DB"><img id="#01A9DB"></td><td bgcolor="#0174DF"><img id="#0174DF"></td><td bgcolor="#013ADF"><img id="#013ADF"></td><td bgcolor="#0101DF"><img id="#0101DF"></td><td bgcolor="#3A01DF"><img id="#3A01DF"></td><td bgcolor="#7401DF"><img id="#7401DF"></td><td bgcolor="#A901DB"><img id="#A901DB"></td><td bgcolor="#DF01D7"><img id="#DF01D7"></td><td bgcolor="#DF01A5"><img id="#DF01A5"></td><td bgcolor="#DF0174"><img id="#DF0174"></td><td bgcolor="#DF013A"><img id="#DF013A"></td><td bgcolor="#6E6E6E"><img id="#6E6E6E"></td>
								</tr>
								<tr>
									<td bgcolor="#B40404"><img id="#B40404"></td><td bgcolor="#B43104"><img id="#B43104"></td><td bgcolor="#B45F04"><img id="#B45F04"></td><td bgcolor="#B18904"><img id="#B18904"></td><td bgcolor="#AEB404"><img id="#AEB404"></td><td bgcolor="#86B404"><img id="#86B404"></td><td bgcolor="#5FB404"><img id="#5FB404"></td><td bgcolor="#31B404"><img id="#31B404"></td><td bgcolor="#04B404"><img id="#04B404"></td><td bgcolor="#04B431"><img id="#04B431"></td><td bgcolor="#04B45F"><img id="#04B45F"></td><td bgcolor="#04B486"><img id="#04B486"></td><td bgcolor="#04B4AE"><img id="#04B4AE"></td><td bgcolor="#0489B1"><img id="#0489B1"></td><td bgcolor="#045FB4"><img id="#045FB4"></td><td bgcolor="#0431B4"><img id="#0431B4"></td><td bgcolor="#0404B4"><img id="#0404B4"></td><td bgcolor="#3104B4"><img id="#3104B4"></td><td bgcolor="#5F04B4"><img id="#5F04B4"></td><td bgcolor="#8904B1"><img id="#8904B1"></td><td bgcolor="#B404AE"><img id="#B404AE"></td><td bgcolor="#B40486"><img id="#B40486"></td><td bgcolor="#B4045F"><img id="#B4045F"></td><td bgcolor="#B40431"><img id="#B40431"></td><td bgcolor="#585858"><img id="#585858"></td>
								</tr>
								<tr>
									<td bgcolor="#8A0808"><img id="#8A0808"></td><td bgcolor="#8A2908"><img id="#8A2908"></td><td bgcolor="#8A4B08"><img id="#8A4B08"></td><td bgcolor="#886A08"><img id="#886A08"></td><td bgcolor="#868A08"><img id="#868A08"></td><td bgcolor="#688A08"><img id="#688A08"></td><td bgcolor="#4B8A08"><img id="#4B8A08"></td><td bgcolor="#298A08"><img id="#298A08"></td><td bgcolor="#088A08"><img id="#088A08"></td><td bgcolor="#088A29"><img id="#088A29"></td><td bgcolor="#088A4B"><img id="#088A4B"></td><td bgcolor="#088A68"><img id="#088A68"></td><td bgcolor="#088A85"><img id="#088A85"></td><td bgcolor="#086A87"><img id="#086A87"></td><td bgcolor="#084B8A"><img id="#084B8A"></td><td bgcolor="#08298A"><img id="#08298A"></td><td bgcolor="#08088A"><img id="#08088A"></td><td bgcolor="#29088A"><img id="#29088A"></td><td bgcolor="#4B088A"><img id="#4B088A"></td><td bgcolor="#6A0888"><img id="#6A0888"></td><td bgcolor="#8A0886"><img id="#8A0886"></td><td bgcolor="#8A0868"><img id="#8A0868"></td><td bgcolor="#8A084B"><img id="#8A084B"></td><td bgcolor="#8A0829"><img id="#8A0829"></td><td bgcolor="#424242"><img id="#424242"></td>
								</tr>
								<tr>
									<td bgcolor="#610B0B"><img id="#610B0B"></td><td bgcolor="#61210B"><img id="#61210B"></td><td bgcolor="#61380B"><img id="#61380B"></td><td bgcolor="#5F4C0B"><img id="#5F4C0B"></td><td bgcolor="#5E610B"><img id="#5E610B"></td><td bgcolor="#4B610B"><img id="#4B610B"></td><td bgcolor="#38610B"><img id="#38610B"></td><td bgcolor="#21610B"><img id="#21610B"></td><td bgcolor="#0B610B"><img id="#0B610B"></td><td bgcolor="#0B6121"><img id="#0B6121"></td><td bgcolor="#0B6138"><img id="#0B6138"></td><td bgcolor="#0B614B"><img id="#0B614B"></td><td bgcolor="#0B615E"><img id="#0B615E"></td><td bgcolor="#0B4C5F"><img id="#0B4C5F"></td><td bgcolor="#0B3861"><img id="#0B3861"></td><td bgcolor="#0B2161"><img id="#0B2161"></td><td bgcolor="#0B0B61"><img id="#0B0B61"></td><td bgcolor="#210B61"><img id="#210B61"></td><td bgcolor="#380B61"><img id="#380B61"></td><td bgcolor="#4C0B5F"><img id="#4C0B5F"></td><td bgcolor="#610B5E"><img id="#610B5E"></td><td bgcolor="#610B4B"><img id="#610B4B"></td><td bgcolor="#610B38"><img id="#610B38"></td><td bgcolor="#610B21"><img id="#610B21"></td><td bgcolor="#2E2E2E"><img id="#2E2E2E"></td>
								</tr>
								<tr>
									<td bgcolor="#3B0B0B"><img id="#3B0B0B"></td><td bgcolor="#3B170B"><img id="#3B170B"></td><td bgcolor="#3B240B"><img id="#3B240B"></td><td bgcolor="#3A2F0B"><img id="#3A2F0B"></td><td bgcolor="#393B0B"><img id="#393B0B"></td><td bgcolor="#2E3B0B"><img id="#2E3B0B"></td><td bgcolor="#243B0B"><img id="#243B0B"></td><td bgcolor="#173B0B"><img id="#173B0B"></td><td bgcolor="#0B3B0B"><img id="#0B3B0B"></td><td bgcolor="#0B3B17"><img id="#0B3B17"></td><td bgcolor="#0B3B24"><img id="#0B3B24"></td><td bgcolor="#0B3B2E"><img id="#0B3B2E"></td><td bgcolor="#0B3B39"><img id="#0B3B39"></td><td bgcolor="#0B2F3A"><img id="#0B2F3A"></td><td bgcolor="#0B243B"><img id="#0B243B"></td><td bgcolor="#0B173B"><img id="#0B173B"></td><td bgcolor="#0B0B3B"><img id="#0B0B3B"></td><td bgcolor="#170B3B"><img id="#170B3B"></td><td bgcolor="#240B3B"><img id="#240B3B"></td><td bgcolor="#2F0B3A"><img id="#2F0B3A"></td><td bgcolor="#3B0B39"><img id="#3B0B39"></td><td bgcolor="#3B0B2E"><img id="#3B0B2E"></td><td bgcolor="#3B0B24"><img id="#3B0B24"></td><td bgcolor="#3B0B17"><img id="#3B0B17"></td><td bgcolor="#1C1C1C"><img id="#1C1C1C"></td>
								</tr>
								<tr>
									<td bgcolor="#2A0A0A"><img id="#2A0A0A"></td><td bgcolor="#2A120A"><img id="#2A120A"></td><td bgcolor="#2A1B0A"><img id="#2A1B0A"></td><td bgcolor="#29220A"><img id="#29220A"></td><td bgcolor="#292A0A"><img id="#292A0A"></td><td bgcolor="#222A0A"><img id="#222A0A"></td><td bgcolor="#1B2A0A"><img id="#1B2A0A"></td><td bgcolor="#122A0A"><img id="#122A0A"></td><td bgcolor="#0A2A0A"><img id="#0A2A0A"></td><td bgcolor="#0A2A12"><img id="#0A2A12"></td><td bgcolor="#0A2A1B"><img id="#0A2A1B"></td><td bgcolor="#0A2A22"><img id="#0A2A22"></td><td bgcolor="#0A2A29"><img id="#0A2A29"></td><td bgcolor="#0A2229"><img id="#0A2229"></td><td bgcolor="#0A1B2A"><img id="#0A1B2A"></td><td bgcolor="#0A122A"><img id="#0A122A"></td><td bgcolor="#0A0A2A"><img id="#0A0A2A"></td><td bgcolor="#120A2A"><img id="#120A2A"></td><td bgcolor="#1B0A2A"><img id="#1B0A2A"></td><td bgcolor="#220A29"><img id="#220A29"></td><td bgcolor="#2A0A29"><img id="#2A0A29"></td><td bgcolor="#2A0A22"><img id="#2A0A22"></td><td bgcolor="#2A0A1B"><img id="#2A0A1B"></td><td bgcolor="#2A0A12"><img id="#2A0A12"></td><td bgcolor="#151515"><img id="#151515"></td>
								</tr>
								<tr>
									<td bgcolor="#190707"><img id="#190707"></td><td bgcolor="#190B07"><img id="#190B07"></td><td bgcolor="#191007"><img id="#191007"></td><td bgcolor="#181407"><img id="#181407"></td><td bgcolor="#181907"><img id="#181907"></td><td bgcolor="#141907"><img id="#141907"></td><td bgcolor="#101907"><img id="#101907"></td><td bgcolor="#0B1907"><img id="#0B1907"></td><td bgcolor="#071907"><img id="#071907"></td><td bgcolor="#07190B"><img id="#07190B"></td><td bgcolor="#071910"><img id="#071910"></td><td bgcolor="#071914"><img id="#071914"></td><td bgcolor="#071918"><img id="#071918"></td><td bgcolor="#071418"><img id="#071418"></td><td bgcolor="#071019"><img id="#071019"></td><td bgcolor="#070B19"><img id="#070B19"></td><td bgcolor="#070719"><img id="#070719"></td><td bgcolor="#0B0719"><img id="#0B0719"></td><td bgcolor="#100719"><img id="#100719"></td><td bgcolor="#140718"><img id="#140718"></td><td bgcolor="#190718"><img id="#190718"></td><td bgcolor="#190714"><img id="#190714"></td><td bgcolor="#190710"><img id="#190710"></td><td bgcolor="#19070B"><img id="#19070B"></td><td bgcolor="#000000"><img id="#000000"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
				<td>
					<ul id="pFormat">
						<li><a href="#" id="p">Normal</a></li>
						<li><a href="#" id="h1">Encabezado 1</a></li>
						<li><a href="#" id="h2">Encabezado 2</a></li>
						<li><a href="#" id="h3">Encabezado 3</a></li>
						<li><a href="#" id="h4">Encabezado 4</a></li>
						<li><a href="#" id="h5">Encabezado 5</a></li>				
						<li><a href="#" id="h6">Encabezado 6</a></li>
						<li><a href="#" id="address">Address</a></li>
						<li><a href="#" id="pre">Formateado</a></li>
					</ul>
				</td>
				<td>
					<div id="linkBox">
						<input type="text" id="textLink" size="30" width="30">
						<input type="button" value="Agregar" id="agregar">
					</div>
				</td>
				<td>
					<div id="boxUp">						
						<form action="" method="post" id="imageUpload" enctype="multiparta/form-data">
							<div class="inputsBox">
								<label class="fileLabel"><p>Selecciona una imagen</p>
									<input type="file" class="fileUp" name="fileUp[]" multiple="multiple"/><!--<a href="#" id="plusfile">Añadir otro archivo</a><br />-->
								</label>
								<!--<input type="text" name="" value="" placeholder="">-->
							</div>
							<hr>
							<!--<button type="submit" id="subir" value="Subir Archivos" name="Subir"/>Subir Archivos</button>-->
						</form>						
						<div id="showUploadImage">
						<progress class="imagePrebarr" value="0" max="100" style="width:100px;"></progress>
																
						</div>
						<hr>
						<div class="insertBox">
							<label class="insertLabel"><p>Insertar Imagen</p>
								<button type="button" id="insertImg" title="Insertar Imagenes">Insertar Imagen</button>
							</label>
						</div>
					</div>
				</td>
				</tr>
			</tbody>
		</table>
		
	</section>
	

	<script>

	function blogDate(){
		var nameDay=["Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo"];
		var nameMonth=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
		var date=new Date();
		var year=date.getFullYear(),
			mont=date.getMonth(),
			mes=(mont<10)?'0'+mont:mont,
			montName=nameMonth[mont],
			day=date.getDate(),
			dia=(day<10)?'0'+day:day,
			nameDate=nameDay[date.getDay()-1],
			hour=date.getHours(),
			hora=(hour<10)?'0'+hour:hour,
			min=date.getMinutes(),
			minut=(min<10)?'0'+min:min,
			second=date.getSeconds(),
			seg=(second<10)?'0'+second:second;
		var finalBlogDate=nameDate+"," +dia+" de "+montName+" de "+year+" - "+hora+":"+minut+":"+seg;
		$("#articuloDate").val(finalBlogDate);
		setTimeout("blogDate()",1000);
		return finalBlogDate;
	}
		var finalBlogDate=blogDate();
		//console.log(finalBlogDate);

		function negrilla(){
			var diveditable=document.getElementById("editor");
			document.execCommand("bold",false,false);					
		}
		
		function cursiva(){
			document.execCommand("italic",false,null);
		}
		
		function listen(){
			document.getElementById("buttonSize").addEventListener("click",size,false);
		}
		function listen2(){
			document.getElementById("buttonStyle").addEventListener("click",cursiva,false);
		}
		
		function obtenerEvento(e){
			var evento=e.type;
			if(evento=="click"){
				var eventoTarget=e.target;
				var eventoAttribute=eventoTarget.getAttribute("id");
				
				switch(eventoAttribute){
					case "buttonBold":
						negrilla();
					break;
					
					case "buttonStyle":
						cursiva();
					break;
				}
			
			}
			
		}	
		
		window.onload=function(){
			document.getElementById("textFormat").onclick=obtenerEvento;};
	</script>
	<script>
		$(function(){

			var editorFocus=$("#editor").contentDocument;
		//----------------------------------------
			$("#fuente").click(function(){

				$("#selFont").slideDown(200);
				$("#selFont li a").each(function(){
					$(this).css("font-family",$(this).text());
				});				

				$("#selFont li a").click(function(){
					var valueName=$(this).text();					
					document.execCommand("fontName",false,valueName);
					$("#selFont").slideUp(400);
				});
				$("#selFont").click(function(){
					$("#selFont").slideUp(400);
				});
			});
		//-------------------------------------------------	
			$("#buttonSize").click(function(){
				$("#selFontSize").parent().css("display","block");
				$("#selFontSize").slideDown(200);

				$("#selFontSize li a").click(function(){
					var valueSize=$(this).text();
					document.execCommand("fontSize",false,valueSize);
					$("#selFontSize").slideUp(400);
										
				});	
				$("#selFontSize").click(function(){
					$("#selFontSize").slideUp(400);
				});
				
			});
		//----------------------------------------------------------
		/*$("#backButton").click(function(){
			$("#fontColor").css("left","14.5em").slideDown(200);
			$("#fontColor").attr("id","backColor");
		});
		$("#backColor img").click(function(){
				var valueBack=$(this).attr("id");
				document.execCommand("hiliteColor",false,valueBack);
				$("#backColor").slideUp(200);
				$("#backColor").attr("id","fontColor");
			});*/
		//---------------------------------------------------------------
			$("#colorButton").click(function(){
				$("#fontColor").slideDown(200);

				$("#fontColor img").click(function(){
					var valueColor=$(this).attr("id");
					document.execCommand("foreColor",false,valueColor);
					$("#fontColor").slideUp(200);
				});
				$("#fontColor").click(function(){
					$("#fontColor").slideUp(400);
				});
			});
		//--------------------------------------------------------------
		
			$("#buttonFormat").click(function(){
				$("#pFormat").slideDown(200);
			});

			$("#pFormat a").click(function(){
				var valueFormat=$(this).attr("id");
				document.execCommand("formatBlock",false,valueFormat);
				$("#pFormat").slideUp(200);
			});
			$("#pFormat").click(function(){
					$("#pFormat").slideUp(400);
				});
		//--------------------------------------------------------------------
			$("#justifyI").click(function(){
				document.execCommand("justifyLeft",false,"");
			});
			$("#justifyC").click(function(){
				document.execCommand("justifyCenter",false,"");
			});
			$("#justifyD").click(function(){
				document.execCommand("justifyRight",false,"");
			});
		//--------------------------------------------------------------------
			$("#buttonIndent").click(function(){
				document.execCommand("indent",false,"");
			});
			$("#buttonOutdent").click(function(){
				document.execCommand("outdent",false,"");
			});

		//--------------------------------------------------------------------
			$("#buttonUnderline").click(function(){
				document.execCommand("underline",false,"");
			});
		//--------------------------------------------------------------------
			$("#buttonOrder").click(function(){
				document.execCommand("insertOrderedList",false,"");
			});
			$("#buttonUnorder").click(function(){
				document.execCommand("insertUnorderedList",false,"");
			});
		//--------------------------------------------------------------------
			$("#buttonSup").click(function(){
				document.execCommand("superscript",false,"");
			});
			$("#buttonSub").click(function(){
				document.execCommand("subscript",false,"");
			});
		//--------------------------------------------------------------------
			$("#buttonLink").click(function(){
				$("#linkBox").slideDown(200);				

				var seleccion=document.getSelection().getRangeAt(0);
				//console.log(seleccion);
				$("#agregar").click(function(){
					var url=$("#textLink").val();
					
					var rangeSeleccion=seleccion.extractContents();					
					var stringSel=rangeSeleccion.toString();
					var link=$('<a href="'+url+'" target="_blank">'+rangeSeleccion.textContent+'</a>');
					seleccion.insertNode(link[0]);

					/*var divEditor=$("#editor");
					var url=$("#textLink").val();
					var editorAnchor=document.createElement("a");
					editorAnchor.setAttribute('href', url);
					editorAnchor.innerHTML="video YouTube";
					divEditor.insertNode(editorAnchor[0]);*/

					$("#linkBox").slideUp(200);
					
				});
				$("#linkBox").click(function(){
					$("#linkBox").slideUp(400);
				});
			});
			/*$("#agregar").click(function(){
				var linkValue=$("#textLink").value;
				document.execCommand("createLink",false,linkValue);
				$("#linkBox").slideUp(200);
				console.log(linkValue);
			});*/
		//------------------------------------------------------------------------
			$("#showBoxUp").click(function(){
				$("#boxUp").slideDown(200);
				
			});
			$("#showVideoBoxUp").click(function(){
				$("#videoUp").slideDown(200);
				
			});
		
		
		//-----------Funcion para subir archivos sin recargar la pagina---------------------
			$('body').on('change','.fileUp',function(e){
				e.preventDefault();
				var countImgUpload=$(".fileUp").length;
				//var imageFile=$(".fileUp").files[0];
				
				var formData = new FormData($(this).parents('form')[0]);
								
				/*var ajax=new XMLHttpRequest();
				ajax.upload.addEventListener("progress", showPrecharger, false);
				ajax.addEventListener("load", upLoadFiles, false);

				ajax.open('POST','upload.php');
				ajax.send(formData);*/
				 $.ajax({
		            url: 'upload.php',
		            type: 'POST',
		            data: formData,
		            xhr: function() {
		                var myXhr = $.ajaxSettings.xhr();
		                return myXhr;
		            },
		            
		            success: function (data) {
		               
		                ReadFileUploaded();
		            },
		            
		            cache: false,
		            contentType: false,
		            processData: false
		        });
        		return false;
        		
			});

		//función para insertar pregargadores en el div de show imagesExist
			function showPrecharger(event){
				var showDestiny=$("#showUploadImage");
				var divImagePre=$('<div class="imgBackSel"></div>');
				var imagePre=$('<img src="Image/precarga/logo2014-400px.png" width="100"/>');
				var barraPre=$(".imagePrebarr");
				showDestiny.append(divImagePre);
				divImagePre.append(imagePre);
				divImagePre.append(barraPre);

				var percent = ((event.loaded/100) / event.total)*100;
				$(".imagePrebarr").val(Math.round(percent));
			}

			var imgSrcArray=[];
			var countElement=0;

			function upLoadFiles(event){				

				if(window.File&&window.FileList&&window.FileReader){

					var filePath="userfiles/img/";
					var files = event.target.files; //FileList object
        			var output=document.getElementById('showUploadImage');
        			countFiles=files;
			        for (var i = 0;i<files.length; i++) {
			        	countElement++;
			            var file=files[i];
			            
			            imgSrcArray[imgSrcArray.length]=filePath+files[i].name;
			            
			            if (!file.type.match('image')) continue; 
			            var givFile=filePath+files[i].name;

			            var picReader = new FileReader();
			            picReader.addEventListener("loadend", function (event) {
			                var picFile = event.target;
			                
			                /*var div = document.createElement("div");
			                div.setAttribute("class","imgBackSel");
			                div.innerHTML = "<img class='imgTmp' src='" + givFile + "'width='100'/>";
			               // <div class="imgBackSel"><img class="imgTmp" src="'.$fileSrcShow.'" /></div>
			                output.insertBefore(div, null);	*/	
			            });
			            //Read the image
			            picReader.readAsDataURL(file);
			        }

				}else{
					console.log("upppssss");
				}
				
				
			}
			//fin de function upLoadFiles
			
			document.getElementsByClassName('fileUp')[0].addEventListener('change', upLoadFiles, false);	
			
			function ReadFileUploaded(event){
				var filePath="userfiles/img/";
				var output=document.getElementById('showUploadImage');
				var proveSrc=document.getElementById("showUploadImage");
			    var proveSrcLen=proveSrc.getElementsByTagName("img").length;
			    
				for (var i=proveSrcLen;i<imgSrcArray.length; i++) {
			            var fileArr=imgSrcArray;
			            var givePath=fileArr[i];
			            
			            var div = document.createElement("div");
						div.setAttribute("class","imgBackSel");
						div.innerHTML = "<img class='imgTmp' src='" + fileArr[i] + "'width=''/>";
						// <div class="imgBackSel"><img class="imgTmp" src="'.$fileSrcShow.'" /></div>
						output.insertBefore(div, null);
				}			
				
			}
			
	//-------------------------------------------------------------------------
			/*var inputCount=0;
			$("#plusfile").click(function(){
				inputCount++;
				var newInputfile=$('<input class="fileUp" id=filePlus'+inputCount+' type="file" name="fileUp[]" multiple="multiple"/>');
				$("#inputsBox").append(newInputfile);
			});*/
			
			$('body').on('click','.imgTmp',function(){				
				$(this).toggleClass("imgSelected");	
										
			});	

			function randomId(){
				var stringId="";
				var char="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				for(r=0;r<10;r++){
					var randNum=Math.floor((Math.random()*char.length)+1);
					stringId+=char.charAt(randNum);
				}
				return stringId;
			}

			var imagesIdArray=[];
			function getRandomId(){
				var imagesExist=$("#editor img"),
				imagesCount=imagesExist.length;				

				for(var m=0;m<imagesCount;m++){
					var imagesExistId=imagesExist[m].getAttributeNode("id");
					var imagesExistIdValue=imagesExistId.value;
					imagesIdArray.push(imagesExistIdValue);
				}
				
				return imagesIdArray;
			}

			$("#insertImg").click(function(){
				
				var clasImg=$("#showUploadImage .imgSelected");				
				
				for (var i=0;i<clasImg.length;i++){
					var atribSrc=clasImg[i].src;
					
					
					var randId=randomId();
					var editorImg=$('<p class="separator"><img id="'+randId+'" class="separatorImg" src="'+atribSrc+'" /></p>');
					//var imgIdWdt=$("#ranIdStr").innerWidth();
					//var areaNewImg=$('<map id="separator'+randId+'" name="separator'+randId+'"><area shape="rect" coords="260,170,410,278" href="#"/></map>');
					$("#editor").append(editorImg);
					$("#editor").append("<p></p>");
					//$("#editor .separator").append(areaNewImg);						
					
					//getRandomId();

				}					
							
				//$("#showUploadImage img").attr("src","");
				$("#boxUp").slideUp(200);
				$("#editor").css({"overflow":"scroll","overflow-x":"hidden"});

			});

			
		//------Inicia función que adiciona div para cambiar tamaño de imagen----------------

			$("body").click(function(event){
				
				var divCloneExt=$(".imageResize").length;
				
				var pointerX=event.clientX;
				var pointerY=event.clientY;
				
				var divClone=$('<p class="separatorResize"><span class="resizeLink"><a href="#" name="small">Pequeña</a></span> | <span class="resizeLink"><a href="#" name="medium">Mediana</a></span> | <span class="resizeLink"><a href="#" name="large">Grande</a></span> | <span class="resizeLink"><a href="#" name="extralarge">Extragrande</a></span> | <span class="resizeLink"><a href="#" name="delete">Eliminar</a></span></p>');
				
				var targetTag=event.target;
				var tipoEvent=event.type;
				var attrTarget=targetTag.getAttributeNode("class");
				var attrTargetId=targetTag.getAttributeNode("id");
				var attrTargetWidth=targetTag.getAttributeNode("width");
								
				if(imagesIdArray.indexOf(attrTargetId)!=0){
					
					//clickcount++;
					var imgWidth=$(".separatorImg").innerWidth();
					var imgHeight=$(".separatorImg").innerHeight();

					if(divCloneExt!=1){
						divClone.addClass("imageResize");
						$(targetTag).parents(".separator ").append(divClone);
						
						//divClone.css("left",imgWidth);	
					}else{
						$(".imageResize").remove();
					}			
					//aquí crear el cambio de imagen con el resize link

				}		

				$(".resizeLink a").click(function(){
						var resizeLinkName=$(this).attr("name"),
						editorWidth=$("#editor").width();
						
						switch(resizeLinkName){
							case "small":
							$(".separatorResize").prev().css("width",editorWidth*20/100);							
							break;
							case "medium":
							$(".separatorResize").prev().css("width",editorWidth*40/100);							
							break;
							case "large":
							$(".separatorResize").prev().css("width",editorWidth*60/100);				
							break;
							case "extralarge":
							$(".separatorResize").prev().css("width",editorWidth*80/100);							
							break;
							case "delete":
							$(".separatorResize").prev().remove();							
							break;
						}
					});	
				
			});
		//------Final funcion que adiciona div para cambiar tamaño de imagen----------------	
		//------Función para saber si hay que mostrar la barra de scroll vertical-----------
			$("#editor").scroll(function(){
				if($("#editor").prop('scrollHeight')>$("#editor").height()&&$("#editor img").length!=0)
				{
					var editorHeight=$("#editor").height();
					$("#editor").css("overflow","scroll");
					$("#editor").css("overflow-x","hidden");
				}
			});
			
		//------------------------------------------------------------------------------

			function randomIdEntrie(){				
				var stringId="";
				var char="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				for(r=0;r<16;r++){
					var randNum=Math.floor((Math.random()*char.length)+1);
					stringId+=char.charAt(randNum);
				}
				return stringId;
			}
			
			function identifierRandomEntrie(){
					var dato=new Date();
					var year=dato.getFullYear(),
					mes=dato.getMonth()+1,
					day=dato.getDate();
					var random=randomIdEntrie();
					var dayDate=(day<10)?'0'+day:day;
					var monDate=(mes<10)?'0'+mes:mes;
					var identifier=year+"-"+monDate+"-"+dayDate+"-"+random;
					return identifier;				
			}
			var identifier=identifierRandomEntrie();
			var i=document.getElementById('entrieIdentifier').value;
			if(i==0){
				$("#entrieIdentifier").val(identifier);
			}
			//$("#entrieIdentifier").val(identifier);

			$("#pubButton").click(function(e){
				//e.preventDefault();
				var dataBlog=$("#editor").html();
				var objReplace={
					"<":"[",
					">":"]"
				};
				var newDataBlog=dataBlog.replace(/<|>/g, function(matched){
					return objReplace[matched];
				});
				$("#hiddenCopyEditable").html(newDataBlog);
				//$("#entrieIdentifier").val(identifier);
				$("#typePub").val("Public");
			});

			
		//------------------------------------------------------------------------------
		$("#saveButton").click(function(){

			var dataBlog=$("#editor").html();
				var objReplace={
					"<":"[",
					">":"]"
				};
				var newDataBlog=dataBlog.replace(/<|>/g, function(matched){
					return objReplace[matched];
				});

			$("#hiddenCopyEditable").html(newDataBlog);
			//$("#entrieIdentifier").val(identifier);
			$("#typePub").val("Draft");
			

			/*var titulo=$("#titulo").val(),
			    date=$("#articuloDate").val(),
			    id=$("#entrieIdentifier").val(),
			    blog=$("#hiddenCopyEditable").val();*/
				
				 $.ajax({
		            url: 'saveentries.php',
		            type: 'POST',
		            //data: ('tituloEntrada='+titulo+'&articuloDate='+date+'&articuloId='+id),
		            //data:{'tituloEntrada':titulo, 'articuloDate':date, 'articuloId':id, 'entrieText':blog},		            
		            data: $("form").serialize(),
		            success: function (data) {
		               alert("Listo");
		                
		            },
		            
		            //cache: false,
		           // contentType: false,
		          // processData: false
		        });
        		//return false;
		});
			
	});
	</script>
</body>
</html>