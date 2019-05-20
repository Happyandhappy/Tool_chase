var csv_data=[];
var dataTable ;
var countA, countB, currentNum, notified;

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

    var initCSVTable = function(_data){
        var data = [];

        for (i = 0; i < _data.length; i++){
            data.push([i, _data[i].LastName, _data[i].FirstName, _data[i].PrimaryPhone, _data[i].Address, _data[i].City, _data[i].State, _data[i].ZipCode ])
        }

        dataTable.clear();
        dataTable.rows.add(data);
        dataTable.draw();
    }

    var initSettingTable = function(_data){
        var i, html = "";
        html += "<tr>";
        html += "<td>A</td>";
        html += "<td>" + _data['GroupId_A'] + "</td>";
        html += "<td>" + _data['SecurityCode_A'] + "</td>";
        html += "<td>" + _data['Campaign_A'] + "</td>";
        html += "<td>" + _data['Subcampaign_A'] + "</td>";
        html += "<td>" + _data['Rate_A'] + "</td>";
        html += "</tr>";

        html += "<tr>";
        html += "<td>B</td>";
        html += "<td>" + _data['GroupId_B'] + "</td>";
        html += "<td>" + _data['SecurityCode_B'] + "</td>";
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
            csv_data.shift();
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

        dataTable = $('.dataTable').DataTable({
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

    // While there remain elements to shuffle...
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

function FuncUnit(type){
    console.log(type);
    if ( type === 'A' && countA > 0)        countA--;
    else if( type === 'B' && countB > 0)    countB--;
    else {
        if (countA ===0 && countB===0 && notified === false){
            notified = true;
            $('.page-loader').css('display', 'none');
            showNotification('alert-success', 'Successfully all leads Importted.', "top", "center", "", "animated fadeOutRight");
        }        
        return;
    }

    row = csv_data[currentNum++];
    row['action']       = 'import';
    row['GroupId']      = $('input[name=GroupId_'       + type + ']').val();
    row['SecurityCode'] = $('input[name=SecurityCode_'  + type + ']').val();
    row['Campaign']     = $('input[name=Campaign_'      + type + ']').val();
    row['Subcampaign']  = $('input[name=Subcampaign_'   + type + ']').val();


    var formData = new FormData();
    for(p in row) {
        formData.append(p, row[p]);
    }
    
    $.ajax({
        url : 'Controller.php',
        method  : 'POST',
        data    : formData,
        success : function(res){
            setTimeout(function(){
                FuncUnit(type);
            }, getRandomInt*2000); 
        },
        processData: false,
        contentType: false,
    });    
}


$(function(){
    App.init();
    $('#import_button').click(function(){
        notified = false;
        csv_data = shuffle(csv_data);
        countA = Math.floor(csv_data.length * $('input[name=Rate_A]').val()/100);
        countB = csv_data.length - countA;
        currentNum = 0;
        $('.page-loader').css('display', 'block');
        FuncUnit('A');
        FuncUnit('B');
    });
});