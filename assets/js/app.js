var csv_data_A=[], csv_data_B = [], csv_data = [];
var dataTable ;
var countA, countB, notified_A, notified_B, notified;
var Unit = 500;

function AjaxRequest(data){
    return new Promise((resolve, reject) => {
       $.ajax({
            url : 'Controller.php',
            method : 'POST',
            data : data,
            success :  function(res){
                resolve(res);
            },
            error: function(err){
                reject();
            },
            processData: false,
            contentType: false,
       });
    });
}

function getRandomInt() {
    return Math.random();
}

var App = function(){
    var dataTable;

    var initTableHeader= function(arr){
        dataTable.clear();
        dataTable.destroy();
        var html = "<tr><th>#</th>";
        for (var i = 0 ;  i < arr.length ; i++){
            html += "<th>" + arr[i] + "</th>";
        }
        $('#dataTable thead').html(html);

        dataTable = $('#dataTable').DataTable({
            responsive: true,
        });
    }

    var initCSVTable = function(_data){
        var data = [];
        var array_keys= [], array_values= [];

        for (i = 0; i < _data.length; i++){
            array_keys= [];
            array_values = [i+1];
            for (var key in _data[i]) {
                array_keys.push(key);
                array_values.push(_data[i][key]);
            }
            data.push(array_values);
        }
        initTableHeader(array_keys);

        dataTable.clear();
        dataTable.rows.add(data);
        dataTable.draw();
    }

    var initSettingTable = function(_data){
        var i, html = "";
        html += "<tr>";
        html += "<td>BT07.chasedatacorp.com</td>";
        // html += "<td>" + _data['GroupId_A'] + "</td>";
        // html += "<td>" + _data['SecurityCode_A'] + "</td>";
        html += "<td>" + _data['Campaign_A'] + "</td>";
        html += "<td>" + _data['Subcampaign_A'] + "</td>";
        html += "<td>" + _data['Rate_A'] + "</td>";
        html += "</tr>";

        html += "<tr>";
        html += "<td>BT15.chasedatacorp.com</td>";
        // html += "<td>" + _data['GroupId_B'] + "</td>";
        // html += "<td>" + _data['SecurityCode_B'] + "</td>";
        html += "<td>" + _data['Campaign_B'] + "</td>";
        html += "<td>" + _data['Subcampaign_B'] + "</td>";
        html += "<td>" + _data['Rate_B'] + "</td>";
        html += "</tr>";

        $('#settingsTable tbody').html(html);
    }

    var uploadRequest = async function(){
        var dt = $('#file_upload').serializeArray();
        var formData = new FormData();
        for (var i = 0 ; i < dt.length ; i++){
            formData.append(dt[i].name, dt[i].value);
        }
        
        if (document.getElementById('file'))
            if (document.getElementById('file').files.length > 0)
                formData.append("file", document.getElementById('file').files[0]);
        showSpinner('uploading_spinner');

        var res = await AjaxRequest(formData);
        var data = JSON.parse(res);
        if (data.status === 'success'){
            csv_data = data.data;            
            // csv_data.shift();
            initCSVTable(csv_data, dataTable);
            hideSpinner('uploading_spinner');
            showNotification('alert-success', 'Successfully Uploaded.', "top", "center", "", "animated fadeOutRight");
        }else{
            hideSpinner('uploading_spinner');
            showNotification('alert-danger', data.message, "top", "center", "", "animated fadeOutRight");
        }
    }


    var settingsRequest = async function(){
        var dt = $('#settingsForm').serializeArray();
        var formData = new FormData();
        for (var i = 0 ; i < dt.length ; i++){
            formData.append(dt[i].name, dt[i].value);
        }
        showSpinner('setting_spinner');

        var res = await AjaxRequest(formData);
        var data = JSON.parse(res);
        if (data.status === 'success'){
            showNotification('alert-success', 'Successfully Submitted.', "top", "center", "", "animated fadeOutRight");
            initSettingTable(data.data);
            hideSpinner('setting_spinner');
            $('#settingModal').modal('hide');
        }else{
            hideSpinner('setting_spinner');
            showNotification('alert-danger', data.message, "top", "center", "", "animated fadeOutRight");            
            /*alert(data.message);*/
        }
    }


    var initialize = function(){
        $('#cred_sec').removeClass('hidden');

        $('#file_upload').validate({
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler:function(form){
                try{
                    uploadRequest();
                }catch(err){

                }
                return false;
            }
        });

        dataTable = $('#dataTable').DataTable({
            responsive: true,
        });

        $('.settings').on('click', function () {
            $('#settingModal').modal('show');
        });


        $('#settingsForm').validate({
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler:function(form){
                try{
                    settingsRequest();
                }catch(err){

                }
                return false;
            }
        });
    }

    return {
        // Public functions
        init: function() {
            // init
            initialize();
        },
    };
}();

