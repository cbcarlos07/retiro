<?php
session_start();

if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}
$codigo = $_POST['codigo'];
//echo "<link rel='shortcut icon' href='img/ham.png'>";
// PRIMEIRAMENTE: INSTALEI A CLASSE NA PASTA FPDF DENTRO DE MEU SITE.
define('FPDF_FONTPATH','fpdf/font/'); 

// INSTALA AS FONTES DO FPDF
require('fpdf/fpdf.php');

// INSTALA A CLASSE FPDF
class PDF extends FPDF {

// CRIA UMA EXTENSÃO QUE SUBSTITUI AS FUNÇÕES DA CLASSE. 
// SOMENTE AS FUNÇÕES QUE ESTÃO DENTRO DESTE EXTENDS É QUE SERÃO SUBSTITUIDAS.


    function Header(){ //CABECALHO
        
        $codigo = "Variavel Codigo";
        global $codigo; // EXEMPLO DE UMA VARIAVEL QUE TERÁ O MESMO VALOR EM QUALQUER ÁREA DO PDF.
        $l=3; // DEFINI ESTA VARIAVEL PARA ALTURA DA LINHA
        $this->SetXY(10,10); // SetXY - DEFINE O X E O Y NA PAGINA
        //$this->Rect(10,10,190,280); // CRIA UM RETÂNGULO QUE COMEÇA NO X = 10, Y = 10 E 
                                    //TEM 190 DE LARGURA E 280 DE ALTURA. 
                                    //NESTE CASO, É UMA BORDA DE PÁGINA.

       // $this->Image('logo.jpg',11,11,40); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
        $this->SetFont('Arial','B',8); // DEFINE A FONTE ARIAL, NEGRITO (B), DE TAMANHO 8


        $this->Ln(); // QUEBRA DE LINHA

        $l = 4;
        $this->SetFont('Arial','B',12);
        $this->SetXY(10,15);
       $this->Cell(0,$l,'FICHA INDIVIDUAL','B',1,'C');

        $this->SetFont('Arial','B',12);

        $this->Ln();



    }

    function Footer(){ // CRIANDO UM RODAPE

        $this->SetXY(15,260);
        //$this->Rect(10,270,190,20);
        $this->SetFont('Arial','',10);
        //$this->Cell(70,8,'Assinatura ','T',0,'L');
        $this->Cell(40,8,' ',0,0,'L');
        //$this->Cell(70,8,'Assinatura','T',0,'L'); 
        $this->Ln();
        $this->SetFont('Arial','',7);
        $this->Cell(190,7,utf8_decode('Página '.$this->PageNo().' de {nb}'),0,0,'L');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Manaus');
        $dia_hoje = date('d');
        $ano_hoje = date('Y');
        $hora_hoje = date('H:i:s');
        $data =  'Manaus, '.ucfirst(gmstrftime('%A')).', '.$dia_hoje.' de '.ucfirst(gmstrftime('%B')).' '.$ano_hoje.' '.$hora_hoje;
        //echo $data;
        
        $this->Cell(0,7,$data,0,0,'R');


    }


}

