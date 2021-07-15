<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scr;
use Codedge\Fpdf\Fpdf\Fpdf;
use Mail;

class ScrEduController extends Controller
{
    private $fpdf;
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        return view('scr-edu');
    }
    function add(Request $request)
    {

        $code = isset($_GET['code']) ? $_GET['code'] : md5(uniqid());

        if (isset($_GET['id'], $_GET['code'])) {
           
            $scr = Scr::find($_GET['id']);
            if (!$scr) {
                exit('Invalid code and/or ID!');
            } else {
                $scr->update($request->all());
                if ($request->input('form_end')) {
                    $pdf = new \setasign\Fpdi\Fpdi();
                    $pdf->setSourceFile(public_path('/assets/template/SCB Educare_WEB_Template.pdf'));
                    $tplIdx = $pdf->importPage(1);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 48);
                    $pdf->Write(0, 'SCB/SLUL/EDU/'.$scr['id']);

                    $pdf->SetXY(40, 59);
                    $pdf->Write(0, $scr['firstName']);

                    $pdf->SetXY(140, 59);
                    $pdf->Write(0, $scr['lastName']);

                    $pdf->SetXY(40, 65);
                    $pdf->Write(0, $scr['birthDateOfChild']);

                    $pdf->SetXY($scr['childGender'] == 'Male' ? 96 : 111, 65);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(155, 65);
                    $pdf->Write(0, $scr['relationship']);

                    $pdf->SetXY(40, 79);
                    $pdf->Write(0, $scr['2_firstName']);

                    $pdf->SetXY(40, 85);
                    $pdf->Write(0, $scr['2_lastName']);

                    $pdf->SetXY(40, 90);
                    $pdf->Write(0, $scr['2_idNumber']);

                    $pdf->SetXY(133, 90);
                    $pdf->Write(0, $scr['2_passportNumber']);

                    $pdf->SetXY(183, 90);
                    $pdf->Write(0, $scr['2_title']);

                    $pdf->SetXY($scr['2_maritalStatus'] == "Married" ? 37 : 55, 96);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(99, 96);
                    $pdf->Write(0, $scr['2_birthDate']);

                    $pdf->SetXY($scr['2_gender'] == 'Male' ? 161 : 176, 96);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(40, 102);
                    $pdf->Write(0, $scr['2_occupation']);

                    $pdf->SetXY(150, 102);
                    $pdf->Write(0, $scr['2_pinNumber']);

                    $pdf->SetXY(40, 108);
                    $pdf->Write(0, $scr['2_nationality']);

                    $pdf->SetXY(155, 109);
                    $pdf->Write(0, $scr['2_tin']);

                    $pdf->SetXY(40, 114);
                    $pdf->Write(0, $scr['2_citizenship']);

                    $pdf->SetXY(40, 121);
                    $pdf->Write(0, $scr['2_residency']);

                    $pdf->SetXY($scr['2_1_employed'] == "Yes" ? 32 : 43, 134);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(40, 141);
                    $pdf->Write(0, $scr['2_1_employer']);

                    $pdf->SetXY(165, 134);
                    $pdf->Write(0, $scr['2_1_employerCode']);

                    $pdf->SetXY(50, 150);
                    $pdf->Write(0, $scr['2_1_departmentCode']);

                    $pdf->SetXY($scr['2_1_employeeTerms'] == 'Temporary' ? 125 : ($scr['2_1_employeeTerms'] == 'Permanent' ? 149 : 174), 149);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(170, 142);
                    $pdf->Write(0, $scr['2_1_employerNumber']);

                    $pdf->SetXY(60, 169);
                    $pdf->Write(0, $scr['2_2_businessName']);

                    $pdf->SetXY(60, 175);
                    $pdf->Write(0, $scr['2_2_natureOfBusiness']);

                    $pdf->SetXY(60, 181);
                    $pdf->Write(0, $scr['2_2_properBusiness']);

                    $pdf->SetXY(20, 199);
                    $pdf->Write(0, $scr['2_3_cell']);

                    $pdf->SetXY(80, 199);
                    $pdf->Write(0, $scr['2_3_workPhone']);

                    $pdf->SetXY(145, 199);
                    $pdf->Write(0, $scr['2_3_homePhone']);

                    $pdf->SetXY(45, 204);
                    $pdf->Write(0, $scr['2_3_emailAddress']);


                    $pdf->SetXY(40, 216);
                    $pdf->Write(0, $scr['2_4_poBox']);

                    $pdf->SetXY(140, 216);
                    $pdf->Write(0, $scr['2_4_building']);

                    $pdf->SetXY(40, 223);
                    $pdf->Write(0, $scr['2_4_town']);

                    $pdf->SetXY(140, 223);
                    $pdf->Write(0, $scr['2_4_postalCode']);

                    $pdf->SetXY(40, 236);
                    $pdf->Write(0, $scr['2_5_physicalBuilding']);

                    $pdf->SetXY(140, 236);
                    $pdf->Write(0, $scr['2_5_physicalStreet']);

                    $pdf->SetXY(40, 244);
                    $pdf->Write(0, $scr['2_5_physicalTown']);

                    $pdf->SetXY(140, 244);
                    $pdf->Write(0, $scr['2_5_physicalPostalCode']);

                    $pdf->SetXY(40, 255);
                    $pdf->Write(0, $scr['2_6_usaStreet']);

                    $pdf->SetXY(140, 255);
                    $pdf->Write(0, $scr['2_6_usaTown']);

                    $pdf->SetXY(40, 262);
                    $pdf->Write(0, $scr['2_6_usaRegion']);

                    $pdf->SetXY(140, 262);
                    $pdf->Write(0, $scr['2_6_usaPostalCode']);

                    $tplIdx = $pdf->importPage(2);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 10);
                    $pdf->Write(0, 'SCB/SLUL/EDU/'.$scr['id']);



                    $pdf->SetXY(194, 32);
                    $pdf->Write(0, $scr['3_1']);

                    $pdf->SetXY(194, 42);
                    $pdf->Write(0, $scr['3_2']);

                    $pdf->SetXY(194, 55);
                    $pdf->Write(0, $scr['3_3']);

                    $pdf->SetXY(14, 75);
                    $pdf->Write(0, $scr['3_4_1']);

                    $pdf->SetXY(104, 75);
                    $pdf->Write(0, $scr['3_4_2']);

                    $pdf->SetXY(14, 86);
                    $pdf->Write(0, $scr['3_4_3']);

                    $pdf->SetXY(104, 86);
                    $pdf->Write(0, $scr['3_4_4']);

                    $pdf->SetXY(14, 97);
                    $pdf->Write(0, $scr['3_4_5']);

                    $pdf->SetXY(104, 97);
                    $pdf->Write(0, $scr['3_4_6']);

                    $pdf->SetXY(14, 108);
                    $pdf->Write(0, $scr['3_4_7']);

                    $pdf->SetXY(104, 108);
                    $pdf->Write(0, $scr['3_4_8']);

                    $pdf->SetXY(195, 120);
                    $pdf->Write(0, $scr['3_5']);

                    $pdf->SetXY(70, 130);
                    $pdf->Write(0, $scr['3_5_height']);

                    $pdf->SetXY(165, 130);
                    $pdf->Write(0, $scr['3_5_weight']);

                    $pdf->SetXY($scr['3_5_weightStatus'] == "Stationary" ? 61 : ($scr['3_5_weightStatus'] == "Increasing" ? 85 : 109),  137);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(20, 168);
                    $pdf->Write(0, $scr['3_7_1']);

                    $pdf->SetXY(20, 205);
                    $pdf->Write(0, $scr['3_7_2']);

                    $pdf->SetXY(55, 239);
                    $pdf->Write(0, $scr['3_7_3']);

                    $pdf->SetXY(160, 242);
                    $pdf->Write(0, $scr['3_7_4']);

                    $tplIdx = $pdf->importPage(3);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(162, 10);
                    $pdf->Write(0, 'SCB/SLUL/EDU/'.$scr['id']);

                    $pdf->SetXY(20, 26);
                    $pdf->Write(0, $scr['4_weeklyIncome']);

                    $pdf->SetXY(70, 26);
                    $pdf->Write(0, $scr['4_monthlyIncome']);

                    $pdf->SetXY(135, 26);
                    $pdf->Write(0, $scr['4_sourceOfIncome']);


                    $pdf->SetXY(181, 43);
                    $pdf->Write(0, $scr['4_1_1']);

                    $pdf->SetXY(181, 49);
                    $pdf->Write(0, $scr['4_1_2']);

                    $pdf->SetXY(181, 55);
                    $pdf->Write(0, $scr['4_1_3']);

                    $pdf->SetXY(181, 61);
                    $pdf->Write(0, $scr['4_1_4']);

                    $pdf->SetXY(181, 68);
                    $pdf->Write(0, $scr['4_1_5']);



                    $pdf->SetXY(60, 93);
                    $pdf->Write(0, $scr['4_2_nameOfInsure']);

                    $pdf->SetXY(60, 100);
                    $pdf->Write(0, $scr['4_2_dateOfProposal']);

                    $pdf->SetXY(160, 100);
                    $pdf->Write(0, $scr['4_2_sumAssured']);

                    $pdf->SetXY($scr['4_2_acceptedAt'] == 'Ordinary Term' ? 57 : ($scr['4_2_acceptedAt'] == 'Declined or Loaded' ? 91 : ($scr['4_2_acceptedAt'] == 'Postponed' ? 131 : 157)), 106);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY($scr['4_2_1'] == 'Matured' ? 47 : ($scr['4_2_1'] == 'In force' ? 69 : ($scr['4_2_1'] == 'Lapsed' ? 90 : ($scr['4_2_1'] == 'Surrender' ? 110 : ($scr['4_2_1'] == 'Cancelled' ? 133 : 158)))), 114);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(190, 114);
                    $pdf->Write(0, $scr['4_2_2']);

                    $pdf->SetXY($scr['4_3_paymentMethod'] == 'Check-off' ? 63 : ($scr['4_3_paymentMethod'] == 'Direct Debit' ? 88 : ($scr['4_3_paymentMethod'] == 'Standing Order' ? 113 : 145)), 128);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY($scr['4_3_paymentFrequency'] == 'Monthly' ? 70 : ($scr['4_3_paymentFrequency'] == 'Quarterly' ? 93 : ($scr['4_3_paymentFrequency'] == 'Semi-Annually' ? 116 : 147)), 135);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(70, 142);
                    $pdf->Write(0, $scr['4_3_debitInstructionDate']);

                    $pdf->SetXY(180, 142);
                    $pdf->Write(0, $scr['4_3_policyTerm']);

                    $pdf->SetXY(70, 149);
                    $pdf->Write(0, $scr['4_3_premiumPayable']);

                    $pdf->SetXY(90, 156);
                    $pdf->Write(0, $scr['4_3_initialPremiumPaymentAccountNumber']);

                    $pdf->SetXY(90, 163);
                    $pdf->Write(0, $scr['4_3_regularPremiumPaymentAccountNumber']);

                    $pdf->SetXY(15, 187);
                    $pdf->Write(0, $scr['4_4_anb']);

                    $pdf->SetXY(35, 187);
                    $pdf->Write(0, $scr['4_4_term']);

                    $pdf->SetXY(52, 187);
                    $pdf->Write(0, $scr['4_4_rate']);

                    $pdf->SetXY(70, 187);
                    $pdf->Write(0, $scr['4_4_sumAssured']);

                    $pdf->SetXY(120, 187);
                    $pdf->Write(0, $scr['4_4_monthlyPremium']);

                    $pdf->SetXY(165, 187);
                    $pdf->Write(0, $scr['4_4_nonMonthlyPremium']);

                    $pdf->SetXY(120, 194);
                    $pdf->Write(0, $scr['4_4_monthlyPremium_1']);

                    $pdf->SetXY(165, 194);
                    $pdf->Write(0, $scr['4_4_nonMonthlyPremium_1']);

                    $pdf->SetXY(120, 204);
                    $pdf->Write(0, $scr['4_4_monthlyPremium_2']);

                    $pdf->SetXY(165, 204);
                    $pdf->Write(0, $scr['4_4_nonMonthlyPremium_2']);

                    $pdf->SetXY(120, 211);
                    $pdf->Write(0, $scr['4_4_monthlyPremium_3']);

                    $pdf->SetXY(165, 211);
                    $pdf->Write(0, $scr['4_4_nonMonthlyPremium_3']);

                    $pdf->SetXY(120, 218);
                    $pdf->Write(0, $scr['4_4_monthlyPremium_4']);

                    $pdf->SetXY(165, 218);
                    $pdf->Write(0, $scr['4_4_nonMonthlyPremium_4']);

                    $pdf->SetXY(120, 225);
                    $pdf->Write(0, $scr['4_4_monthlyPremium_5']);

                    $pdf->SetXY(165, 225);
                    $pdf->Write(0, $scr['4_4_nonMonthlyPremium_5']);

                    $pdf->SetXY(120, 232);
                    $pdf->Write(0, $scr['4_4_monthlyPremium_6']);

                    $pdf->SetXY(165, 232);
                    $pdf->Write(0, $scr['4_4_nonMonthlyPremium_6']);

                    $pdf->SetXY(55, 240);
                    $pdf->Write(0, $scr['4_4_premiumInWords']);

                    $tplIdx = $pdf->importPage(4);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(162, 9);
                    $pdf->Write(0, 'SCB/SLUL/EDU/'.$scr['id']);

                    $pdf->SetXY(40, 21);
                    $pdf->Write(0, $scr['5_firstName']);

                    $pdf->SetXY(150, 21);
                    $pdf->Write(0, $scr['5_surname']);

                    $pdf->SetXY(40, 29);
                    $pdf->Write(0, $scr['5_dateOfBirth']);

                    $pdf->SetXY($scr['5_gender'] == "Male" ? 89 : 105, 29);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(153, 29);
                    $pdf->Write(0, $scr['5_relationshipToMinor']);

                    $pdf->SetXY(40, 36);
                    $pdf->Write(0, $scr['5_title']);

                    $pdf->SetXY(150, 36);
                    $pdf->Write(0, $scr['5_cell']);

                    $pdf->SetXY($scr['5_postalAddress'] == "Email" ? 44 : 60, 50);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(182, 78);
                    $pdf->Write(0, $scr['6_1_1']);

                    $pdf->SetXY(182, 84);
                    $pdf->Write(0, $scr['6_1_1_a']);

                    $pdf->SetXY(182, 90);
                    $pdf->Write(0, $scr['6_1_1_b']);

                    $pdf->SetXY(182, 96);
                    $pdf->Write(0, $scr['6_1_1_c']);

                    $pdf->SetXY(182, 113);
                    $pdf->Write(0, $scr['6_2_1']);

                    $pdf->SetXY(182, 122);
                    $pdf->Write(0, $scr['6_2_1_b']);

                    $pdf->SetXY(182, 132);
                    $pdf->Write(0, $scr['6_2_2']);

                    $pdf->SetXY(182, 138);
                    $pdf->Write(0, $scr['6_2_2_a']);

                    $pdf->SetXY(182, 144);
                    $pdf->Write(0, $scr['6_2_2_b']);

                    $pdf->SetXY(182, 150);
                    $pdf->Write(0, $scr['6_2_2_c']);

                    $pdf->SetXY(182, 157);
                    $pdf->Write(0, $scr['6_2_2_d']);

                    $pdf->SetXY(182, 163);
                    $pdf->Write(0, $scr['6_2_2_e']);

                    $pdf->SetXY(182, 170);
                    $pdf->Write(0, $scr['6_2_2_f']);

                    $pdf->SetXY(182, 176);
                    $pdf->Write(0, $scr['6_2_2_g']);

                    $pdf->SetXY(182, 192);
                    $pdf->Write(0, $scr['6_3_a']);

                    $pdf->SetXY(182, 199);
                    $pdf->Write(0, $scr['6_3_b']);

                    $pdf->SetXY(70, 212);
                    $pdf->Write(0, $scr['6_4_a']);

                    $pdf->SetXY(150, 212);
                    $pdf->Write(0, $scr['6_4_a_amount']);

                    $pdf->SetXY(70, 219);
                    $pdf->Write(0, $scr['6_4_b']);

                    $pdf->SetXY(150, 219);
                    $pdf->Write(0, $scr['6_4_b_amount']);

                    $pdf->SetXY(70, 226);
                    $pdf->Write(0, $scr['6_4_c']);

                    $pdf->SetXY(150, 226);
                    $pdf->Write(0, $scr['6_4_c_amount']);

                    $pdf->SetXY(70, 232);
                    $pdf->Write(0, $scr['6_4_d']);

                    $pdf->SetXY(150, 232);
                    $pdf->Write(0, $scr['6_4_d_amount']);

                    $pdf->SetXY(70, 239);
                    $pdf->Write(0, $scr['6_4_e']);

                    $pdf->SetXY(150, 239);
                    $pdf->Write(0, $scr['6_4_e_amount']);

                    $pdf->SetXY(70, 246);
                    $pdf->Write(0, $scr['6_4_f']);

                    $pdf->SetXY(150, 246);
                    $pdf->Write(0, $scr['6_4_f_amount']);

                    $pdf->SetXY(71, 251);
                    $pdf->Write(0, $scr['6_4_g']);

                    $tplIdx = $pdf->importPage(5);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(162, 9);
                    $pdf->Write(0, 'SCB/SLUL/EDU/'.$scr['id']);

                    $pdf->Output(public_path('/assets/output/scr/' . $code . '.pdf'), 'F');

                    $email = $scr['2_3_emailAddress'];
                    dd($email);

                    if ($email) {
                        Mail::raw('Your scr subscription', function ($message) use ($email, $code,$scr) {
                            $message->to($email)->subject("scr subscription")
                                ->attach(public_path('/assets/output/scr/' . $code . '.pdf'), [
                                    'as' => 'name.pdf',
                                    'mime' => 'application/pdf',
                                ]);
                            $message->from(env('MAIL_USERNAME'), 'sanlam');
                        });
                    }
                }
                echo $scr['id'] . ',', $scr['code'];
            }
        } else {
            $scr = new Scr;

            $scr['code'] = $code;
            $scr['firstName'] = $request->input('firstName');
            $scr['lastName'] = $request->input('lastName');
            $scr['birthDateOfChild'] = $request->input('birthDateOfChild');
            $scr['childGender'] = $request->input('childGender');
            $scr['relationship'] = $request->input('relationship');

            $scr['2_firstName'] = $request->input('2_firstName');
            $scr['2_lastName'] = $request->input('2_lastName');
            $scr['2_idNumber'] = $request->input('2_idNumber');
            $scr['2_passportNumber'] = $request->input('2_passportNumber');
            $scr['2_title'] = $request->input('2_title');
            $scr['2_maritalStatus'] = $request->input('2_maritalStatus');
            $scr['2_birthDate'] = $request->input('2_birthDate');
            $scr['2_gender'] = $request->input('2_gender');
            $scr['2_occupation'] = $request->input('2_occupation');
            $scr['2_pinNumber'] = $request->input('2_pinNumber');
            $scr['2_nationality'] = $request->input('2_nationality');
            $scr['2_tin'] = $request->input('2_tin');
            $scr['2_citizenship'] = $request->input('2_citizenship');
            $scr['2_residency'] = $request->input('2_residency');

            $scr['2_1_employed'] = $request->input('2_1_employed');
            $scr['2_1_employer'] = $request->input('2_1_employer');
            $scr['2_1_employerCode'] = $request->input('2_1_employerCode');
            $scr['2_1_departmentCode'] = $request->input('2_1_departmentCode');
            $scr['2_1_employeeTerms'] = $request->input('2_1_employeeTerms');
            $scr['2_1_employerNumber'] = $request->input('2_1_employerNumber');

            $scr['2_2_businessName'] = $request->input('2_2_businessName');
            $scr['2_2_natureOfBusiness'] = $request->input('2_2_natureOfBusiness');
            $scr['2_2_properBusiness'] = $request->input('2_2_properBusiness');

            $scr['2_3_cell'] = $request->input('2_3_cell');
            $scr['2_3_workPhone'] = $request->input('2_3_workPhone');
            $scr['2_3_homePhone'] = $request->input('2_3_homePhone');
            $scr['2_3_emailAddress'] = $request->input('2_3_emailAddress');

            $scr['2_4_poBox'] = $request->input('2_4_poBox');
            $scr['2_4_building'] = $request->input('2_4_building');
            $scr['2_4_town'] = $request->input('2_4_town');
            $scr['2_4_postalCode'] = $request->input('2_4_postalCode');

            $scr['2_5_physicalBuilding'] = $request->input('2_5_physicalBuilding');
            $scr['2_5_physicalStreet'] = $request->input('2_5_physicalStreet');
            $scr['2_5_physicalTown'] = $request->input('2_5_physicalTown');
            $scr['2_5_physicalPostalCode'] = $request->input('2_5_physicalPostalCode');

            $scr['2_6_usaStreet'] = $request->input('2_6_usaStreet');
            $scr['2_6_usaTown'] = $request->input('2_6_usaTown');
            $scr['2_6_usaRegion'] = $request->input('2_6_usaRegion');
            $scr['2_6_usaPostalCode'] = $request->input('2_6_usaPostalCode');

            $scr['3_1'] = $request->input('3_1');
            $scr['3_2'] = $request->input('3_2');
            $scr['3_3'] = $request->input('3_3');

            $scr['3_4_1'] = $request->input('3_4_1');
            $scr['3_4_2'] = $request->input('3_4_2');
            $scr['3_4_3'] = $request->input('3_4_3');
            $scr['3_4_4'] = $request->input('3_4_4');
            $scr['3_4_5'] = $request->input('3_4_5');
            $scr['3_4_6'] = $request->input('3_4_6');
            $scr['3_4_7'] = $request->input('3_4_7');
            $scr['3_4_8'] = $request->input('3_4_8');

            $scr['3_5'] = $request->input('3_5');
            $scr['3_5_height'] = $request->input('3_5_height');
            $scr['3_5_weight'] = $request->input('3_5_weight');
            $scr['3_5_weightStatus'] = $request->input('3_5_weightStatus');

            $scr['3_7_1'] = $request->input('3_7_1');
            $scr['3_7_2'] = $request->input('3_7_2');
            $scr['3_7_3'] = $request->input('3_7_3');
            $scr['3_7_4'] = $request->input('3_7_4');

            $scr['4_weeklyIncome'] = $request->input('4_weeklyIncome');
            $scr['4_monthlyIncome'] = $request->input('4_monthlyIncome');
            $scr['4_sourceOfIncome'] = $request->input('4_sourceOfIncome');

            $scr['4_1_1'] = $request->input('4_1_1');
            $scr['4_1_2'] = $request->input('4_1_2');
            $scr['4_1_3'] = $request->input('4_1_3');
            $scr['4_1_4'] = $request->input('4_1_4');
            $scr['4_1_5'] = $request->input('4_1_5');
            $scr['4_2_nameOfInsure'] = $request->input('4_2_nameOfInsure');
            $scr['4_2_dateOfProposal'] = $request->input('4_2_dateOfProposal');
            $scr['4_2_sumAssured'] = $request->input('4_2_sumAssured');
            $scr['4_2_acceptedAt'] = $request->input('4_2_acceptedAt');

            $scr['4_2_1'] = $request->input('4_2_1');
            $scr['4_2_2'] = $request->input('4_2_2');

            $scr['4_3_paymentMethod'] = $request->input('4_3_paymentMethod');
            $scr['4_3_paymentFrequency'] = $request->input('4_3_paymentFrequency');
            $scr['4_3_debitInstructionDate'] = $request->input('4_3_debitInstructionDate');
            $scr['4_3_policyTerm'] = $request->input('4_3_policyTerm');
            $scr['4_3_premiumPayable'] = $request->input('4_3_premiumPayable');
            $scr['4_3_initialPremiumPaymentAccountNumber'] = $request->input('4_3_initialPremiumPaymentAccountNumber');
            $scr['4_3_regularPremiumPaymentAccountNumber'] = $request->input('4_3_regularPremiumPaymentAccountNumber');

            $scr['4_4_anb'] = $request->input('4_4_anb');
            $scr['4_4_term'] = $request->input('4_4_term');
            $scr['4_4_rate'] = $request->input('4_4_rate');

            $scr['4_4_sumAssured'] = $request->input('4_4_sumAssured');
            $scr['4_4_monthlyPremium'] = $request->input('4_4_monthlyPremium');
            $scr['4_4_nonMonthlyPremium'] = $request->input('4_4_nonMonthlyPremium');
            $scr['4_4_discountOnNonMonthly'] = $request->input('4_4_discountOnNonMonthly');

            $scr['4_4_monthlyPremium_1'] = $request->input('4_4_monthlyPremium_1');
            $scr['4_4_nonMonthlyPremium_1'] = $request->input('4_4_nonMonthlyPremium_1');

            $scr['4_4_monthlyPremium_2'] = $request->input('4_4_monthlyPremium_2');
            $scr['4_4_nonMonthlyPremium_2'] = $request->input('4_4_nonMonthlyPremium_2');

            $scr['4_4_monthlyPremium_3'] = $request->input('4_4_monthlyPremium_3');
            $scr['4_4_nonMonthlyPremium_3'] = $request->input('4_4_nonMonthlyPremium_3');

            $scr['4_4_monthlyPremium_4'] = $request->input('4_4_monthlyPremium_4');
            $scr['4_4_nonMonthlyPremium_4'] = $request->input('4_4_nonMonthlyPremium_4');

            $scr['4_4_monthlyPremium_5'] = $request->input('4_4_monthlyPremium_5');
            $scr['4_4_nonMonthlyPremium_5'] = $request->input('4_4_nonMonthlyPremium_5');

            $scr['4_4_monthlyPremium_6'] = $request->input('4_4_monthlyPremium_6');
            $scr['4_4_nonMonthlyPremium_6'] = $request->input('4_4_nonMonthlyPremium_6');

            $scr['4_4_premiumInWords'] = $request->input('4_4_premiumInWords');

            $scr['5_firstName'] = $request->input('5_firstName');
            $scr['5_surname'] = $request->input('5_surname');
            $scr['5_dateOfBirth'] = $request->input('5_dateOfBirth');
            $scr['5_gender'] = $request->input('5_gender');
            $scr['5_relationshipToMinor'] = $request->input('5_relationshipToMinor');
            $scr['5_title'] = $request->input('5_title');
            $scr['5_cell'] = $request->input('5_cell');
            $scr['5_postalAddress'] = $request->input('5_postalAddress');

            $scr['6_1_1'] = $request->input('6_1_1');
            $scr['6_1_1_a'] = $request->input('6_1_1_a');
            $scr['6_1_1_b'] = $request->input('6_1_1_b');
            $scr['6_1_1_c'] = $request->input('6_1_1_c');

            $scr['6_2_1'] = $request->input('6_2_1');
            $scr['6_2_1_b'] = $request->input('6_2_1_b');

            $scr['6_2_2'] = $request->input('6_2_2');
            $scr['6_2_2_a'] = $request->input('6_2_2_a');
            $scr['6_2_2_b'] = $request->input('6_2_2_b');
            $scr['6_2_2_c'] = $request->input('6_2_2_c');
            $scr['6_2_2_d'] = $request->input('6_2_2_d');
            $scr['6_2_2_e'] = $request->input('6_2_2_e');
            $scr['6_2_2_f'] = $request->input('6_2_2_f');
            $scr['6_2_2_g'] = $request->input('6_2_2_g');

            $scr['6_3_a'] = $request->input('6_3_a');
            $scr['6_3_b'] = $request->input('6_3_b');

            $scr['6_4_a'] = $request->input('6_4_a');
            $scr['6_4_a_amount'] = $request->input('6_4_a_amount');
            $scr['6_4_b'] = $request->input('6_4_b');
            $scr['6_4_b_amount'] = $request->input('6_4_b_amount');
            $scr['6_4_c'] = $request->input('6_4_c');
            $scr['6_4_c_amount'] = $request->input('6_4_c_amount');
            $scr['6_4_d'] = $request->input('6_4_d');
            $scr['6_4_d_amount'] = $request->input('6_4_d_amount');
            $scr['6_4_e'] = $request->input('6_4_e');
            $scr['6_4_e_amount'] = $request->input('6_4_e_amount');
            $scr['6_4_f'] = $request->input('6_4_f');
            $scr['6_4_f_amount'] = $request->input('6_4_f_amount');
            $scr['6_4_g'] = $request->input('6_4_g');

            $scr['4_2_hasProposal'] = $request->input('4_2_hasProposal');
            $scr->save();

            echo $scr['id'] . ',', $scr['code'];
        }
    }
}
