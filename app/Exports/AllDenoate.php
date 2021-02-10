<?php

namespace App\Exports;

use App\Models\DenoatePayDetail;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use \Carbon\Carbon;
class AllDenoate implements FromQuery,WithHeadings,WithMapping
{
     /*
	`denoateId`, `denoatePhone`, `projectTable`, `paymentMethodTable`, `moneyValue`, `kickbacks`, `denoateStatus`, `created_at`, `updated_at`
	*/
	use Exportable;

	private $startdate;
	private $enddate;
	public function __construct($startdate,$enddate)
	{
			$this->startdate =$startdate;
			$this->enddate   =$enddate;
	}
   public function query()
    {
			// dd(Carbon::parse($this->startdate)->startOfMonth()->subDay(1) ->format('Y-m-d') .' <=> '. Carbon::parse($this->enddate)->endOfMonth()->addDay(1)->format('Y-m-d'));

			$count =  DenoatePayDetail::query()
				->where('denoateStatus',1)
						->whereBetween( 'created_at',[
							 Carbon::parse($this->startdate)->startOfMonth()->subDay(1)->format('Y-m-d'),
							 Carbon::parse($this->enddate)->endOfMonth()->addDay(1)->format('Y-m-d')
						]);

			if($count->count() == null)
			{
				dd('خطأ	',' عفوا لا توجد نتائج تأكد من صحة  تاريخ البداية او تاريخ النهاية ');
			}
			else
			{
				if($count->count() > 0)
  			{

  				return DenoatePayDetail::query()
  							->where('denoateStatus',1)
  							->whereBetween( 'created_at',[
  								 Carbon::parse($this->startdate)->startOfMonth()->subDay(1)->format('Y-m-d'),
  								 Carbon::parse($this->enddate)->endOfMonth()->addDay(1)->format('Y-m-d')
  							])->orderBy('denoateId','ASC');
  			}
			}



    }


    //headings
     public function headings(): array
    {
        return [
            'المشروع',
            'إسم المتبرع',
            'رقم الهاتف',
            ' مبلغ التبرع',
            '  وسيلة الدفع',
            '   تاريخ الدفع  ',
            '  الحالة',
        ];
    }

     public function map($denoate): array
    {
        return [
            $denoate->projects->projectName,
            $denoate->denoateName,
            $denoate->denoatePhone,
            $denoate->moneyValue,
            $denoate->pmethods->methodName,
            $denoate->created_at->format('Y-m-d'),
            $denoate->denoateStatus==1 ? 'تم الدفع' :'لم يتم الدفع',

        ];
    }
}
