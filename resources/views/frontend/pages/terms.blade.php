@extends('frontend/frame')
@section('nav-style', 'nav-authorize-question')
@section('content')
    <section class="page-title page-title-4 image-bg parallax">
        <div class="background-image-holder fadeIn">
            <img alt="Background Image" class="background-image" src="{{ url()->to('/') }}/images/cover14.jpg" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="uppercase mb8">Terms & conditions</h2>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="entry drop-shadow curved terms-conditions">
                        <p class="lead">These Rules (hereinafter the Rules) establish the terms and conditions of the style consulting services (hereinafter referred to as the Services) provided on the WEBSITE www.StyleSensei.co.uk (hereafter the Website).</p>
                        <h4>I. GENERAL PROVISIONS</h4>
                        <p>1. The Service Provider providing the Services referred to in paragraph 3 of these Rules is Pixsens LTD, company code 09875891, registered address: Kemp House 160 City Road, London EC1V 2NX, email <span id="eadr">m<b>@</b>e@d<b>no</b>oma<b>.com</b>in.com</span>.</p>
                        <p>2. The Service Recipient is any person who has paid for the Website's Services which are referred to in paragraph 3 of the Rules as specified in Section III of the Rules. The Rules shall take effect for each individual Website visitor (hereinafter referred to as the User) from the moment when a person begins to use the Website.</p>
                        <p>3. The services shall include:
                            <ul>
                                <li>3.1 Advisory services clothing style issues;</li>
                                <li>3.2 Consulting services on appearance style issues.</li>
                            </ul>
                        </p>

                        <h4>II. TERMS AND CONDITIONS OF SERVICES</h4>
                        <p>4. The Services will be provided only to persons with a valid virtual user account (hereinafter referred to as the User Account) which is acquired by each person by creating a personal User Account on the Website.</p>
                        <p>5. The Services will be provided to the Service Recipient only after payment in advance.</p>
                        <p>6. The Service Provider, before separate order of the Service Recipient, shall have the right to unilaterally change the amount of fees and payment procedures for any Service.</p>
                        <p>7. The Services will be provided in virtual space, i.e. by communicating in writing on the Website;</p>

                        <h4>III. PAYMENT FOR THE SERVICES</h4>
                        <p>8. The price of Services is determined by the Service Provider. It is shown on the Website on the page for each service.</p>
                        <p>
                            9. The Service Recipient shall pay for the Services in the following ways:
                            <ul>
                                <li>9.1. With virtual credit money acquired an the Website in advance (hereinafter referred to as the Credits);</li>
                                <li>9.2. By direct transfers through Braintree or PayPal.</li>
                            </ul>
                        </p>
                        <p>10. The Service Recipient is entitled to pay with credits for the service and full only if he has sufficient credit balance on the User Account.</p>
                        <p>11. The Service Recipient is entitled to pay part of the price for the Services in Credits and another part – in cash.</p>
                        <p>12. If the Service Recipient as insufficient credit balance in his personal User Account when paying for the Service, the difference must be paid by direct transfer via PayPal or Braintree.</p>

                        <h4>IV. GUARANTEES AND REPRESENTATIONS OF THE PARTIES</h4>
                        <p>13. The parties hereby represent and guarantee to each other the following:</p>
                        <p>
                            <ul>
                                <li>13.1. Each of them is a legally capable person who has the right to enter into and carry out transactions on the Website;</li>
                                <li>13.2. Understands and agrees that only the legal relations directly and clearly referred to in these Rules are created between them;</li>
                                <li>13.3. Understands and agrees that if the Service Recipient's User name and password become known to a third party, such third parties may commit, and the commitments will become mandatory to the Service Recipient. The Service Recipient undertakes to assume and discharge such commitments in a proper manner, and the Service Provider shall have no obligation in any method other than verifying the User name and password, to verify the User identity;</li>
                                <li>13.4. Bears the potential risk of disclosure of confidential information to third parties, which may arise by sending the service-related information by e-mail.</li>
                                <li>13.5. Understands and agrees that any of them shall have the right at any time to suspend its activities on the Website, i.e. the Service Provider shall have the right to terminate the Website activities and the Service Recipient shall have the right to remove his User Account on the Website.</li>
                                <li>13.6. Understands and agrees for the Service Provider to process the Customer's personal data in accordance with the legislation of the Data Protection Act.</li>
                                <li>13.7. Any material, which the Service Recipient reads, downloads or otherwise receives in using the Service shall be solely used at his sole discretion and risk, and he will be solely responsible for damage caused to his health or property.</li>
                            </ul>
                        </p>

                        <h4>V. RIGHTS AND OBLIGATIONS OF THE PARTIES</h4>
                        <p>14. Rights and obligations of the Service Recipient:
                            <ul>
                                <li>14.1. The Service Recipient shall be entitled:
                                    <ul>
                                        <li>14.1.1. Timely obtain the Services ordered;</li>
                                        <li>14.1.2. To manage User Account and credits on the in his sole discretion. In order to remove the User Account, it is necessary to contact the Service Provider;</li>
                                        <li>14.1.3. Present Credits to others by sending them a voucher the value whereof is equivalent to the amount of granted Credits, in accordance with the Website procedures. The voucher is valid for 6 months. After the expiration of this term the Credits are not refundable.</li>
                                        <li>14.1.4. Refuse to receive commercial and other proposals sent to him by the Service Provider;</li>
                                        <li>14.1.5. To create own blog on the topics of fashion, style and (or) appearance. Entries in the Blog are published through the Service Provider and must meet these requirements; in case of failure to meet them, the Service Provider will have the right not to publish the entry and (or) to remove it in case of publication:
                                            <ul>
                                                <li>14.1.5.1. The content must meet the topics of fashion, style and (or) appearance, the general ethical and public policy requirements;</li>
                                                <li>14.1.5.2. The content cannot be used for other personal portrayal;</li>
                                                <li>14.1.5.3. Videos cannot be used for advertising.</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>14.2. The Service Recipient undertakes:
                                    <ul>
                                        <li>14.2.1. To provide the correct information to the Service Provider, which is necessary to provide the Services;</li>
                                        <li>14.2.2. Not to use the Website or the Services for illegal actions, transactions or fraud;</li>
                                        <li>14.2.3. To ensure that the information and data provided:
                                            <ul>
                                                <li>14.2.3.1. Is not misleading or inaccurate;</li>
                                                <li>14.2.3.2. Is without prejudice to the property or personal rights of third parties (including the rights to intellectual property);</li>
                                                <li>14.2.3.3. Is not contrary to public order and good morals.</li>
                                                <li>14.2.3.4. To protect the login name and password from transferring it to the third parties;</li>
                                                <li>14.2.3.5. Shall immediately notify the Service Provider by e-mail if the User name and (or) the password, which are necessary for using the Website, have been lost or become known to any third party;</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </p>
                        <p>15. Rights and Obligations of the Service Provider:
                            <ul>
                                <li>15.1. Rights of the Service Provider:
                                    <ul>
                                        <li>15.1.1. The Service Provider shall have the right in its sole discretion, to restrict, suspend or terminate the Website User's access to the Website and the Services, including changes to any information that the User has submitted to the Website, deletion of the User Account, and banning the User to repeatedly sign up on the Website. The Service Provider has the right to perform the actions referred to in this paragraph, when:
                                            <ul>
                                                <li>15.1.1.1. User questions and (or) comments on the Website not related to the Services described on the Website, are immoral, defamatory, promote violence, hatred or otherwise violate the law;</li>
                                                <li>15.1.1.2. The User has provided false, incomplete and (or) misleading information when signing up or using the Website;</li>
                                                <li>15.1.1.3. The User is intentionally and deliberately spreading false information on the Website, insulting others, deceiving other users and fails to fulfil the obligations concerning the submission and payment of the Services or otherwise act inappropriately;</li>
                                            </ul>
                                        </li>
                                        <li>15.1.2. The Service Provider shall have the right to investigate violations of the Rules and to monitor User activities on the Website;</li>
                                        <li>15.1.3. The Service Provider shall have the right to change, rearrange, or stop the Website operation;</li>
                                        <li>15.1.4. The Service Provider shall be entitled, during the preventive work on the Website, to limit or suspend the provision of the Services to the Service Recipient.</li>
                                        <li>15.1.5. The Service Provider shall have the right to get remuneration for the Services based on the prices referred to an the Website.</li>
                                        <li>15.1.6. The Service Provider shall have the right to send commercial and other proposals to the User;</li>
                                        <li>15.1.7. The Service Provider, in order to ensure the quality of the Services, shall have the right to store information on the content of the Services provided.</li>
                                        <li>15.1.8. The Service Provider, as referred to in paragraph 13.1.4 of the Rules, shall have the right not to publish and (or) to remove the Service Recipient's entry in the Blog.</li>
                                    </ul>
                                </li>
                                <li>15.2. The Service Provider undertakes:
                                    <ul>
                                        <li>15.2.1. To provide high quality Services in the responsible manner, applying all the necessary efforts;</li>
                                        <li>15.2.2. At the latest within 24 hours to provide the Service in accordance with the request of the Service Recipient;</li>
                                        <li>15.2.3. To ensure the uninterrupted operation of the Website;</li>
                                        <li>15.2.4. In accordance with the request from the Service Recipient to submit him an invoice for the Services rendered to him;</li>
                                        <li>15.2.5. To guarantee the protection and confidentiality of information of the content of the Services;</li>
                                        <li>15.2.6. To maintain the confidentiality of all personal information of the User transferred directly on the Website.</li>
                                    </ul>
                                </li>
                            </ul>
                        </p>

                        <h4>VI. LIABILITY OF THE PARTIES</h4>
                        <p>16. In the case of the infringement of those Rules, as provided for in paragraph 14.1.1, the Service Provider shall have the right to restrict, suspend or terminate the right of the Service Recipient or his access to the Website and the Services.</p>
                        <p>17. If the Service Recipient does not receive the Services or does not receive them on time for reasons other than the violation by the Service Recipient of these Rules, the Service Provider shall, at the request of the Service Recipient, compensate for losses by providing free Services to the Service Recipient to the extent to which the Services have not been provided.</p>
                        <p>18. None of the parties shall be liable for their failure to discharge obligations under the Contract due to force majeure circumstances, as stipulated in the laws of the Republic of Lithuania. The party unable to fulfil its contractual obligations due to the force majeure circumstances shall as soon as possible but no later than in 24 hours notify the other party in writing of these circumstances. In this case, the discharge of obligations is suspended until such force majeure circumstances possessed.</p>
                        <p>19. The Service Recipient shall be fully responsible for the damage caused by his fault or negligence, to the Service Provider.</p>
                        <p>20. The Service Provider shall not be liable for any Credits unused on the Website, if the activity of the Website is suspended.</p>
                        <p>21. The Service Provider is not liable for information made public by the Users on the Website. The Service Provider shall not verify or delete such information arbitrary.</p>

                        <h4>VII. CONFIDENTIAL INFORMATION AND INTELLECTUAL PROPERTY</h4>
                        <p>22. Photos (author works) published on the Website belong to the Service Provider or authors, with whom he has collaborated, and has partial copyrights. It is strictly forbidden to use these works on other websites, in the media or to distribute in any other form without the consent of the Service Provider and the corresponding author-partner.</p>

                        <h4>VIII. FINAL PROVISIONS</h4>
                        <p>23. These terms and conditions are governed by and construed in accordance with the laws of England and Wales.</p>
                        <p>24. Any dispute you have which relates to these terms and conditions, or your use of StyleSensei.co.uk, will be subject to the exclusive jurisdiction of the courts of England and Wales.</p>

                        <div class="clearboth">&nbsp;</div>
                        <div class='innerText'><br>Last Edited on 2016-08-25</div>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    @include('frontend/footer')
@stop
@push('scripts')
<script type="text/javascript">
    <!--
    ($)(function(){
        var s="=b!isfg>#nbjmup;jogpAtuzmftfotfj/dp/vl#?jogpAtuzmftfotfj/dp/vl=0b?";
        m=""; for (i=0; i<s.length; i++) m+=String.fromCharCode(s.charCodeAt(i)-1); document.getElementById('eadr').innerHTML=(m);
    });
    //-->
</script>
@endpush