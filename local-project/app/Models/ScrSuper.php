<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrSuper extends Model
{
    use HasFactory;
    protected $fillable = [
        '1_firstName',
        '1_lastName',
        '1_idNumber',
        '1_passportNumber',
        '1_title',
        '1_maritalStatus',
        '1_birthDate',
        '1_gender',
        '1_occupation',
        '1_pinNumber',
        '1_nationality',
        '1_tin',
        '1_citizenship',
        '1_residency',
        '1_1_employed',
        '1_1_employer',
        '1_1_employerCode',
        '1_1_departmentCode',
        '1_1_employeeTerms',
        '1_1_employerNumber',
        '1_2_businessName',
        '1_2_natureOfBusiness',
        '1_2_properBusiness',
        '1_3_cell',
        '1_3_workPhone',
        '1_3_homePhone',
        '1_3_emailAddress',
        '1_4_poBox',
        '1_4_building',
        '1_4_town',
        '1_4_postalCode',
        '1_5_physicalBuilding',
        '1_5_physicalStreet',
        '1_5_physicalTown',
        '1_5_physicalPostalCode',
        '1_6_usaStreet',
        '1_6_usaTown',
        '1_6_usaRegion',
        '1_6_usaPostalCode',
        '2_1',
        '2_2',
        '2_3',
        '2_4_1',
        '2_4_2',
        '2_4_3',
        '2_4_4',
        '2_4_5',
        '2_4_6',
        '2_4_7',
        '2_4_8',
        '2_5',
        '2_5_height',
        '2_5_weight',
        '2_5_weightStatus',
        '2_7_1',
        '2_7_2',
        '2_7_3',
        '2_7_4',
        '3_weeklyIncome',
        '3_monthlyIncome',
        '3_sourceOfIncome',
        '3_1_1',
        '3_1_2',
        '3_1_3',
        '3_1_4',
        '3_1_5',
        '3_2_nameOfInsure',
        '3_2_dateOfProposal',
        '3_2_sumAssured',
        '3_2_acceptedAt',
        '3_2_1',
        '3_2_2',
        '3_3_paymentMethod',
        '3_3_paymentFrequency',
        '3_3_debitInstructionDate',
        '3_3_policyTerm',
        '3_3_premiumPayable',
        '3_3_initialPremiumPaymentAccountNumber',
        '3_3_regularPremiumPaymentAccountNumber',
        '3_4_anb',
        '3_4_term',
        '3_4_rate',
        '3_4_sumAssured',
        '3_4_monthlyPremium',
        '3_4_nonMonthlyPremium',
        '3_4_discountOnNonMonthly',
        '3_4_monthlyPremium_1',
        '3_4_nonMonthlyPremium_1',
        '3_4_monthlyPremium_2',
        '3_4_nonMonthlyPremium_2',
        '3_4_monthlyPremium_3',
        '3_4_nonMonthlyPremium_3',
        '3_4_monthlyPremium_4',
        '3_4_nonMonthlyPremium_4',
        '3_4_monthlyPremium_5',
        '3_4_nonMonthlyPremium_5',
        '3_4_monthlyPremium_6',
        '3_4_nonMonthlyPremium_6',
        '3_4_premiumInWords',
        '5_1_1',
        '5_1_1_a',
        '5_1_1_b',
        '5_1_1_c',
        '5_2_1',
        '5_2_1_b',
        '5_2_2',
        '5_2_2_a',
        '5_2_2_b',
        '5_2_2_c',
        '5_2_2_d',
        '5_2_2_e',
        '5_2_2_f',
        '5_2_2_g',
        '5_3_a',
        '5_3_b',
        '5_4_a',
        '5_4_a_amount',
        '5_4_b',
        '5_4_b_amount',
        '5_4_c',
        '5_4_c_amount',
        '5_4_d',
        '5_4_d_amount',
        '5_4_e',
        '5_4_e_amount',
        '5_4_f',
        '5_4_f_amount',
        '5_4_g',
        'created_at',
        'updated_at',
        'code',
        '4_1_firstName',
        '4_1_surName',
        '4_1_dateOfBirth',
        '4_1_gender',
        '4_1_title',
        '4_1_relationship',
        '4_1_cell',
        '4_1_benefitShare',
        '4_1_guadianFullname',
        '4_1_guadianBirthDate',
        '4_1_guadianTelephone',
        '4_2_firstName',
        '4_2_surName',
        '4_2_dateOfBirth',
        '4_2_gender',
        '4_2_title',
        '4_2_relationship',
        '4_2_cell',
        '4_2_benefitShare',
        '4_2_guadianFullname',
        '4_2_guadianBirthDate',
        '4_2_guadianTelephone',
        '4_3_firstName',
        '4_3_surName',
        '4_3_dateOfBirth',
        '4_3_gender',
        '4_3_title',
        '4_3_relationship',
        '4_3_cell',
        '4_3_benefitShare',
        '4_3_guadianFullname',
        '4_3_guadianBirthDate',
        '4_3_guadianTelephone',
        '4_4_firstName',
        '4_4_surName',
        '4_4_dateOfBirth',
        '4_4_gender',
        '4_4_title',
        '4_4_relationship',
        '4_4_cell',
        '4_4_benefitShare',
        '4_4_guadianFullname',
        '4_4_guadianBirthDate',
        '4_4_guadianTelephone',
        '4_5_firstName',
        '4_5_surName',
        '4_5_dateOfBirth',
        '4_5_gender',
        '4_5_title',
        '4_5_relationship',
        '4_5_cell',
        '4_5_benefitShare',
        '4_5_guadianFullname',
        '4_5_guadianBirthDate',
        '4_5_guadianTelephone',
        '4_postalAddress',
    ];
}
