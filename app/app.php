<?php

include_once 'header.php';

?>

    <main>
        <div class="row no-margins">

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
                                <i class="material-icons">
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
                                content
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
                                <i class="material-icons">
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
                                <input class="formal-input validate" type="text" placeholder="Lead Name*" />
                            </div>
                            <div class="col s12">
                                <input class="formal-input validate" type="text" placeholder="Phone Number*" />
                            </div>
                            <div class="col s12">
                                <input class="formal-input validate" type="text" placeholder="E-Mail*" />
                            </div>
                            <div class="col s12">
                                <input class="formal-input validate" type="text" placeholder="Estimator*" />
                            </div>
                            <div class="col s6">
                                <input type="date" class="datepicker formal-input" placeholder="Date of Booking*">
                            </div>
                            <div class="col s6 right-align">
                                <a class="waves-effect waves-light btn"><i class="material-icons left">save</i>Save</a>
                            </div>

                        </div>
                    </div>
                </div>

                <!--WEATHER WIDGET-->
                <div class="col s12 m12 l6 widget-container">
                    <div class="widget">
                        <div class="row widget-header no-margins ">
                            <div class="col s10">
                                <p class="widget-title">
                                    Weather
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="material-icons">
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
                            <div class="row">
                                <div class="col s6 right-align">
                                    <a class="btn waves-effect">
                                        HOURLY
                                    </a>
                                </div>
                                <div class="col s6 left-align">
                                    <a class="btn waves-effect">
                                        3-DAY
                                    </a>
                                </div>
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
                                <i class="material-icons">
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

                <!--OVERDUE HOMES WIDGET-->
                <div class="col s12 m12 l6 widget-container">
                    <div class="widget">
                        <div class="row widget-header no-margins ">
                            <div class="col s10">
                                <p class="widget-title">
                                    Recent Leads
                                </p>
                            </div>
                            <div class="col s2 right-align">
                                <i class="material-icons">
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
            </div>


        </div>
    </main>

</body>
</html>