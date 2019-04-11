<?php

require_once '../../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$id=$_GET['idvenda'];

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $dados = curl_exec($ch);
    curl_close($ch);

    return $dados;
}

$html=file_get_contents("http://localhost/Sistema-Snelis-Estoque/sistema/view/vendas/relatorioVendaPdf.php?idvenda=".$id);

// Instanciamos um objeto da classe DOMPDF.
$pdf = new DOMPDF();
 
// Definimos o tamanho do papel e orientação.
$pdf->set_paper('A4');
//$pdf->set_paper("letter", "portrait");
//$pdf->set_paper(array(0,0,104,250));
 
// Carregar o conteúdo html.
//$pdf->load_html(utf8_decode($html));

//O problema estava na forma como você colocou o encoding. Passei o UFT-8 como parâmetro e não usei como função de encoding.
$pdf->load_html($html, 'UTF-8');

// Renderizar PDF.
$pdf->render();
 
// Enviamos pdf para navegador.
$pdf->stream('relatorioSaida.pdf');