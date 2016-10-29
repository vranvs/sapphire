$( document ).ready(function() {

    //lab meeting panel
    var labMeetingsTable = $("#dash_labMeetingsTable");

    //announcement cache
    var postTable = $("#dash_postTables");
    var postContent = $("#dash_announce");
    var postSubmit = $("#dash_post");
    var postGlobal = $("#dash_globalPost");
    var announceHint = $("#dash_announceHint");

    //order cache
    var orderTable = $("#dash_orderPanel");
    var receivedPopup = $("#dash_orderReceivedPopup");
    var backShader = $(".backShader");
    var orderAcd = $("#dash_order_acd");
    var acdCache = [];

    //form
    var recCabinet = $("#dash_order_rec_cabinet");
    var recRack = $("#dash_order_rec_rack");
    var recBox = $("#dash_order_rec_box");
    var recCoords = $("#dash_order_rec_coords");
    var recSubmit = $("#dash_order_rec_accept");
    var idOfOrder;
    var nameOfOrder;

    //bug report cache
    var bugReport = $("#dash_bugReport");
    var submitBug = $("#dash_bugSubmit");
    var bugHint = $("#dash_bugHint");

    //order request form cache
    var orderItem = $("#dash_orderItem");
    var orderQuantity = $("#dash_orderQuantity");
    var orderSupplier = $("#dash_orderSupplier");
    var orderProductNumber = $("#dash_orderProductNumber");
    var orderLink = $("#dash_orderLink");
    var orderPrice = $("#dash_orderPrice");
    var orderUrgency = $("#dash_orderUrgency");
    var orderNotes = $("#dash_orderNotes");
    var orderSubmit = $("#dash_orderSubmit");
    var orderHint = $("#dash_orderHint");

    //points data
    var labPointData = [];
    var labPointLabels = [];

    //refresh info
    var refreshDisplay = $("#dash_refreshDisplay");
    var refreshCounter = 300;

    //current event cache
    var currentEvents = $("#dash_todaysEvents");

    RefreshDash();

    setInterval(function(){

        refreshCounter--;
        refreshDisplay.html(refreshCounter);

        if(refreshCounter == 0){
            refreshCounter = 300;

            RefreshDash();
        }
        else{

        }
    }, 1000);

    //dash refresh
    $(document).on('click', '.pnlNavBtn', function(){
        if($(this).data('value') == 0){
            RefreshDash();
        }

    });

    $(document).on('click', '.commentPaneHeader', function(){

        $(this).next('td').html('Collapse comment pane &#xf139;');
        $(this).next('.commentPane').toggle();

    });

    $(document).on('click', '.dash_submitComment', function(){

        var post_id = $(this).data('id');
        var content = $(this).siblings('.rtf').summernote('code');

        console.log(post_id);
        console.log(content);

        $.ajax({
            //dataType: "json",
            type: 'POST',
            data: {
                com_sub_req: true,
                post_id: post_id,
                content: content
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {
                console.log(data);
                AddPoints();
                RefreshDash();
            }

        });

    });

    orderSubmit.on('click', function(){

        var item = orderItem.val();
        var quant = orderQuantity.val();
        var supp = orderSupplier.val();
        var code = orderProductNumber.val();
        var price = orderPrice.val();
        var link = orderLink.val();
        var urg  = orderUrgency.val();
        var note = orderNotes.val();

        $.ajax({
            dataType: "text",
            type: 'POST',
            data: {
                dash_order_sub_req: true,
                item: item,
                quant: quant,
                supplier: supp,
                number: code,
                link: link,
                urgency: urg,
                notes: note,
                price: price
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                console.log(data);

                orderItem.val("");
                orderQuantity.val("")
                orderSupplier.val("");
                orderProductNumber.val("");
                orderPrice.val("");
                orderLink.val("");
                orderUrgency.val("");
                orderNotes.val("");
                orderHint.fadeIn(500).delay(2000).fadeOut(500);
                RefreshDash();
                AddPoints();

            }

        });

    });

    postSubmit.on('click', function(){
        SubmitPost();
    });

    $( document ).on('click', '.btn_orderReceived', function(){

        if($(this).data('disabled') == 1){
            return;
        }

        idOfOrder = ($(this).data('value'));
        nameOfOrder = ($(this).data('item'));

        receivedPopup.fadeIn();
        backShader.fadeIn();

    });

    $(document).keyup(function(e){

        orderAcd.show();

        if(orderItem.is(":focus")){
            var query = orderItem.val();
            if(query.length > 2){
                OrderFetch(query);
            }
        }

    });

    $(document).on('click', '.acdiv', function(){

        console.log("clicked");

        var t = $(this).data('id');

        orderItem.val(acdCache[t][0]);
        orderSupplier.val(acdCache[t][1]);
        orderLink.val(acdCache[t][2]);
        orderProductNumber.val(acdCache[t][3]);
        orderPrice.val(acdCache[t][4]);

        orderAcd.hide();

    });

    /*orderItem.on('blur', function(){
        orderAcd.hide();
    });*/

    recSubmit.on('click', function(){
        ReceiveOrder(idOfOrder, nameOfOrder);
    });


    function RefreshDash(){

        $(".gen").remove();

        RefreshPosts();
        RefreshLabMeetings();
        RefreshOrders();
        RefreshPoints();
        RefreshCurrentEvents();
    }

    function RefreshPosts(){

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                dash_post_ref: true
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                for(var i = 0; i < data.length; i++){

                    var comment_block = "";

                    for(var n = 0; n < data[i].comments.length; n++){

                        var qa = data[i].comments[n];

                        comment_block += (
                                "<tr class='commentRow'>" +
                                    "<td></td>" +
                                    "<td>" + "<img class=\"commentAvatarThumb\" src=\"img/avatars/" + qa.author + ".png\" /></td>" +
                                    "<td colspan='1'><i>" + qa.author + " on " + qa.date + " at " + qa.time + "</i><br/>" + qa.content + "</td>" +
                                "</tr>"
                        );

                    }

                    postTable.append(

                        "<div class='postContainer gen'>" +
                        "<table data-id=\"" + data[i].id + "\" class='postTable gen'>" +

                        "<tr class=\"postRow\">" +

                        "<td>" + "<img src=\"" + data[i].avatar + "\" class=\"postAvatarThumb\" />" + "</td>" +
                        "<td colspan='2'>" +  data[i].date + " at " + data[i].time + "<br/><b>" + data[i].author + "</b>: " + data[i].content + "</td>" +

                        "</tr>" +

                        "</table>" +

                        "<table class='commentTable'>" +

                            comment_block +

                        "</table>" +

                        "<table class='addCommentTable'>" +
                        "<tr class='commentPaneHeader'><td>Click to comment &#xf13a;</td></tr>" +
                        "<tr class='commentPane dontShow'>" +

                            "<td><textarea class='rtf'></textarea><input type='submit' class='btn_w dash_submitComment' value='Comment' data-id=\"" + data[i].id + "\"></td>" +

                        "</tr>" +
                        "</table>" +
                        "</div>"
                    );

                }

                $(".rtf").summernote();

            }

        });
    }
    function RefreshLabMeetings(){

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                lm_ref_req: true
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                for(var i = 0; i < data.length; i++){

                    labMeetingsTable.append(

                        "<tr class=\"gen meetingsRow\">" +

                        "<td>" + data[i].date + "</td>" +
                        "<td>" + data[i].room + "</td>" +
                        "<td>" + data[i].time + "</td>" +
                        "<td>" + data[i].subject + "</td>" +

                        "</tr>"

                    );


                }
            }

        });

    }
    function RefreshOrders(){

        $(".genOrder").remove();

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                dash_ord_ref_req: true
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                for(var i = 0; i < data.length; i++){

                    var button;
                    if(data[i].approved == 0){
                        button = "<input type=\"submit\" data-value=\"" + data[i].id + "\" data-item=\"" + data[i].name + "\" data-disabled=\"1\" class=\"btn_sq_dis btn_orderReceived\" value=\"&#xf141;\" />"
                    }else{
                        button = "<input type=\"submit\" data-value=\"" + data[i].id + "\" data-item=\"" + data[i].name + "\" class=\"btn_sq btn_orderReceived\" value=\"&#xf25a;\" />"
                    }

                    var urgency;
                    if(data[i].urg == "Urgent"){
                        urgency = "orderUrgent"
                    }else{
                        urgency = ""
                    }

                    orderTable.append(

                                "<table class=\"gen orderGen orderTable " + urgency + "\" >" +
                                    "<thead>" +
                                    "<tr>" +
                                        "<td><b>" + data[i].name + " (" + data[i].id + ")" + "</b></td>" +
                                        "<td rowspan=\"2\">" + button + "</td>" +
                                    "</tr>" +
                                        "</thead>" +
                                        "<tbody>" +
                                    "<tr>" +
                                        "<td>" + data[i].supplier + ": " + data[i].code + "</td>" +
                                        "<td>SUPPLIER, CAT#</td>" +
                                    "</tr>" +
                                    "<tr>" +
                                        "<td>" + data[i].urg + "</td>" +
                                        "<td>URGENCY</td>" +
                                    "</tr>" +
                                    "<tr>" +
                                        "<td>" + data[i].price + "</td>" +
                                        "<td>PRICE</td>" +
                                    "</tr>" +
                                    "<tr>" +
                                        "<td>" + data[i].by + "</td>" +
                                        "<td>ORDERED BY</td>" +
                                    "</tr>" +
                                    "<tr>" +
                                        "<td><a href=\"" + data[i].link + "\">" + data[i].link + "</a></td>" +
                                        "<td><a href=\"" + data[i].link + "\">PRODUCT LINK</a></td>" +
                                    "</tr>" +
                                    "<tr>" +
                                        "<td>" + data[i].quantity + "</td>" +
                                        "<td>QUANT/SIZE</td>" +
                                    "</tr>" +
                                    "<tr>" +
                                        "<td>" + data[i].time + "</td>" +
                                        "<td>DATE</td>" +
                                    "</tr>" +

                                    "<tr>" +
                                        "<td colspan='2'><b>Notes from " + data[i].by + ":</b><br/><mark>" + data[i].comments + "</mark></td>" +
                                    "</tr>" +
                                    "<tr>" +
                                        "<td colspan='2'><b>Notes from Lab Technician:</b><br/><mark>" + data[i].tech + "</mark></td>" +
                                    "</tr>" +
                                        "</tbody>" +

                                "</table>"

                    );

                }

            }

        });

    }
    function RefreshPoints(){

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                lp_get_points: true
            },
            url: 'lab_points.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                labPointData = [];
                labPointLabels = [];

                for(var i = 0; i < data.length; i++){

                    labPointData.push(data[i].points);
                    labPointLabels.push(data[i].username);

                }

                var barChartData = {
                    labels: labPointLabels,
                    datasets: [{
                        label: 'Lab Points',
                        backgroundColor: "rgba(37, 206, 18, 0.75)",
                        data: labPointData
                    }]

                };

                var ctx = document.getElementById("canvas").getContext("2d");
                var barChart = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                    }
                });

                barChart.update();
            }

        });

    }
    function RefreshCurrentEvents(){

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                dash_today_event_req: true
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                $(".todayEvGen").remove();

                    for (var i = 0; i < data.length; i++) {

                        var symbol = "";

                        switch(data[i].symbol){
                            case "none":
                                break;
                            case "warning":
                                symbol = "<span class=\"fa fa-fw fa-lg fa-warning\"></span>";
                                break;
                            case "exclamation":
                                symbol = "<span class=\"fa fa-fw fa-lg fa-exclamation\"></span>";
                                break;
                            case "meeting":
                                symbol = "<span class=\"fa fa-fw fa-lg fa-users\"></span>";
                                break;
                            case "celebration":
                                symbol = "<span class=\"fa fa-fw fa-lg fa-birthday-cake\"></span>";
                                break;

                        }

                        currentEvents.append(
                            "<div class=\"eventDiv todayEvGen eventText " + data[i].color + "\">" +
                            symbol +
                            "  " +
                            data[i].time +
                            ": " +
                            data[i].name +
                            "</div>"
                        );
                    }

            }

        });

    }

    function SubmitPost(){

        var content = postContent.summernote('code');
        var global = postGlobal.val();

        $.ajax({
            dataType: "text",
            type: 'POST',
            data: {
                dash_post_req: true,
                dash_post_content: content,
                dash_global: global
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                console.log(data);

                announceHint.fadeIn(500).delay(2000).fadeOut(500);
                postContent.summernote('reset');
                window.scrollTo(0,0);
                RefreshDash();
                AddPoints();

            }

        });



    }
    function ReceiveOrder(id, item){

        var cabinet = recCabinet.val();
        var rack = recRack.val();
        var box = recBox.val();
        var coords = recCoords.val();

        $.ajax({
            dataType: "text",
            type: 'POST',
            data: {
                dash_ord_rec: true,
                ord_id: id,
                ord_rec_item: item,
                ord_rec_cabinet: cabinet,
                ord_rec_rack: rack,
                ord_rec_box: box,
                ord_rec_coords: coords
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                receivedPopup.fadeOut();
                backShader.fadeOut();

                RefreshDash();
                AddPoints();

            }

        });

    }

    function OrderFetch(query){

        orderAcd.children().remove();
        orderAcd.html("<span class=\"fa fa-spin fa-gear fa-2x myGray\"></span>");

        $.ajax({
            dataType: "json",
            type: 'POST',
            data: {
                ord_ac_req: true,
                ord_ac_query: query
            },
            url: 'dash.php',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
            },
            success: function (data) {

                console.log(data);

                $(".acdiv").remove();

                if(data.length == 0){
                    orderAcd.children(".fa").remove();

                    orderAcd.append(

                    "<div class='ofinterest'>" + "No similar products found." + "</div>"

                    );
                    return;
                }

                acdCache = [];
                orderAcd.children(".fa").remove();

                for(var i = 0; i < data.length; i++){
                    acdCache.push([data[i].name, data[i].supplier, data[i].link, data[i].code, data[i].price]);
                    orderAcd.append(

                        "<div class='acdiv' data-id=\"" + i + "\">" + data[i].name + "</div>"

                    );


                }

            }

        });

    }




});

