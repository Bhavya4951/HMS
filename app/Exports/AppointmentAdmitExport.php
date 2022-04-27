<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Appointment;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
 use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class AppointmentAdmitExport implements WithDrawings,FromCollection,
WithHeadings,ShouldAutoSize,WithEvents,WithCustomStartCell
{


/**
* @return \Illuminate\Support\Collection
*/

public function collection()
{
return Appointment::select('id','p_name','disease','p_phone','p_email','message','status','a_date','appointment_date')->whereIn('status', ['Rejected', 'Approved','In Progress'])->whereDate('created_at', carbon::today())->get();
}
public function headings(): array
{
return [
    'Id','P_name','Disease','P_Phone','P_Email','Message','Status','A_Date','Appointment Date',
];
}

public function registerEvents(): array
{
return [
    AfterSheet::class    => function(AfterSheet $event) {

        $event->sheet->getDelegate()->getStyle('A1:I1')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


                        
    },
];
}

public function drawings()
{
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('This is my logo');
$drawing->setPath(public_path('/logo.png'));
$drawing->setHeight(90);
$drawing->setCoordinates('C3');

return $drawing;
}

public function startCell(): string
{
return 'A10';
}
}