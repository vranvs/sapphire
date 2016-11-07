<?php

include_once 'header.php';

?>

    <main>
        <!--DASHBOARD PAGE-->
        <div id="page_0" class="mainPage row no-margins" data-page="0">

            <!-- LEFT-SIDE CONTAINER -->
            <div class="col s12 m12 l6 no-padding">
                <!--NEWS FEED WIDGET-->
                <div class="col s12 widget-container">
                    <div class="widget news-feed">
                        <div class="row widget-header no-margins ">
                            <div class="col s10">
                                <p class="widget-title">
                                    News Feed
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    close
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <div class="col s12">
                                <!-- COMPOST POST CONTENT -->
                                <div class="row">
                                    <div class="col s12 m12 l8">
                                        <label for="dash_post_textarea">New Post</label>
                                        <textarea id="dash_post_textarea" class="materialize-textarea" placeholder="Start writing your new post here..." length="5000"></textarea>
                                    </div>
                                    <div class="col s12 m12 l4">
                                        <div class="row">
                                            <div class="col s12 center-align">
                                                <div class="switch">
                                                    <label>
                                                        Site Only
                                                        <input id="dash_post_global" type="checkbox">
                                                        <span class="lever"></span>
                                                        Global E-Mail
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 center-align">
                                                <a class="btn-floating red"><i class="material-icons">insert_chart</i></a>
                                                <a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a>
                                                <a class="btn-floating green"><i class="material-icons">attachment</i></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 center-align">
                                                <a id="dash_submit_post_btn" class="waves-effect waves-light btn"><i class="material-icons right">send</i>post</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="divider"></div>
                                </div>

                                <!-- POST CONTENT -->
                                <h5>Recent Posts</h5>
                                <div id="dash_recent_posts_container">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT-SIDE CONTAINER -->

            <div class="col s12 m12 l6 no-padding">
                <!--NEW LEAD WIDGET-->
                <div class="col s12 m12 l6 widget-container">
                    <div class="widget">
                        <div class="row widget-header no-margins ">
                            <div class="col s10">
                                <p class="widget-title">
                                    New Lead
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    close
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <div class="col s12">
                                <input id="dash_add_lead_name" class="formal-input validate dash-lead-field" type="text" placeholder="Lead Name*" />
                            </div>
                            <div class="col s6">
                                <input id="dash_add_lead_phone" class="formal-input validate dash-lead-field" type="text" placeholder="Phone Number*" />
                            </div>
                            <div class="col s6">
                                <input id="dash_add_lead_email" class="formal-input validate dash-lead-field" type="text" placeholder="E-Mail*" />
                            </div>
                            <div class="col s12">
                                <input id="dash_add_lead_address" class="formal-input validate dash-lead-field" type="text" placeholder="Home Address*" />
                            </div>
                            <div class="col s6">
                                <input id="dash_add_lead_date" type="date" class="datepicker formal-input dash-lead-field" placeholder="Date of Booking*">
                            </div>
                            <div class="col s6">
                                <input id="dash_add_lead_time" type="text" class="formal-input dash-lead-field" placeholder="Time of Booking*">
                            </div>
                            <div class="col s6" style="position: relative;">
                                <div id="dash_lead_estimator_autocomplete_container" class="acd"></div>
                                <input id="dash_add_lead_estimator" class="formal-input validate dash-lead-field" type="text" placeholder="Estimator*" />
                            </div>
                            <div class="col s6 right-align">
                                <a id="dash_add_lead_btn" class="waves-effect waves-light btn"><i class="material-icons left">save</i>Save</a>
                            </div>

                        </div>
                    </div>
                </div>

                <!--OVERDUE HOMES WIDGET-->
                <div class="col s12 m12 l6 widget-container">
                    <div class="widget">
                        <div class="row widget-header no-margins ">
                            <div class="col s10">
                                <p class="widget-title">
                                    Overdue Homes
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    close
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">

                        </div>
                    </div>
                </div>

                <!--WEATHER WIDGET-->
                <div class="col s12 m12 l12 widget-container">
                    <div class="widget auto-height">
                        <div class="row widget-header no-margins ">
                            <div class="col s6">
                                <p class="widget-title">
                                    Weather
                                </p>
                            </div>
                            <div class="col s6 right-align">

                                <ul id='weather_widget_options' class='dropdown-content'>
                                    <li><a class="weather-city-code-button" href="#!" data-code="49550">Barrie</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-code="54977">Orangeville</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#!">Hourly</a></li>
                                    <li><a href="#!">3-Day</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#!">Graph</a></li>
                                    <li><a href="#!">Grid</a></li>
                                    <li class="divider"></li>
                                </ul>
                                <i class="material-icons dropdown-button" data-activates='weather_widget_options'>
                                    settings
                                </i>
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    close
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <!--GRAPH VIEW: HOURLY-->
                            <!-- <div id="dash_widget_weather_graph_hourly" class="row dash-weather-widget-view">
                                <div class="col s12">
                                    <canvas id="weather_chart" height="75%"></canvas>
                                </div>
                            </div>

                            <!--GRID VIEW: HOURLY-->
                            <div id="dash_widget_weather_grid_hourly" class="row dash-weather-widget-view center-align">
                                <h5 class="teal-text">HOURLY FORECAST</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!--RECENT LEADS WIDGET-->
                <div class="col s12 m12 l6 widget-container">
                    <div class="widget">
                        <div class="row widget-header no-margins ">
                            <div class="col s10">
                                <p class="widget-title">
                                    Recent Leads
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    close
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <div class="col s12">
                                <ul id="dash_recent_leads_list" class="collapsible" data-collapsible="accordion">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <!--LEADS PAGE-->
        <div id="page_1" class="mainPage row no-margins initHide" data-page="1">
            <div class="col s12">
                LEADS
            </div>
        </div>

        <!--SCHEDULE PAGE-->
        <div id="page_2" class="mainPage row no-margins initHide" data-page="2">
            <div class="col s12">
                SCHEDULE PAGE
            </div>
        </div>

        <!--ESTIMATOR CALCULATOR PAGE-->
        <div id="page_3" class="mainPage row no-margins initHide" data-page="3">
            <div class="col s12">
                <!--CLIENT INFORMATION WIDGET-->
                <div class="col s12 m12 l6 widget-container auto-height">
                    <div class="widget">
                        <div class="row widget-header no-margins">
                            <div class="col s10">
                                <p class="widget-title">
                                    Client Information
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    settings
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <div class="col s12">
                                <!-- POST CONTENT -->
                                <div class="row">
                                    <div class="col s12 m6 l6" style="position: relative;">
                                        <input id="estcalc_client_name" class="formal-input" type="text" placeholder="Client Name"/>
                                        <div id="estcalc_client_autocomplete_container" class="acd"></div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <input id="estcalc_client_address" class="formal-input" type="text" placeholder="Client Address"/>
                                        <input id="estcalc_client_phone" class="formal-input" type="text" placeholder="Client Phone"/>
                                        <input id="estcalc_client_email" class="formal-input" type="text" placeholder="Client E-Mail"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--MEASUREMENTS WIDGET-->
                <div class="col s12 m12 l6 widget-container auto-height">
                    <div class="widget">
                        <div class="row widget-header no-margins">
                            <div class="col s10">
                                <p class="widget-title">
                                    Measurements
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    settings
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <div class="col s12">
                                <!-- POST CONTENT -->
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <h5>Square Footage</h5>
                                        <input id="estcalc_x_dimension" class="formal-input" type="text" placeholder="X Dimension (ft)"/>
                                        <input id="estcalc_y_dimension" class="formal-input" type="text" placeholder="Y Dimension (ft)"/>
                                        <input id="estcalc_area" class="formal-input" type="text" placeholder="Area (sqft)" disabled>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <h5>Pitch</h5>
                                        <input id="estcalc_pitch" class="formal-input" type="text" placeholder="? / 12"/>
                                        <input id="estcalc_bundles" class="formal-input" type="text" placeholder="Bundles">
                                        <input id="estcalc_cap" class="formal-input" type="text" placeholder="Cap">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--BASE WORK & ADDITIONS WIDGET-->
                <div class="col s12 widget-container">
                    <div class="widget auto-height">
                        <div class="row widget-header no-margins">
                            <div class="col s10">
                                <p class="widget-title">
                                    Base Work
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    settings
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <div class="col s12">
                                <!-- BASE WORK -->
                                <div class="row">
                                    <h5>Base Work</h5>
                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test0" />
                                            <label for="test0">Removal of 1 layer of existing shingles</label>
                                            <input type="text" class="formal-input valign" placeholder="3ft, 6ft">
                                            <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test1" />
                                            <label for="test1">Installation - 3ft Ice & Water Shield</label>
                                            <input type="text" class="formal-input valign" placeholder="3ft, 6ft">
                                            <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test2" />
                                            <label for="test2">Balance of Roof - Snynthetic Underlayment</label>
                                            <input type="text" class="formal-input valign" placeholder="Notes">
                                        <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test3" />
                                            <label for="test3">Vent & Plumbing Stack Flashing</label>
                                            <input type="text" class="formal-input valign" placeholder="Notes">
                                        <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test4" />
                                            <label for="test4">28-Gauge Metal Valley Installation</label>
                                            <input type="text" class="formal-input valign" placeholder="Notes">
                                        <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test5" />
                                            <label for="test5">Supply & Install Vents</label>
                                            <input type="text" class="formal-input valign" placeholder="Notes">
                                        <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test6" />
                                            <label for="test6">Drip Edge</label>
                                            <select class="materi">
                                                <option value="" disabled selected>Finish</option>
                                                <option value="1">Galvanized</option>
                                                <option value="2">Black</option>
                                                <option value="3">Brown</option>
                                            </select>
                                        <div class="divider"></div>
                                        </p>
                                    </div>
                                </div>

                                <!-- ADDITIONS -->
                                <div class="row">
                                    <h5>Additions</h5>
                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test7" />
                                            <label for="test7">Venting</label>
                                            <select>
                                                <option value="" disabled selected>Venting Type</option>
                                                <option value="1">Big Whirly ($200)</option>
                                                <option value="2">Max ($200)</option>
                                                <option value="3">Ridge ($150)</option>
                                                <option value="4">Standard ($0)</option>
                                            </select>
                                            <select>
                                                <option value="" disabled selected>Venting Finish</option>
                                                <option value="1">Brown</option>
                                                <option value="2">Black</option>
                                            </select>
                                        <div class="divider"></div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--SHINGLES WIDGET-->
                <div class="col s12 widget-container">
                    <div class="widget auto-height">
                        <div class="row widget-header no-margins">
                            <div class="col s10">
                                <p class="widget-title">
                                    Shingles
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    settings
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <!-- SHINGLES -->
                            <div class="col s12 m12 l6">
                                <select>
                                    <option value="" disabled selected>Choose a supplier</option>
                                    <option value="1">BP</option>
                                    <option value="2">CertainTeed</option>
                                    <option value="3">GAF</option>
                                    <option value="4">IKO</option>
                                    <option value="5">Owens Corning</option>
                                </select>
                                <label>Supplier / Company</label>
                            </div>

                            <div class="col s12 m12 l6">
                                <select>
                                    <option value="" disabled selected>Choose a shingle type</option>
                                    <option value="1">Type 1</option>
                                    <option value="2">Type 2</option>
                                </select>
                                <label>Shingle Type</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!--SHINGLES WIDGET-->
                <div class="col s12 widget-container">
                    <div class="widget auto-height">
                        <div class="row widget-header no-margins">
                            <div class="col s10">
                                <p class="widget-title">
                                    Complete the Estimate
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="widget-sizer material-icons">
                                    expand_less
                                </i>
                                <i class="material-icons">
                                    settings
                                </i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="divider"></div>
                            </div>
                        </div>
                        <div class="row widget-body">
                            <!-- COMPLETION TIME -->
                            <div class="row">
                                <div class="col s12">
                                    <select>
                                        <option value="" disabled selected>Completion Time</option>
                                        <option value="1">2 Days</option>
                                        <option value="2">14 Days</option>
                                    </select>
                                    <label>Completion Time</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 m12 l4 center-align">
                                    <h5 class="teal-text">COST</h5>
                                    <h3>$22,000</h3>
                                    <div class="divider"></div>
                                </div>

                                <div class="col s12 m12 l4 center-align">
                                    <h5 class="teal-text">COST + TAX</h5>
                                    <h3>$25,520</h3>
                                    <div class="divider"></div>
                                </div>

                                <div class="col s12 m12 l4 center-align">
                                    <h5 class="teal-text">DEPOSIT</h5>
                                    <h3>$2,520</h3>
                                    <div class="divider"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 m6 l4 center-align top-margin">
                                    <a id="dash_submit_post_btn" class="waves-effect waves-light btn"><i class="material-icons right">save</i>save</a>
                                </div>
                                <div class="col s12 m6 l4 center-align top-margin">
                                    <a id="dash_submit_post_btn" class="waves-effect waves-light btn"><i class="material-icons right">mail</i>save & email</a>
                                </div>
                                <div class="col s12 m6 l4 center-align top-margin">
                                    <a id="dash_submit_post_btn" class="waves-effect waves-light btn"><i class="material-icons right">print</i>save & print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

</body>
</html>