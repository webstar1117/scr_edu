// -----------------------------------------//
//             GLOBAL VARIABLES             //
//------------------------------------------//
var html = $('html, body'),
    winWidth  = $(window).width(),
    winHeight = $(window).height(),
    docHeight = $(document).height(),
    desktop = 1280,
    laptop = 1150,
    tablet = 1150,
    mobile = 555,
    s,
    navOpen = 0,
    formOpen = 0,
    actionBarOpen = 0,
    firstCard,
    secondCard,
    winTop,
    pageWidth,
    contactMe = '#contactMe',
    emailUs = '#emailUs',
    formSection = '.formSection',
    formSuccess = '.formSuccess',
    formInRow = 0,
    fulfillRow = $('#footerDesktop').height() + $('.fulfillRow').height(),
    rowWidth = $('.row').width(),
    fulfillConWidth = $('#fulfillContainer').width(),
    fulfillBlock = $('#fulfillBlock'),
    headerH = $('#headerNav').height(),
    contentH,
    fulfillBlockTop = $('#fulfillBlock').css('top'),
    fulfillBlockRight = Math.round( ((rowWidth - fulfillConWidth) / 2) + ((winWidth - rowWidth) / 2) ),
    select = $('select'),
    selectId,
    selected,
    option,

    termsOpen   = 0,
    termsLink   = $('a.termsLink'),
    terms       = $('.terms'),
    termsCon    = $('.termsContainer'),
    termsText   = $('.termsText'),
	termsPages 	= $('.termsPage'),
    sumTerms    = $('.sumTerms'),
    fullTerms   = $('.fullTerms'),
    currentPage = 1,
	currentPageDiv,
    maxPage,
	maxHeight,
    pageNo,
    
    editFieldOpen = 0;

// set overlay height to full height of document
$('#overlay').height(docHeight);


// -----------------------------------------//
//             HEADER NAVIGATION            //
//------------------------------------------//
var HeaderNav = {

    settings: { 
        // settings go here
    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        // click any link in header to open drop-down
        $('#headerNav a').not('a#navBtn').click(function() {
            clickedLink = '#' + $(this).parent().attr('id');
            HeaderNav.openDropDown();
        });

        // click overlay or X to close drop-down
        $('#overlay, .dropMenuClose').click(function() {
            HeaderNav.closeDropDown();
        });

        // location map selector
        $('#locationList li').click(function(e) {
            e.preventDefault();
            var clickedLocation = $(this).attr('id');
            HeaderNav.locations( clickedLocation );
        });
    },

    openDropDown: function() {
        if (winWidth >= tablet) {
            if ($(clickedLink + ' .dropMenu').attr('class') == 'dropMenu') {
                $(clickedLink + ' > a').addClass('activeLink');
                $(clickedLink + ' .dropMenu').show();
                $(clickedLink + ' .dropMenu').animate({'opacity':'1','top':'69px'},200,'linear');
                $('#overlay').fadeIn(300);
            }
        }
        // when opening search drop-down focus on field
        if ( $('#search .dropMenu').css('display') == 'block' ) {
            $('#search .dropMenu input').focus();
        }
    },

    closeDropDown: function() {
        $('#headerNav a').removeClass('activeLink');
        $('.dropMenu').animate({'opacity':'0','top':'55px'}, 150, 'linear', function() { $('.dropMenu').hide(); });
        $('#overlay').fadeOut(300);
    },

    locations: function(clickedLocation) {
        $('#currentLocation').text(clickedLocation.toUpperCase());
        HeaderNav.closeDropDown();
    },

    language: function(clickedLanguage) {
        if (clickedLanguage == "english") {
            $('#afrikaans').removeClass('currentLanguage');
            $('#english').addClass('currentLanguage');
        } else {
            $('#english').removeClass('currentLanguage');
            $('#afrikaans').addClass('currentLanguage');
        }
    }
}; // end of HEADER NAVIGATION


