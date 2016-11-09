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
                                <p id="dash_weather_title" class="widget-title">
                                    Weather
                                </p>
                            </div>
                            <div class="col s6 right-align">

                                <ul id='weather_widget_options' class='dropdown-content'>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Angus" data-code="55012">Angus</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Barrie" data-code="49550">Barrie</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Gravenhurst" data-code="55002">Gravenhurst</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="King City" data-code="55173">King City</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Midland" data-code="55004">Midland</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Newmarket" data-code="55017">Newmarket</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Orangeville" data-code="54977">Orangeville</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Scarborough" data-code="55049">Scarborough</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Toronto" data-code="55488">Toronto</a></li>
                                    <li><a class="weather-city-code-button" href="#!" data-city="Wasaga Beach" data-code="55488">Wasaga Beach</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#!">Hourly</a></li>
                                    <li><a href="#!">3-Day</a></li>
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

                <!--TASK LIST WIDGET-->
                <div class="col s12 m12 l12 widget-container">
                    <div class="widget auto-height">
                        <div class="row widget-header no-margins ">
                            <div class="col s6">
                                <p class="widget-title">
                                    Tasks
                                </p>
                            </div>
                            <div class="col s6 right-align">

                                <ul id='task_widget_options' class='dropdown-content'>
                                    <li><a class="task-code-button" href="#!" data-code="1">My Tasks</a></li>
                                    <li><a class="task-code-button" href="#!" data-code="2">Global Tasks</a></li>
                                    <li><a class="task-code-button" href="#!" data-code="3">Employee Lookup</a></li>
                                </ul>
                                <i class="material-icons dropdown-button" data-activates='task_widget_options'>
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
                            <!--VIEW: MY TASKS-->
                            <div class="row">
                                <div class="col s12">
                                    <ul class="collapsible" data-collapsible="accordion">
                                        <li>
                                            <div class="collapsible-header">
                                                TASK NAME
                                            </div>
                                            <div class="collapsible-body row">
                                                <div class="col s12 top-margin">
                                                    <a class="btn-floating green"><i class="material-icons">done</i></a> Mark as complete
                                                    <a class="btn-floating red"><i class="material-icons">delete</i></a> Delete this task
                                                </div>
                                                <div class="col s12 left-align"></div>
                                                <p>TASK DETAILS</p>
                                                <div class="row"></div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--VIEW: GLOBAL TASKS-->

                            <!--VIEW: LOOKUP TASKS-->
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
                    <div class="widget auto-height">
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
                                        <input id="estcalc_x_dimension" class="formal-input" type="text" placeholder="X Dimension (ft)"/>
                                        <input id="estcalc_y_dimension" class="formal-input" type="text" placeholder="Y Dimension (ft)"/>
                                        <input id="estcalc_area" class="formal-input" type="text" placeholder="Area (sqft)" disabled>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <input id="estcalc_pitch" class="formal-input" type="text" placeholder="? / 12"/>
                                        <input id="estcalc_bundles" class="formal-input" type="text" placeholder="Bundles">
                                        <input id="estcalc_cap" class="formal-input" type="text" placeholder="Cap">
                                    </div>
                                    <div class="col s12 right-align top-margin">
                                        <a class="btn">Save Measurements</a>
                                    </div>
                                    <div id="estcalc_roofing_sqft_sections" class="row">
                                        <table class="striped">
                                            <thead>
                                            <tr>
                                                <th data-field="id">#</th>
                                                <th data-field="name">X</th>
                                                <th data-field="name">Y</th>
                                                <th data-field="name">FT&sup2;</th>
                                                <th data-field="name">PITCH</th>
                                                <th data-field="price">BUND.</th>
                                                <th data-field="price">CAP.</th>
                                                <th data-field="price">DEL</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>221</td>
                                                <td>10</td>
                                                <td>2210</td>
                                                <td>7/12</td>
                                                <td>80</td>
                                                <td>15</td>
                                                <td><a class="btn-floating"><i class="material-icons">clear</i></a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>221</td>
                                                <td>10</td>
                                                <td>2210</td>
                                                <td>7/12</td>
                                                <td>80</td>
                                                <td>15</td>
                                                <td><a class="btn-floating"><i class="material-icons">clear</i></a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>221</td>
                                                <td>10</td>
                                                <td>2210</td>
                                                <td>7/12</td>
                                                <td>80</td>
                                                <td>15</td>
                                                <td><a class="btn-floating"><i class="material-icons">clear</i></a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>221</td>
                                                <td>10</td>
                                                <td>2210</td>
                                                <td>7/12</td>
                                                <td>80</td>
                                                <td>15</td>
                                                <td><a class="btn-floating"><i class="material-icons">clear</i></a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>221</td>
                                                <td>10</td>
                                                <td>2210</td>
                                                <td>7/12</td>
                                                <td>80</td>
                                                <td>15</td>
                                                <td><a class="btn-floating"><i class="material-icons">clear</i></a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>221</td>
                                                <td>10</td>
                                                <td>2210</td>
                                                <td>7/12</td>
                                                <td>80</td>
                                                <td>15</td>
                                                <td><a class="btn-floating"><i class="material-icons">clear</i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
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
                                            <select>
                                                <option value="" disabled selected>Select # of Layers</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                            <label>Layer Number</label>
                                            <input type="text" class="formal-input valign" placeholder="Indicate Cost">
                                            <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test1" />
                                            <label for="test1">Installation - 3ft Ice & Water Shield</label>
                                            <select>
                                                <option value="" disabled selected>3FT or 6FT</option>
                                                <option value="1">3 FT</option>
                                                <option value="2">6 FT</option>
                                            </select>
                                            <label>3 / 6 FT</label>
                                            <input type="text" class="formal-input valign" placeholder="Indicate Cost">
                                            <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test2" />
                                            <label for="test2">Balance of Roof - Snynthetic Underlayment</label>
                                            <input type="text" class="formal-input valign" placeholder="Indicate Price">
                                        <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test3" />
                                            <label for="test3">Vent & Plumbing Stack Flashing</label>
                                            <input type="text" class="formal-input valign" placeholder="Indicate Price">
                                        <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test4" />
                                            <label for="test4">28-Gauge Metal Valley Installation</label>
                                            <input type="text" class="formal-input valign" placeholder="Indicate Price">
                                        <div class="divider"></div>
                                        </p>
                                    </div>

                                    <div class="col s12 m6 l3">
                                        <p>
                                            <input type="checkbox" id="test5" />
                                            <label for="test5">Supply & Install Vents</label>
                                            <input type="text" class="formal-input valign" placeholder="Indicate Price">
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
                                            <input type="text" class="formal-input valign" placeholder="Indicate Quantity of Vents">
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
                            <div class="col s12">

                                <table>
                                    <thead>
                                    <tr>
                                        <th data-field="id">COMPANY</th>
                                        <th data-field="name">SHINGLE 1</th>
                                        <th data-field="price">SHINGLE 2</th>
                                        <th data-field="price">SHINGLE 3</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>Alvin</td>
                                        <td>Eclair</td>
                                        <td>$0.87</td>
                                    </tr>
                                    <tr>
                                        <td>Alan</td>
                                        <td>Jellybean</td>
                                        <td>$3.76</td>
                                    </tr>
                                    <tr>
                                        <td>Jonathan</td>
                                        <td>Lollipop</td>
                                        <td>$7.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!--COMPLETION WIDGET-->
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
                                <div class="col s12">
                                    <p>
                                        <input type="checkbox" id="estcalc_credit_card" />
                                        <label for="estcalc_credit_card">3% Credit Card Surcharge</label>
                                    <div class="divider"></div>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--ESTIMATE VALUES-->
                <div class="col s12 widget-container">
                    <div class="widget auto-height">
                        <div class="row widget-header no-margins">
                            <div class="col s10">
                                <p class="widget-title">
                                    Finalized Numbers
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
                            <!-- FINAL NUMBERS -->

                            <div class="row">
                                <div class="col s12 m12 l3 center-align">
                                    <h5 class="teal-text">COST</h5>
                                    <h3>$22,000</h3>
                                    <div class="divider"></div>
                                </div>

                                <div class="col s12 m12 l3 center-align">
                                    <h5 class="teal-text">COST + TAX</h5>
                                    <h3>$25,520</h3>
                                    <div class="divider"></div>
                                </div>

                                <div class="col s12 m12 l3 center-align">
                                    <h5 class="teal-text">DEPOSIT</h5>
                                    <h3>$2,520</h3>
                                    <div class="divider"></div>
                                </div>

                                <div class="col s12 m12 l3 center-align">
                                    <h5 class="teal-text">PROFIT MARGIN</h5>
                                    <h3>22.6%</h3>
                                    <div class="divider"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 right-align top-margin">
                                    <a id="dash_submit_post_btn" class="waves-effect waves-light btn top-margin"><i class="material-icons right">save</i>save</a>
                                    <a id="dash_submit_post_btn" class="waves-effect waves-light btn top-margin"><i class="material-icons right">print</i>save & print</a>
                                    <a id="dash_submit_post_btn" class="waves-effect waves-light btn top-margin"><i class="material-icons right">mail</i>save & email</a>
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