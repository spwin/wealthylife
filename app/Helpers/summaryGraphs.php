<?php

namespace App\Helpers;

use App\Article;
use App\Orders;
use App\Questions;
use App\User;

class summaryGraphs
{
    public function __construct(){}

    protected function random_color_part() {
        return mt_rand( 0, 255 );
    }

    protected function random_color() {
        return $this->random_color_part().','.$this->random_color_part().','.$this->random_color_part();
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
                'archived' => 0
            ]
        );
        $articles = Article::where('created_at', '>=', $date->format('Y-m-d H:i:s'))->where(['status' => 1])->orWhere(['status' => 2])->orWhere(['status' => 3])->orderBy('created_at', 'DESC')->get();
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

        $articles = Article::where('created_at', '>=', $payroll->starts_at)->where(['status' => 1])->orWhere(['status' => 2])->orWhere(['status' => 3])->orderBy('created_at', 'DESC')->get();
        if(count($articles) > 0){
            foreach($articles as $article){
                $result['totals']['articles'] += 1;
                if($article->status == 2) {
                    $result['totals']['archived'] += 1;
                } elseif($article->status == 3){
                    $result['totals']['published'] += 1;
                } else {
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
        $questions = Questions::where('asked_at', '>=', $date->format('Y-m-d H:i:s'))->where(['status' => 1])->orWhere(['status' => 2])->orWhere(['status' => 3])->orderBy('created_at', 'DESC')->get();
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

        $questions = Questions::where('asked_at', '>=', $payroll->starts_at)->where(['status' => 1])->orWhere(['status' => 2])->orWhere(['status' => 3])->orderBy('created_at', 'DESC')->get();
        if(count($questions) > 0){
            foreach($questions as $question){
                $result['totals']['questions'] += 1;
                if($question->status == 2){
                    $result['totals']['answered'] += 1;
                } elseif($questions->status == 3){
                    $result['totals']['rejected'] += 1;
                } elseif($questions->status == 1) {
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