// -----------------------------------------//
//             SLIDE NAVIGATION             //
//------------------------------------------//
var SlideNav = {

    settings: {
        // settings go here
    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        // click hamburger icon to open or close
        $('a#navBtn').click(function(e) {
            e.preventDefault()
            if (navOpen == 0) {
                SlideNav.openIt();
            } else {
                SlideNav.closeIt();
            }
            // close fulfillment form if open
            if (formOpen == 1) {
                FulfillForm.closeIt();
            }
            // prevent closing right after opening
            return false;
        });        
        // slide in sub menu
        $('#slideNavMain a').click(function() {
            var linkText = $(this).html().toUpperCase(),
                subMenu  = $(this).siblings().attr('class'),
                parentId = '#' + $(this).parent().attr('id');
            SlideNav.slideInSubMenu( linkText, subMenu, parentId );
        });
        // slide out sub menu
        $('a.slideNavBack').click(function() {
            SlideNav.slideOutSubMenu();
        });
    },

    openIt: function() {
        navOpen = 1;
        $('#slideNav').show();
        $('#page').addClass('slideNavOpen').animate({'marginLeft':'270px'}, 300);
        $('#slideNav').animate({'marginLeft':'0'}, 300);
    },

    closeIt: function() {
        navOpen = 0;
        $('#page').animate({'marginLeft':'0'}, 300,
            function () {
                $(this).removeClass('slideNavOpen');
            }
        );

        $('#slideNav').animate({'marginLeft':'-270px'}, 300, function() {
            $('#slideNav').hide();
            $('#page').css({'margin':'auto', 'float':'none'});
        });
    },

    closeItNoAnim: function () 
    {
        navOpen = 0;
        $('#page')
            .css({'margin':'auto', 'float':'none'})
            .removeClass('slideNavOpen');
        $('#slideNav').css({'marginLeft':'-270px'});
        $('#slideNav').hide();
    },

    slideInSubMenu: function(linkText, subMenu, parentId) {
        if (subMenu == "slideNavSubLinks") {
            copiedSubLinks = $(parentId + ' .slideNavSubLinks').html();
            $('#slideNavSubListWrapper h2').html(linkText);
            $('#slideNavSubList').append(copiedSubLinks);
            // if not on top of page:
            //   - scroll to top
            //   - and then open up sub menu
            // otherwise open up sub menu without scrolling up
            if ($('body,html').scrollTop() > 0) {
                $('body,html').animate({scrollTop:0}, 400, function() {
                    $('#slideNavMain').animate({marginLeft:'-270px'},300);
                });
            } else {
                $('#slideNavMain').animate({marginLeft:'-270px'}, 300);
            }    
        }
    },

    slideOutSubMenu: function() {
        if ($('body,html').scrollTop() > 0) {
            $('body,html').animate({scrollTop:0},400,function(){
                $('#slideNavMain').animate({marginLeft: '0px'},300,function() {$('#slideNavSubList').empty();});
            });
        } else {
            $('#slideNavMain').animate({marginLeft: '0px'},300,function() {$('#slideNavSubList').empty();});
        }
    }
}; // end of SLIDE NAVIGATION


// -----------------------------------------//
//            PLACEHOLDER TEXT              //
//------------------------------------------//
var PlaceholderText = {

    init: function() {
        // fixes ie placeholder text issues
        $('[placeholder]').focus(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function() {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur().parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                  input.val('');
                }
            })
        });
    }

}; // end of PLACEHOLDER TEXT 


// -----------------------------------------//
//             IE7 SUPPORT MODAL            //
//------------------------------------------//
var IE7 = {

    settings: {
        lowerThanIE8: $('html').hasClass('lowerThanIE8'),
        modalLeft: (winWidth - 605) / 2
    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        // if lower than ie8 show modal
        if (s.lowerThanIE8) {
            IE7.createModal();
        }
        // click overlay or X to close modal
        $('body').on('click','#browserSupport .close, #overlay', function() {
            IE7.closeModal();
        });
    },

    createModal: function() {
        // fade in overlay
        // create the modal inside the html
        // populate modal dynamically
        // fade in modal
        // position modal
        $('#overlay').fadeIn(300);
        $('body').append('<div class="modal" id="browserSupport"></div>');
        $('#browserSupport').load('includes/browser_support.html');
        $('#browserSupport').fadeIn(300);
        $('#browserSupport').css({ top: '100px', left: s.modalLeft + 'px' });   
    },

    closeModal: function() {
        // fade out overlay and modal
        $('#browserSupport, #overlay').fadeOut(300);
    }
}; // end of BROWSER SUPPORT


