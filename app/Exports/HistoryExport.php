<?php

namespace App\Exports;

use App\Models\Followup;
use App\Models\History;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class HistoryExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $userId;

    public function __construct($id)
    {
        $this->userId = $id;
    }

    public function query()
    {
        return History::query()
            ->join('followups', 'histories.followup_id', '=', 'followups.id')
            ->join('users', 'histories.user_id', '=', 'users.id')
            ->where('histories.user_id', $this->userId)
            ->select('histories.id', 'histories.detail', 'followups.name', 'users.username');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Detail',
            'Buyer Name',
            'Sales Name',
        ];
    }
}
