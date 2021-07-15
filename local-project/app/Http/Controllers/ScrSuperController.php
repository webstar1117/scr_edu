<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScrSuper;
use Codedge\Fpdf\Fpdf\Fpdf;
use Mail;

class ScrSuperController extends Controller
{
    private $fpdf;
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        return view('scr-super');
    }
    function add(Request $request)
    {

        $code = isset($_GET['code']) ? $_GET['code'] : md5(uniqid());

        if (isset($_GET['id'], $_GET['code'])) {

            $scr = ScrSuper::find($_GET['id']);
            if (!$scr) {
                exit('Invalid code and/or ID!');
            } else {
                $scr->update($request->all());
                if ($request->input('form_end')) {
                    $pdf = new \setasign\Fpdi\Fpdi();
                    $pdf->setSourceFile(public_path('/assets/template/SCB Super Endowment Plus_WEB Template.pdf'));
                    $tplIdx = $pdf->importPage(1);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 60);
                    $pdf->Write(0, 'SCB/SLUL/END/'.$scr['id']);


                    $pdf->SetXY(40, 74);
                    $pdf->Write(0, $scr['1_firstName']);


                    $pdf->SetXY(40, 80);
                    $pdf->Write(0, $scr['1_lastName']);

                    $pdf->SetXY(40, 85);
                    $pdf->Write(0, $scr['1_idNumber']);

                    $pdf->SetXY(130, 85);
                    $pdf->Write(0, $scr['1_passportNumber']);

                    $pdf->SetXY($scr['1_maritalStatus'] == 'Married' ? 37 : 56, 91);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(100, 91);
                    $pdf->Write(0, $scr['1_birthDate']);

                    $pdf->SetXY($scr['1_gender'] == "Male" ? 157 : 172, 91);
                    $pdf->Write(0, 'x');


                    $pdf->SetXY(40, 97);
                    $pdf->Write(0, $scr['1_occupation']);

                    $pdf->SetXY(130, 97);
                    $pdf->Write(0, $scr['1_pinNumber']);

                    $pdf->SetXY(40, 103);
                    $pdf->Write(0, $scr['1_nationality']);

                    $pdf->SetXY(155, 103);
                    $pdf->Write(0, $scr['1_tin']);

                    $pdf->SetXY(40, 109);
                    $pdf->Write(0, $scr['1_citizenship']);

                    $pdf->SetXY(40, 115);
                    $pdf->Write(0, $scr['1_residency']);

                    $pdf->SetXY($scr['1_1_employed'] == "Yes" ? 30 : 41, 128);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(165, 129);
                    $pdf->Write(0, $scr['1_1_employerCode']);

                    $pdf->SetXY(40, 133);
                    $pdf->Write(0, $scr['1_1_employer']);

                    $pdf->SetXY(50, 140);
                    $pdf->Write(0, $scr['1_1_departmentCode']);

                    $pdf->SetXY(170, 140);
                    $pdf->Write(0, $scr['1_1_employerNumber']);

                    $pdf->SetXY($scr['1_1_employeeTerms'] == 'Temporary' ? 39 : ($scr['1_1_employeeTerms'] == 'Permanent' ? 63 : 89), 145);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(60, 158);
                    $pdf->Write(0, $scr['1_2_businessName']);

                    $pdf->SetXY(60, 162);
                    $pdf->Write(0, $scr['1_2_natureOfBusiness']);

                    $pdf->SetXY(60, 168);
                    $pdf->Write(0, $scr['1_2_properBusiness']);


                    $pdf->SetXY(65, 181);
                    $pdf->Write(0, $scr['1_3_cell']);

                    $pdf->SetXY(165, 182);
                    $pdf->Write(0, $scr['1_3_homePhone']);

                    $pdf->SetXY(40, 186);
                    $pdf->Write(0, $scr['1_3_workPhone']);

                    $pdf->SetXY(45, 192);
                    $pdf->Write(0, $scr['1_3_emailAddress']);


                    $pdf->SetXY(40, 203);
                    $pdf->Write(0, $scr['1_4_poBox']);

                    $pdf->SetXY(140, 203);
                    $pdf->Write(0, $scr['1_4_building']);

                    $pdf->SetXY(40, 209);
                    $pdf->Write(0, $scr['1_4_town']);

                    $pdf->SetXY(140, 209);
                    $pdf->Write(0, $scr['1_4_postalCode']);

                    $pdf->SetXY(40, 221);
                    $pdf->Write(0, $scr['1_5_physicalBuilding']);

                    $pdf->SetXY(140, 221);
                    $pdf->Write(0, $scr['1_5_physicalStreet']);

                    $pdf->SetXY(40, 229);
                    $pdf->Write(0, $scr['1_5_physicalTown']);

                    $pdf->SetXY(140, 229);
                    $pdf->Write(0, $scr['1_5_physicalPostalCode']);

                    $pdf->SetXY(40, 241);
                    $pdf->Write(0, $scr['1_6_usaStreet']);

                    $pdf->SetXY(140, 241);
                    $pdf->Write(0, $scr['1_6_usaTown']);

                    $pdf->SetXY(40, 247);
                    $pdf->Write(0, $scr['1_6_usaRegion']);

                    $pdf->SetXY(140, 247);
                    $pdf->Write(0, $scr['1_6_usaPostalCode']);

                    $tplIdx = $pdf->importPage(2);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 23);
                    $pdf->Write(0, 'SCB/SLUL/END/'.$scr['id']);

                    $pdf->SetXY(189, 43);
                    $pdf->Write(0, $scr['2_1']);

                    $pdf->SetXY(189, 53);
                    $pdf->Write(0, $scr['2_2']);

                    $pdf->SetXY(189, 61);
                    $pdf->Write(0, $scr['2_3']);

                    $pdf->SetXY(22, 75);
                    $pdf->Write(0, $scr['2_4_1']);

                    $pdf->SetXY(105, 75);
                    $pdf->Write(0, $scr['2_4_2']);

                    $pdf->SetXY(22, 86);
                    $pdf->Write(0, $scr['2_4_3']);

                    $pdf->SetXY(105, 86);
                    $pdf->Write(0, $scr['2_4_4']);

                    $pdf->SetXY(22, 95);
                    $pdf->Write(0, $scr['2_4_5']);

                    $pdf->SetXY(105, 95);
                    $pdf->Write(0, $scr['2_4_6']);

                    $pdf->SetXY(22, 104);
                    $pdf->Write(0, $scr['2_4_7']);

                    $pdf->SetXY(105, 104);
                    $pdf->Write(0, $scr['2_4_8']);

                    $pdf->SetXY(190, 113);
                    $pdf->Write(0, $scr['2_5']);

                    $pdf->SetXY(70, 120);
                    $pdf->Write(0, $scr['2_5_height']);

                    $pdf->SetXY(165, 120);
                    $pdf->Write(0, $scr['2_5_weight']);

                    $pdf->SetXY($scr['2_5_weightStatus'] == "Stationary" ? 59 : ($scr['2_5_weightStatus'] == "Increasing" ? 83 : 107),  127);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(20, 148);
                    $pdf->Write(0, $scr['2_7_1']);

                    $pdf->SetXY(20, 175);
                    $pdf->Write(0, $scr['2_7_2']);

                    $pdf->SetXY(55, 202);
                    $pdf->Write(0, $scr['2_7_3']);

                    $pdf->SetXY(160, 202);
                    $pdf->Write(0, $scr['2_7_4']);

                    $pdf->SetXY(45, 222);
                    $pdf->Write(0, $scr['3_weeklyIncome']);

                    $pdf->SetXY(95, 222);
                    $pdf->Write(0, $scr['3_monthlyIncome']);

                    $pdf->SetXY(145, 222);
                    $pdf->Write(0, $scr['3_sourceOfIncome']);


                    $pdf->SetXY(177, 246);
                    $pdf->Write(0, $scr['3_1_1']);

                    $pdf->SetXY(177, 252);
                    $pdf->Write(0, $scr['3_1_2']);

                    $pdf->SetXY(177, 258);
                    $pdf->Write(0, $scr['3_1_3']);

                    $pdf->SetXY(177, 264);
                    $pdf->Write(0, $scr['3_1_4']);

                    $pdf->SetXY(177, 272);
                    $pdf->Write(0, $scr['3_1_5']);

                    $tplIdx = $pdf->importPage(3);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 23);
                    $pdf->Write(0, 'SCB/SLUL/END/'.$scr['id']);


                    $pdf->SetXY(60, 45);
                    $pdf->Write(0, $scr['3_2_nameOfInsure']);

                    $pdf->SetXY(60, 51);
                    $pdf->Write(0, $scr['3_2_dateOfProposal']);

                    $pdf->SetXY(160, 51);
                    $pdf->Write(0, $scr['3_2_sumAssured']);

                    $pdf->SetXY($scr['3_2_acceptedAt'] == 'Ordinary Term' ? 56 : ($scr['3_2_acceptedAt'] == 'Declined or Loaded' ? 90 : ($scr['3_2_acceptedAt'] == 'Postponed' ? 130 : 156)), 59);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY($scr['3_2_1'] == 'Matured' ? 47 : ($scr['3_2_1'] == 'In force' ? 69 : ($scr['3_2_1'] == 'Lapsed' ? 90 : ($scr['3_2_1'] == 'Surrender' ? 110 : ($scr['3_2_1'] == 'Cancelled' ? 133 : 158)))), 66);
                    $pdf->Write(0, 'x');



                    $pdf->SetXY(190, 66);
                    $pdf->Write(0, $scr['3_2_2']);

                    $pdf->SetXY($scr['3_3_paymentMethod'] == 'Check-off' ? 60 : ($scr['3_3_paymentMethod'] == 'Direct Debit' ? 85 : ($scr['3_3_paymentMethod'] == 'Standing Order' ? 110 : 142)), 79);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY($scr['3_3_paymentFrequency'] == 'Monthly' ? 68 : ($scr['3_3_paymentFrequency'] == 'Quarterly' ? 91 : ($scr['3_3_paymentFrequency'] == 'Semi-Annually' ? 114 : 145)), 87);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(70, 94);
                    $pdf->Write(0, $scr['3_3_debitInstructionDate']);

                    $pdf->SetXY(180, 94);
                    $pdf->Write(0, $scr['3_3_policyTerm']);

                    $pdf->SetXY(70, 101);
                    $pdf->Write(0, $scr['3_3_premiumPayable']);

                    $pdf->SetXY(90, 108);
                    $pdf->Write(0, $scr['3_3_initialPremiumPaymentAccountNumber']);

                    $pdf->SetXY(90, 115);
                    $pdf->Write(0, $scr['3_3_regularPremiumPaymentAccountNumber']);

                    $pdf->SetXY(15, 137);
                    $pdf->Write(0, $scr['3_4_anb']);

                    $pdf->SetXY(35, 137);
                    $pdf->Write(0, $scr['3_4_term']);

                    $pdf->SetXY(52, 137);
                    $pdf->Write(0, $scr['3_4_rate']);

                    $pdf->SetXY(70, 137);
                    $pdf->Write(0, $scr['3_4_sumAssured']);

                    $pdf->SetXY(120, 137);
                    $pdf->Write(0, $scr['3_4_monthlyPremium']);

                    $pdf->SetXY(165, 137);
                    $pdf->Write(0, $scr['3_4_nonMonthlyPremium']);

                    $pdf->SetXY(120, 144);
                    $pdf->Write(0, $scr['3_4_monthlyPremium_1']);

                    $pdf->SetXY(165, 144);
                    $pdf->Write(0, $scr['3_4_nonMonthlyPremium_1']);

                    $pdf->SetXY(120, 154);
                    $pdf->Write(0, $scr['3_4_monthlyPremium_2']);

                    $pdf->SetXY(165, 154);
                    $pdf->Write(0, $scr['3_4_nonMonthlyPremium_2']);

                    $pdf->SetXY(120, 161);
                    $pdf->Write(0, $scr['3_4_monthlyPremium_3']);

                    $pdf->SetXY(165, 161);
                    $pdf->Write(0, $scr['3_4_nonMonthlyPremium_3']);

                    $pdf->SetXY(120, 168);
                    $pdf->Write(0, $scr['3_4_monthlyPremium_4']);

                    $pdf->SetXY(165, 168);
                    $pdf->Write(0, $scr['3_4_nonMonthlyPremium_4']);

                    $pdf->SetXY(120, 175);
                    $pdf->Write(0, $scr['3_4_monthlyPremium_5']);

                    $pdf->SetXY(165, 175);
                    $pdf->Write(0, $scr['3_4_nonMonthlyPremium_5']);

                    $pdf->SetXY(120, 182);
                    $pdf->Write(0, $scr['3_4_monthlyPremium_6']);

                    $pdf->SetXY(165, 182);
                    $pdf->Write(0, $scr['3_4_nonMonthlyPremium_6']);

                    $pdf->SetXY(55, 189);
                    $pdf->Write(0, $scr['3_4_premiumInWords']);

                    $tplIdx = $pdf->importPage(4);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 23);
                    $pdf->Write(0, 'SCB/SLUL/END/'.$scr['id']);

                    $pdf->SetXY(45, 41);
                    $pdf->Write(0, $scr['4_1_firstName']);

                    $pdf->SetXY(45, 47);
                    $pdf->Write(0, $scr['4_1_surName']);

                    $pdf->SetXY(160, 47);
                    $pdf->Write(0, $scr['4_1_dateOfBirth']);

                    $pdf->SetXY($scr['4_1_gender'] == "Mail" ? 43 : 59, 53);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(95, 53);
                    $pdf->Write(0, $scr['4_1_title']);

                    $pdf->SetXY(145, 53);
                    $pdf->Write(0, $scr['4_1_relationship']);

                    $pdf->SetXY(45, 59);
                    $pdf->Write(0, $scr['4_1_cell']);

                    $pdf->SetXY(160, 60);
                    $pdf->Write(0, $scr['4_1_benefitShare']);

                    $pdf->SetXY(60, 68);
                    $pdf->Write(0, $scr['4_1_guadianFullname']);

                    $pdf->SetXY(60, 73);
                    $pdf->Write(0, $scr['4_1_guadianBirthDate']);

                    $pdf->SetXY(150, 73);
                    $pdf->Write(0, $scr['4_1_guadianTelephone']);


                    $pdf->SetXY(45, 83);
                    $pdf->Write(0, $scr['4_2_firstName']);

                    $pdf->SetXY(45, 89);
                    $pdf->Write(0, $scr['4_2_surName']);

                    $pdf->SetXY(160, 89);
                    $pdf->Write(0, $scr['4_2_dateOfBirth']);

                    $pdf->SetXY($scr['4_2_gender'] == "Mail" ? 43 : 59, 95);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(95, 95);
                    $pdf->Write(0, $scr['4_2_title']);

                    $pdf->SetXY(145, 95);
                    $pdf->Write(0, $scr['4_2_relationship']);

                    $pdf->SetXY(45, 102);
                    $pdf->Write(0, $scr['4_2_cell']);

                    $pdf->SetXY(160, 103);
                    $pdf->Write(0, $scr['4_2_benefitShare']);

                    $pdf->SetXY(60, 110);
                    $pdf->Write(0, $scr['4_2_guadianFullname']);

                    $pdf->SetXY(60, 116);
                    $pdf->Write(0, $scr['4_2_guadianBirthDate']);

                    $pdf->SetXY(150, 116);
                    $pdf->Write(0, $scr['4_2_guadianTelephone']);


                    $pdf->SetXY(45, 126);
                    $pdf->Write(0, $scr['4_3_firstName']);

                    $pdf->SetXY(45, 132);
                    $pdf->Write(0, $scr['4_3_surName']);

                    $pdf->SetXY(160, 132);
                    $pdf->Write(0, $scr['4_3_dateOfBirth']);

                    $pdf->SetXY($scr['4_3_gender'] == "Mail" ? 43 : 59, 138);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(95, 138);
                    $pdf->Write(0, $scr['4_3_title']);

                    $pdf->SetXY(145, 138);
                    $pdf->Write(0, $scr['4_3_relationship']);

                    $pdf->SetXY(45, 145);
                    $pdf->Write(0, $scr['4_3_cell']);

                    $pdf->SetXY(160, 146);
                    $pdf->Write(0, $scr['4_3_benefitShare']);

                    $pdf->SetXY(60, 153);
                    $pdf->Write(0, $scr['4_3_guadianFullname']);

                    $pdf->SetXY(60, 159);
                    $pdf->Write(0, $scr['4_3_guadianBirthDate']);

                    $pdf->SetXY(150, 159);
                    $pdf->Write(0, $scr['4_3_guadianTelephone']);

                    $pdf->SetXY(45, 169);
                    $pdf->Write(0, $scr['4_4_firstName']);

                    $pdf->SetXY(45, 175);
                    $pdf->Write(0, $scr['4_4_surName']);

                    $pdf->SetXY(160, 175);
                    $pdf->Write(0, $scr['4_4_dateOfBirth']);

                    $pdf->SetXY($scr['4_4_gender'] == "Mail" ? 43 : 59, 181);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(95, 181);
                    $pdf->Write(0, $scr['4_4_title']);

                    $pdf->SetXY(145, 181);
                    $pdf->Write(0, $scr['4_4_relationship']);

                    $pdf->SetXY(45, 188);
                    $pdf->Write(0, $scr['4_4_cell']);

                    $pdf->SetXY(160, 187);
                    $pdf->Write(0, $scr['4_4_benefitShare']);

                    $pdf->SetXY(60, 196);
                    $pdf->Write(0, $scr['4_4_guadianFullname']);

                    $pdf->SetXY(60, 201);
                    $pdf->Write(0, $scr['4_4_guadianBirthDate']);

                    $pdf->SetXY(150, 201);
                    $pdf->Write(0, $scr['4_4_guadianTelephone']);


                    $pdf->SetXY(45, 211);
                    $pdf->Write(0, $scr['4_5_firstName']);

                    $pdf->SetXY(45, 217);
                    $pdf->Write(0, $scr['4_5_surName']);

                    $pdf->SetXY(160, 217);
                    $pdf->Write(0, $scr['4_5_dateOfBirth']);

                    $pdf->SetXY($scr['4_5_gender'] == "Mail" ? 43 : 59, 223);
                    $pdf->Write(0, 'x');

                    $pdf->SetXY(95, 223);
                    $pdf->Write(0, $scr['4_5_title']);

                    $pdf->SetXY(145, 223);
                    $pdf->Write(0, $scr['4_5_relationship']);

                    $pdf->SetXY(45, 230);
                    $pdf->Write(0, $scr['4_5_cell']);

                    $pdf->SetXY(160, 231);
                    $pdf->Write(0, $scr['4_5_benefitShare']);

                    $pdf->SetXY(60, 238);
                    $pdf->Write(0, $scr['4_5_guadianFullname']);

                    $pdf->SetXY(60, 244);
                    $pdf->Write(0, $scr['4_5_guadianBirthDate']);

                    $pdf->SetXY(150, 244);
                    $pdf->Write(0, $scr['4_5_guadianTelephone']);


                    $pdf->SetXY($scr['4_postalAddress'] == "Email" ? 43 : 59, 261);
                    $pdf->Write(0, 'x');


                    $tplIdx = $pdf->importPage(5);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 23);
                    $pdf->Write(0, 'SCB/SLUL/END/'.$scr['id']);


                    $pdf->SetXY(176, 49);
                    $pdf->Write(0, $scr['5_1_1']);

                    $pdf->SetXY(176, 55);
                    $pdf->Write(0, $scr['5_1_1_a']);

                    $pdf->SetXY(176, 61);
                    $pdf->Write(0, $scr['5_1_1_b']);

                    $pdf->SetXY(176, 67);
                    $pdf->Write(0, $scr['5_1_1_c']);

                    $pdf->SetXY(176, 84);
                    $pdf->Write(0, $scr['5_2_1']);

                    $pdf->SetXY(176, 93);
                    $pdf->Write(0, $scr['5_2_1_b']);

                    $pdf->SetXY(176, 103);
                    $pdf->Write(0, $scr['5_2_2']);

                    $pdf->SetXY(176, 109);
                    $pdf->Write(0, $scr['5_2_2_a']);

                    $pdf->SetXY(176, 115);
                    $pdf->Write(0, $scr['5_2_2_b']);

                    $pdf->SetXY(176, 121);
                    $pdf->Write(0, $scr['5_2_2_c']);

                    $pdf->SetXY(176, 127);
                    $pdf->Write(0, $scr['5_2_2_d']);

                    $pdf->SetXY(176, 133);
                    $pdf->Write(0, $scr['5_2_2_e']);

                    $pdf->SetXY(176, 139);
                    $pdf->Write(0, $scr['5_2_2_f']);

                    $pdf->SetXY(176, 145);
                    $pdf->Write(0, $scr['5_2_2_g']);

                    $pdf->SetXY(176, 161);
                    $pdf->Write(0, $scr['5_3_a']);

                    $pdf->SetXY(176, 167);
                    $pdf->Write(0, $scr['5_3_b']);

                    $pdf->SetXY(70, 185);
                    $pdf->Write(0, $scr['5_4_a']);

                    $pdf->SetXY(150, 185);
                    $pdf->Write(0, $scr['5_4_a_amount']);

                    $pdf->SetXY(70, 192);
                    $pdf->Write(0, $scr['5_4_b']);

                    $pdf->SetXY(150, 192);
                    $pdf->Write(0, $scr['5_4_b_amount']);

                    $pdf->SetXY(70, 199);
                    $pdf->Write(0, $scr['5_4_c']);

                    $pdf->SetXY(150, 199);
                    $pdf->Write(0, $scr['5_4_c_amount']);

                    $pdf->SetXY(70, 205);
                    $pdf->Write(0, $scr['5_4_d']);

                    $pdf->SetXY(150, 205);
                    $pdf->Write(0, $scr['5_4_d_amount']);

                    $pdf->SetXY(70, 212);
                    $pdf->Write(0, $scr['5_4_e']);

                    $pdf->SetXY(150, 212);
                    $pdf->Write(0, $scr['5_4_e_amount']);

                    $tplIdx = $pdf->importPage(6);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 0, 0);
                    $pdf->SetFont('Arial', '', '10');
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetXY(155, 23);
                    $pdf->Write(0, 'SCB/SLUL/END/'.$scr['id']);

                    $pdf->Output(public_path('/assets/output/scr-super/' . $code . '.pdf'), 'F');


                    $email = $scr['1_3_emailAddress'];

                    if ($email) {
                        Mail::raw('Your scr subscription', function ($message) use ($email, $code) {
                            $message->to($email)->subject("scr subscription")
                                ->attach(public_path('/assets/output/scr-super/' . $code . '.pdf'), [
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
            $scr = new ScrSuper;

            $scr['code'] = $code;
            $scr['1_firstName'] = $request->input('1_firstName');
            $scr['1_lastName'] = $request->input('1_lastName');
            $scr['1_idNumber'] = $request->input('1_idNumber');
            $scr['1_passportNumber'] = $request->input('1_passportNumber');
            $scr['1_title'] = $request->input('1_title');
            $scr['1_maritalStatus'] = $request->input('1_maritalStatus');
            $scr['1_birthDate'] = $request->input('1_birthDate');
            $scr['1_gender'] = $request->input('1_gender');
            $scr['1_occupation'] = $request->input('1_occupation');
            $scr['1_pinNumber'] = $request->input('1_pinNumber');
            $scr['1_nationality'] = $request->input('1_nationality');
            $scr['1_tin'] = $request->input('1_tin');
            $scr['1_citizenship'] = $request->input('1_citizenship');
            $scr['1_residency'] = $request->input('1_residency');
    
            $scr['1_1_employed'] = $request->input('1_1_employed');
            $scr['1_1_employer'] = $request->input('1_1_employer');
            $scr['1_1_employerCode'] = $request->input('1_1_employerCode');
            $scr['1_1_departmentCode'] = $request->input('1_1_departmentCode');
            $scr['1_1_employeeTerms'] = $request->input('1_1_employeeTerms');
            $scr['1_1_employerNumber'] = $request->input('1_1_employerNumber');
    
            $scr['1_2_businessName'] = $request->input('1_2_businessName');
            $scr['1_2_natureOfBusiness'] = $request->input('1_2_natureOfBusiness');
            $scr['1_2_properBusiness'] = $request->input('1_2_properBusiness');
    
            $scr['1_3_cell'] = $request->input('1_3_cell');
            $scr['1_3_workPhone'] = $request->input('1_3_workPhone');
            $scr['1_3_homePhone'] = $request->input('1_3_homePhone');
            $scr['1_3_emailAddress'] = $request->input('1_3_emailAddress');
    
            $scr['1_4_poBox'] = $request->input('1_4_poBox');
            $scr['1_4_building'] = $request->input('1_4_building');
            $scr['1_4_town'] = $request->input('1_4_town');
            $scr['1_4_postalCode'] = $request->input('1_4_postalCode');
    
            $scr['1_5_physicalBuilding'] = $request->input('1_5_physicalBuilding');
            $scr['1_5_physicalStreet'] = $request->input('1_5_physicalStreet');
            $scr['1_5_physicalTown'] = $request->input('1_5_physicalTown');
            $scr['1_5_physicalPostalCode'] = $request->input('1_5_physicalPostalCode');
    
            $scr['1_6_usaStreet'] = $request->input('1_6_usaStreet');
            $scr['1_6_usaTown'] = $request->input('1_6_usaTown');
            $scr['1_6_usaRegion'] = $request->input('1_6_usaRegion');
            $scr['1_6_usaPostalCode'] = $request->input('1_6_usaPostalCode');
    
            $scr['2_1'] = $request->input('2_1');
            $scr['2_2'] = $request->input('2_2');
            $scr['2_3'] = $request->input('2_3');
    
            $scr['2_4_1'] = $request->input('2_4_1');
            $scr['2_4_2'] = $request->input('2_4_2');
            $scr['2_4_3'] = $request->input('2_4_3');
            $scr['2_4_4'] = $request->input('2_4_4');
            $scr['2_4_5'] = $request->input('2_4_5');
            $scr['2_4_6'] = $request->input('2_4_6');
            $scr['2_4_7'] = $request->input('2_4_7');
            $scr['2_4_8'] = $request->input('2_4_8');
    
            $scr['2_5'] = $request->input('2_5');
            $scr['2_5_height'] = $request->input('2_5_height');
            $scr['2_5_weight'] = $request->input('2_5_weight');
            $scr['2_5_weightStatus'] = $request->input('2_5_weightStatus');
    
            $scr['2_7_1'] = $request->input('2_7_1');
            $scr['2_7_2'] = $request->input('2_7_2');
            $scr['2_7_3'] = $request->input('2_7_3');
            $scr['2_7_4'] = $request->input('2_7_4');
    
            $scr['3_weeklyIncome'] = $request->input('3_weeklyIncome');
            $scr['3_monthlyIncome'] = $request->input('3_monthlyIncome');
            $scr['3_sourceOfIncome'] = $request->input('3_sourceOfIncome');
    
            $scr['3_1_1'] = $request->input('3_1_1');
            $scr['3_1_2'] = $request->input('3_1_2');
            $scr['3_1_3'] = $request->input('3_1_3');
            $scr['3_1_4'] = $request->input('3_1_4');
            $scr['3_1_5'] = $request->input('3_1_5');
            $scr['3_2_nameOfInsure'] = $request->input('3_2_nameOfInsure');
            $scr['3_2_dateOfProposal'] = $request->input('3_2_dateOfProposal');
            $scr['3_2_sumAssured'] = $request->input('3_2_sumAssured');
            $scr['3_2_acceptedAt'] = $request->input('3_2_acceptedAt');
    
            $scr['3_2_1'] = $request->input('3_2_1');
            $scr['3_2_2'] = $request->input('3_2_2');
    
            $scr['3_3_paymentMethod'] = $request->input('3_3_paymentMethod');
            $scr['3_3_paymentFrequency'] = $request->input('3_3_paymentFrequency');
            $scr['3_3_debitInstructionDate'] = $request->input('3_3_debitInstructionDate');
            $scr['3_3_policyTerm'] = $request->input('3_3_policyTerm');
            $scr['3_3_premiumPayable'] = $request->input('3_3_premiumPayable');
            $scr['3_3_initialPremiumPaymentAccountNumber'] = $request->input('3_3_initialPremiumPaymentAccountNumber');
            $scr['3_3_regularPremiumPaymentAccountNumber'] = $request->input('3_3_regularPremiumPaymentAccountNumber');
    
            $scr['3_4_anb'] = $request->input('3_4_anb');
            $scr['3_4_term'] = $request->input('3_4_term');
            $scr['3_4_rate'] = $request->input('3_4_rate');
    
            $scr['3_4_sumAssured'] = $request->input('3_4_sumAssured');
            $scr['3_4_monthlyPremium'] = $request->input('3_4_monthlyPremium');
            $scr['3_4_nonMonthlyPremium'] = $request->input('3_4_nonMonthlyPremium');
            $scr['3_4_discountOnNonMonthly'] = $request->input('3_4_discountOnNonMonthly');
    
            $scr['3_4_monthlyPremium_1'] = $request->input('3_4_monthlyPremium_1');
            $scr['3_4_nonMonthlyPremium_1'] = $request->input('3_4_nonMonthlyPremium_1');
    
            $scr['3_4_monthlyPremium_2'] = $request->input('3_4_monthlyPremium_2');
            $scr['3_4_nonMonthlyPremium_2'] = $request->input('3_4_nonMonthlyPremium_2');
    
            $scr['3_4_monthlyPremium_3'] = $request->input('3_4_monthlyPremium_3');
            $scr['3_4_nonMonthlyPremium_3'] = $request->input('3_4_nonMonthlyPremium_3');
    
            $scr['3_4_monthlyPremium_4'] = $request->input('3_4_monthlyPremium_4');
            $scr['3_4_nonMonthlyPremium_4'] = $request->input('3_4_nonMonthlyPremium_4');
    
            $scr['3_4_monthlyPremium_5'] = $request->input('3_4_monthlyPremium_5');
            $scr['3_4_nonMonthlyPremium_5'] = $request->input('3_4_nonMonthlyPremium_5');
    
            $scr['3_4_monthlyPremium_6'] = $request->input('3_4_monthlyPremium_6');
            $scr['3_4_nonMonthlyPremium_6'] = $request->input('3_4_nonMonthlyPremium_6');
    
            $scr['3_4_premiumInWords'] = $request->input('3_4_premiumInWords');
            $scr['4_1_firstName'] = $request->input('4_1_firstName');
            $scr['4_1_surName'] = $request->input('4_1_surName');
            $scr['4_1_dateOfBirth'] = $request->input('4_1_dateOfBirth');
            $scr['4_1_gender'] = $request->input('4_1_gender');
            $scr['4_1_title'] = $request->input('4_1_title');
            $scr['4_1_relationship'] = $request->input('4_1_relationship');
            $scr['4_1_cell'] = $request->input('4_1_cell');
            $scr['4_1_benefitShare'] = $request->input('4_1_benefitShare');
            $scr['4_1_guadianFullname'] = $request->input('4_1_guadianFullname');
            $scr['4_1_guadianBirthDate'] = $request->input('4_1_guadianBirthDate');
            $scr['4_1_guadianTelephone'] = $request->input('4_1_guadianTelephone');
    
            $scr['4_2_firstName'] = $request->input('4_2_firstName');
            $scr['4_2_surName'] = $request->input('4_2_surName');
            $scr['4_2_dateOfBirth'] = $request->input('4_2_dateOfBirth');
            $scr['4_2_gender'] = $request->input('4_2_gender');
            $scr['4_2_title'] = $request->input('4_2_title');
            $scr['4_2_relationship'] = $request->input('4_2_relationship');
            $scr['4_2_cell'] = $request->input('4_2_cell');
            $scr['4_2_benefitShare'] = $request->input('4_2_benefitShare');
            $scr['4_2_guadianFullname'] = $request->input('4_2_guadianFullname');
            $scr['4_2_guadianBirthDate'] = $request->input('4_2_guadianBirthDate');
            $scr['4_2_guadianTelephone'] = $request->input('4_2_guadianTelephone');
    
            $scr['4_3_firstName'] = $request->input('4_3_firstName');
            $scr['4_3_surName'] = $request->input('4_3_surName');
            $scr['4_3_dateOfBirth'] = $request->input('4_3_dateOfBirth');
            $scr['4_3_gender'] = $request->input('4_3_gender');
            $scr['4_3_title'] = $request->input('4_3_title');
            $scr['4_3_relationship'] = $request->input('4_3_relationship');
            $scr['4_3_cell'] = $request->input('4_3_cell');
            $scr['4_3_benefitShare'] = $request->input('4_3_benefitShare');
            $scr['4_3_guadianFullname'] = $request->input('4_3_guadianFullname');
            $scr['4_3_guadianBirthDate'] = $request->input('4_3_guadianBirthDate');
            $scr['4_3_guadianTelephone'] = $request->input('4_3_guadianTelephone');
    
            $scr['4_4_firstName'] = $request->input('4_4_firstName');
            $scr['4_4_surName'] = $request->input('4_4_surName');
            $scr['4_4_dateOfBirth'] = $request->input('4_4_dateOfBirth');
            $scr['4_4_gender'] = $request->input('4_4_gender');
            $scr['4_4_title'] = $request->input('4_4_title');
            $scr['4_4_relationship'] = $request->input('4_4_relationship');
            $scr['4_4_cell'] = $request->input('4_4_cell');
            $scr['4_4_benefitShare'] = $request->input('4_4_benefitShare');
            $scr['4_4_guadianFullname'] = $request->input('4_4_guadianFullname');
            $scr['4_4_guadianBirthDate'] = $request->input('4_4_guadianBirthDate');
            $scr['4_4_guadianTelephone'] = $request->input('4_4_guadianTelephone');
    
            $scr['4_5_firstName'] = $request->input('4_5_firstName');
            $scr['4_5_surName'] = $request->input('4_5_surName');
            $scr['4_5_dateOfBirth'] = $request->input('4_5_dateOfBirth');
            $scr['4_5_gender'] = $request->input('4_5_gender');
            $scr['4_5_title'] = $request->input('4_5_title');
            $scr['4_5_relationship'] = $request->input('4_5_relationship');
            $scr['4_5_cell'] = $request->input('4_5_cell');
            $scr['4_5_benefitShare'] = $request->input('4_5_benefitShare');
            $scr['4_5_guadianFullname'] = $request->input('4_5_guadianFullname');
            $scr['4_5_guadianBirthDate'] = $request->input('4_5_guadianBirthDate');
            $scr['4_5_guadianTelephone'] = $request->input('4_5_guadianTelephone');
    
            $scr['4_postalAddress'] = $request->input('4_postalAddress');
    
            $scr['5_1_1'] = $request->input('5_1_1');
            $scr['5_1_1_a'] = $request->input('5_1_1_a');
            $scr['5_1_1_b'] = $request->input('5_1_1_b');
            $scr['5_1_1_c'] = $request->input('5_1_1_c');
    
            $scr['5_2_1'] = $request->input('5_2_1');
            $scr['5_2_1_b'] = $request->input('5_2_1_b');
    
            $scr['5_2_2'] = $request->input('5_2_2');
            $scr['5_2_2_a'] = $request->input('5_2_2_a');
            $scr['5_2_2_b'] = $request->input('5_2_2_b');
            $scr['5_2_2_c'] = $request->input('5_2_2_c');
            $scr['5_2_2_d'] = $request->input('5_2_2_d');
            $scr['5_2_2_e'] = $request->input('5_2_2_e');
            $scr['5_2_2_f'] = $request->input('5_2_2_f');
            $scr['5_2_2_g'] = $request->input('5_2_2_g');
    
            $scr['5_3_a'] = $request->input('5_3_a');
            $scr['5_3_b'] = $request->input('5_3_b');
    
            $scr['5_4_a'] = $request->input('5_4_a');
            $scr['5_4_a_amount'] = $request->input('5_4_a_amount');
            $scr['5_4_b'] = $request->input('5_4_b');
            $scr['5_4_b_amount'] = $request->input('5_4_b_amount');
            $scr['5_4_c'] = $request->input('5_4_c');
            $scr['5_4_c_amount'] = $request->input('5_4_c_amount');
            $scr['5_4_d'] = $request->input('5_4_d');
            $scr['5_4_d_amount'] = $request->input('5_4_d_amount');
            $scr['5_4_e'] = $request->input('5_4_e');
            $scr['5_4_e_amount'] = $request->input('5_4_e_amount');
            $scr['5_4_f'] = $request->input('5_4_f');
            $scr['5_4_f_amount'] = $request->input('5_4_f_amount');
            $scr['5_4_g'] = $request->input('5_4_g');
    
            $scr->save();

            echo $scr['id'] . ',', $scr['code'];
        }
    }
}
