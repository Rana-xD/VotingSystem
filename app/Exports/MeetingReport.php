<?php

namespace App\Exports;

/**
 * Import Model
 */
use App\User;
use App\MeetingUser;
use App\MeetingMaster;
use App\VoterInfo;
use App\VoteMaster;
use App\Vote;
/**
 * Import Excel Concerns 
 */
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;



class MeetingReport implements FromQuery,WithHeadings,WithTitle
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }


    public function headings(): array
    {
        return [
            'username',
            'name',
            'address',
            'number_of_share'

        ];
    }
    public function title(): string
    {
        return 'Vote Users';
    }

    public function query()
    {
		$meeting_user = MeetingUser::where('meeting_uuid','=', $this->uuid)->get();
		
		// build array for fetching user
		$username = array();
		for ($i=0; $i < $meeting_user->count() ; $i++) {
			array_push($username, ($meeting_user[$i]->username));
		}

		$users = new VoterInfo;
        $users = $users->whereIn('username', $username)->select('username','name','address','number_of_share')->get();	

        return VoterInfo::whereIn('username', $username)->select('username','name','address','number_of_share');

    }

}
