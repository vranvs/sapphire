$(document).ready(function(){

    //materialize initializations
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15,
        format: 'yyyy-mm-dd'
    });
    $('select').material_select();

    //variable initialization, pages
    var pageDash = $("#page_0");        //page 0
    var pageLeads = $("#page_1");       //page 1
    var pageSched = $("#page_2");         //page 2
    var pageEst = $("#page_3");         //page 2
    var pageArray = [
        pageDash,
        pageLeads,
        pageSched,
        pageEst
    ];
    var currentPage = 0;

    //variable initialization, globals
    var autocompleteObject  = [];
    var weatherCityCode = 49550; //default barrie

    //dash cache
    var dashPostContainer   = $("#dash_recent_posts_container");
    var dashPostText        = $("#dash_post_textarea");
    var dashPostGlobal      = $("#dash_post_global");
    var dashLeadName        = $("#dash_add_lead_name");
    var dashLeadPhone       = $("#dash_add_lead_phone");
    var dashLeadEmail       = $("#dash_add_lead_email");
    var dashLeadAddress     = $("#dash_add_lead_address");
    var dashLeadEstimator   = $("#dash_add_lead_estimator");
    var dashLeadDate        = $("#dash_add_lead_date");
    var dashLeadTime        = $("#dash_add_lead_time");
    var dashRecentLeadList  = $("#dash_recent_leads_list");
    var dashLeadEstimatorAcd= $("#dash_lead_estimator_autocomplete_container");
    var dashWeatherGridHourly = $("#dash_widget_weather_grid_hourly");

    //estimator calculator cache
    var estCalcXDimension   = $("#estcalc_x_dimension");
    var estCalcYDimension   = $("#estcalc_y_dimension");
    var estCalcArea         = $("#estcalc_area");
    var estCalcPitch        = $("#estcalc_pitch");
    var estCalcBundles      = $("#estcalc_bundles");
    var estCalcCap          = $("#estcalc_cap");
    var estCalcClientName   = $("#estcalc_client_name");
    var estCalcClientEmail  = $("#estcalc_client_email");
    var estCalcClientAddr   = $("#estcalc_client_address");
    var estCalcClientPhone  = $("#estcalc_client_phone");
    var estCalcClientAcd    = $("#estcalc_client_autocomplete_container");

    //initialization, custom functions

    CallForWeather();
    RetrieveRecentLeads();
    RetrieveRecentPosts();

    //listeners, dash
    $("#dash_add_lead_btn").on('click', function(){
       AddLead(
           dashLeadName.val(),
           dashLeadPhone.val(),
           dashLeadEmail.val(),
           dashLeadAddress.val(),
           dashLeadEstimator.val(),
           dashLeadDate.val(),
           dashLeadTime.val()
       )
    });
    $(".side-nav-button").on('click', function(){
        var pageToDisplay = $(this).data('page');
        $(".mainPage").hide();
        pageArray[pageToDisplay].fadeIn(300);
    });
    $("#dash_submit_post_btn").on('click', function(){

        var content = dashPostText.val();
        var global = dashPostGlobal.prop('checked');

        if(content == ""){
            Materialize.toast("Please enter something in the post textarea before posting.", 5000);
            return;
        }

        $.ajax({
            dataType: "text",
            type: 'POST',
            data: {
                DASH_ADD_POST: true,
                content: content,
                global: global
            },
            url: 'databasing.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {
                dashPostText.val("");
                Materialize.toast(data, 5000);
                RetrieveRecentPosts();
            }

        });

    });
    dashLeadEstimator.on('keyup', function() {

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                DASH_RETRIEVE_ALL_EMPLOYEES: true,
                query: dashLeadEstimator.val()
            },
            url: 'databasing.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {
                autocompleteObject = data;
                $(".autocomplete-selection").remove();

                for (var i = 0; i < data.length; i++) {
                    dashLeadEstimatorAcd.append(
                        '<div class="autocomplete-selection" data-section="dash-estimator" data-estimatorid="' + i + '">' +
                        data[i].fullname +
                        '</div>'
                    );
                }
            }

        })
    });
    $( document ).on('click', '.add-comment-btn', function(){

        var postId = $(this).data('id');
        var commentPane = $("#comment_pane_" + postId);
        var content = commentPane.val();

        $.ajax({
            dataType: "text",
            type: 'POST',
            data: {
                DASH_ADD_COMMENT: true,
                postid: postId,
                content: content
            },
            url: 'databasing.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {
                commentPane.val("");
                RetrieveRecentPosts();
            }

        });

    });
    $(".weather-city-code-button").on('click', function(){
        weatherCityCode = $(this).data('code');
        CallForWeather();
    });


    //listeners, estimator calculator
    estCalcXDimension.on('keyup', function(){
        EstCalcArea();
        PitchCalc();
    });
    estCalcYDimension.on('keyup', function(){
        EstCalcArea();
        PitchCalc();
    });
    estCalcPitch.on('keyup', function(){
        PitchCalc();
    });
    estCalcClientName.on('keyup', function(){

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                DASH_RETRIEVE_ALL_LEADS_BY_STATUS: true,
                status: 0,
                query: estCalcClientName.val()
            },
            url: 'databasing.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {
                autocompleteObject = data;
                $(".autocomplete-selection").remove();

                for(var i = 0; i < data.length; i++){
                    estCalcClientAcd.append(
                        '<div class="autocomplete-selection" data-section="estcalc-client" data-clientid="' + i + '">' +
                            data[i].name +
                        '</div>'
                    );
                }
            }

        });
    });

    //listeners, global
    $(".widget-sizer").on('click', function(){
        $(this).parents('.widget').children('.widget-body').slideToggle(300);
        if($(this).html == "expand_less"){
            $(this).html("expand_more");
        }else{
            $(this).html("expand_less");
        }

    });
    $( document ).on('click', '.autocomplete-selection', function(){

        var id;

        //autocomplete for clients in estimator calculator
        if($(this).data('section') == "estcalc-client"){
            id = $(this).data('clientid');
            estCalcClientName.val(autocompleteObject[id].name);
            estCalcClientEmail.val(autocompleteObject[id].email);
            estCalcClientAddr.val(autocompleteObject[id].address);
            estCalcClientPhone.val(autocompleteObject[id].phone);

        }
        else if($(this).data('section') == "dash-estimator"){
            id = $(this).data('estimatorid');
            dashLeadEstimator.val(autocompleteObject[id].fullname);
        }

        $('.autocomplete-selection').remove();
        autocompleteObject = [];

    });


    //functions, dash
    function CallForWeather(){

        $.ajax({
            type: "GET",
            dataType: "jsonp",
            url: 'http://dataservice.accuweather.com/forecasts/v1/hourly/12hour/' + weatherCityCode + '?apikey=AAHeyLjBik8eNL68OWwHQuRMKaqUR02R&language=en-us&details=true&metric=true',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                $(".gen-weather").remove();

                for(var i = 0; i <= 11; i++){

                    var icon = '';

                    switch(data[i].WeatherIcon){
                        case 1:
                            icon = '<i class="wi wi-day-sunny icon-35 top-margin deep-orange-text"></i><br/>'
                            break;
                        case 2:
                            icon = '<i class="wi wi-day-sunny icon-35 top-margin deep-orange-text"></i><br/>'
                            break;
                        case 3:
                            icon = '<i class="wi wi-day-sunny icon-35 top-margin deep-orange-text"></i><br/>'
                            break;
                        case 4:
                            icon = '<i class="wi wi-day-sunny-overcast icon-35 top-margin deep-orange-text"></i><br/>'
                            break;
                        case 5:
                            icon = '<i class="wi wi-day-cloudy icon-35 top-margin grey-text-text"></i><br/>'
                            break;
                        case 6:
                            icon = '<i class="wi wi-day-cloudy icon-35 top-margin grey-text"></i><br/>'
                            break;
                        case 7:
                            icon = '<i class="wi wi-cloudy icon-35 top-margin grey-text"></i><br/>'
                            break;
                        case 8:
                            icon = '<i class="wi wi-cloudy icon-35 top-margin grey-text"></i><br/>'
                            break;
                        case 9:
                            icon = '<i class="wi wi-day-sunny icon-35 top-margin deep-orange-text"></i><br/>'
                            break;
                        case 10:
                            icon = '<i class="wi wi-day-sunny icon-35 top-margin deep-orange-text"></i><br/>'
                            break;
                        case 11:
                            icon = '<i class="wi wi-fog icon-35 top-margin gray-text"></i><br/>'
                            break;
                        case 12:
                            icon = '<i class="wi wi-rain icon-35 top-margin blue-text"></i><br/>'
                            break;
                        case 13:
                            icon = '<i class="wi wi-day-rain icon-35 top-margin orange-text"></i><br/>'
                            break;
                        case 14:
                            icon = '<i class="wi wi-day-rain icon-35 top-margin orange-text"></i><br/>'
                            break;
                        case 15:
                            icon = '<i class="wi wi-day-lightning icon-35 top-margin red-text"></i><br/>'
                            break;
                        case 16:
                            icon = '<i class="wi wi-day-lightning icon-35 top-margin red-text"></i><br/>'
                            break;
                        case 17:
                            icon = '<i class="wi wi-day-lightning icon-35 top-margin red-text"></i><br/>'
                            break;
                        case 18:
                            icon = '<i class="wi wi-rain icon-35 top-margin blue-text"></i><br/>'
                            break;
                        case 19:
                            icon = '<i class="wi wi-snow icon-35 top-margin black-text"></i><br/>'
                            break;
                        case 20:
                            icon = '<i class="wi wi-day-snow icon-35 top-margin black-text"></i><br/>'
                            break;
                        case 21:
                            icon = '<i class="wi wi-day-snow icon-35 top-margin black-text"></i><br/>'
                            break;
                        case 22:
                            icon = '<i class="wi wi-day-snow icon-35 top-margin black-text"></i><br/>'
                            break;
                        case 25:
                            icon = '<i class="wi wi-sleet icon-35 top-margin purple-text"></i><br/>'
                            break;
                        case 32:
                            icon = '<i class="wi wi-strong-wind icon-35 top-margin teal-text"></i><br/>'
                            break;
                        case 33:
                            icon = '<i class="wi wi-night-clear icon-35 top-margin blue-text text-darken-3"></i><br/>'
                            break;
                        case 34:
                            icon = '<i class="wi wi-night-alt-cloudy icon-35 top-margin blue-text text-darken-3"></i><br/>'
                            break;
                        case 35:
                            icon = '<i class="wi wi-night-alt-cloudy icon-35 top-margin blue-text text-darken-3"></i><br/>'
                            break;
                        case 36:
                            icon = '<i class="wi wi-night-alt-cloudy icon-35 top-margin blue-text blue-text text-darken-3"></i><br/>'
                            break;
                        case 37:
                            icon = '<i class="wi wi-night-alt-cloudy icon-35 top-margin blue-text blue-text text-darken-3"></i><br/>'
                            break;
                        case 38:
                            icon = '<i class="wi wi-night-alt-cloudy icon-35 top-margin blue-text blue-text text-darken-3"></i><br/>'
                            break;
                        case 39:
                            icon = '<i class="wi wi-night-alt-rain icon-35 top-margin blue-text blue-text text-darken-3"></i><br/>'
                            break;
                        case 40:
                            icon = '<i class="wi wi-night-alt-rain icon-35 top-margin blue-text blue-text text-darken-3"></i><br/>'
                            break;
                        case 41:
                            icon = '<i class="wi wi-night-alt-lightning icon-35 top-margin blue-text red-text text-darken-3"></i><br/>'
                            break;
                        case 42:
                            icon = '<i class="wi wi-night-alt-lightning icon-35 top-margin blue-text red-text text-darken-3"></i><br/>'
                            break;
                        case 43:
                            icon = '<i class="wi wi-night-alt-snow icon-35 top-margin blue-text red-text text-darken-3"></i><br/>'
                            break;
                        case 44:
                            icon = '<i class="wi wi-night-alt-snow icon-35 top-margin blue-text red-text text-darken-3"></i><br/>'
                            break;

                    }

                    dashWeatherGridHourly.append(
                    '<div class="col s12 m12 l2 weather-panel gen-weather">' +
                        '<div class="center-align">' +
                        '<h6 class="teal-text">' + data[i].DateTime.substr(11, 5) + '</h6>' +
                        '<div class="divider"></div>' +
                         icon +
                        '<span class="small-text">' + data[i].IconPhrase + '</span>' +
                        '<div class="divider"></div>' +
                        '<i class="wi wi-thermometer wi-fw icon-15 grey-text top-margin"></i><span class="weather-text">' + data[i].RealFeelTemperature.Value + '&deg;' + data[i].RealFeelTemperature.Unit + '</span><br/>' +
                        '<i class="wi wi-wu-chancerain wi-fw icon-15 grey-text top-margin"></i><span class="weather-text">' + data[i].PrecipitationProbability + '%</span><br/>' +
                        '</div>' +
                    '</div>'
                    );
                }

            }

        });
    }
    function AddLead(name, phone, email, address, estimator, date, time){
        $.ajax({
            dataType: "text",
            type: 'POST',
            data: {
                DASH_ADD_LEAD: true,
                name: name,
                phone: phone,
                email: email,
                address: address,
                estimator: estimator,
                date: date,
                time: time
            },
            url: 'databasing.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {
                Materialize.toast(data, 5000);
                $(".dash-lead-field").val("");
                RetrieveRecentLeads();
            }

        });
    }
    function RetrieveRecentPosts(){
        $(".gen-post").remove();
        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                DASH_RETRIEVE_POSTS: true
            },
            url: 'databasing.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                for(var i = 0; i < data.length; i++){

                    var comment_block = "";
                    //var file_block = "";

                    if(data[i].comments.length == 0){
                        comment_block = '<div class="row no-margins valign-wrapper"><div class="col s12 center-align small-text valign">No comments yet.</div></div>';
                    }else{
                        for(var n = 0; n < data[i].comments.length; n++){

                            var qa = data[i].comments[n];

                            comment_block += (

                                '<div class="post-comment col s11 offset-s1 grey lighten-5">' +
                                '<div class="chip">' +
                                '<img src="' + qa.avatar + '" />' +
                                qa.author +
                            '</div>' +
                            '<span class="blue-grey-text text-lighten-2">' + qa.date + ' at ' + qa.time + '</span>' +
                            '<br/>' +
                                    qa.content +
                            '</div>'

                            );

                        }
                    }

                    /*
                    var fileObject = JSON.parse(data[i].files);

                    if($.isEmptyObject(fileObject)){file_block = "";}
                    else{

                        $.each(fileObject, function(name, dir){

                            file_block += (
                                '<li class="collection-item"><div>' + name + '<a href="' + dir + '" class="secondary-content"><i class="material-icons">attachment</i></a></div></li>'
                            );

                        });

                    }
                    */

                    dashPostContainer.append(

                    '<div class="gen-post post-container col s12">' +
                        '<div class="row no-margins post-header valign-wrapper">' +
                        '<div class="post-title valign col s10" style="margin-top: 10px">' +
                        '<div class="chip">' +
                        '<img src="' + data[i].avatar + '" />' +
                        data[i].author +
                    '</div>' +
                    '<span class="post-date blue-grey-text text-lighten-2">' + data[i].date + ' at ' + data[i].time + '</span>' +
                    '</div>' +
                    '<div class="col s2 post-settings right-align">' +
                        '<i class="material-icons mini-icon button">' +
                        'settings' +
                        '</i>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="divider"></div>' +
                        '<div class="col s12 post-content">' +
                        data[i].content +
                '</div>' +
                    '</div>' +
                    '<div class="row">' +
                        '<div>' +
                        '<i class="material-icons mini-icon">' +
                        'sms' +
                        '</i>' +
                        '<span class="teal-text">Comments</span>' +
                        '</div>' +
                        '<div class="divider"></div>' + comment_block +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="divider"></div>' +
                        '<div class="col s11 offset-s1 comment-textarea-container">' +
                        '<textarea id="comment_pane_' + data[i].id + '" class="post-textarea no-margins" placeholder="Comment..."></textarea>' +
                        '</div>' +
                        '<div class="col s12 right-align">' +
                        '<a class="waves-effect waves-light btn add-comment-btn" data-id="' + data[i].id + '"><i class="material-icons right">sms</i>comment</a>' +
                        '</div>' +
                    '</div>' +
                    '</div>'

                    );

                }
            }

        });
    }
    function RetrieveRecentLeads(){

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                DASH_RETRIEVE_RECENT_LEADS: true
            },
            url: 'databasing.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                if(data.length == 0){
                    $("#dash_recent_leads_list").hide();
                    dashRecentLeadList.parent().append("There are no recent leads.");
                    return;
                }else{
                    $(".gen-recent-leads").remove();
                    $("#dash_recent_leads_list").show();
                }

                for(var i = 0; i<data.length; i++){
                    dashRecentLeadList.append(
                        '<li class="gen-recent-leads">' +
                        '<div class="collapsible-header blue-grey lighten-5"><span class="new badge" style="position: relative; margin-left: 10px;" data-badge-caption="' + data[i].datetime + '"></span><i class="material-icons">face</i>' + data[i].name + '</div>' +
                        '<div class="collapsible-body"><p>' +
                        '<span class="">Lead/Client ID: ' + data[i].id + '</span><br/>' +
                        '<span class="">Client\'s Name: ' + data[i].name + '</span><br/>' +
                        '<span class="">Phone Number : ' + data[i].phone + '</span><br/>' +
                        '<span class="">E-Mail: ' + data[i].email + '</span><br/>' +
                        '<span class="">Home Address: ' + data[i].address + '</span><br/>' +
                        '<span class="">Assigned Estimator: ' + data[i].estimator + '</span><br/>' +
                        '<span class="">Appointment: ' + data[i].booking_date + ' at ' + data[i].booking_time + '</span><br/>' +
                        + '</p></div></li>'
                    );
                }
            }

        });
    }

    //functions, estimator calculator
    function EstCalcArea(){
        var area = (estCalcXDimension.val() * estCalcYDimension.val()).toFixed(2);
        estCalcArea.val(area);
    }
    function PitchCalc(){
        var slopeCorrectionFactor = 0;
        var capLinearFeet = 0;

        switch(parseInt(estCalcPitch.val())){
            case 1:
                slopeCorrectionFactor = 1.003;
                break;
            case 2:
                slopeCorrectionFactor = 1.014;
                break;
            case 3:
                slopeCorrectionFactor = 1.031;
                break;
            case 4:
                slopeCorrectionFactor = 1.054;
                break;
            case 5:
                slopeCorrectionFactor = 1.083;
                break;
            case 6:
                slopeCorrectionFactor = 1.118;
                break;
            case 7:
                slopeCorrectionFactor = 1.158;
                break;
            case 8:
                slopeCorrectionFactor = 1.202;
                break;
            case 9:
                slopeCorrectionFactor = 1.250;
                break;
            case 10:
                slopeCorrectionFactor = 1.302;
                break;
            case 11:
                slopeCorrectionFactor = 1.357;
                break;
            case 12:
                slopeCorrectionFactor = 1.414;
                break;
            case 13:
                slopeCorrectionFactor = 1.474;
                break;
            case 14:
                slopeCorrectionFactor = 1.537;
                break;
            case 15:
                slopeCorrectionFactor = 1.601;
                break;
            case 16:
                slopeCorrectionFactor = 1.667;
                break;
            case 17:
                slopeCorrectionFactor = 1.734;
                break;
            case 18:
                slopeCorrectionFactor = 1.803;
                break;
            case 19:
                slopeCorrectionFactor = 1.873;
                break;
            case 20:
                slopeCorrectionFactor = 1.994;
                break;
            case 21:
                slopeCorrectionFactor = 2.016;
                break;
            case 22:
                slopeCorrectionFactor = 2.088;
                break;
            case 23:
                slopeCorrectionFactor = 2.162;
                break;
            case 24:
                slopeCorrectionFactor = 2.236;
                break;
            default:
                slopeCorrectionFactor = 0;
                break;
        }

        if(estCalcXDimension < estCalcYDimension){
            capLinearFeet = estCalcYDimension.val();
        }else{
            capLinearFeet = estCalcXDimension.val();
        }

        var trueArea = estCalcArea.val() * slopeCorrectionFactor;

        estCalcBundles.attr("placeholder", "Exact bundles: " + Math.ceil(trueArea / 33));
        estCalcCap.attr("placeholder", "Exact capping: " + Math.ceil(capLinearFeet / 20))

    }

});