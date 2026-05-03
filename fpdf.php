<?php
class FPDF
{
    function __construct($orientation='P', $unit='mm', $size='A4') {}
    function AddPage() {}
    function SetFont($a, $b='', $c=12) {}
    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='') {
        echo htmlspecialchars($txt) . " | ";
    }
    function Output($dest='', $name='', $isUTF8=false) {
        echo "<br><br><b>Simulacion de PDF generado:</b> $name";
    }
    function SetTextColor($r, $g=-1, $b=-1) {}
    function SetFillColor($r, $g=-1, $b=-1) {}
    function Ln($h=null) { echo "<br>"; }
    function AliasNbPages($alias='{nb}') {}
    function PageNo() { return 1; }
    function SetY($y, $resetX=true) {}
}
?>