// -----------------------------------------//
//                ACTION BAR                //
//------------------------------------------//
var ActionBar = {

    settings: {
        // settings go here
    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        // click link to open or close
        $('.seeMore').click(function(e) {
            e.preventDefault();
            if (actionBarOpen == 0) {
                if (winWidth > mobile) {
                    ActionBar.openIt( 965 );
                } else if (winWidth <= mobile) {
                    ActionBar.openIt( 521 );
                }
            } else if (actionBarOpen == 1) {
                if (winWidth > mobile) {
                    ActionBar.closeIt( 210 );
                } else if (winWidth <= mobile) {
                    ActionBar.closeIt( 98 );
                }
            }
        });
    },

    openIt: function( openHeight ) {
        actionBarOpen = 1;
        $('#actionBar').animate({height: openHeight + 'px'},200);
        $('.seeMore').text('See less').addClass('seeMoreDown');
    },

    closeIt: function( closeHeight ) {
        actionBarOpen = 0;
        $('.seeMore').text('See all tools').removeClass('seeMoreDown');
        $('body,html').animate({scrollTop:200},400,function() {
            $('#actionBar').animate({height: closeHeight + 'px'},200);
        });
    },

    resizeIt: function() {
        // resize action bar when resizing browser window
        if (actionBarOpen == 0) 
        {
            if (winWidth > mobile) 
            {
                $('#actionBar').css({'height':'210px'});
            } 
            else if (winWidth < mobile) 
            {
                $('#actionBar').css({'height':'98px'});
            }
        } 
        else if (actionBarOpen == 1) 
        {
            if (winWidth > mobile) 
            {
                $('#actionBar').css({'height':'965px'});
            } 
            else if (winWidth < mobile) 
            {
                $('#actionBar').css({'height':'521px'});
            }
        }
    }
}; // end of ACTION BAR 


// -----------------------------------------//
//               CUSTOM SELECTBOX           //
//------------------------------------------//
var CustomSelect = {

    init: function () {

        // initialize jQuery UI selectmenu
		var selectSelector = 'select.selectMenu';
		$(selectSelector).selectmenu({ maxHeight: '185'});
            
        // loop through each select box and set width of dropdown menu
        $(selectSelector).each(function () 
        {
            var buttonId = $(this).next().find('a.ui-selectmenu').attr('id'),
                menuId = buttonId.replace(/button/g, 'menu'),
                buttonWidth = $('#' + buttonId).width();

            // set width of dropdown menu
            $('#' + menuId).width(buttonWidth + 20);

            // check to see if parent is gray
            if ($(this).parents('.row').hasClass('grayCell'))
            {
                $('#' + menuId).addClass('grayDropdown');
            }
        }); 

    }
}; // end of CUSTOM SELECTBOX


// -----------------------------------------//
//               PAGINATION                 //
//------------------------------------------//
var Pagination = {

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {
        // click terms link to open or close
        termsLink.click(function(e) {
            e.preventDefault();
            if (termsOpen == 0) {
                Pagination.openIt();
                termsOpen = 1;
            } else if (termsOpen == 1) {
                Pagination.closeIt();
                termsOpen = 0;
            }
        });

        $('.fullTermsLink').click(function(e) {
            e.preventDefault();
            if (termsOpen == 0) {
                Pagination.openIt();
                Pagination.createIt();
                termsOpen = 1;
            } else if (termsOpen == 1) {
                Pagination.closeIt();
                termsOpen = 0;
            }
        });

        // click x to close terms
        $('.terms').on('click','.termsClose', function(e) {
            e.preventDefault();
            Pagination.closeIt();
            termsOpen = 0;
        });

        // click 'read the full t&c' to open up full terms
        $('.terms').on('click','.readFullTerms', function(e) {
            e.preventDefault();
            sumTerms.fadeOut(300, function() {
                fullTerms.fadeIn(300);
                // can only get height once text is visible
                Pagination.createIt();
            });
        });

        $('.pagination').on('click','.firstPage', function(e) {
            e.preventDefault();
            currentPage = 1;
            $('.currentPage').text(currentPage);
            Pagination.slideToPage();
        });

        $('.pagination').on('click','.lastPage', function(e) {
            e.preventDefault();
            currentPage = maxPage;
            $('.currentPage').text(currentPage);
            Pagination.slideToPage();
        });

        $('.pagination').on('click','.prevPage', function(e) {
            e.preventDefault();
            if (!(currentPage-1 < 1)) {
                currentPage -= 1;
                $('.currentPage').text(currentPage);
                Pagination.slideToPage();   
            }
        });

        $('.pagination').on('click','.nextPage', function(e) {
            e.preventDefault();
            if (!(currentPage+1 > maxPage)) {
                currentPage += 1;
                $('.currentPage').text(currentPage);
                Pagination.slideToPage();   
            }
        });
    },

    openIt: function() {
        terms.fadeIn(300);
    },

    closeIt: function() {
        terms.fadeOut(300);
    },

    createIt: function() {
		maxPage = termsPages.length;
		maxHeight = 0;
		termsPages.height('auto');
		for(i = 0; i < termsPages.length; i++){
			currentHeight = $(termsPages[i]).height();
			if (currentHeight <= 0)
			{
				continue;
			}
			
			if (currentHeight > maxHeight) {
				maxHeight = currentHeight;
			}
		}	
		if (maxHeight != 0){		
			termsPages.height(maxHeight);
			Pagination.setContainerHeight(maxHeight);	
		}	
        $('.currentPage').text(currentPage);
        $('.maxPage').text(maxPage);
    },

    slideToPage: function() {
			
		var scrollHeight = Pagination.calculateScrollHeight();
		
        termsText.stop().animate(
            {'marginTop': -(scrollHeight) + 'px'}, 300
        );
    },
	
    slideToFirstPage: function() {
        currentPage = 1;
        termsText.stop().animate(
            {'marginTop': '0px'}, 300
        );
    },
	
	setContainerHeight: function(height){	
		termsCon.stop().animate(
            {'height': height +'px'}, 300
        );
	},
	
	calculateScrollHeight: function() {
		return (currentPage-1) * maxHeight;
	}

}; // end of PAGINATION


