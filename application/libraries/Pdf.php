<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Incluimos el archivo fpdf
require_once APPPATH."/third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FPDF {
		public function __construct() {
				parent::__construct();
		}
		// El encabezado del PDF
		public function Header(){
				$this->Image('resources/i/logo-corto.png',10,15,30);
				$this->SetFont('Arial','',12);
				$this->ln(12);
				date_default_timezone_set("America/Argentina/Buenos_Aires");
				$this->Cell(0,10,date('j\/m\/Y \a \l\a\s H:i \h\s'/*, time() - 10800*/),'B',1,'R');
				$this->Ln(10);
	 }

	 // El pie del pdf
	 public function Footer(){
			 $this->SetY(-15);
			 $this->SetFont('Arial','I',8);
			 $this->Cell(0,
									 10,
									 'Este documento fue generado automáticamente por el sistema de gestión del Campus Virtual',
									 0,
									 0,
									 'C');
	}


	// Cuerpo del formulario de creación de aula
	public function EjemploBase()
	{
																	/****************************
																	 **CONFIGURACION DE PAGINA **
																	 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/

		// Creacion del PDF Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
		// heredó todos las variables y métodos de fpdf
		$this->pdf = new Pdf();

		// Agregamos una página
		$this->pdf->AddPage();

		// Se define el nombre del archivo,
		// márgenes izquierdo, derecho,
		// el color de relleno de celda predeterminado y
		// el color de lineas predeterminado
		$this->pdf->SetTitle(urldecode('Solicitud de creaci%F3n de aula'));
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(230,230,230);
		$this->pdf->SetDrawColor(200,200,200);


																	/*************************
																	 **TITULO DEL DOCUMENTO **
																	 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/

		//Defino color y fuente para el titulo
		$this->pdf->SetTextColor(0,204,255);
		$this->pdf->SetFont(/*fuente*/ 'Arial',
												/*estilo: B|I|U*/ 'B',
												/*tamaño*/ 16);

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Solicitud de creación de aula virtual',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1, /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');


																	/*************************
																	 **CUERPO DEL DOCUMENTO **
																	 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/

		//Defino color y fuente para el cuerpo
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFont(/*fuente*/ 'Arial', /*estilo: B|I|U*/ '', /*tamaño*/ 10);

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Para: Dirección del Campus Virtual ',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'De: Director de Carrera solicitante:',
										 /*borde: 0|1|T|R|L|B*/ 'B',
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Ln(3);

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Nombre del aula:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Departamento:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Carrera:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'E-mail del Director de la Carrera:',
										 /*borde: 0|1|T|R|L|B*/ 'B',
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Ln(3);

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Docente:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 120,
										 /*alto*/ 10,
										 /*texto*/ 'E-mail:   ',
										 /*borde: 0|1|T|R|L|B*/ 'B',
										 /*nueva linea: 0|1/2*/ 0,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'DNI:   ',
										 /*borde: 0|1|T|R|L|B*/ 'B',
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Ln(3);

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Breve descripción del uso que se le dará al aula:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->MultiCell(/*ancho*/ 0,
													/*alto*/ 10,
													/*texto*/ '',
													/*borde: 0|1|T|R|L|B*/ 1,
													/*Aliniacion: L|C|R*/ 'L',
													/*fondo-coloreado*/ false);

		$this->pdf->Ln(3);

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Modalidad que se implementará en el aula:',
										 /*borde: 0|1|T|R|L|B*/ 'B',
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Ln(3);

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Asignatura:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 60,
										 /*alto*/ 10,
										 /*texto*/ 'Carga horaria total:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 0,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 60,
										 /*alto*/ 10,
										 /*texto*/ 'Horas presenciales:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 0,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Horas virtuales:',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Ln(20);

		$this->pdf->Cell(/*ancho*/ 100,
										 /*alto*/ 10,
										 /*texto*/ 'Firma del Director de la Carrera :  _________',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 0,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');

		$this->pdf->Cell(/*ancho*/ 0,
										 /*alto*/ 10,
										 /*texto*/ 'Firma del Director de Departamento:  _________',
										 /*borde: 0|1|T|R|L|B*/ 0,
										 /*nueva linea: 0|1/2*/ 1,
										 /*Aliniacion: L|C|R*/ 'L',
										 /*fondo-coloreado*/ false,
										 /*link*/ '');


		//I: Imprime el pdf en la pantalla del navegador
		//D: Descarga el pdf en la PC
		ob_end_clean();
		$this->pdf->Output("prueba1.pdf", 'I');
		ob_end_flush();
	}












}
?>;

<!--   PLANTILLA DOCUMENTADA DE LAS FUNCIONES MAS USADAS

				 $this->pdf->Cell(/*ancho*/ 0,
													/*alto*/ 0,
													/*texto*/ '',
													/*borde: 0|1|T|R|L|B*/ 0,
													/*nueva linea: 0|1/2*/ 1,
													/*Aliniacion: L|C|R*/ 'L',
													/*fondo-coloreado*/ false,
													/*link*/ '');

				 $this->pdf->SetFont(/*fuente*/ 'Arial',
														 /*estilo: B|I|U*/ '',
														 /*tamaño*/ 9);

				 $this->pdf->Ln(/*altura, default: altura anterior*/ 20);


 INFO: PARA ADJUNTAR EL PDF A UN MAIL CON PHPMAILER

					$mail = new PHPMailer();
					...
					$doc = $pdf->Output('S');
					$mail->AddStringAttachment($doc, 'doc.pdf', 'base64', 'application/pdf');
					$mail->Send();


CODIFICACION DE CARACTERES ESPECIALES. USAR EN COMBINACION CON LA FUNCION urldecode()

@ -> %40         ` -> %60         ¢ -> %A2         £ -> %A3         ¥ -> %A5         | -> %A6         « -> %AB         ¬ -> %AC         ¯ -> %AD         º -> %B0         ± -> %B1         ª -> %B2         µ -> %B5         » -> %BB         ¼ -> %BC         ½ -> %BD         ¿ -> %BF         À -> %C0         Á -> %C1         Â -> %C2         Ã -> %C3         Ä -> %C4         Å -> %C5         Æ -> %C6         Ç -> %C7         È -> %C8         É -> %C9         Ê -> %CA         Ë -> %CB         Ì -> %CC         Í -> %CD         Î -> %CE         Ï -> %CF         Ð -> %D0         Ñ -> %D1         Ò -> %D2         Ó -> %D3         Ô -> %D4         Õ -> %D5         Ö -> %D6         Ø -> %D8         Ù -> %D9         Ú -> %DA         Û -> %DB         Ü -> %DC         Ý -> %DD         Þ -> %DE         ß -> %DF         à -> %E0         á -> %E1         â -> %E2         ã -> %E3         ä -> %E4         å -> %E5         æ -> %E6         ç -> %E7         è -> %E8         é -> %E9         ê -> %EA         ë -> %EB         ì -> %EC         í -> %ED         î -> %EE         ï -> %EF         ð -> %F0         ñ -> %F1         ò -> %F2         ó -> %F3         ô -> %F4         õ -> %F5         ö -> %F6         ÷ -> %F7         ø -> %F8         ù -> %F9         ú -> %FA         û -> %FB         ü -> %FC         ý -> %FD         þ -> %FE         ÿ -> %FF
-->