<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background: linear-gradient(-45deg, #2196F3 50%, #EEEEEE 50%);
            background-repeat: no-repeat
        }

        .card {
            background-color: #FFF;
            border-radius: 25px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            padding: 40px;
            z-index: 0
        }

        .heading {
            font-weight: normal
        }

        .desc {
            font-size: 14px
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey;
            padding-left: 0px;
            display: flex;

        }

        #progressbar .active {
            color: #673AB7
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            flex: 1;
            position: relative;
            font-weight: 400
        }

        #progressbar .step0:before {
            content: ""
        }

        #progressbar li:before {
            width: 40px;
            height: 40px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            background: #E0E0E0;
            border-radius: 50%;
            margin: auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 10px;
            background: #E0E0E0;
            position: absolute;
            left: 0;
            top: 17px;
            z-index: -1
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #F9A825
        }

        .sub-heading {
            font-weight: 500
        }

        .yellow-text {
            color: #F9A825
        }

        fieldset.show {
            display: block
        }

        fieldset {
            display: none
        }

        .radio {
            display: inline-block;
            border-radius: 0;
            box-sizing: border-box;
            cursor: pointer;
            color: #BDBDBD;
            font-weight: 500;
            -webkit-filter: grayscale(100%);
            -moz-filter: grayscale(100%);
            -o-filter: grayscale(100%);
            -ms-filter: grayscale(100%);
            filter: grayscale(100%)
        }

        .radio:hover {
            box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
        }

        .radio.selected {
            border: 1px solid #F9A825;
            box-shadow: 0px 8px 16px 0px #EEEEEE;
            color: #29B6F6 !important;
            -webkit-filter: grayscale(0%);
            -moz-filter: grayscale(0%);
            -o-filter: grayscale(0%);
            -ms-filter: grayscale(0%);
            filter: grayscale(0%)
        }

        .card-block {
            border: 1px solid #CFD8DC;
            width: 45%;
            margin: 2.5%;
            padding: 20px 25px 15px 25px
        }

        @media screen and (max-width: 768px) {
            .card-block {
                padding: 20px 20px 0px 20px;
                height: 250px
            }
        }

        .icon {
            width: 85px;
            height: 100px
        }

        .image-icon {
            width: 85px;
            height: 100px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px
        }

        select,
        input,
        textarea,
        button {
            padding: 8px 15px 8px 15px;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            background-color: #ECEFF1;
            border: 1px solid #ccc;
            font-size: 16px;
            letter-spacing: 1px
        }

        select:focus,
        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid skyblue !important;
            outline-width: 0
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        textarea {
            height: 100px
        }

        button {
            width: 120px;
            letter-spacing: 2px
        }

        .check {
            display: flex;
            justify-content: center;
        }

        .fit-image {
            margin: 0 auto;
            text-align: center;
            width: 50%;
            object-fit: cover
        }

        .btn-block {
            border-radius: 5px;
            height: 50px;
            font-weight: 500;
            cursor: pointer
        }

        .fa-long-arrow-right {
            float: right;
            margin-top: 4px
        }

        .fa-long-arrow-left {
            float: left;
            margin-top: 4px
        }

        .disable {
            opacity: 0.25
        }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var client_details_code = null;
        var client_details_id = null;

        <?php if (isset($_GET['new']) || isset($clear_details)) : ?>
            localStorage.removeItem("db_client_details_id");
            localStorage.removeItem("db_client_details_code");
            var newurl = window.location.protocol + "//" + window.location.host;
            window.history.pushState({
                path: newurl
            }, '', newurl);
            location.href = newurl;
        <?php endif; ?>


        $(document).ready(function() {
            var current_fs, next_fs, previous_fs;

            $(".next").click(function() {
                var chk_status = true;
                try {
                    var chk_status = $(this).parent()[0].checkValidity();
                    $(this).parent()[0].reportValidity();
                } catch (err) {

                }
                if (chk_status) {
                    str1 = "next1";
                    str2 = "next2";
                    str3 = "next3";

                    if (!str2.localeCompare($(this).attr('id'))) {
                        val2 = true;
                    } else {
                        val2 = false;
                    }

                    if (!str3.localeCompare($(this).attr('id'))) {
                        val3 = true;
                    } else {
                        val3 = false;
                    }

                    if (
                        !str1.localeCompare($(this).attr('id')) ||
                        (!str2.localeCompare($(this).attr('id')) && val2 == true) ||
                        (!str3.localeCompare($(this).attr('id')) && val3 == true)) {
                        current_fs = $(this).parent().parent();
                        next_fs = $(this).parent().parent().next();

                        $(current_fs).removeClass("show");
                        $(next_fs).addClass("show");

                        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                        current_fs.animate({}, {
                            step: function() {

                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });

                                next_fs.css({
                                    'display': 'block'
                                });
                            }
                        });
                    }
                }
            });

            $(".prev").click(function() {

                current_fs = $(this).parent().parent();
                previous_fs = $(this).parent().parent().prev();

                $(current_fs).removeClass("show");
                $(previous_fs).addClass("show");

                $("#progressbar li").eq($("fieldset").index(next_fs)).removeClass("active");

                current_fs.animate({}, {
                    step: function() {

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });

                        previous_fs.css({
                            'display': 'block'
                        });
                    }
                });
            });

            $('.radio-group .radio').click(function() {
                $(this).toggleClass('selected');
            });


            $("#form1, #form2, #form3, #form4, #form5, #form6").submit(function(e) {

                e.preventDefault();

                var params = '';
                if (client_details_code != null) {
                    params = '?id=' + client_details_id + '&code=' + client_details_code;
                }
                var data = new FormData();
                var form_data = $("#form1, #form2, #form3, #form4, #form5, #form6").serializeArray();
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value);
                });
                if (event.target.id == 'form6') {
                    data.append('form_end', true);
                }

                $.ajax({
                    url: 'scr-edu/add' + params,
                    type: 'POST',
                    data: data,
                    mimeTypes: "multipart/form-data",
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log('data')
                        console.log(data)
                        var client_details = data.split(',');
                        client_details_id = client_details[0];
                        client_details_code = client_details[1];
                        localStorage.setItem("db_client_details_id", client_details[0]);
                        localStorage.setItem("db_client_details_code", client_details[1]);
                        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?id=" + client_details_id + "&code=" + client_details_code;
                        window.history.pushState({
                            path: newurl
                        }, '', newurl);
                        $(".download-pdf").attr("href", "assets/output/scr/" + client_details_code + ".pdf");
                    }
                });

            });

        });
        if (localStorage.getItem("db_client_details_id") && client_details_id == null && client_details_code == null) {
            client_details_id = localStorage.getItem("db_client_details_id");
            client_details_code = localStorage.getItem("db_client_details_code");
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?id=" + client_details_id + "&code=" + client_details_code;
            if (!window.location.href.includes("code=")) {
                window.location.href = newurl;
            }
            $(".download-pdf").attr("href", "assets/output/scr/" + client_details_code + ".pdf");
        }
    </script>