// -----------------------------------------//
//             PASSWORD STRENGTH            //
//------------------------------------------//
var PasswordStrength = {

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {
        $('#choosePassword').keydown(function() {
            var el = $(this);
            PasswordStrength.indicator(el);
        });
    },

    indicator: function(el) {
        var len = $(el).val().length,
            strength = $('.passwordStrength li'),
            blocks = strength.filter(':nth-child(3),:nth-child(4),:nth-child(5)'),
            strengthlabel = ':nth-child(2)',
            colordefault = blocks.css( "background-color", "#e4e4e4" );

        if (len === 0) {      
            colordefault;
            strength.filter(strengthlabel).text('');       
        } 
        else if (len <= 4) {      
            colordefault;       
            strength.filter(':nth-child(3)').css( "background-color", "#ff0000" );
            strength.filter(strengthlabel).text('Unsafe').css("color", "#ff0000");
        } 
        else if (len <= 8) {      
            colordefault;    
            strength.filter(':nth-child(4)').css( "background-color", "#e7b400" );
            strength.filter(strengthlabel).text('Average').css("color", "#e7b400");
        } 
        else if (len >= 6) {       
            colordefault;       
            strength.filter(':nth-child(5)').css( "background-color", "#00ff00" );
            strength.filter(strengthlabel).text('Secure').css("color", "#00ff00");
        }  
    }

}; // end of PASSWORD STRENGTH