function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }
  return array;
}

// Import lead to Campagin A
function FuncUnitA(from, to){
    console.log(from + ":" + to);
    var i, formDt = [];
    
    for ( i = from ; i < to; i++){
        row = csv_data_A[i];
        row['type']         = 'A';
        row['Campaign']     = $('input[name=Campaign_A]').val();
        row['Subcampaign']  = $('input[name=Subcampaign_A]').val();
        formDt.push(row);
    }

    
    $.ajax({
        url : 'Controller.php',
        method  : 'POST',
        data    : { action : 'import', data: JSON.stringify(formDt)},
        success : function(res){


            // importing Campagin A
            if (countA === 0) notified_A = true;
            else if (countA > Unit){
                countA = countA - Unit;
                FuncUnitA(to, to + Unit);
            }else{
                end = to + countA;
                countA = 0;
                FuncUnitA(to, end);
            }

            if (notified_A && notified_B && !notified){
                notified = true;
                $('.page-loader').css('display', 'none');
                showNotification('alert-success', 'Successfully all leads Importted.', "top", "center", "", "animated fadeOutRight");
            }
            console.log(res);
        },
        error: function(err){
            $('.page-loader').css('display', 'none');
            showNotification('alert-danger', err, "top", "center", "", "animated fadeOutRight");
            console.log(err);
        }
    });
}

// Import lead to Campagin B
function FuncUnitB( from, to){
    console.log(from + ":" + to);
    var i, formDt = [];

    for ( i = from ; i < to; i++){
        row = csv_data_B[i];
        row['type']         = 'B';
        row['Campaign']     = $('input[name=Campaign_B]').val();
        row['Subcampaign']  = $('input[name=Subcampaign_B]').val();
        formDt.push(row);
    }

    
    $.ajax({
        url : 'Controller.php',
        method  : 'POST',
        data    : { action : 'import', data: JSON.stringify(formDt)},
        success : function(res){


            // importing Campagin B
            if (countB === 0) notified_B = true;
            else if (countB > Unit){
                countB = countB - Unit;
                FuncUnitB(to, to + Unit);
            }else{
                end = to + countB;
                countB = 0;
                FuncUnitB(to, end);
            }

            if (notified_A && notified_B && !notified){
                $('.page-loader').css('display', 'none');
                showNotification('alert-success', 'Successfully all leads Importted.', "top", "center", "", "animated fadeOutRight");
            }
            console.log(res);
        },
        error: function(err){
            $('.page-loader').css('display', 'none');
            showNotification('alert-danger', err, "top", "center", "", "animated fadeOutRight");
            console.log(err);
        }
    });
}


$(function(){
    App.init();
    $('#import_button').click(function(){
        notified = false, notified_B = false, notified_A = false;

        if (csv_data.length === 0) {
            showNotification('alert-danger', "Please import file first.", "top", "center", "", "animated fadeOutRight");
            return;
        }

        // prepare array data and split it to 2 arrays for A and B
        csv_data = shuffle(csv_data);
        countA = Math.floor(csv_data.length * $('input[name=Rate_A]').val()/100);
        csv_dt = [];
        csv_data.forEach(function(value){
            csv_dt.push(value);
        });
        countB = csv_dt.length - countA;
        csv_data_A = csv_dt.splice(countB);
        csv_data_B = csv_dt;        

        $('.page-loader').css('display', 'block');


        // Start importing Campagin A
        if (countA > Unit){
            countA = countA - Unit;
            FuncUnitA(0, Unit);
        }else{
            countA = 0;
            FuncUnitA(0, csv_data_A.length);
        }


        // Start importing Campagin A
        if (countB > Unit){
            countB = countB - Unit;
            FuncUnitB(0, Unit);
        }else{
            countB = 0;
            FuncUnitB(0, csv_data_B.length);
        }
    });


    $('.percentage').change(function(){
        var val, name = $(this).attr('name');
        val = $(this).val();

        if (name === 'Rate_A'){
            $('input[name=Rate_B]').val( 100 - val );
        }else{
            $('input[name=Rate_A]').val( 100 - val );
        }        
    });


    setInputFilter(document.getElementById("Rate_A"), function(value) {
        return /^\d*$/.test(value) && (value === "" || (parseInt(value) <= 100 && parseInt(value) > -1));
    });

    setInputFilter(document.getElementById("Rate_B"), function(value) {
        return /^\d*$/.test(value) && (value === "" || (parseInt(value) <= 100 && parseInt(value) > -1));
    });
});