</head>

<body oncontextmenu="return false" class="snippet-body">
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-6 col-md-7">
                <div class="card b-0">
                    <h3 class="heading">Complete scr edu</h3>
                    <p class="desc">Fill out the form or call <span class="yellow-text">123 456 7891</span><br>to start protecting your business today!</p>
                    <ul id="progressbar" class="text-center">
                        <li class="active step0" id="step1"></li>
                        <li class="step0" id="step2"></li>
                        <li class="step0" id="step3"></li>
                        <li class="step0" id="step4"></li>
                        <li class="step0" id="step5"></li>
                        <li class="step0" id="step6"></li>
                        <li class="step0" id="step7"></li>
                    </ul>
                    <fieldset class="show">
                        <div class="form-card">
                            <h5 class="sub-heading">Select Service(s)</h5>
                            <div class="row px-1 radio-group">
                                <div class="card-block text-center radio selected">
                                    <div class="image-icon"> <img class="icon icon1" src="https://i.imgur.com/vZxfo9x.png"> </div>
                                    <p class="sub-desc">Scr Edu</p>
                                </div>
                            </div>
                            <button id="next1" class="btn-block btn-primary mt-3 mb-1 next">NEXT<span class="fa fa-long-arrow-right"></span></button>
                        </div>
                    </fieldset>
                    <fieldset>

                        <form method="post" id="form1" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <h5 class="sub-heading mb-4">1.Child`s details</h5>

                            <div class="row gtr-uniform">

                                <div class="col-4 col-12-xsmall">
                                    <label for="fnames">First Name</label>
                                    <input id="fnames" type="text" name="firstName" placeholder="First Name" pattern="([A-zÀ-ž\s]){2,}">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">Surname</label>
                                    <input id="snames" type="text" name="lastName" placeholder="Surname" pattern="([A-zÀ-ž\s]){2,}">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">Date of Birth</label>
                                    <input type="date" id="birthDateOfChild" name="birthDateOfChild">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label for="childGender">Gender</label>
                                    <select name="childGender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label for="snames">Relationship</label>
                                    <input id="snames" type="text" name="relationship" placeholder="Relationship">
                                </div>



                            </div>

                            <button id="next2" class="btn-block btn-primary mt-3 mb-1 next mt-4">NEXT<span class="fa fa-long-arrow-right"></span></button> <button class="btn-block btn-secondary mt-3 mb-1 prev"><span class="fa fa-long-arrow-left"></span>PREVIOUS</button>

                        </form>

                    </fieldset>
                    <fieldset>

                        <form method="post" id="form2" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h5 class="sub-heading mb-4">2.Principal Life to be Assured</h5>

                            <div class="row gtr-uniform">

                                <div class="col-4 col-12-xsmall">
                                    <label for="fnames">First Name</label>
                                    <input id="fnames" type="text" name="2_firstName" placeholder="First Name" pattern="([A-zÀ-ž\s]){2,}">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">Surname</label>
                                    <input id="snames" type="text" name="2_lastName" placeholder="Surname" pattern="([A-zÀ-ž\s]){2,}">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">ID Number</label>
                                    <input id="snames" type="text" name="2_idNumber" placeholder="ID Number">
                                </div>


                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">Passport Number</label>
                                    <input id="snames" type="text" name="2_passportNumber" placeholder="Passport Number">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">Title</label>
                                    <input id="snames" type="text" name="2_title" placeholder="Title">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="2_maritalStatus">Marital Status</label>
                                    <select name="2_maritalStatus">
                                        <option value="Married">Married</option>
                                        <option value="Single">Single</option>
                                    </select>
                                </div>


                                <div class="col-4 col-12-xsmall">
                                    <label for="2_birthDate">Date of Birth</label>
                                    <input type="date" id="2_birthDate" name="2_birthDate">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="2_gender">Gender</label>
                                    <select name="2_gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="2_occupation">Occupation</label>
                                    <input id="2_occupation" type="text" name="2_occupation" placeholder="Occupation">
                                </div>


                                <div class="col-4 col-12-xsmall">
                                    <label for="2_pinNumber">Pin Number</label>
                                    <input id="2_pinNumber" type="text" name="2_pinNumber" placeholder="Pin Number">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="2_nationality">Nationality</label>
                                    <input id="2_nationality" type="text" name="2_nationality" placeholder="Nationality">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="2_tin">Tax Identification Number (TIN)</label>
                                    <input id="2_tin" type="text" name="2_tin" placeholder="Tax Identification Number (TIN)">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label for="2_citizenship">Citizenship</label>
                                    <input id="2_citizenship" type="text" name="2_citizenship" placeholder="Citizenship">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label for="2_residency">Citizenship</label>
                                    <input id="2_residency" type="text" name="2_residency" placeholder="Residency">
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">2.1. Employment Details</h5>
                                </div>


                                <div class="col-4 col-12-xsmall">
                                    <label for="2_1_employed">Employed</label>
                                    <select name="2_1_employed">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="2_1_employer">Employer</label>
                                    <input id="2_1_employer" type="text" name="2_1_employer" placeholder="Employer">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="2_1_employerCode">Employer Code</label>
                                    <input id="2_1_employerCode" type="text" name="2_1_employerCode" placeholder="Employer Code">
                                </div>


                                <div class="col-4 col-12-xsmall">
                                    <label>Department Code</label>
                                    <input type="text" name="2_1_departmentCode" placeholder="Department Code">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Employee Terms</label>
                                    <select name="2_1_employeeTerms">
                                        <option value="Temporary">Temporary</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Contract">Contract</option>
                                    </select>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Employer Number</label>
                                    <input type="text" name="2_1_employerNumber" placeholder="Employer Number">
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">2.2. Business Details</h5>
                                </div>


                                <div class="col-4 col-12-xsmall">
                                    <label>Business Name</label>
                                    <input type="text" name="2_2_businessName" placeholder="Business Name">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Nature of Business</label>
                                    <input type="text" name="2_2_natureOfBusiness" placeholder="Nature of Business">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Role of proposer in business</label>
                                    <input type="text" name="2_2_properBusiness" placeholder="Role of proposer in business">
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">2.3. Telephone Numbers and Email</h5>
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>Cell (Pre-fix for other countries)</label>
                                    <input type="text" name="2_3_cell" placeholder="Cell (Pre-fix for other countries)">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Work Phone</label>
                                    <input type="text" name="2_3_workPhone" placeholder="Work Phone">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>Home Phone</label>
                                    <input type="text" name="2_3_homePhone" placeholder="Home Phone">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label> Email Address</label>
                                    <input type="text" name="2_3_emailAddress" placeholder=" Email Address">
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">2.4. Postal Address</h5>
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>P.O. Box</label>
                                    <input type="text" name="2_4_poBox" placeholder="P.O. Box">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Building</label>
                                    <input type="text" name="2_4_building" placeholder="Building">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>Town</label>
                                    <input type="text" name="2_4_town" placeholder="Town">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Postal Code</label>
                                    <input type="text" name="2_4_postalCode" placeholder="Postal Code">
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4"> 2.5. Physical Address</h5>
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>Building / Village</label>
                                    <input type="text" name="2_5_physicalBuilding" placeholder="Building / Village">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Street / Location</label>
                                    <input type="text" name="2_5_physicalStreet" placeholder="Street / Location">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>Town / County</label>
                                    <input type="text" name="2_5_physicalTown" placeholder="Town / County">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Postal Code</label>
                                    <input type="text" name="2_5_physicalPostalCode" placeholder="Postal Code">
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4"> 2.6. USA Physical Address (For USA citizens only)</h5>
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>Street</label>
                                    <input type="text" name="2_6_usaStreet" placeholder="Street">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Town / City</label>
                                    <input type="text" name="2_6_usaTown" placeholder="Town / City">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>Region / State</label>
                                    <input type="text" name="2_6_usaRegion" placeholder="Region / State">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Postal Code</label>
                                    <input type="text" name="2_6_usaPostalCode" placeholder="Postal Code">
                                </div>


                            </div>

                            <button id="next2" class="btn-block btn-primary mt-3 mb-1 next mt-4">NEXT<span class="fa fa-long-arrow-right"></span></button> <button class="btn-block btn-secondary mt-3 mb-1 prev"><span class="fa fa-long-arrow-left"></span>PREVIOUS</button>

                        </form>

                    </fieldset>
                    <fieldset>

                        <form method="post" id="form3" enctype="multipart/form-data">

                            <h5 class="sub-heading mb-4">3. Statement of Health of the Life Assured</h5>

                            <div class="row gtr-uniform">

                                <div class="col-10">
                                    1. Has an application for life, sickness, disability, or critical illness insurance on your life ever been declined, deferred withdrawn or accepted with a loading or exclusion?
                                    Y/N
                                </div>
                                <div class="col-2">
                                    <input type="text" name="3_1" style="width:50%">
                                </div>


                                <div class="col-10">
                                    2. Have you ever claimed any benefit from sickness, disability, critical illness, or accident policies?
                                    Y/N
                                </div>
                                <div class="col-2">
                                    <input type="text" name="3_2" style="width:50%">
                                </div>


                                <div class="col-10">
                                    3. Have you in the last 5 years: consulted any medical professionals; had medical examinations and/or special investigations (including blood tests); taken medication or received medical treatment; been hospitalized or received medical advice to alter or discontinue your alcohol consumption?
                                    Y/N
                                </div>
                                <div class="col-2">
                                    <input type="text" name="3_3" style="width:50%">
                                </div>


                                <div class="col-12">
                                    4. Have you, in the last 5 years, suffered from or been diagnosed with any form of: (Tick appropriately)
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_1" width="70%">
                                        </div>
                                        <div class="col-9">
                                            blindness, hearing or speech problems asthma, tuberculosis, chronic cough.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_2" width="70%">
                                        </div>
                                        <div class="col-9">
                                            heart attack, heart disease or disorder, high blood pressure, raised cholesterol diabetes, stroke.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_3" width="70%">
                                        </div>
                                        <div class="col-9">
                                            cancer, tumors (state of benign or malignant)
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_4" width="70%">
                                        </div>
                                        <div class="col-9">
                                            kidney disease, blood, or protein in the urine
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_5" width="70%">
                                        </div>
                                        <div class="col-9">
                                            HIV/AIDS or HIV/AIDS related conditions, Sexually Transmitted Diseases (STDs)
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_6" width="70%">
                                        </div>
                                        <div class="col-9">
                                            psychological problems or disability
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_7" width="70%">
                                        </div>
                                        <div class="col-9">
                                            Body or limb defects, paralysis, physical disability
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="3_4_8" width="70%">
                                        </div>
                                        <div class="col-9">
                                            any condition other than colds, flu or other minor, curable ailments
                                        </div>
                                    </div>
                                </div>


                                <div class="col-10">
                                    5. Are you currently experiencing health-related symptoms, or do you intend to seek medical advice or testing for any condition other than colds, flu or other minor, curable ailments in the next 6 months?
                                    Y/N
                                </div>
                                <div class="col-2">
                                    <input type="text" name="3_5" style="width:50%">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-9">
                                            6. What is your height? (Ft, Ins)
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="3_5_height">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-9">
                                            What is your weight? (Kgs)
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="3_5_weight">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <label for="3_5_weightStatus">Is your weight </label>
                                    <select name="3_5_weightStatus">
                                        <option value="Stationary">Stationary</option>
                                        <option value="Increasing">Increasing</option>
                                        <option value="Decreasing">Decreasing</option>
                                    </select>
                                </div>


                                <div class="col-12">
                                    7. If you answered ‘yes’ to any of the questions, please give full details in the table below indicating: -
                                </div>

                                <div class="col-12">
                                    <label>
                                        Nature of complaint or symptoms, Type of treatment or medication, Date of first symptoms or diagnosis, Date of last symptoms, Name, and telephone number of attending doctor
                                    </label>
                                    <input type="text" name="3_7_1">
                                </div>
                                <div class="col-12">
                                    <label>
                                        <strong>You may use additional Paper for more information.</strong>
                                        You are required to tell us anything that you may know about your health that may affect our decision to insure you. If you do not provide this information, you may not be able to claim the risk benefits under this policy. Please use the space below to provide such information
                                    </label>
                                    <input type="text" name="3_7_2">
                                </div>
                                <div class="col-12">
                                    <strong>You may use additional Paper for more information.</strong>
                                    I declare that the information I have given above is correct and a true representation of my medical history. I understand that any medical history not mentioned may invalidate the application for life assurance or a claim.
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label for="3_7_3">Name </label>
                                    <input type="text" name="3_7_3">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label for="3_7_3">Date </label>
                                    <input type="date" name="3_7_4">
                                </div>
                            </div>

                            <button id="next2" class="btn-block btn-primary mt-3 mb-1 next mt-4">NEXT<span class="fa fa-long-arrow-right"></span></button> <button class="btn-block btn-secondary mt-3 mb-1 prev"><span class="fa fa-long-arrow-left"></span>PREVIOUS</button>

                        </form>

                    </fieldset>
                    <fieldset>

                        <form method="post" id="form4" enctype="multipart/form-data">

                            <h5 class="sub-heading mb-4">4. Financial Questionnaire</h5>

                            <div class="row gtr-uniform">

                                <div class="col-4 col-12-xsmall">
                                    <label>Weekly Income</label>
                                    <input type="text" name="4_weeklyIncome">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Monthly Income</label>
                                    <input type="text" name="4_monthlyIncome">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Source of Income</label>
                                    <input type="text" name="4_sourceOfIncome">
                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">4.1. Occupational and Recreational Hazard</h5>
                                    <p>
                                        Do you have any intentions of (where the answer is YES, please give details)
                                    </p>
                                </div>

                                <div class="col-10">
                                    A) Changing the nature of your occupation?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="4_1_1" style="width:50%">
                                </div>


                                <div class="col-10">
                                    B) Engaging in hazardous occupation? (e.g., working with machinery or electricity)
                                </div>
                                <div class="col-2">
                                    <input type="text" name="4_1_2" style="width:50%">
                                </div>

                                <div class="col-10">
                                    C) Engaging in hazardous sports or pastime? (e.g., hang gliding, sky diving, mining etc.)
                                </div>
                                <div class="col-2">
                                    <input type="text" name="4_1_3" style="width:50%">
                                </div>

                                <div class="col-10">
                                    D) Engaging in naval, military or air services?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="4_1_4" style="width:50%">
                                </div>

                                <div class="col-10">
                                    E) Flying other than as a fare paying passenger by a recognized airline on scheduled in routes
                                </div>
                                <div class="col-2">
                                    <input type="text" name="4_1_5" style="width:50%">
                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">4.2. Insurance History</h5>
                                </div>

                                <div class="col-10">
                                    Has any proposal on your life ever been made, or is now being made (excluding this application)? If YES, please state:
                                </div>
                                <div class="col-2">
                                    <input type="text" name="4_2_hasProposal" style="width:50%">
                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <label> Date of proposal</label>
                                    <input type="text" name="4_2_nameOfInsure">
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label> Name of the Insurer(s)</label>
                                    <input type="date" name="4_2_dateOfProposal">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label> Sum assured</label>
                                    <input type="text" name="4_2_sumAssured">
                                </div>

                                <div class="col-4 col-12-xsmall">
                                    <label>Was it accepted at?</label>
                                    <select name="4_2_acceptedAt">
                                        <option value="Ordinary Term">Ordinary Term</option>
                                        <option value="Declined or Loaded">Declined or Loaded</option>
                                        <option value="Postponed">Postponed</option>
                                        <option value="Special Premium">Special Premium</option>
                                    </select>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Status:</label>
                                    <select name="4_2_1">
                                        <option value="Matured">Matured</option>
                                        <option value="In Force">In Force</option>
                                        <option value="Lapsed">Lapsed</option>
                                        <option value="Surrender">Surrender</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>sss:</label>
                                    <input type="text" name="4_2_2">
                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">4.3. Plan Details </h5>
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label>Payment Method</label>
                                    <select name="4_3_paymentMethod">
                                        <option value="Check-off">Check-off</option>
                                        <option value="Direct Debit">Direct Debit</option>
                                        <option value="Standing Order">Standing Order</option>
                                        <option value="Cheques">Cheques</option>
                                    </select>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Premium Payment Frequency</label>
                                    <select name="4_3_paymentFrequency">
                                        <option value="Monthly">Monthly</option>
                                        <option value="Querterly">Querterly</option>
                                        <option value="Semi Annually">Semi Annually</option>
                                        <option value="Annually">Annually</option>
                                    </select>
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label>Direct Debit Instruction Date</label>
                                    <input type="date" name="4_3_debitInstructionDate">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>Policy Term</label>
                                    <input type="text" name="4_3_policyTerm">
                                </div>

                                <div class="col-4 col-12-xsmall">
                                    <label>Premium Payable</label>
                                    <input type="text" name="4_3_premiumPayable">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Initial Premium Payment Account Number</label>
                                    <input type="text" name="4_3_initialPremiumPaymentAccountNumber">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Regular premium payment account number</label>
                                    <input type="text" name="4_3_regularPremiumPaymentAccountNumber">
                                </div>


                                <div class="col-12 col-12-xsmall">
                                    <h5 class="sub-heading mb-4">4.4. Premium Calculator</h5>
                                </div>

                                <div class="col-4 col-12-xsmall">
                                    <label>ANB</label>
                                    <input type="text" name="4_4_anb">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Term</label>
                                    <input type="text" name="4_4_term">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label>Rate</label>
                                    <input type="text" name="4_4_rate">
                                </div>

                                <div class="col-5 col-12-xsmall">
                                    <label>Sum Assured</label>
                                    <input type="text" name="4_4_sumAssured">
                                </div>

                                <div class="col-7 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Monthly Premium</label>
                                            <input type="text" name="4_4_monthlyPremium" style="width:90%">
                                        </div>
                                        <div class="col-6">
                                            <label>Non-Monthly Premium</label>
                                            <input type="text" name="4_4_nonMonthlyPremium">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-5">
                                            Discount on NonMonthly
                                        </div>
                                        <div class="col-7">
                                            <span>Q-4%</span>
                                            &nbsp;&nbsp;<span>SA-6%</span>
                                            &nbsp;&nbsp;<span>A-8%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-6">
                                            -<input type="text" name="4_4_monthlyPremium_1" style="width:90%">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="4_4_nonMonthlyPremium_1">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-12-xsmall">
                                    Sub total
                                </div>
                                <div class="col-7 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-6">
                                            =<input type="text" name="4_4_monthlyPremium_2" style="width:90%">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="4_4_nonMonthlyPremium_2">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-12-xsmall">
                                    Policy Fee
                                </div>
                                <div class="col-7 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-6">
                                            -<input type="text" name="4_4_monthlyPremium_3" style="width:90%">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="4_4_nonMonthlyPremium_3">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-12-xsmall">
                                    Sub total
                                </div>
                                <div class="col-7 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-6">
                                            =<input type="text" name="4_4_monthlyPremium_4" style="width:90%">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="4_4_nonMonthlyPremium_4">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-12-xsmall">
                                    0.5 % Training levy
                                </div>
                                <div class="col-7 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-6">
                                            -<input type="text" name="4_4_monthlyPremium_5" style="width:90%">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="4_4_nonMonthlyPremium_5">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5 col-12-xsmall">
                                    Total Premium DUE
                                </div>
                                <div class="col-7 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-6">
                                            =<input type="text" name="4_4_monthlyPremium_6" style="width:90%">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="4_4_nonMonthlyPremium_6">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    Premium in Words
                                </div>
                                <div class="col-8 col-12-xsmall">
                                    <input type="text" name="4_4_premiumInWords">
                                </div>
                            </div>

                            <button id="next2" class="btn-block btn-primary mt-3 mb-1 next mt-4">NEXT<span class="fa fa-long-arrow-right"></span></button> <button class="btn-block btn-secondary mt-3 mb-1 prev"><span class="fa fa-long-arrow-left"></span>PREVIOUS</button>

                        </form>

                    </fieldset>
                    <fieldset>

                        <form method="post" id="form5" enctype="multipart/form-data">

                            <h5 class="sub-heading mb-4">5. Guardian</h5>

                            <div class="row gtr-uniform">

                                <div class="col-4 col-12-xsmall">
                                    <label for="fnames">First Name</label>
                                    <input id="fnames" type="text" name="5_firstName" placeholder="First Name" pattern="([A-zÀ-ž\s]){2,}">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">Surname</label>
                                    <input id="snames" type="text" name="5_surname" placeholder="Surname" pattern="([A-zÀ-ž\s]){2,}">
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <label for="snames">Date of Birth</label>
                                    <input type="date" id="birthDateOfChild" name="5_dateOfBirth">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label for="5_gender">Gender</label>
                                    <select name="5_gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label for="snames">Relationship</label>
                                    <input id="snames" type="text" name="5_relationshipToMinor" placeholder="Relationship">
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label for="snames">Title</label>
                                    <input id="snames" type="text" name="5_title" placeholder="Title">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label for="snames">Cell</label>
                                    <input id="snames" type="text" name="5_cell" placeholder="Cell">
                                </div>

                                <div class="col-12">
                                    How would you like to receive your statement/Policy document? (Tick One)
                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <label for="5_postalAddress">Postal Address</label>
                                    <select name="5_postalAddress">
                                        <option value="Email">Email</option>
                                        <option value="Physical Address">Physical Address</option>
                                    </select>
                                </div>
                            </div>

                            <button id="next2" class="btn-block btn-primary mt-3 mb-1 next mt-4">NEXT<span class="fa fa-long-arrow-right"></span></button> <button class="btn-block btn-secondary mt-3 mb-1 prev"><span class="fa fa-long-arrow-left"></span>PREVIOUS</button>

                        </form>

                    </fieldset>
                    <fieldset>

                        <form method="post" id="form6" enctype="multipart/form-data">

                            <h5 class="sub-heading mb-4">6. Disclosure Checklist</h5>

                            <div class="row gtr-uniform">

                                <div class="col-12">
                                    The policyholder has the right to the following information. Kindly confirm that this has been provided.
                                </div>
                                <div class="col-12">
                                    <h5 class="sub-heading mb-4"> 6.1. Agent Status (Please enter your “Y” for Yes or “N” for No)</h5>
                                </div>

                                <div class="col-10">
                                    1. Have you provided the following information to the policyholder?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_1_1" style="width:50%">
                                </div>
                                <div class="col-10">
                                    a) Your full name and title?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_1_1_a" style="width:50%">
                                </div>
                                <div class="col-10">
                                    b) Office details (physical and postal address)?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_1_1_b" style="width:50%">
                                </div>
                                <div class="col-10">
                                    c) Telephone and email contact details?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_1_1_c" style="width:50%">
                                </div>



                                <div class="col-12">
                                    <h5 class="sub-heading mb-4"> 6.2. Advice</h5>
                                </div>

                                <div class="col-10">
                                    1. Have you taken the circumstances of the policyholder into account in-order to satisfy their financial needs
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_1" style="width:50%">
                                </div>
                                <div class="col-10">
                                    b) Have you done a sufficient needs analysis?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_1_b" style="width:50%">
                                </div>


                                <div class="col-10">
                                    2. Have you disclosed the following information to the policy holder?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2" style="width:50%">
                                </div>
                                <div class="col-10">
                                    a) Name and type of policy?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2_a" style="width:50%">
                                </div>
                                <div class="col-10">
                                    b) The premium?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2_b" style="width:50%">
                                </div>
                                <div class="col-10">
                                    c) Type, extent, and limitations of benefits?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2_c" style="width:50%">
                                </div>
                                <div class="col-10">
                                    d) That commission is payable on this policy and answered any commission-related questions?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2_d" style="width:50%">
                                </div>
                                <div class="col-10">
                                    e) The 28-day cooling-off period?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2_e" style="width:50%">
                                </div>
                                <div class="col-10">
                                    f) Claims notification procedure?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2_f" style="width:50%">
                                </div>
                                <div class="col-10">
                                    g) Cancellation procedure and surrender?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_2_2_g" style="width:50%">
                                </div>

                                <div class="col-12">
                                    <h5 class="sub-heading mb-4"> 6.3. Application Stage</h5>
                                </div>

                                <div class="col-10">
                                    a) Is the policyholder satisfied with the advice and disclosure that you have given?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_3_a" style="width:50%">
                                </div>
                                <div class="col-10">
                                    b) Has the policyholder completed and signed the application form?
                                </div>
                                <div class="col-2">
                                    <input type="text" name="6_3_b" style="width:50%">
                                </div>


                                <div class="col-12">
                                    <h5 class="sub-heading mb-4">6.4. New business Rater</h5>
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label>A. Gross Regular/Basic Earnings </label>
                                    <input type="text" name="6_4_a">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>UGX</label>
                                    <input type="text" name="6_4_a_amount">
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label> B. Total Existing Deductions</label>
                                    <input type="text" name="6_4_b">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>UGX</label>
                                    <input type="text" name="6_4_b_amount">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>C. Premium for New Policy</label>
                                    <input type="text" name="6_4_c">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>UGX</label>
                                    <input type="text" name="6_4_c_amount">
                                </div>


                                <div class="col-6 col-12-xsmall">
                                    <label>D. Total Deductions (B + C) </label>
                                    <input type="text" name="6_4_d">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>UGX</label>
                                    <input type="text" name="6_4_d_amount">
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label>E. New Net Earnings</label>
                                    <input type="text" name="6_4_e">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>UGX</label>
                                    <input type="text" name="6_4_e_amount">
                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <label>F. 1/3 of A</label>
                                    <input type="text" name="6_4_f">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <label>UGX</label>
                                    <input type="text" name="6_4_f_amount">
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <div class="row">
                                        <div class="col-9">
                                            Test: Is E>F
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="6_4_g" style="width:70%">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6 col-12-xsmall">
                                    Y/N, if NO, the application does not qualify
                                </div>

                            </div>

                            <button id="next2" class="btn-block btn-primary mt-3 mb-1 next mt-4">NEXT<span class="fa fa-long-arrow-right"></span></button> <button class="btn-block btn-secondary mt-3 mb-1 prev"><span class="fa fa-long-arrow-left"></span>PREVIOUS</button>
                        </form>

                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <h5 class="sub-heading mb-4">Success!</h5>
                            <p class="message">Thank You for choosing our website.<br>Quotation will be sent to your Email ID and Contact Number.</p>
                            <div class="check"> <img class="fit-image check-img" src="https://i.imgur.com/QH6Zd6Y.gif"> </div>
                            <a href="#" class="download-pdf btn-block btn btn-primary p-2" style="height:auto;" download>Download PDF</a>
                            <br>
                            <a href="{{url('/scr-edu/?new=true')}}" class="btn-block btn btn-success p-2 mt-2" style="height:auto;">Create New Form</a>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</body>

</html>