// -----------------------------------------//
//             EMAIL CERTIFICATE            //
//------------------------------------------//
var EmailCert = {

    settings: {
        mail: $('a.sendMail, .emailCert, .sendMail2'),
        curMail: null
    },

    init: function() {
        s=this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        s.mail.click(function(e) {
            e.preventDefault();
            s.curMail = $(this);
            s.curMailIndex = s.curMail.data('form');
            EmailCert.showInput();
        });

        $('.sendCert').on('click','form button',function(){
            EmailCert.validate();
        });

        // .sendSert is the parent container to the form field.
        // The .prev() method refers to the link directly above it in the DOM
        // When .sendSert is clicked the curMail and curMailIndex variables are both updated 
        //   so that when you have multiple fields open on the page it only validates the 
        //     field that you clicked on. ie: one at a time and not all at once

        $('.sendCert').on('click',function(){
            s.curMail = $(this).prev();
            s.curMailIndex = s.curMail.data('form');
        });
    },
    showInput: function() {
        if (s.curMailIndex === '#h')
        {
            EmailCert.showTick();
            setTimeout(function () {
            s.curMail.text('Re-send the request');
            },2000);
        }
        else
        {
           s.curMail.fadeOut(300);
            setTimeout(function () {
                s.curMail.next().fadeIn(300);
            },300); 
        }
        
        
    },
    validate: function() {

        $(s.curMailIndex + ' form').validate({
            rules: {
                email: { required: true, email: true }
            },
            messages: {
                email: ""
            },
            submitHandler: function() {
                $('.loaderSml').fadeIn(300);

                setTimeout(function () {
                    s.curMail.next().fadeOut(300);
                    },400);

                
              
            setTimeout(function () {
                if (s.curMail.text() === "Email")
                {
                    EmailCert.showTick();
                    setTimeout(function () {
                        s.curMail.text('Email');
                        $('.hiddenMsg, .break').remove();
                    },6000);
                }
                else if (s.curMail.text() === "Send a request" && s.curMail.hasClass('sendBenReq'))
                {
                    EmailCert.showTick2();
                    setTimeout(function () {
                        s.curMail.text('Send a request');
                        $('.hiddenMsg, .break').remove();
                    },6000);
                }
                else if (s.curMail.text() === "Send a request")
                {
                    EmailCert.showTick();
                    setTimeout(function () {
                        s.curMail.text('Send a request');
                        $('.hiddenMsg, .break').remove();
                    },6000);
                }
                else if (s.curMail.text() ==="Email all certificates")
                {
                    EmailCert.showTick();
                        setTimeout(function () {
                        s.curMail.text('Email all certificates');
                    },6000);
                }
                $(s.curMailIndex + ' input').val('');
                $('.loaderSml').hide();
            },1000);

            }
        });

    },
    showTick: function () {
        s.curMail.text('Sent');
        s.curMail.after('<div class="break"></div><span class=\"hiddenMsg\">The statement/s you requested will be emailed to you by our Support Centre within 24 hours.</span>');
        s.curMail.addClass('mailSent');
        s.curMail.fadeIn(300);
    },
    showTick2: function () {
        s.curMail.text('Your request has been sent!');
        s.curMail.after('<div class="break"></div><span class=\"hiddenMsg\">The statement/s you requested will be emailed to you by our Support Centre within 24 hours.</span>');
        s.curMail.addClass('mailSent');
        s.curMail.fadeIn(300);
    }
} // end of EMAIL CERTIFICATE






// -----------------------------------------//
//                DATE PICKER               //
//------------------------------------------//
var DatePicker = {

    settings: {
        Sunday: "Su",
        Monday: "Mo",
        Tuesday: "Tu",
        Wednesday: "We",
        Thursday: "Th",
        Friday: "Fr",
        Saturday: "Sa",
        January: "January",
        February: "February",
        March: "March",
        April: "April",
        May: "May",
        June: "June",
        July: "July",
        August: "August",
        September: "September",
        October: "October",
        November: "November",
        December: "December"
    },
    init: function () {

    if(winWidth > mobile) {  

        $(".datepicker").datepicker({

            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'dd/mm/yy',
            showOn: "button",
            buttonImage: "/content/img/calendar.png",
            buttonImageOnly: true
        }).datepicker("setDate", "0")
        .datepicker( "option", "monthNames", 
            [ DatePicker.settings.January, DatePicker.settings.February, DatePicker.settings.March, 
            DatePicker.settings.April, DatePicker.settings.May, DatePicker.settings.June,  
            DatePicker.settings.July, DatePicker.settings.August, DatePicker.settings.September,  
            DatePicker.settings.October, DatePicker.settings.November, DatePicker.settings.December ] )
        .datepicker( "option", "dayNamesMin",
            [ DatePicker.settings.Sunday, DatePicker.settings.Monday, DatePicker.settings.Tuesday, 
            DatePicker.settings.Wednesday, DatePicker.settings.Thursday, DatePicker.settings.Friday, 
            DatePicker.settings.Saturday ])
        ; 
    }
            

    }

}; // end of DATE PICKER


// -----------------------------------------//
//        PROXY DROPDOWN                    //
//------------------------------------------//
    
    var ProxyDropdown = {

    init: function () {
        s = this.settings;
        this.bindUIActions();
    },
    bindUIActions: function () {
        $('.proxyTrigger').click(function(e){
            e.preventDefault();

            var dropDown = $(this).parent().find('.proxyDropDown');
            if (dropDown.length > 0 && dropDown.css('display') === 'none')
            {
                dropDown.show();
                dropDown.animate({'opacity':'1','top':'55px'},200,'linear');
                
            }
            else
            {
                dropDown.animate({'opacity':'0','top':'42px'},200,'linear');
                setTimeout(function () {
                        dropDown.hide();
                    }, 200);
                
            }


        });

        $('.proxyDropDown .close').click(function () {
            
                 $('.proxyDropDown').animate({'opacity':'0','top':'42px'},200,'linear');
                setTimeout(function () {
                        $('.proxyDropDown').hide();
                    }, 200);

        });

        $(document).bind('click', function(e) {
            var clicked = $(e.target);
            if (!clicked.parents('.proxyMbl').find(".proxyTrigger").length) {
                $('.proxyDropDown').animate({'opacity':'0','top':'42px'},200,'linear');
                setTimeout(function () {
                         $('.proxyDropDown').hide();
                    }, 200);
            }
        });
    }
} // end of PROXY DROPDOWN



