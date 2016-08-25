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
                    <div class="entry drop-shadow curved ">
                        <p>Šios taisyklės (toliau – Taisyklės) nustato stiliaus konsultavimo paslaugų, teikiamų internetinėje svetainėje <a href="http://www.StyleSensei.co.uk/">www.StyleSensei.co.uk</a> (toliau – svetainė StyleSensei.co.uk) 4 punkte aprašytais būdais ir pagal 5 punkte nurodytas konsultavimo sritis (toliau – Paslaugos), teikimo tvarką bei sąlygas.</p>
                        <p>1. Paslaugų teikėjas yra Pixsens LTD, įmonės kodas 302753042,&nbsp;registracijos adresas: Gedimino&nbsp;pr. 20, LT-01103 Vilnius, el. paštas <a href="mailto:info@StyleSensei.co.uk">info@StyleSensei.co.uk</a>.</p>
                        <p>2. Paslaugomis pradedama naudotis susipažinus su Taisyklėmis bei svetainėje StyleSensei.co.uk pažymėjus varnelę prie teiginio „Susipažinau su svetainės StyleSensei.co.uk taisyklėmis ir su jomis sutinku“.</p>
                        <p>3. Paslaugos pradedamos teikti iš anksto už jas apmokėjus šiai būdais:<br>
                            3.1 &nbsp; Iš anksto įgytais virtualiais kreditiniais pinigais (kreditais);<br>
                            3.2 &nbsp;Tiesioginiu pavedimu, atliktu per Lietuvos elektroninės bankininkystės sistemas arba PayPal.</p>
                        <p style="text-align: justify;">4.&nbsp;Paslaugos teikimo būdai:<br>
                            4.1 virtualioje erdvėje, t.y. raštu komunikuojant svetainėje StyleSensei.co.uk esančia programa “Chat”;<br>
                            4.2 elektroniniu paštu, t.y. raštu iš el. pašto dėžutės <a href="mailto:info@StyleSensei.co.uk">info@StyleSensei.co.uk</a> siunčiant konsultacinio turinio žinutę.</p>
                        <p style="text-align: justify;">5. Paslaugas apimančios sritys:<br>
                            5.1 Konsultavimo paslaugos aprangos stiliaus klausimais.<br>
                            5.2 Konsultavimo paslaugos išvaizdos stiliaus klausimais.</p>
                        <p style="text-align: justify;">6. Kliento sąskaita:<br>
                            6.1 Naudojimusi Paslaugomis atsiskaitoma 3 punkte nurodytais būdais,<br>
                            6.2 Kreditais atsiskaitoma tik tuo atveju, jei Kliento sąskaitoje yra pakankamas kreditų likutis;<br>
                            6.3 Paslaugos kreditan Klientui nėra teikiamos ir kredito limitas nėra nustatomas;<br>
                            6.4 Paslaugos yra teikiamos Klientams turintiems galiojančią sąskaitą.</p>
                        <p style="text-align: justify;">7. Paslaugų sąlygos<br>
                            7.1 Paslaugos bei naudojimosi jomis tvarka yra apibūdinta ir nurodyta svetainėje StyleSensei.co.uk, o Paslaugų kainos ir apmokėjimo už jas būdai nurodyti kiekvienos konkrečios Paslaugos užsakymo puslapyje.<br>
                            7.2 Klientas supranta ir sutinka, kad Paslaugos gali būti teikiamos tik po to, kai Klientas sumoka Paslaugų teikėjui už Paslaugą svetainėje StyleSensei.co.uk nurodyta tvarka. Paslaugų teikėjas turi teisę bet kada vienašališkai pakeisti užmokesčio už bet kurią Paslaugą dydį bei mokėjimo tvarką.<br>
                            7.3 Apribojus ar sustabdžius Kliento galimybę naudotis Paslaugomis ar Klientui negavus, ar laiku negavus Paslaugų dėl kitų priežasčių nei Kliento įvykdytas šių Taisyklių pažeidimas, Paslaugos teikėjas Kliento prašymu, įsipareigoja nemokamą Paslaugų teikimą Klientui ta apimtimi, kuria nebuvo suteiktos Paslaugos.<br>
                            7.4 Paslaugų teikėjas turi teisę profilaktinių svetainėje StyleSensei.co.uk vykdomų darbų metu apriboti ar nutraukti Paslaugų teikimą Klientui.<br>
                            7.5 Paslaugų teikėjas suteikia Klientui virtualią erdvę, kurioje Klientas turi galimybę gauti patarimą, konsultaciją prieš tai svetainėje StyleSensei.co.uk Paslaugų teikėjui uždavęs klausimą, susijusį su 5 punkte nurodytomis konsultavimo sritimis.<br>
                            7.6 Visos intelektinės nuosavybės teisės į svetainę StyleSensei.co.uk ir visą jos turinį, įskaitant autorių teises, pramoninės intelektinės nuosavybės teises, firmų vardus, know-how, komercines ir gamybines paslaptis, priklauso Paslaugų teikėjui, kuris teisėtai naudojasi trečiųjų asmenų suteiktomis teisėmis.<br>
                            7.7 Naudodamasis svetaine StyleSensei.co.uk ir/ar Paslaugomis ir teikdamas, įvesdamas ar kitaip siųsdamas bet kokią informaciją, duomenis į svetainę StyleSensei.co.uk Klientas neatlygintinai, neribotam laikui ir neribotoje teritorijoje perduoda Paslaugos teikėjui teises naudoti šią informaciją, duomenis.</p>
                        <p style="text-align: justify;">8. Kliento įsipareigojimai<br>
                            8.1 Klientas, siekdamas gauti kokybiškas Paslaugas, įsipareigoja:<br>
                            8.1.1 pateikti teisingą savo el. pašto adresą;<br>
                            8.1.2 nenaudoti svetainės StyleSensei.co.uk ir/ar Paslaugų neteisėtiems veiksmams ar sandoriams vykdyti arba sukčiavimui;<br>
                            8.1.3 užtikrinti, kad pateikiama informacija ir duomenys:<br>
                            – nėra klaidinanti ar neteisinga;<br>
                            – nepažeidžia trečiųjų asmenų turtinių ar asmeninių teisių (įskaitant teises į intelektinę nuosavybę);<br>
                            – neprieštarauja viešajai tvarkai ir moralės normoms.<br>
                            8.1.4 saugoti Kliento prisijungimo vardą ir slaptažodį, kad jo nesužinotų tretieji asmenys;<br>
                            8.1.5 nedelsdamas el. paštu pranešti Paslaugų teikėjui, jei Kliento vartotojo vardas ir/ar slaptažodis, kurie reikalingi naudotis svetainėje StyleSensei.co.uk, buvo prarasti ar tapo žinomi tretiesiems asmenims;<br>
                            8.2 Apmokėdamas už Paslaugą 3.2 punkte nurodytu būdu, Klientas patvirtina, kad jis/ji:<br>
                            8.2.1 yra veiksnus fizinis asmuo (ar juridinio asmens atstovas), turintis visus įgaliojimus ir teises vykdyti sandorius, siūlomus svetainėje StyleSensei.co.uk;<br>
                            8.2.2 supranta ir sutinka, kad tarp Kliento ir Paslaugų teikėjo sukuriami tik tokie teisiniai santykiai, kuriuos tiesiogiai ir aiškiai numato šios Taisyklės;<br>
                            8.2.3 supranta ir sutinka, kad tuo atveju, jei vartotojo vardas ir slaptažodis taps žinomi tretiesiems asmenims, tokie tretieji asmenys gali prisiimti įsipareigojimus, kurie taps privalomais Klientui, Klientas įsipareigoja tokius įsipareigojimus prisiimti ir tinkamai vykdyti, o Paslaugos teikėjas neturi pareigos jokiu kitu būdu, išskyrus vartotojo vardo ir slaptažodžio patikrinimą, tikrinti vartotojo tapatybės;<br>
                            8.2.4&nbsp;patvirtina, kad prisiima galimą konfidencialios informacijos atskleidimo riziką tretiesiems asmenims, kuri gali atsirasti su Paslaugos suteikimu susijusią informaciją siunčiant elektroniniu paštu.<br>
                            8.2.5 supranta ir sutinka, kad Paslaugos teikėjas tvarkytų ir valdytų Kliento asmens duomenis vadovaudamasi Lietuvos Respublikos teisės aktais.<br>
                            8.3 Klientas sutinka, kad Paslaugos teikėjas turi teisę bet kada be išankstinio įspėjimo nutraukti svetainės StyleSensei.co.uk veiklą.</p>
                        <p style="text-align: justify;">9. Paslaugos teikėjo teisės ir pareigos:<br>
                            9.1 Paslaugos teikėjas turi teisę savo nuožiūra apriboti arba nutraukti Kliento teisę ar galimybę naudotis svetaine StyleSensei.co.uk, įskaitant bet kokios informacijos, kurią Klientas pateikė į svetainę StyleSensei.co.uk, pakeitimu, Kliento prieigos panaikinimu ir uždraudimu Klientui iš naujo užsiregistruoti svetainėje StyleSensei.co.uk, jei:<br>
                            9.1.1 Kliento klausimai ir/ar komentarai yra nesusiję su svetainėje StyleSensei.co.uk aprašytomis Paslaugomis, nekultūringi, įžeidžiantys, skatina smurtą, neapykantą ar kitaip pažeidžia įstatymus;<br>
                            9.1.2 Klientas pateikė neteisingą, nepilną ir/ar klaidinančią informaciją registruodamasis ar naudodamasis svetaine StyleSensei.co.uk;<br>
                            9.1.3 tyčia ir sąmoningai skleidžia apgaulingą ar neteisingą informaciją svetainėje StyleSensei.co.uk, įžeidinėja kitus asmenis, apgaudinėja kitus Klientus, nevykdo prisiimtų įsipareigojimų dėl Paslaugų pateikimo bei apmokėjimo ar kitaip netinkamai elgiasi;<br>
                            9.2 Paslaugų teikėjas turi teisę tirti Taisyklių pažeidimus, teisę (bet ne pareigą) stebėti Kliento veiksmus svetainėje StyleSensei.co.uk;<br>
                            9.3 Paslaugų teikėjas turi teisę bet kada pakeisti ar pertvarkyti svetainę StyleSensei.co.uk, kad ja visoms suinteresuotoms šalims būtų patogiau naudotis.<br>
                            9.4 Paslaugos teikėjas turi teisę gauti užmokestį už suteikiamas Paslaugas pagal svetainėje StyleSensei.co.uk nurodytas kainas. Klientui pareikalavus, pateiks Klientui sąskaitą.<br>
                            9.5 Paslaugos teikėjas turi teisę Klientui siųsti komercinius ir kitus pasiūlymus, o Klientas turi teisę atsisakyti gauti tokius pasiūlymus.<br>
                            9.6 Paslaugų teikėjas, siekdamas užtikrinti teikiamų paslaugų kokybę, turi teisę saugoti teikiamos Paslaugų turinio informaciją bei garantuoti jos konfidencialumą ir apsaugą.<br>
                            9.7 Paslaugų teikėjas&nbsp;išlaiko visos asmeninės Kliento informacijos, kuri yra perduodama tiesiogiai StyleSensei.co.uk, konfidencialumą.</p>
                        <p style="text-align: justify;">10. Teisės ir intelektinė nuosavybė:<br>
                            10.1&nbsp;Svetainėje StyleSensei.co.uk&nbsp;viešai publikuojamos nuotraukos (autoriniai kūriniai) priklauso Pixsens LTD arba autoriams, su kuriais įmonė bendradarbiavo ir turi dalines autorines teises. Griežtai draudžiama šiuos kūrinius panaudoti kitose interneto svetainėse, žiniasklaidos priemonėse arba platinti kokiu nors kitu pavidalu be Pixsens LTD ir atitinkamo autoriaus-partnerio sutikimo.<br>
                            10.2&nbsp;Paslaugų teikėjas&nbsp;negarantuoja, kad Paslaugų funkcionavimas bus nepertraukiamas ir be klaidų, kad defektai bus ištaisyti, ar kad paslauga bus apsaugota nuo virusų ar kitų kenksmingų komponentų. Jūs suprantate ir sutinkate, kad bet kokia medžiaga, kurią jūs skaitote, atsisiunčiate ar kitaip gaunate naudodamiesi Paslaugomis, yra išimtinai jūsų nuožiūra bei rizika, ir tik jūs atsakote už žalą, padarytą jūsų sveikatai, kompiuterinei sistemai, jūs tai pat prisiimate visas išlaidas būtinoms aptarnavimo paslaugoms, remontui ar pataisoms.</p>
                        <p style="text-align: justify;">11. Baigiamosios nuostatos:<br>
                            11.1 Taisyklėms yra taikoma Lietuvos Respublikos teisė.<br>
                            11.2 Visi tarp Paslaugų teikėjo ir Kliento kilę nesutarimai dėl šių Taisyklių vykdymo yra sprendžiami derybų keliu. Šalims neišsprendus ginčo derybų būdu toks ginčas galutinai sprendžiamas Lietuvos Respublikos įstatymų nustatyta tvarka teismuose pagal Paslaugų teikėjo buveinės vietą.</p>
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