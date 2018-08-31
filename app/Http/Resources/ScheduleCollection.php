<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ScheduleCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'employee' => $this->getName($this->emp_id),
            'position' => $this->getPosition($this->emp_id),
            'schedule' => $this->getSchedule($this->schedule, $this->updated_at)
        ];
    }

    public function getName($id)
    {
        $user = \App\Employee::where('id', $id)->first();
        return $user->firstname . ' '. $user->lastname;
    }

    public function getPosition($id)
    {
        $user = \App\Employee::where('id', $id)->first();
        return $user->position->name;
    }

    public function getSchedule($data, $date)
    {
        //return json_decode($data);
        $schedule = json_decode($data);
        $new = [];
        for($i = 0; $i < sizeof($schedule); $i++)
        {
            $d = explode(',', $schedule[$i]);
            if(strtotime(date('Y-m-d', strtotime($d[0]))) >= strtotime(date('Y-m-d', strtotime($date))))
            {
                $new[] = [
                    'date' => $d[0],
                    'shift' => $d[1]
                ];
            }
        }
        return $new;
    }
}
