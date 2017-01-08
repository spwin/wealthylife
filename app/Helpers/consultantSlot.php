<?php

namespace App\Helpers;

use App\Notifications;
use App\Payroll;
use App\Settings;
use App\User;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;

class ConsultantSlot
{
    public function __construct(){}

    protected function diffInMin($from, $to){
        $result = round(abs(strtotime($to) - strtotime($from)) / 60);
        return $result;
    }

    protected function calculateResult($start, $busyness, $qt){
        $parts = explode(':', $start);
        $minutes = $parts[0]*60+$parts[1] + $busyness + $qt;
        $hours = floor($minutes / 60);
        $minutes = $minutes - $hours * 60;
        return $hours.':'.$minutes;
    }

    protected function calculateSlot($start, $end, &$busyness, $qt){
        if(($diff = $this->diffInMin($start, $end)) <= ($busyness + $qt)) {
            $busyness -= $diff;
            return false;
        } else {
            return $this->calculateResult($start, $busyness, $qt);
        }
    }

    protected function getExactTodayTime(&$busyness, $qt, $slots, $now){
        $result = false;
        foreach($slots as $slot){
            if($slot->from < $now && $slot->to > $now){
                $result = $this->calculateSlot($now, $slot->to, $busyness, $qt);
                if($result) break;
            } elseif($now < $slot->from){
                $result = $this->calculateSlot($slot->from, $slot->to, $busyness, $qt);
                if($result) break;
            }
        }
        return $result;
    }

    protected function getTodayTime($slots, $now){
        $total = 0;
        echo '<br/><br/>consultant';
        foreach($slots as $slot){
            echo '<br/>slot from: '.$slot->from;
            echo '<br/>slot to: '.$slot->to;
            echo '<br/>now: '.$now;
            if($slot->from < $now && $slot->to > $now) {
                echo '<br/>case1';
                $total += $this->diffInMin($now, $slot->to);
            } elseif($slot->from > $now) {
                echo '<br/>case2';
                $total += $this->diffInMin($slot->from, $slot->to);
            }
        }
        return $total;
    }

    protected function getTime($slots){
        $total = 0;
        foreach($slots as $slot)
            $total += $this->diffInMin($slot->from, $slot->to);
        return $total;
    }

    protected function getDayTime($dayTime, $day, $now, $days)
    {
        $current_weekday = strtolower(date('D', $now + $day * 86400));
        if (array_key_exists($current_weekday, $dayTime)){
            return $dayTime[$current_weekday];
        }else {
            $current_day_slots = $days->$current_weekday;
            $dayTime[$current_weekday] = $this->getTime($current_day_slots);
            return $dayTime[$current_weekday];
        }
    }

    protected function getExactTime($day, &$busyness, $qt, $days, $now){
        $current_weekday = strtolower(date('D', $now + $day * 86400));
        $current_day_slots = $days->$current_weekday;
        foreach($current_day_slots as $slot){
            if(($diff = $this->diffInMin($slot->from, $slot->to)) <= ($busyness + $qt)) {
                $busyness -= $diff;
            }
            else {
                return $this->calculateResult($slot->from, $busyness, $qt);
            }
        }
        return false;
    }

    protected function isWorking($days){
        $found = false;
        foreach($days as $slots){
            if(count($slots) > 0) $found = true;
        }
        return $found;
    }

    protected function getFirstEmptyTime($days, $now, $busyness, $qt){
        $day = 0;
        $nowHI = date('H:i', $now);
        $current_weekday = strtolower(date('D', $now + $day * 86400));
        if(isset($days->$current_weekday)) {
            $current_day_slots = $days->$current_weekday;
            if($this->isWorking($days)) {
                $todayTime = $this->getTodayTime($current_day_slots, $nowHI);
                if ($todayTime > ($busyness + $qt)) {
                    $result = $this->getExactTodayTime($busyness, $qt, $current_day_slots, $nowHI);
                } else {
                    $day++;
                    $busyness -= $todayTime;
                    $dayTime = array();
                    while (($currentTime = $this->getDayTime($dayTime, $day, $now, $days)) < ($busyness + $qt)) {
                        $day++;
                        $busyness -= $currentTime;
                    }
                    $result = $this->getExactTime($day, $busyness, $qt, $days, $now);
                }
                return date('Y-m-d', $now + $day * 86400) . ' ' . $result;
            }
        }
        return false;
    }

    protected function getAverageAnswerTime($consultant){
        $payroll = Payroll::where(['current' => 1])->first();
        $average = array();
        foreach(
            $consultant->questions()
            ->join('answers', 'answers.question_id', '=', 'questions.id')
            ->where(['answers.payroll_id' => $payroll->id, 'questions.status' => 2])
            ->get() as $question){
            $average[] = $question->timer;
        }
        $result = count($average) > 0 ? floor(round(array_sum($average) / count($average))/60) : 30;
        $result = $result > 10 ? $result : 30;
        return $result;
    }

    public function getRightConsultant(){
        date_default_timezone_set("Europe/London");
        $consultants = User::where(['type' => 'consultant', 'disable' => 0])->get();
        $result = false;
        $now = time();
        $current = '9999999999';
        foreach($consultants as $consultant){
            $days = json_decode($consultant->timetable);
            $pending_questions = $consultant->questions()->where(['status' => 1])->count();
            $qt = $this->getAverageAnswerTime($consultant);
            $busyness = $pending_questions * $qt;
            $firstEmptyTime = $this->getFirstEmptyTime($days, $now, $busyness, $qt);
            $timestampResult = strtotime($firstEmptyTime);
            if($timestampResult && $timestampResult < $current){
                $result = $consultant;
                $current = $timestampResult;
            }
        }
        if(!$result){
            $result = User::where(['type' => 'consultant', 'disable' => 0])->inRandomOrder()->first();
        }
        return $result;
    }

    public function getExpectedTime(){
        date_default_timezone_set("Europe/London");
        $consultants = User::where(['type' => 'consultant', 'disable' => 0])->get();
        $now = time();
        $current = '9999999999';
        $found = false;
        foreach($consultants as $consultant){
            $days = json_decode($consultant->timetable);
            $pending_questions = $consultant->questions()->where(['status' => 1])->count();
            $qt = $this->getAverageAnswerTime($consultant);
            $busyness = $pending_questions * $qt;
            $slotCalculator = new consultantSlot;
            $firstEmptyTime = $slotCalculator->getFirstEmptyTime($days, $now, $busyness, $qt);
            $timestampResult = strtotime($firstEmptyTime);
            if($timestampResult && $timestampResult < $current){
                $found = true;
                $current = $timestampResult;
            }
        }
        $result = false;
        if($found){
            die();
            $result = $current;
        }
        return $result;
    }
}