//CONECTE SE AO BANCO DE DADOS SE PRECISAR 
//include("config.php"); // A MINHA CONEXÃO FICOU EM CONFIG.PHP

           include_once 'controller/Pessoa_Controller.class.php';
           include_once 'services/PessoaListIterator.class.php';;
           include_once 'beans/Pessoa.class.php';
           $pc = new Pessoa_Controller();
           $pessoa = new Pessoa();
           $pessoa = $pc->getPessoa($codigo);



            $pdf=new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
            //$pdf=new PDF('L','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
            $pdf->AddPage(); // ADICIONA UMA PAGINA
            $pdf->AliasNbPages(); // SELECIONA O NUMERO TOTAL DE PAGINAS, USADO NO RODAPE
            $pdf->SetFont('Arial','',8);

                //CAMPOS :
                $pdf->SetFont('Arial','B',10);

                $pdf->SetY(30);
                $pdf->SetX(10);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'CADASTRO No.',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                $pdf->SetY(35);
                $pdf->SetX(10);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'NOME',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                $pdf->SetY(40);
                $pdf->SetX(10);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'DATA NASCIMENTO',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                $pdf->SetY(45);
                $pdf->SetX(10);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'CPF',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                $pdf->SetY(40);
                $pdf->SetX(95);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'E-MAIL',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                $pdf->SetY(45);
                $pdf->SetX(95);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'TELFONE',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                $pdf->SetY(58);
                $pdf->SetX(10);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'VALOR PAGAR',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                $pdf->SetY(58);
                $pdf->SetX(65);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'VALOR PAGO',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                $pdf->SetY(58);
                $pdf->SetX(120);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'VALOR FALTA',0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                $pdf->SetY(58);
                $pdf->SetX(170);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,utf8_decode('CHALÉ?'),0,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA
                $pdf->SetFont('Arial','',10);

                $pdf->SetFont('Arial','',10);




                //DADOS
                $pdf->SetY(30);
                $pdf->SetX(40);
            //    $pdf->Rect(10,$y,20,$l);
                $pdf->MultiCell(20,6,$pessoa->getCodigoPessoa(),0,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                $pdf->SetY(35);
                $pdf->SetX(48);
                //$pdf->Rect(30,$y,80,$l);
                $pdf->MultiCell(100,5,$pessoa->getNmPessoa(),0,'L'); //NOME

                $pdf->SetY(40);
                $pdf->SetX(44);
                //$pdf->Rect(113,$y,16,$l);
                $dataMySQL = explode('-',$pessoa->getDtNascimento());

                $dia = $dataMySQL[2];
                $mes = $dataMySQL[1];
                $ano = $dataMySQL[0];
                $pdf->MultiCell(27,5,$dia.'/'.$mes.'/'.$ano,0,'C',false); ///CPF

                 $pdf->SetY(45);
                 $pdf->SetX(44);
                //$pdf->Rect(129,$y,70,$l);
                 $pdf->MultiCell(35,5,$pessoa->getNrCpf(),0,'C',false); //NASCIMENTO


                $pdf->SetY(40);
                $pdf->SetX(113);
                //$pdf->Rect(129,$y,70,$l);
                $pdf->MultiCell(50,5,$pessoa->getDsEmail(),0,'C',false); //NASCIMENTO

                $pdf->SetY(45);
                $pdf->SetX(114);
                $pdf->MultiCell(35,5,formataTelefone($pessoa->getNrTelefone()),0,'C',false); //NASCIMENTO

                $pdf->SetXY(10,45);
                $pdf->Cell(0,10,'','B',1,'C');

                $pdf->SetY(58);
                $pdf->SetX(30);
                $pdf->MultiCell(35,5,'R$ '.number_format($pessoa->getValorPagar(),2,',','.'),0,'C',false); //NASCIMENTO

                $pdf->SetY(58);
                $pdf->SetX(82);
                $pdf->MultiCell(35,5,'R$ '.number_format($pessoa->getValorPago(),2,',','.'),0,'C',false); //NASCIMENTO

                $pdf->SetY(58);
                $pdf->SetX(137);
                $pdf->MultiCell(35,5,'R$ '.number_format($pessoa->getValorFalta(),2,',','.'),0,'C',false); //NASCIMENTO

                $pdf->SetY(58);
                $pdf->SetX(172);
                $pdf->MultiCell(35,5,$pessoa->getSnChale(),0,'C',false); //NASCIMENTO

$pdf->Footer();
$pdf->Output(); // IMPRIME O PDF NA TELA

Header('Pragma: public'); // ESTA FUNÇÃO É USADA PELO FPDF PARA PUBLICAR NO IE

function contaLinhas($text, $maxwidth){	
	$lines=0;
	if($text==''){
		$cont = 1;
	}else{
		$cont = strlen($text);
	}
	if($cont < $maxwidth){
		$lines = 1;
	}else{
		if($cont % $maxwidth > 0){
			$lines = ($cont / $maxwidth) + 1; 
		}else{
			$lines = ($cont / $maxwidth); 
		}
	} 
	$lines = $lines + substr_count(nl2br($text),'
');
	return $lines;

    }

function formataTelefone($numero){
    if(strlen($numero) == 10){
        $novo = substr_replace($numero, '(', 0, 0);
        $novo = substr_replace($novo, ' ', 3, 0);
        $novo = substr_replace($novo, '-', 8, 0);
        $novo = substr_replace($novo, ')', 3, 0);
    }else{
        $novo = substr_replace($numero, '(', 0, 0);
        $novo = substr_replace($novo, ' ', 3, 0);
        $novo = substr_replace($novo, '-', 9, 0);
        $novo = substr_replace($novo, ')', 3, 0);
    }
    return $novo;


}

