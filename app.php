<?php

include_once "header.php";

if(!isset($role)){
    header('Location: secure_login.php');
    return;
}

if($role == "Administrator" || $role == "Private Investigator" || $role = "Lab Technician"){
    echo<<<_END

        <div class="labPage"          id="labPage_home">
            <!--PAGE HEADERS -->
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">Dashboard</span> <span class="fa fa-home myBlue"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        Welcome to your dashboard. <br/>
                        Here you can post announcements to the lab, place orders with the technician, and view the currently open orders.
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->
            <div class="viewMain row">

                <div class="backShader"></div>
                <div class="popup pup" id="dash_orderReceivedPopup">
                    <div class="popupHeader">Storage Information</div>
                    <div class="col-12">
                        <input class="ipt" type="text" id="dash_order_rec_cabinet" placeholder="Cabinet ID" />
                        <br/>
                        <input class="ipt" type="text" id="dash_order_rec_rack" placeholder="Cabinet Rack" />
                        <br/>
                        <input class="ipt" type="text" id="dash_order_rec_box" placeholder="Box/Container" />
                        <br/>
                        <input class="ipt" type="text" id="dash_order_rec_coords" placeholder="Coordinates" />
                        <br/>
                        <br/>
                        <input type="submit" id="dash_order_rec_accept" value="Submit" class="btn_w"/>
                    </div>
                </div>

                <div class="col-8">

                    <div class="dashPanel">
                        <div class="dashPanelHeader">
                            <span class="regTextPanelA" id="dash_refreshDisplay"></span> <span class="fa fa-refresh myGreen"> </span> <span class="regTextPanelA">Live Announcement Feed</span>
                        </div>

                        <div id="dash_postTables" class="dashPanelBody">

                        </div>
                    </div>

                </div>

                <div class="col-4 leftBorder bottomBorder whiteBg">

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-comment myBlue"></span> <span class="regTextPanelA">Quick Post</span></div>
                        <div class="collapseContent">
                            <div id="dash_announce" class="rtf"></div>
                            <select id="dash_globalPost">
                                <option value="0">Dash Only</option>
                                <option value="1">Global E-mail</option>
                            </select>
                            <br/>
                            <input type="submit" value="Post" class="btn_w" id="dash_post" /> <span class="fa fa-check myGreen" style="display: none;" id="dash_announceHint"></span>
                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-shopping-cart myBlue"></span> <span class="regTextPanelA">Quick Order</span></div>
                        <div class="collapseContent">
                            <input class="ipt" type="text" id="dash_orderItem" placeholder="Product Name">
                            <br/>
                            <div id="dash_order_acd" class="dontShow"></div>
                            <input class="ipt" type="text" id="dash_orderQuantity" placeholder="Quantity / Size">
                            <br/>
                            <input class="ipt" type="text" id="dash_orderSupplier" placeholder="Supplier">
                            <br/>
                            <input class="ipt" type="text" id="dash_orderProductNumber" placeholder="Product Number">
                            <br/>
                            <input class="ipt" type="text" id="dash_orderPrice" placeholder="Price" />
                            <br/>
                            <input class="ipt" type="text" id="dash_orderLink" placeholder="Link">
                            <br/>
                            <select id="dash_orderUrgency">
                                <option value="Normal">Normal</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                            <br/>
                            <textarea id="dash_orderNotes" class="announceBox" placeholder="Ordering notes"></textarea>
                            <br/>
                            <br/>
                            <input type="submit" id="dash_orderSubmit" class="btn_w" value="Order" />
                            <span class="fa fa-check myGreen" style="display:none;" id="dash_orderHint"></span>
                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="dashPanel">
                        <div class="dashPanelHeader">
                            <span class="fa fa-warning fa-fw myOrange"></span><span class="regTextPanelA">Today's Events</span>
                        </div>

                        <div class="dashPanelBody">

                        <div id="dash_todaysEvents">

                        </div>

                        </div>
                    </div>

                    <div class="dashPanel">
                        <div class="dashPanelHeader">
                            <span class="fa fa-group fa-fw myDarkBlue"></span><span class="regTextPanelA">Next Lab Meetings</span>
                        </div>

                        <div class="dashPanelBody">

                            <table class="searchResultsTable" id="dash_labMeetingsTable">
                                <tr>
                                    <td>Date</td>
                                    <td>Room</td>
                                    <td>Time</td>
                                    <td>Subject</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div class="dashPanel">
                        <div class="dashPanelHeader">
                            <span class="fa fa-database fa-fw myYellow"></span><span class="regTextPanelA">Pending Inventory</span>
                        </div>

                        <div id="dash_orderPanel" class="dashPanelBody">

                        </div>
                    </div>


                    <div class="dashPanel">
                        <div class="dashPanelHeader">
                            <span class="fa fa-bar-chart fa-fw myPink"></span><span class="regTextPanelA">Lab Points</span>
                        </div>

                        <div class="dashPanelBody">
                            <canvas id="canvas" width="100%" height="100%"></canvas>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="labPage dontShow" id="labPage_notebook">
            <!--PAGE HEADERS -->
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">Lab Notebook</span> <span class="fa fa-book myPurple"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        Welcome to your notebook. <br/>
                        Start a new page simply by entering a title and description. Drag and drop images and files up to 500 megabytes. Reference protocols easily using the drop-down menu.
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->
            <div class="viewMain row">
                <div class="col-6">
                    <span id="nb_entryTitle" class="headerText"></span> <span id="nb_entryId" class="headerText"></span>
                    <br/>
                    <span id="nb_entryAuthor" class="regText"></span>
                    <br/>
                    <span id="nb_entryDescription" class="regText"></span>
                    <br/>
                    <span id="nb_entryProtocol" class="regText"></span>
                    <br/>
                    <div id="nb_entryImages" class="col-12"></div>
                </div>

                <div class="col-6 leftBorder bottomBorder whiteBg">

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-pencil myBlue"></span> <span class="regTextPanelA">New Notebook Page</span></div>
                        <div class="collapseContent">
                            <div id="protocolTitleInfo">
                                <input id="notebook_pageTitle" class="realInput titleText fullWidth" placeholder="&#xf040; New Page Title..."/>
                                <br/>
                                <br/>
                                <span class="fa fa-star fa-2x fa-toggle myBlue" id="nb_entryStar"></span><span class="regText"> Mark as Interesting</span>
                                <br/>
                                <br/>
                                <div id="notebook_pageDetails" class="rtf"></div>
                                <br/>
                                <span class="headerText">Files & Images</span>
                                <form id="myDropzone" class="dropzone fileUploadBox" enctype="multipart/form-data" action="upload.php">
                                </form>
                                <br/>
                                <br/>
                                <div class="oj_trim_dashed"></div>
                                <br/>
                                <span class="regText">Search for protocols to reference:</span><br/>
                                <input type="text" class="ipt longInput" placeholder="&#xf002; Search query..." id="nb_protSearchQuery" /> <input type="submit" class="btn_sq" value="&#xf002;" id="nb_protSearchButton"/><br/>


                                <table class="fullTable" id="nb_protSearchTable">

                                    <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Version</td>
                                            <td>Variables</td>
                                            <td>View</td>
                                            <td>Ref.</td>
                                        </tr>
                                    </thead>

                                </table>
                                <div id="notebook_protocolPopulate">
                                </div>
                            </div>
                            <br/>
                            <div class="oj_trim_dashed"></div>
                            <br/>
                            <input type="submit" class="btn_w" id="notebook_submitEntry" value="Submit Entry"/>
                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-search myBlue"></span> <span class="regTextPanelA">Search Notebook</span></div>
                        <div class="collapseContent">
                            <input class="ipt" type="text" id="notebook_searchQuery" placeholder="Search Notebook..."/><input class="btn_sq" type="submit" id="notebook_submitSearch" value="&#xf002;"/><br/>
                            <br/>

                            <div id="notebook_searchResults">

                                <table class="searchResultsTable" id="nb_searchTableView">

                                    <tr id="nb_searchTableHead">
                                        <td>ID</td>
                                        <td>Title</td>
                                        <td>Date</td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader" id="tab_table_notebook"><span class="fa fa-list myBlue"></span> <span class="regTextPanelA">Recent Entries</span></div>
                        <div class="collapseContent">
                            <table class="searchResultsTable" id="nb_tableView">

                                <tr id="nb_tableHead">
                                    <td>ID</td>
                                    <td>Title</td>
                                    <td>Date</td>
                                </tr>

                            </table>
                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                </div>

            </div>
        </div>

        <div class="labPage dontShow" id="labPage_orders">
            Orders
        </div>

        <div class="labPage dontShow" id="labPage_protocols">
            <!--PAGE HEADERS -->
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">Protocols</span> <span class="fa fa-list myOrange"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        Welcome to the protocols page. <br/>
                        You can easily compose a new protocol with fields to be referenced later, when making lab book entries.
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->
            <div class="viewMain row">

                <div class="col-6">
                    <div class="genericPanel padded" id="protocol_prevPane">
                    <table class="protocolViewTable">
                        <tbody>
                            <tr>
                                <td>Protocol</td>
                                <td id="protocol_previewName"></td>
                            </tr>

                            <tr>
                                <td>Version</td>
                                <td id="protocol_previewId"></td>
                            </tr>

                            <tr>
                                <td>Date Created</td>
                                <td id="protocol_previewDate"></td>
                            </tr>

                            <tr>
                                <td>Author</td>
                                <td id="protocol_previewAuth"></td>
                            </tr>

                            <tr>
                                <td>List of Variables</td>
                                <td id="protocol_previewVars"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <div class="regText" id="protocol_previewDesc"></div>
                    </div>
                </div>


                <div class="col-6 leftBorder bottomBorder whiteBg">

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-pencil myBlue"></span> <span class="regTextPanelA">Compose New Protocol</span></div>
                        <div class="collapseContent">

                            <input class="realInput titleText fullWidth" type="text" class="realInput titleText fullWidth" id="protocolName" placeholder="New Protocol Name"/><span id="newProtocolHint" style="display: none"></span><br/>
                            <div class="rtf" id="protocolDescription" placeholder="New protocol description"></div>
                            <input type="submit" class="btn_w" id="prot_addVars" value="Add Variables" />

                            <div id="protocolOptions" class="dontShow">

                                <br/>
                                <input class="ipt" type="text" id="new_textField" placeholder="New variable (short)"/>    <input class="btn_sq" type="submit" id="btn_new_textField" value="&#xf067;" /> <br/>
                                <input class="ipt" type="text" id="new_textArea" placeholder="New variable (long)"/>    <input class="btn_sq" type="submit" id="btn_new_textArea" value="&#xf067;" />
                            </div>
                            <br/>
                            <span class="regText">Variables:</span>
                            <div id="protocolDiv"></div>
                            <div class="fullWidth">
                            <input type="submit" class="btn_w" id="submit_protocol" value="submit"/> <span id="submissionHint" style="display: none">SUCCESS</span>  <br/>
                            </div>

                     </div>

                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>

                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-search myBlue"></span> <span class="regTextPanelA">Search Protocols</span></div>
                        <div class="collapseContent">

                            <input type="text" class="ipt longInput" placeholder="&#xf002; Search query..." id="prot_searchQuery" /><br/>
                            <input type="submit" class="btn_w" value="&#xf002; Search" id="prot_searchButton"/><br/><br/>

                            <table class="fullTable" id="prot_searchResults">

                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Version</td>
                                        <td>Owner</td>
                                        <td>Edit</td>
                                        <td>View</td>
                                        <td>Export</td>
                                    </tr>
                                </thead>

                            </table>

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                </div>

            </div>
        </div>

        <div class="labPage dontShow" id="labPage_storage">
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">Storage</span> <span class="fa fa-database myGreen"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        Welcome to the storage page. <br/>
                        Create entries in the database for future ease of finding stored items. You can search the database from this page as well.
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->
            <div class="viewMain row">
                <div class="col-8">
                    <table id="storage_resultsTable" class="fullTable editTable" data-tabletype="storage">
                    <thead>
                        <tr>
                            <td>Item</td>
                            <td>Barcode #</td>
                            <td>Cabinet</td>
                            <td>Rack</td>
                            <td>Box</td>
                            <td>Coords</td>
                        </tr>
                    </thead>
                    </table>
                </div>

                <div class="col-4 leftBorder bottomBorder whiteBg">

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-database myBlue"></span> <span class="regTextPanelA">Store an Item</span></div>
                        <div class="collapseContent">

                            <span class="regText">Item Description</span>
                            <br/>
                            <input class="ipt" type="text" id="storage_itemName" placeholder="Item">
                            <br/>
                            <input class="ipt" type="text" id="storage_itemBarcode" placeholder="Barcode">
                            <br/>
                            <textarea placeholder="Item details" id="storage_details"></textarea>
                            <br/>
                            <br/>
                            <span class="regText">Location Information</span>
                            <br/>
                            <input class="ipt" type="text" id="storage_cabinet" placeholder="Cabinet ID" />
                            <br/>
                            <input class="ipt" type="text" id="storage_rack" placeholder="Cabinet Rack" />
                            <br/>
                            <input class="ipt" type="text" id="storage_box" placeholder="Box/Container" />
                            <br/>
                            <input class="ipt" type="text" id="storage_coords" placeholder="Coordinates" />
                            <br/>
                            <br/>
                            <input type="submit" id="storage_submitEntry" value="Submit" class="btn_w"/>
                            <span class="regText dontShow myGreen" id="storage_submitHint"></span>
                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>

                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-search myBlue"></span> <span class="regTextPanelA">Search Database</span></div>
                        <div class="collapseContent">
                            <span class="regText hint">Search by...</span><br/>
                            <select id="storage_searchCol">
                                <option disabled>Search by...</option>
                                <option value="item">Item Name</option>
                                <option value="barcode">Barcode</option>
                                <option value="description">Description</option>
                                <option value="cabinet">Cabinet</option>
                                <option value="box">Box</option>
                            </select>
                            <br/>
                            <input class="ipt" type="text" id="storage_searchQuery"  placeholder="Search query..."><br/>
                            <input type="submit" class="btn_w" id="storage_dbSearch" value="Search" /> <span id="storage_searchHint" class="dontShow"></span>

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                </div>

            </div>
        </div>

        <div class="labPage dontShow" id="labPage_members">
            <!--PAGE HEADERS -->
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">Members</span> <span class="fa fa-users myDarkBlue"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        Welcome to the members page. <br/>
                        Here you can can view member profiles, and communicate with labmates.
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->

            <div class="viewMain row">

                <div class="membersWrapper col-12">

                </div>

            </div>
        </div>

        <div class="labPage dontShow" id="labPage_calendar">
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">Calendar</span> <span class="fa fa-calendar myYellow"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        <select id="cal_calendars" class="large">

                            <optgroup label="General">
                            <option>Public Calendar</option>
                            </optgroup>

                            <optgroup label="Equipment">
                            <option>PCR Machine 1</option>
                            <option>PCR Machine 2</option>
                            <option>PCR Machine 3</option>
                            <option>AKTA</option>
                            </optgroup>
                        </select>
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->
            <div class="viewMain row">
                <div class="calendar">

                    <div class="backShader">

                    </div>

                    <div id="cal_eventDetailsPopup" class="eventDetailsPopup pup">
                        <div class="popupHeader">
                            <span class="titleText white" id="cal_evdTitle"></span>
                        </div>
                        <div class="evdWrapper">
                        <span class="headerText" id="cal_evdTime"></span><br/>
                        <span class="regText" id="cal_evdDesc"></span>
                        </div>
                    </div>

                    <div class="eventPopup pup">
                            <span class="headerText">New Event</span><br/>
                            <input class="ipt" type="text" id="cal_eventName" placeholder="Event Name" /><br/>
                            <input class="ipt" type="text" id="cal_eventTime" placeholder="Time of Day" /><br/>
                            <textarea id="cal_eventDetails" placeholder="Event Details"></textarea><br/>
                            <select id="cal_eventColor">
                                <option value="calBlue" style="background-color: #7db8ff" selected>Blue</option>
                                <option value="calRed" style="background-color: #b60000">Red</option>
                                <option value="calPurple" style="background-color: #f869ff">Purple</option>
                                <option value="calGreen" style="background-color: #65ff5f">Green</option>
                                <option value="calYellow" style="background-color: #ffd368">Yellow</option>
                            </select>
                            <select id="cal_eventSymbol">
                                <option class="symbols" value="none" selected>No Symbol</option>
                                <option class="symbols" value="warning">&#xf071;</option>
                                <option class="symbols" value="exclamation">&#xf12a;</option>
                                <option class="symbols" value="meeting">&#xf0c0;</option>
                                <option class="symbols" value="celebration">&#xf1fd;</option>
                            </select>
                            <input type="submit" id="cal_eventSubmit" class="btn_w" value="Add" /> <span class="fa fa-warning fa-fw cal_eventSubmitHint dontShow"></span><span class="regText cal_EventSubmitHint dontShow">Please fill in both fields.</span>
                        </div>

                    <div class="calendarTitle">
                        <div class="titleWrapper row">
                            <div class="col-2 ta_right"><span class="prevMonth fa fa-chevron-circle-left fa-2x fa-fw calControl"></span></div>
                            <div class="col-8 ta_center"><div class="titleMMYYYY"></div></div>
                            <div class="col-2 ta_left"><span class="nextMonth fa fa-chevron-circle-right fa-2x  fa-fw calControl"></span></div>
                        </div>

                    </div>

                    <div class="row week">
                        <div class="day-1 calHeader">
                            Sunday
                        </div>
                        <div class="day-1 calHeader">
                            Monday
                        </div>
                        <div class="day-1 calHeader">
                            Tuesday
                        </div>
                        <div class="day-1 calHeader">
                            Wednesday
                        </div>
                        <div class="day-1 calHeader">
                            Thursday
                        </div>
                        <div class="day-1 calHeader">
                            Friday
                        </div>
                        <div class="day-1 calHeader">
                            Saturday
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="labPage dontShow" id="labPage_forums">
            Forums
        </div>

        <div class="labPage dontShow" id="labPage_chat">
            Chat
        </div>

        <div class="labPage dontShow" id="labPage_administration">
            <!--PAGE HEADERS -->
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">Administration</span> <span class="fa fa-lock myRose"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        Welcome to the FMAX Administration page. <br/>
                        See the "Help" panel on the right for information about this page.
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->
            <div class="viewMain row">
                <div class="col-8">

                    <div class="genericPanel">

                            <div id="admin_orderDiv">


                            </div>
                            <div id="#admin_membersDiv">


                            </div>

                    </div>

                </div>

                <div class="col-4 leftBorder bottomBorder whiteBg">

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-link fa-fw myBlue"></span> <span class="regTextPanelA">Generate Registration Link</span></div>
                        <div class="collapseContent">
                            <span class="regText">In order to restrict unauthorized access to the lab website/database information, a new, unique registration link must be generated for each new member.
                                                    To begin generating a link so that a new member can join, click the square 'lightning' button below to generate a unique key.
                                                    Once a key has been generated, click "Authorize Key". This will generate a registration link in the read-only field below which you can copy and
                                                    send to the new member.
                            </span>
                            <br/>

                            <input class="ipt" type="text" id="admin_saltField" readonly><input type="submit" class="btn_sq" value="&#xf0e7;" id="admin_generateSalt"/> <input type="submit" class="btn_w" value="Authorize Key" id="admin_authorizeKey">
                            <br/>
                            <span class="regText">Registration Link: (Valid for 1 day)</span><br/>
                            <input class="ipt" type="text" id="admin_regLink" class="maxLength" readonly />

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down fa-fw myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-users fa-fw myBlue"></span> <span class="regTextPanelA">Add Lab Meetings</span></div>
                        <div class="collapseContent">

                        <input class="ipt" type="text" id="admin_lmDate" placeholder="&#xf073; Click to set date" /><br/>
                        <input class="ipt" type="text" class="longInput" id="admin_lmRoom" placeholder="&#xf140; Meeting room" /><br/>
                        <input class="ipt" type="text" class="longInput" id="admin_lmTime" placeholder="&#xf017; Meeting time" /><br/>
                        <input class="ipt longInput" type="text" id="admin_lmContent" placeholder="&#xf1d8; Meeting content (Optional)" /><br/>
                        <input type="submit" class="btn_w" id="admin_lmSubmit" value="&#xf067; Add Meeting" />
                        <span class="fa fa-check myGreen" id="admin_lmHint" style="display: none;"></span>

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down fa-fw myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-archive fa-fw myBlue"></span> <span class="regTextPanelA">Archive Search</span></div>
                        <div class="collapseContent">



                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down fa-fw myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-question-circle fa-fw myBlue"></span> <span class="regTextPanelA">Help</span></div>
                        <div class="collapseContent">
                            <span class="regText">The administration page allows you to do the following:</span><br/><br/>
                            <span class="regText">1. Generate registration links for new members</span><br/>
                            <span class="regText">2. Approve and deny orders from lab members</span><br/>
                            <span class="regText">3. Edit member details, and change their public visibility</span><br/>
                            <span class="regText">4. Set lab meeting dates</span><br/>
                            <span class="regText">5. Search and view lab notebooks</span><br/><br/>

                            <span class="headerText">Generating Registration Links</span><br/>
                            <span class="regText">To generate, a link, start by clicking the "Generate Registration Link" panel head on the right hand side of the page.
                                                    Simply follow the instructions outlined in the panel to create a link, and send it to the new member.
                                                    FMAX uses secure registration links to prevent attackers and random users from 'joining' the lab. This limits the number of people that have direct
                                                    access to the database.</span><br/><br/>

                            <span class="headerText">Approving and Denying Orders</span><br/>
                            <span class="regText">Orders from lab members can be seen on the left hand side of this page.
                                                    Order information is shown in the "Order Information" column, and details of the order are to the right of that.
                                                    To approve an order, click the 'credit card' button:</span><br/>
                            <input type="submit" class="btn_sq" value="&#xf09d;" /><br/>
                            <span class="regText">Marking an order as 'ordered' will change the status of the order on the dashboard to 'approved'. Once the shipment is delivered to the lab, the user who accepts it will click the 'received'
                                                    button on the dashboard, and indicate where they stored it. This will then be automatically entered into your storage inventory.
                                                    To deny an order, and remove it from the queue, click the 'trash can' button:</span>
                            <input type="submit" class="btn_sq red" value="&#xf1f8;" /><br/>
                            <span class="regText">Finally, to archive an order (hide it from your 'to-do' list without deleting it's record, use the 'archive button' shown below. You can search your archive at any time in the 'Archive Search' panel below.</span><br/>
                            <input type="submit" class="btn_sq purple" value="&#xf187;" /><br/><br/>
                            <span class="headerText">Editing and Removing Members</span><br/>
                            <span class="regText">The members table can be found underneath the orders table. Here, you can simple double-click to edit any field of a member profile.
                                                    If, say, the member is a collaborator, and you with not to display their information on your public lab page, you can simply change their visibility
                                                    to 'hidden' using the checkbox.</span><br/><br/>
                            <span class="headerText">Lab Meetings</span><br/>
                            <span class="regText">Lab meeting dates can be set using the "Lab Meetings" panel on the right hand side of this page. Simply open it and enter the meeting information.</span><br/><br/>
                            <span class="headerText">Viewing lab notebooks</span><br/>
                            <span class="regText">Pending.</span>
                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down fa-fw myBlue"></span></div>
                    </div>

                </div>

            </div>
        </div>

        <div class="labPage dontShow" id="labPage_account">
            <!--PAGE HEADERS -->
            <div class="viewHeader row">

                <div class="col-2">
                    <span class="titleText">My Account</span> <span class="fa fa-user myBlue"></span>
                    <br/>
                    <span class="regTextHint">$labname</span><br/>
                    <span class="regTextHint">$date_official</span>
                </div>

                <div class="col-6">
                    <span class="regText hint">
                        Welcome to your account. <br/>
                        Here you can edit your account information including your profile picture, password, full display name, e-mail, biography/interests, Scopus author ID, LinkedIn information and whether or not you would like your information to be displayed publically.
                    </span>
                </div>

                <div class="col-2">

                </div>


                <div class="col-2">

                </div>

            </div>

            <!-- PAGE VIEWS -->
            <div class="viewMain row">
                <div class="col-8">
                    <table class="memberTable">
                        <thead class="tableCollapse">
                        <tr>
                            <td id="acc_prev_member_thead" colspan="4"></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="ta_center">
                                <img id="acc_memberPhoto" class="profilePicture" src="img/headshot_placeholder.png" />
                            </td>
                            <td id="acc_memberInfo">
                                <span class="headerText" id="acc_prev_name"></span><br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" id="acc_prev_bio"></td>
                        </tr>
                        <tr>
                            <td colspan="4" id="acc_prev_contact">
                                <span class="fa fa-envelope myOrange"></span>
                                <span id="acc_prev_email"></span>
                                <br/>
                                <span class="fa fa-linkedin-square myDarkBlue"></span>
                                <span><a id="acc_prev_linkedIn" href="#">LinkedIn</a></span>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>

                <div class="col-4 leftBorder bottomBorder whiteBg">

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-photo fa-fw myBlue"></span> <span class="regTextPanelA">Profile Picture</span></div>
                        <div class="collapseContent">

                        <form id="acc_profilePictureUpload" class="dropzone fileUploadBox" enctype="multipart/form-data" action="upload_profile_picture_account.php">
                                </form>

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-user fa-fw myBlue"></span> <span class="regTextPanelA">Edit Profile</span></div>
                        <div class="collapseContent">

                            <input class="ipt" type="text" id="acc_edit_fullName" placeholder="My Full Name"/><br/>
                            <input class="ipt" type="text" id="acc_edit_email" placeholder="My email"/><br/>
                            <input class="ipt" type="text" id="acc_edit_degree" placeholder="My degrees"/><br/>
                            <input class="ipt" type="text" id="acc_edit_scopus" placeholder="Scopus Author ID"/><br/>
                            <input class="ipt" type="text" id="acc_edit_linkedin" placeholder="LinkedIn URL"/><br/>

                            <textarea id="acc_edit_bio" placeholder="Biography & Interests"></textarea><br/>

                            <input type="checkbox" class="checkBox" id="acc_edit_visibility" />
                            <label class="regText" for="acc_edit_visibility">Hide Public Profile</label>

                            <br/>
                            <input type="submit" class="btn_w" id="acc_updateInfo" value="Save"/> <span class="fa fa-check dontShow myGreen" id="acc_editHint"></span>


                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-unlock-alt fa-fw myBlue"></span> <span class="regTextPanelA">Change Password</span></div>
                        <div class="collapseContent">

                            <input type="password" id="acc_edit_pass_current" placeholder="Current Password"/><br/>
                            <input type="password" id="acc_edit_pass_new" placeholder="New Password"/><br/>
                            <input type="password" id="acc_edit_pass_new_2" placeholder="Confirm New Password"/><br/>

                            <input type="submit" class="btn_w" id="acc_updatePassword" value="Save"/> <span class="regText dontShow myGreen" id="acc_passHint"></span>

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-pie-chart fa-fw myBlue"></span> <span class="regTextPanelA">Scopus Data</span></div>
                        <div class="collapseContent">

                            <span class="regText">Coming in later versions.</span>

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down myBlue"></span></div>
                    </div>

                    <div class="collapsePanel">
                        <div class="collapseHeader"><span class="fa fa-code-fork fa-fw myBlue"></span> <span class="regTextPanelA">IP Address Validation</span></div>
                        <div class="collapseContent">
                            <input type="checkbox" id="acc_toggleValidation" /> <span class="regText">Use IP Validation for $username?</span><br/><br/>
                            <span class="regText myRose">Current IP Address:</span><br/>
                            <input class="ipt" type="text" id="acc_currentIp" class="longInput" value="$usr_ip" /><br/>
                            <input class="ipt" type="text" id="acc_ipNick" class="longInput" placeholder="Nickname this location" /><br/>
                            <input type="submit" class="btn_w" value="Validate IP" id="acc_ipVal" /> <span class="regText" id="ipHint" style="display: none;"></span><br/><br/>
                            <span class="regText">List of Authorized Connection Points for $username:</span><br/>
                            <table class="tableGeneric" id="acc_ipList">

                            <tr>
                                <td>Location</td>
                                <td>IP</td>
                                <td>Delete</td>
                            </tr>

                            </table>

                        </div>
                        <div class="collapseFooter"><span class="fa fa-angle-double-down fa-fw myBlue"></span></div>
                    </div>

                </div>

            </div>
        </div>

        <div class="labPage dontShow" id="labPage_pubMods">
            Public Modules
        </div>

</div>


<div id="footer">



</div>

</body>
</html>

_END;

}
else
{
    echo<<<_END

    Make the user an administrator, then login again.

_END;
}