<?php


require_once("classes/monetizze.php");

//Instancia a classe
$IntegracaoMonetizze = new monetizzeJogos(7,2);

/*  
* jogos
* 
*/ 

$jogos 		= $IntegracaoMonetizze->jogos(); 

/*  
* sorteios
* 
*/ 
$sorteio 	= $IntegracaoMonetizze->sorteios();

/*  
* resultado
* 
*/
$resultado = $IntegracaoMonetizze->resultados(); 

?>

<html>
<table border =1>
<tr><td colspan=7>Números Sorteados</tr></td>
<tr>
<?php foreach($resultado['sorteio'] as $id=>$result){ ?>
<td><?=$result?></td>
<?php } ?>
</tr>


<?php 

		for($i=0;$i<count($resultado['jogos']);$i++){
		$total_coluna = count($resultado['jogos'][$i]);
?>
<tr><td colspan=<?=$total_coluna?>>Jogos <?=$i+1?></td></tr>
<tr>
<?php			
			for($y=0;$y<count($resultado['jogos'][$i]);$y++){

?>

<td><?=$resultado['jogos'][$i][$y]?></td>
<?php } 
		?>
</tr>

<tr><td colspan=<?=$total_coluna?>> Acerto Jogos <?=$i+1?></td></tr>
<tr>
<?php			
		
?>

<td><?=$resultado['acertos'][$i]?></td>
<?php } 
		?>
</tr>
</table>
</html>