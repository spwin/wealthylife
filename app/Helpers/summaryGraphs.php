<?php

namespace App\Helpers;

use App\Article;
use App\Discounts;
use App\Orders;
use App\Questions;
use App\User;
use App\Vouchers;

class summaryGraphs
{
    public function __construct(){}

    protected function random_color_part() {
        return mt_rand( 0, 255 );
    }

    protected function random_color() {
        return $this->random_color_part().','.$this->random_color_part().','.$this->random_color_part();
    }

    public function getReferralsGraph($payroll){
        $credits_per_referral = 2;
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'labels' => [],
            'values' => [],
            'days' => [],
            'totals' => [
                'registered' => 0,
                'confirmed' => 0,
                'earned' => 0
            ]
        );
        $registered = User::where('created_at', '>=', $date->format('Y-m-d H:i:s'))->whereNotNull('referral_id')->orderBy('created_at', 'DESC')->get();
        $tomorrow = new \DateTime('tomorrow');
        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'value' => 0
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($registered) > 0){
            foreach($registered as $user){
                $dayname = date('Y-m-d', strtotime($user->created_at));
                if(array_key_exists($dayname, $result['days'])){
                    $result['days'][$dayname]['value'] += 1;
                }
            }
        }

        $referrals = User::where('created_at', '>=', $payroll->starts_at)->whereNotNull('referral_id')->orderBy('created_at', 'DESC')->get();
        if(count($referrals) > 0){
            foreach($referrals as $referral){
                $result['totals']['registered'] += 1;
            }
        }
        $referrals = User::where('first_service_use', '>=', $payroll->starts_at)->whereNotNull('referral_id')->orderBy('created_at', 'DESC')->get();
        if(count($referrals) > 0){
            foreach($referrals as $referral){
                $result['totals']['confirmed'] += 1;
                $result['totals']['earned'] += $credits_per_referral;
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            $result['values'][] = $day['value'];
        }

        return $result;
    }

    public function getDiscountsGraph($price, $payroll){
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'labels' => [],
            'values' => [],
            'days' => [],
            'totals' => [
                'discounts' => 0,
                'discounts_sum' => 0
            ]
        );
        $discounts = Discounts::where('used_at', '>=', $date->format('Y-m-d H:i:s'))->where(['used' => 1])->orderBy('created_at', 'DESC')->get();
        $tomorrow = new \DateTime('tomorrow');
        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'value' => 0
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($discounts) > 0){
            foreach($discounts as $discount){
                $dayname = date('Y-m-d', strtotime($discount->used_at));
                if(array_key_exists($dayname, $result['days'])){
                    if($discount->type == 'fixed'){
                        $result['days'][$dayname]['value'] += $discount->fixed;
                    } else {
                        $result['days'][$dayname]['value'] += (($discount->percent/100)*$price);
                    }
                }
            }
        }

        $discounts = Discounts::where('used_at', '>=', $payroll->starts_at)->where(['used' => 1])->orderBy('created_at', 'DESC')->get();
        if(count($discounts) > 0){
            foreach($discounts as $discount){
                $result['totals']['discounts'] += 1;
                if($discount->type == 'fixed'){
                    $result['totals']['discounts_sum'] += $discount->fixed;
                } else {
                    $result['totals']['discounts_sum'] += (($discount->percent/100)*$price);
                }
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            $result['values'][] = $day['value'];
        }

        return $result;
    }

    public function getVouchersGraph($payroll){
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'labels' => [],
            'values' => [],
            'days' => [],
            'totals' => [
                'bought' => 0,
                'bought_sum' => 0,
                'bought_used' => 0,
                'generated_used' => 0,
                'generated_used_sum' => 0
            ]
        );
        $vouchers = Vouchers::where('created_at', '>=', $date->format('Y-m-d H:i:s'))->where(['status' => 1, 'generated' => 0])->orderBy('created_at', 'DESC')->get();
        $tomorrow = new \DateTime('tomorrow');
        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'value' => 0
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($vouchers) > 0){
            foreach($vouchers as $voucher){
                $dayname = date('Y-m-d', strtotime($voucher->created_at));
                if(array_key_exists($dayname, $result['days'])){
                    $result['days'][$dayname]['value'] += $voucher->price;
                }
            }
        }

        $vouchers = Vouchers::where('created_at', '>=', $payroll->starts_at)->whereIn('status', [1,2])->orderBy('created_at', 'DESC')->get();
        if(count($vouchers) > 0){
            foreach($vouchers as $voucher){
                if($voucher->generated){
                    if($voucher->used_by) {
                        $result['totals']['generated_used'] += 1;
                        $result['totals']['generated_used_sum'] += $voucher->price;
                    }
                } else {
                    $result['totals']['bought'] += 1;
                    $result['totals']['bought_sum'] += $voucher->price;
                    if($voucher->used_by){
                        $result['totals']['bought_used'] += 1;
                    }
                }
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            $result['values'][] = $day['value'];
        }

        return $result;
    }

    public function getArticlesGraph($payroll){
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'labels' => [],
            'values' => [],
            'days' => [],
            'totals' => [
                'articles' => 0,
                'published' => 0,
                'pending' => 0,
                'archived' => 0,
                'new' => 0,
                'edited' => 0
            ]
        );
        $articles = Article::where('created_at', '>=', $date->format('Y-m-d H:i:s'))->whereIn('status', [1,2,3])->orderBy('created_at', 'DESC')->get();
        $tomorrow = new \DateTime('tomorrow');
        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'value' => 0
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($articles) > 0){
            foreach($articles as $article){
                $dayname = date('Y-m-d', strtotime($article->created_at));
                if(array_key_exists($dayname, $result['days'])){
                    $result['days'][$dayname]['value'] += 1;
                }
            }
        }

        $articles = Article::where('created_at', '>=', $payroll->starts_at)->whereIn('status', [1,2,3])->orderBy('created_at', 'DESC')->get();
        if(count($articles) > 0){
            foreach($articles as $article){
                $result['totals']['articles'] += 1;
                if($article->status == 2) {
                    $result['totals']['archived'] += 1;
                } elseif($article->status == 3){
                    $result['totals']['published'] += 1;
                } elseif($article->status == 1) {
                    if($article->published_at){
                        $result['totals']['edited'] += 1;
                    } else {
                        $result['totals']['new'] += 1;
                    }
                    $result['totals']['pending'] += 1;
                }
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            $result['values'][] = $day['value'];
        }

        return $result;
    }

    public function getUsersGraph($payroll){
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'labels' => [],
            'values' => [],
            'days' => [],
            'totals' => [
                'users' => 0,
                'local' => 0,
                'facebook' => 0,
                'google' => 0,
                'twitter' => 0
            ]
        );
        $users = User::where('created_at', '>=', $date->format('Y-m-d H:i:s'))->where(['type' => 'user'])->orderBy('created_at', 'DESC')->get();
        $tomorrow = new \DateTime('tomorrow');
        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'value' => 0
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($users) > 0){
            foreach($users as $user){
                $dayname = date('Y-m-d', strtotime($user->created_at));
                if(array_key_exists($dayname, $result['days'])){
                    $result['days'][$dayname]['value'] += 1;
                }
            }
        }

        $users = User::where('created_at', '>=', $payroll->starts_at)->where(['type' => 'user'])->orderBy('created_at', 'DESC')->get();
        if(count($users) > 0){
            foreach($users as $user){
                $result['totals']['users'] += 1;
                if(count($user->social) > 0) {
                    foreach ($user->social as $social) {
                        $result['totals'][$social->provider] += 1;
                    }
                } else {
                    $result['totals']['local'] += 1;
                }
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            $result['values'][] = $day['value'];
        }

        return $result;
    }

    public function getQuestionsGraph($payroll){
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'labels' => [],
            'values' => [],
            'days' => [],
            'totals' => [
                'questions' => 0,
                'pending' => 0,
                'answered' => 0,
                'rejected' => 0
            ]
        );
        $questions = Questions::where('asked_at', '>=', $date->format('Y-m-d H:i:s'))->whereIn('status', [1,2,3])->orderBy('created_at', 'DESC')->get();
        $tomorrow = new \DateTime('tomorrow');
        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'value' => 0
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($questions) > 0){
            foreach($questions as $question){
                $dayname = date('Y-m-d', strtotime($question->asked_at));
                if(array_key_exists($dayname, $result['days'])){
                    $result['days'][$dayname]['value'] += 1;
                }
            }
        }

        $questions = Questions::where('asked_at', '>=', $payroll->starts_at)->whereIn('status', [1,2,3])->orderBy('created_at', 'DESC')->get();
        if(count($questions) > 0){
            foreach($questions as $question){
                $result['totals']['questions'] += 1;
                if($question->status == 2){
                    $result['totals']['answered'] += 1;
                } elseif($question->status == 3){
                    $result['totals']['rejected'] += 1;
                } elseif($question->status == 1) {
                    $result['totals']['pending'] += 1;
                }
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            $result['values'][] = $day['value'];
        }

        return $result;
    }

    public function getOrdersGraph($price, $payroll){
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'labels' => [],
            'values' => [],
            'days' => [],
            'totals' => [
                'questions' => 0,
                'vouchers' => 0,
                'credits' => 0,
                'total' => 0,
                'discounts' => 0
            ]
        );
        $orders = Orders::where('created_at', '>=', $date->format('Y-m-d H:i:s'))->where(['status' => 1])->orderBy('created_at', 'DESC')->get();
        $tomorrow = new \DateTime('tomorrow');
        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'value' => 0
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($orders) > 0){
            foreach($orders as $order){
                $dayname = date('Y-m-d', strtotime($order->created_at));
                if(array_key_exists($dayname, $result['days'])) {
                    if($order->type == 'question'){
                        $result['days'][$dayname]['value'] += $price;
                    } else {
                        $result['days'][$dayname]['value'] += $order->priceScheme->price;
                    }
                }
            }
        }

        $orders = Orders::where('created_at', '>=', $payroll->starts_at)->where(['status' => 1])->orderBy('created_at', 'DESC')->get();
        if(count($orders) > 0){
            foreach($orders as $order){
                $dayname = date('Y-m-d', strtotime($order->created_at));
                if(array_key_exists($dayname, $result['days'])) {
                    if($order->type == 'question'){
                        $result['totals']['questions'] += 1;
                        $result['totals']['total'] += $price;
                    } else {
                        $result['totals']['total'] += $order->priceScheme->price;
                        if ($order->type == 'credits') {
                            $result['totals']['credits'] += 1;
                            $result['totals']['discounts'] += ($order->priceScheme->credits - $order->priceScheme->price);
                        } elseif ($order->type == 'vouchers') {
                            $result['totals']['vouchers'] += 1;
                        }
                    }
                }
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            $result['values'][] = $day['value'];
        }

        return $result;
    }

    public function getAnswersGraph($consultants, $payroll){
        $date = new \DateTime('tomorrow -30 days');
        $result = array(
            'period' => null,
            'days' => [],
            'totals' => [],
            'labels' => [],
            'values' => []
        );
        $tomorrow = new \DateTime('tomorrow');
        $answers = Questions::where(['status' => 2])->where('answered_at', '>=',$date->format('Y-m-d H:i:s'))->get();
        $consultants_array = [];
        foreach($consultants as $consultant){
            $consultants_array[$consultant->id] = [
                'email' => $consultant->email,
                'name' => $consultant->userData->first_name.' '.$consultant->userData->last_name,
                'color' => 'rgba('.$this->random_color(),
                'answers' => 0
            ];
        }
        $result['totals'] = $consultants_array;

        $counter = 0;
        while($date < $tomorrow){
            $result['days'][date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'consultants' => $consultants_array
            ];
            $date->modify('+1 day');
            if(date('Y-m-d', strtotime($payroll->starts_at)) == $date->format('Y-m-d')){
                $result['period'] = $counter;
            }
            $counter++;
        }

        if(count($answers) > 0){
            foreach($answers as $answer){
                $dayname = date('Y-m-d', strtotime($answer->answered_at));
                if(array_key_exists($dayname, $result['days']) && array_key_exists($answer->consultant_id, $result['days'][$dayname]['consultants'])){
                    $result['days'][$dayname]['consultants'][$answer->consultant_id]['answers'] += 1;
                }
            }
        }

        $answers = Questions::where(['status' => 2])->where('answered_at', '>=', $payroll->starts_at)->get();
        if(count($answers) > 0){
            foreach($answers as $answer){
                if(array_key_exists($answer->consultant_id, $result['totals'])){
                    $result['totals'][$answer->consultant_id]['answers'] += 1;
                }
            }
        }

        foreach($result['days'] as $day){
            $result['labels'][] = $day['day'];
            foreach($day['consultants'] as $id => $consultant){
                $result['values'][$id][] = $consultant['answers'];
            }
        }

        return $result;
    }
}