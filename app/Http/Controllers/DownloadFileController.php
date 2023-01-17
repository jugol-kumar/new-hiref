<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Job;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
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
        $job = Job::with('appliedUsers')->find(\request()->input('job_id'));
        return Excel::download(new UsersExport($job->appliedUsers), now()->format('Y-m-d').'-seeker-list.xlsx');
    }

    public function exportPdf(){
        $job = Job::with('appliedUsers')->find(\request()->input('job_id'));
        $pdf = Pdf::loadView('files.pdf_file', compact('job'));
        return $pdf->download(now()->format('Y-m-d').'-seeker-list.pdf');
    }

    public function downloadSeekerCV(){
        $user = User::with("seeker")->find(\request()->input('user_id'));
        if($user->seeker?->resume != '' && Storage::exists($user->seeker?->resume)){
            return Storage::disk('public')->download($user->seeker->resume, $user->name.".pdf", [
                'ResponseContentType' => 'application/pdf',
            ]);
        }else{
            toast('Not have resume', 'error');
            return back();
        }

    }

}


