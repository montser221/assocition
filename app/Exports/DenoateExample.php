<?php
namespace App\Exports;
use App\Models\DenoatePayDetail;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use \Carbon\Carbon;
class DenoateExample implements   FromQuery, WithMapping ,WithHeadings
{
		use Exportable;
	  private $id;
		private $startdate;
	 	private $enddate;
	 	public function __construct($id, $startdate,$enddate)
	 	{
				$this->id=$id;
	 			$this->startdate =$startdate;
	 			$this->enddate   =$enddate;
	 	}

		public function query()
    {
        $query = DenoatePayDetail::query()
					->where('denoateStatus',1)
        ->where('projectTable','=',$this->id)
        ->whereBetween( 'created_at',[
          	 Carbon::parse($this->startdate)->startOfMonth()->subDay(1)->format('Y-m-d'),
           	 Carbon::parse($this->enddate)->endOfMonth()->addDay(1)->format('Y-m-d')
        ]);
				if($query->count() == null)
  			{
  				dd('خطأ	',' عفوا لا توجد نتائج تأكد من صحة  تاريخ البداية او تاريخ النهاية ');
  			}
  			else
  			{
					if($query->count() > 0)
					{
						// dd( 'start '. Carbon::parse($this->startdate)->startOfMonth()->format('Y-m-d') .' =  end ' .  Carbon::parse($this->enddate)->endOfMonth()->format('Y-m-d') );
							return DenoatePayDetail::query()
								->where('denoateStatus',1)
							->where('projectTable','=',$this->id)
							->whereBetween( 'created_at',[
									 Carbon::parse($this->startdate)->startOfMonth()->subDay(1)->format('Y-m-d'),
									 Carbon::parse($this->enddate)->endOfMonth()->addDay(1)->format('Y-m-d')
							]);
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
