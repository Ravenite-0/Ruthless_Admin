<?php
class CreatePDF{
    function ClientPDF($header, $headerWidth, $data)
    {
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true);
        $pdf->SetHeaderData(null,null, "Ruthless Real Estate Client List", '');
        $pdf->setHeaderFont(array('helvetica', '', 20));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED, '', 12);

        $pdf->SetHeaderData("","20", "Ruthless Real Estate Client List", '');
        $pdf->setHeaderFont(array('helvetica', '', 20));

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();

        $pdf->Ln();
        $table = '<table cellpadding="5" cellspacing="5" border="0">';
        $table.='<tr bgcolor="#336888">';
        for($i = 0; $i < sizeof($header); ++$i)
        {
            $table.='<td width="'.$headerWidth[$i].'">'.$header[$i].'</td>';
        }
        $table.="</tr>";

        $rowCount=0;

        foreach($data as $row)
        {
            if($rowCount%2==0)
            {
                $table.='<tr valign="top" bgcolor="#ACC5D3">';
            }
            else
            {
                $table.='<tr valign="top">';
            }
            $table.="<td>$row[CLIENT_ID]</td>";
            $table.="<td>$row[CLIENT_GNAME] $row[CLIENT_FNAME]</td>";
            $table.="<td>$row[CLIENT_STREET],<br>$row[CLIENT_SUBURB], $row[CLIENT_STATE],<br>$row[CLIENT_PC]</td>";
            $table.="<td>$row[CLIENT_EMAIL]</td>";
            $table.="<td>$row[CLIENT_MOBILE]</td>";
            $table.="<td>$row[CLIENT_MAIL]</td>";
            $table.="</tr>";
            $rowCount++;
        }

        $table .= "</table>";
        $pdf->writeHTML($table, false, false, false, false, 'L');

        $saveDir= dirname($_SERVER["SCRIPT_FILENAME"])."/PDFS/";


        if($pdf->Output($saveDir.'Clients.pdf','F'));
        {
            return $table;
        }

        exit();
    }
} 