// -----------------------------------------//
//        DATEBOX FOR MOBILE                //
//------------------------------------------//
    
    var DateBox = {

    settings: {
        
    },

    init: function () {
        s = this.settings;
        this.bindUIActions();
    },
    bindUIActions: function () {

        var d = new Date(),
        curMonth = d.getMonth(),
        monthIndex = d.getMonth(),
        curDay = d.getDate(),
        day = d.getDate(),
        curYear = d.getFullYear(),
        year = d.getFullYear(),
        month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        days31 = [month[0],month[2],month[4],month[6],month[7],month[9],month[11]],
        days30 = [month[3],month[5],month[8],month[10]],
        showDate = $('.datebox input#date'),
        showMonth = $('.datebox input#month'),
        showYear = $('.datebox input#year')

        function displayFullDate () {

            $('.datebox .dateString').html(day + " " + month[monthIndex] + ", " + year);

        }
        //this checks if ita a leap year when the year month or day is incremented and adjusts the date accordingly

        function checkIfLeapOnYear () {

            var val = showDate.val(); 
            var valIsNum = !isNaN(parseFloat(val)) && isFinite(val);

            if (valIsNum)  
            {

                if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0) === true)
                {
                    if (monthIndex === 1){

                        if(showDate.val() > 29){
                            day = 29
                            showDate.val("29");
                            displayFullDate();
                            
                        }
                    }
                        
                }
                else {

                    if (monthIndex === 1){
                        if(showDate.val() > 28){
                            day = 28
                            showDate.val("28");
                            displayFullDate();
                            
                        }
                    }
                }
            }  
        }
        //This check's if date is incremented to 31 on a 30 day month and reverts date back to 30
        function checkMonth () {
            if (showMonth.val() === "4" || showMonth.val() === "6" || showMonth.val() === "9" 
                || showMonth.val() === "11")
            {
                if (showDate.val() === "31")
                {
                    day = 30
                    showDate.val("30");
                    displayFullDate();
                }
                
            }

        }
        //This restores the form varibles to current day after set date has been clicked
        function restoreDefaults () {

            day = curDay
            year = curYear
            monthIndex = curMonth

            showDate.val(curDay);
            showMonth.val(curMonth+1);
            showYear.val(curYear);
            displayFullDate();
        }

        //This sets all the default values on initialization
        displayFullDate();
        showDate.val(day);
        showMonth.val(monthIndex+1); //the +1 is because months are zero indexed in javascript
        showYear.val(year);


        // increment current date

        $('button.increaseDate').click(function (e) {
            e.preventDefault();
            // This algorithm checks if the current year is leap year

            if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0) === true)
        
                {
                    // check if the month is february
                    if (monthIndex === 1)
                    {
                         if(day != 29)
                            {
                                day++;
                                showDate.val(day);
                                displayFullDate();
                            }
                            else
                            {
                                day = 1;
                                showDate.val(day);
                                displayFullDate();
                            }
                    }
                    
                }
            else
                {

                    if (monthIndex === 1)
                    {
                        if(day != 28)
                            {
                                day++;
                                showDate.val(day);
                                displayFullDate();
                            }
                            else
                            {
                                day = 1;
                                showDate.val(day);
                                displayFullDate();
                            }
                    }
                    
                }

            // months with 31 days

            if (showMonth.val() === "1" || showMonth.val() === "3" || showMonth.val() === "5" 
                || showMonth.val() === "7"|| showMonth.val() === "8" || showMonth.val() === "10"
                || showMonth.val() === "12")
            {
                 if(day != 31)
                    {
                        day++;
                        showDate.val(day);
                        displayFullDate();
                    }
                    else
                    {
                        day = 1;
                        showDate.val(day);
                        displayFullDate();
                    }
            } 

            // months with 30 days

            if (showMonth.val() === "4" || showMonth.val() === "6" || showMonth.val() === "9" 
                || showMonth.val() === "11")
            {
                 if(day != 30)
                    {
                        day++;
                        showDate.val(day);
                        displayFullDate();
                    }
                    else
                    {
                        day = 1;
                        showDate.val(day);
                        displayFullDate();
                    }
            }              
        });

          // decrement current date

        $('button.decreaseDate').click(function (e) {
            e.preventDefault();
            // check if year is leap year
            if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0) === true)
        
                {
                    // check if the month is february
                    if (monthIndex === 1)
                    {
                         if(day != 1)
                            {
                                day--;
                                showDate.val(day);
                                displayFullDate();
                            }
                            else
                            {
                                day = 29;
                                showDate.val(day);
                                displayFullDate();
                            }
                    }
                    
                }
            else
                {
                    // check if the month is february
                    if (monthIndex === 1)
                    {
                        if(day != 1)
                            {
                                day--;
                                showDate.val(day);
                                displayFullDate();
                            }
                            else
                            {
                                day = 28;
                                showDate.val(day);
                                displayFullDate();
                            }
                    }
                    
                }

            // months with 31 days

            if (showMonth.val() === "1" || showMonth.val() === "3" || showMonth.val() === "5" 
                || showMonth.val() === "7" || showMonth.val() === "8" || showMonth.val() === "10"
                || showMonth.val() === "12")
            {
                 if (day != 1)
                    {
                        day--;
                        showDate.val(day);
                        displayFullDate();

                    }
                    else 
                    {
                        day = 31
                        showDate.val(day);
                        displayFullDate();
                    }
            }

            // months with 30 days

            if (showMonth.val() === "4" || showMonth.val() === "6" || showMonth.val() === "9" 
                || showMonth.val() === "11")
            {
                 if(day != 1)
                    {
                        day--;
                        showDate.val(day);
                        displayFullDate();
                    }
                    else
                    {
                        day = 30;
                        showDate.val(day);
                        displayFullDate();
                    }
            }      

        });

        // increment current month

        $('button.increaseMonth').click(function (e) {
            e.preventDefault();
            displayFullDate();

            if (monthIndex !=11) 
            {
                
                monthIndex++;
                showMonth.val(monthIndex+1);
                displayFullDate();
            }
            else
            {
                monthIndex = 0
                showMonth.val(monthIndex+1);
                displayFullDate();
            }

            checkMonth();
            checkIfLeapOnYear();
        });

         // decrement current month

        $('button.decreaseMonth').click(function (e) {
            e.preventDefault();
            displayFullDate();

            if (monthIndex !=0) 
            {
                monthIndex--;
                showMonth.val(monthIndex+1);
                displayFullDate();
            }
            else
            {
                monthIndex = 11
                showMonth.val(monthIndex+1);
                displayFullDate();
            }

            checkMonth();
            checkIfLeapOnYear();

        });

        // increment current year

        $('button.increaseYear').click(function (e) {
            e.preventDefault();
            year++;
            showYear.val(year);
            displayFullDate();

            checkIfLeapOnYear();
            
        });

         // decrement current year

        $('button.decreaseYear').click(function (e) {
            e.preventDefault();
            if(year != 0)
            {
                
                year--;
                showYear.val(year);
                displayFullDate();
            }
            checkIfLeapOnYear();
            
        });

        //Events fired off after clicking the calendar icon

        $('.calendarIcon').click(function(){
            var topPosition = $(this).offset().top - 20 + 'px',
            left = $('.datebox').offset().left - 14 + 'px',
            leftCal = $(this).offset().left + 'px',
            curCalendar = $(this).data('name'),
            dateBox = $('.datebox')

            $('.datebox .dateboxArrow').css({'top':left,'left':leftCal});

            $('.datebox .setBtn button').data("name",'#' + curCalendar);

            dateBox.fadeIn(200);
            dateBox.css('top',topPosition);

            var calTop = $(this).data('name');

            switch (calTop)
            {
            case "cal1":
                $(window).scrollTop(526);
                break;
            case "cal2":
                $(window).scrollTop(612);
                break;
            case "cal3":
                $(window).scrollTop(889);
                break;
            case "cal4":
                $(window).scrollTop(961);
                break;
            } 
            
        });

        $('.dateClose').click(function(){
            $('.datebox').fadeOut(200);
            restoreDefaults();
        });  

        $('.datebox .setBtn button').click(function(e) {
            e.preventDefault();
            var findCal = $(this).data("name")


            if(showDate.val().length === 1 && showMonth.val().length === 1)
            {
                $(findCal).val("0" + day + "/" + "0" + (monthIndex+1) + "/" + year);
            }
            else if (showDate.val().length === 1) {
                 $(findCal).val("0" + day + "/" + (monthIndex+1) + "/" + year);
            }
            else if (showMonth.val().length === 1) {
                 $(findCal).val(day + "/" + "0" + (monthIndex+1) + "/" + year);
            }
            else{
                $(findCal).val(day + "/" + (monthIndex+1) + "/" + year);
            }

            $('.datebox').fadeOut(200);
            restoreDefaults();
             
        });

        //-- The following scripts allow for user input --- //
        // Credit to Florian Bar 2014 

        //this script limits the user from inserting non numeric characters into the month field
        showMonth.keyup(function (e) {
            var v = $(this).val(); 
            var isNum = !isNaN(parseFloat(v)) && isFinite(v);
            if (!isNum && v != "") {
                $(this).val(monthIndex+1);
            } else {
                if (v > 12) {
                    showMonth.val(12);
                }
            }

            // leap year check
            checkIfLeapOnYear();

            monthIndex = $(this).val()-1;
            displayFullDate();

        });

        //this script limits the user from inserting non numeric characters into the day field
        showDate.keyup(function (e) {
            var v = $(this).val(); 
            var isNum = !isNaN(parseFloat(v)) && isFinite(v);
            if (!isNum && v != "") {
                $(this).val(day);
            } else {
                if (v > 31) {
                    showDate.val(31);
                }
            }
            // leap year check
            checkIfLeapOnYear();

            day = $(this).val();
            displayFullDate();

        });

        //this script limits the user from inserting non numeric characters into the year field
        showYear.keyup(function (e) {
            var v = $(this).val(); 
            var isNum = !isNaN(parseFloat(v)) && isFinite(v);
            if (!isNum && v != "") {
                $(this).val(year);
            } 
            else {
                if (v.length > 4) {
                    showYear.val(year);
                }
            }
            // leap year check
            checkIfLeapOnYear();

            year = $(this).val();
            displayFullDate();

        });
    }

}

