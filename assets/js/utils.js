function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
    if (colorName === null || colorName === '') { colorName = 'bg-black'; }
    if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 1000,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
}

function showSpinner(id){
    $('#' + id).removeClass('hidden');
}

function hideSpinner(id){
    $('#' + id).addClass('hidden');
}


function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } 
          else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            // this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          }
        });
    });
}

/*function initCSVTable(_data, datatable){

    var data = [];

    for (i = 1; i < _data.length; i++){
        data.push([i, _data[i].LastName, _data[i].FirstName, _data[i].PrimaryPhone, _data[i].Address, _data[i].City, _data[i].State, _data[i].ZipCode ])
    }

    datatable.clear();
    datatable.rows.add(data);
    datatable.draw();
}*/

/*function initSettingTable(_data){
    var i, html = "";
    for (i = 1; i < _data.length; i++){
        html += "<tr>";
        html += "<td>A</td>";
        html += "<td>" + _data[i]['GroupId'] + "</td>";
        html += "<td>" + _data[i]['SecurityCode'] + "</td>";
        html += "<td>" + _data[i]['Campaign'] + "</td>";
        html += "<td>" + _data[i]['Subcampaign'] + "</td>";
        html += "<td>" + _data[i]['Rate'] + "</td>";
        html += "</tr>";
    }
    $('#settingsTable tbody').html(html);
}*/