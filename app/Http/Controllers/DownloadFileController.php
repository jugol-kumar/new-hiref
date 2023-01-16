<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class DownloadFileController extends Controller
{
    public function exportWord(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->getCompatibility()->setOoxmlVersion(14);
        $phpWord->getCompatibility()->setOoxmlVersion(15);
        $news =[];
        $targetFile = "./global/uploads/";
        $filename = "hello-world".'.docx';//$news['CompanyDetails']['QuotationCode'].' Quotation For '.$news['CompanyDetails']['CompanyName'].'.docx';

        $section = $phpWord->addSection();
        $section->getStyle()->setBreakType('continuous');
        $header = $section->addHeader();
        $header->headerTop(10);

        $section->addText(htmlspecialchars('Date field:'));
        $section->addField('DATE', array('dateformat' => 'dddd d MMMM yyyy H:mm:ss'), array('PreserveFormat'));

        $section->addText(htmlspecialchars('Page field:'));
        $section->addField('PAGE', array('format' => 'ArabicDash'));

        $section->addText(htmlspecialchars('Number of pages field:'));
        $section->addField('NUMPAGES', array('format' => 'Arabic', 'numformat' => '0,00'), array('PreserveFormat'));


        $section->addImage(public_path('images/avatar.png'), array('align'=>'center' ,'topMargin' => -5));

        $section->addTextBreak(-5);
        $center = $phpWord->addParagraphStyle('p2Style', array('align'=>'center','marginTop' => 1));
        $section->addText('this is my name',array('bold' => true,'underline'=>'single','name'=>'TIMOTHYfont','size' => 14),$center);
        $section->addTextBreak(-.5);

        $section->addText('Tel:    00971-55-25553443 Fax: 00971-55- 2553443',array('name'=>'Times New Roman','size' => 13),$center);
        $section->addTextBreak(-.5);
        $section->addText('Quotation',array('bold' => true,'underline'=>'single','name'=>'Times New Roman','size' => 16),$center);
        $section->addTextBreak(-.5);
        $header = array('size' => 16, 'bold' => true);

// 1. Basic table

        $rows = 10;
        $cols = 5;
        $section->addText(htmlspecialchars('Basic table'), $header);

        $table = $section->addTable();
        for ($r = 1; $r <= 8; $r++) {
            $table->addRow();
            for ($c = 1; $c <= 5; $c++) {
                $table->addCell(1750)->addText(htmlspecialchars("Row {$r}, Cell {$c}"));
            }
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (\Exception $e) {
        }

        return response()->download(storage_path('helloWorld.docx'));
    }

    public function exportWordFile(){
        $templateProcessor = new TemplateProcessor("user-word.docx");
        $templateProcessor->setValue('id', Auth::id());
        $templateProcessor->setValue('name', Auth::user()->name);
    }

    public function exportExcel(){

//        Storage::put(public_path(), )
//            Excel::store(new UsersExport(), public_path());

        return Excel::download(new UsersExport(), 'user-list.xlsx');
    }



}


