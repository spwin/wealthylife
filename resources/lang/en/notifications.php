<?php
return [
    'registration.welcome.topic' => 'Welcome!',
    'registration.welcome.subject' => 'Welcome!',
    'registration.welcome.content' => 'You are now part of our stylesensei family. If you would like to read more about stylesensei all you need to do is click <a href=":link">here</a>. We are looking forward to help you with any style questions. We hope you like our services and would like to share your experience with your friends. We would be extremely happy to receive any feedback about our service as we are always looking forward to improve.',
    'registration.welcome.email' => 'emails.welcome',

    'registration.confirmation.topic' => 'Email confirmation link',
    'registration.confirmation.subject' => 'Email confirmation link',
    'registration.confirmation.content' => 'Almost done! Please click this link to confirm your email and to complete your registration.',
    'registration.confirmation.email' => 'emails.confirmation',

    'question.paid.topic' => '',
    'question.paid.subject' => 'Your Question Has Been Received',
    'question.paid.content' => '',
    'question.paid.email' => 'emails.question-paid',

    'question.answered.topic' => '',
    'question.answered.subject' => 'Your Question is Answered!',
    'question.answered.content' => '',
    'question.answered.email' => 'emails.question-answered',

    'credits.paid.topic' => '',
    'credits.paid.subject' => '',
    'credits.paid.content' => '',
    'credits.paid.email' => '',

    'voucher.coupon.topic' => 'Voucher Details',
    'voucher.coupon.subject' => 'You Received a Gift Voucher',
    'voucher.coupon.content' => 'Your gift voucher has been successfully sent to :email. They will receive the voucher code together with your message shortly. We have sent you a copy of the email as well.',
    'voucher.coupon.email' => 'emails.voucher',

    'voucher.copy.topic' => '',
    'voucher.copy.subject' => 'Your Copy of a Gift Voucher',
    'voucher.copy.content' => '',
    'voucher.copy.email' => 'emails.voucher-copy',

    'password.recovery.topic' => 'Password reset link',
    'password.recovery.subject' => 'Password reset link',
    'password.recovery.content' => '',
    'password.recovery.email' => 'emails.pass-reset',

    'contacts.form.topic' => env('APP_NAME').' Contact Form message',
    'contacts.form.subject' => env('APP_NAME').' Contact Form message',
    'contacts.form.content' => '',
    'contacts.form.email' => 'emails.contacts',

    'article.published.topic' => 'Your Article has been published!',
    'article.published.subject' => '',
    'article.published.content' => 'Your Article has been published on the page. You can view it by clicking this link: <a href=":link">:link</a>',
    'article.published.email' => '',

    'referral.confirmed.topic' => 'Referral reward',
    'referral.confirmed.subject' => '',
    'referral.confirmed.content' => 'You have been just rewarded £2 as your referral has been confirmed. You can check your referrals information <a href=":link">here</a>',
    'referral.confirmed.email' => '',

    'question.rejected.topic' => 'Question rejected',
    'question.rejected.subject' => 'Your question is rejected!',
    'question.rejected.content' => 'Your question was rejected.<br/><strong>Rejection reason:</strong> :reason<br/><strong>:credits credits</strong> have been returned to your balance.<br/><br/>You can see your question <a href=":link">here</a>.',
    'question.rejected.email' => 'emails.question-rejected',
];