// end of DATEBOX




$(document).ready(function() {

    IE7.init();
    //PlaceholderText.init();
    HeaderNav.init();
    SlideNav.init();
        
    ActionBar.init();
    Pagination.init();
    Pagination.createIt();
    PasswordStrength.init();
    EmailCert.init();
    ProxyDropdown.init();
    
    // custom checkbox button
    $('input:checkbox').screwDefaultButtons({
        image: 'url("/cpreg/content/img/checkBox.png")',
        width: 20,
        height: 20
    });

    // custom radio button
    //$('input:radio').screwDefaultButtons({
    //    image: 'url("/cpreg/content/img/radioBox.png")',
    //    width: 20,
    //    height: 20
    //});

    // tooltip open
    $('.tooltipLink').click(function(e) {
        e.preventDefault();
        $('.tooltipWrap').fadeIn(200);
    });

    // tooltip close
    $('.tooltipClose').click(function() {
        $('.tooltipWrap').fadeOut(200);
    });
    
    // print icon functionality
    $('.utility-icons li.print').click(function () {
        window.print();
    });

}); // end of document ready


$(window).resize(function() {

    // update global variables
    winWidth = $(window).width();

    ActionBar.resizeIt();
    if (winWidth > tablet) SlideNav.closeItNoAnim();
    Pagination.createIt();
    Pagination.slideToPage();
    HeaderNav.closeDropDown();

    if (winWidth < tablet) {
        $('#btnUploadPseudo').text('Add a file');

    } else if (winWidth > tablet) {
        $('#btnUploadPseudo').text('Select File');
    }

    if (winWidth > mobile) {
        $('#pdMobileLinks').hide();

    } else if (winWidth < mobile) {
        $('#pdMobileLinks').show();
    }

    $('.calendarIcon').click(function(){
            var left = $('.datebox').offset().left - 14 + 'px',
            leftCal = $(this).offset().left + 'px',
            curCalendar = $(this).data('name')

            $('.datebox .dateboxArrow').css({'top':left,'left':leftCal});
        });
    
});