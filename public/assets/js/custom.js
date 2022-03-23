/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/
$('.scrollTop').click(function() {
    $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
            a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
    tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
    })
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
    template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0)
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./))
    return 11;

  else
    return 0; //It is not IE
}

function getProduit(key, value) {

    const index = key.substring(9, 10);
    //console.log(key);
    //console.log(value);
    //console.log(index);

    const prodIdx = "produits["+ index +"][produit]";
    const poidIdx = "produits["+ index +"][poids]";
    const totaIdx = "produits["+ index +"][total]";

    const prodVal = $("select[name='"+ prodIdx +"']").val();
    const poidVal = $("input[name='"+ poidIdx +"']").val();

    $.ajax({
        type:"POST",
        url: "/produits/get_prix",
        data: {
            id: prodVal
        },
        dataType: 'json',
        success: function(res){

            const total = poidVal * res.montant;
            $("input[name='"+ totaIdx +"']").val(total);

            const nb=$('.repeater_item').length;
            let totalpoids = 0;
            let totalamm = 0;
            for(let i=0; i<nb; i++) {
                const npoidIdx = "produits["+ i +"][poids]";
                const ntotaIdx = "produits["+ i +"][total]";

                totalpoids += Number($("input[name='"+ npoidIdx +"']").val());
                totalamm += Number($("input[name='"+ ntotaIdx +"']").val());
            }
            console.log(totalamm);
            console.log(totalpoids);

            /*const totalpoids = Number($("#poidsA").val()) + Number($("#poidsB").val()) + Number($("#poidsC").val()) + Number($("#poidsD").val());
            const totalamm = Number(totalA) + Number(totalB) + Number(totalC) + Number(totalD) + Number(caf) + Number(cs);
            */
            $('#totalamm').val(totalamm);
            $('#totalpoids').val(totalpoids);
        }
    });
}

function getProduitOld() {
    valA = $("#prodA :selected").val();
    valB = $("#prodB :selected").val();
    valC = $("#prodC :selected").val();
    valD = $("#prodD :selected").val();

    $.ajax({
        type:"POST",
        url: "/produits/prix",
        data: {
            idA: valA,
            idB: valB,
            idC: valC,
            idD: valD,
        },
        dataType: 'json',
        success: function(res){
            console.log(res);
            const totalA = $("#poidsA").val() * res.montantA;
            const totalB = $("#poidsB").val() * res.montantB;
            const totalC = $("#poidsC").val() * res.montantC;
            const totalD = $("#poidsD").val() * res.montantD;

            $('#totalA').val(totalA);
            $('#totalB').val(totalB);
            $('#totalC').val(totalC);
            $('#totalD').val(totalD);

            const caf = $("#valeurcaf").val();

            const totalpoids = Number($("#poidsA").val()) + Number($("#poidsB").val()) + Number($("#poidsC").val()) + Number($("#poidsD").val());
            const totalamm = Number(totalA) + Number(totalB) + Number(totalC) + Number(totalD) + Number(caf) + Number(cs);

            $('#totalamm').val(totalamm);
            $('#totalpoids').val(totalpoids);
        }
    });
}

function getModeTransport() {
    const mode_t = $("#modetransport :selected").val();

    if (mode_t == 'Aérienne') {
        $(".aerienne").show();
        $(".maritime").hide();
        $(".terrestre").hide();
        $(".ferroviaire").hide();
    }

    if (mode_t == 'Maritime') {
        $(".aerienne").hide();
        $(".maritime").show();
        $(".terrestre").hide();
        $(".ferroviaire").hide();
    }

    if (mode_t == 'Terrestre') {
        $(".aerienne").hide();
        $(".maritime").hide();
        $(".terrestre").show();
        $(".ferroviaire").hide();
    }
    if (mode_t == 'Ferroviaire') {
        $(".aerienne").hide();
        $(".maritime").hide();
        $(".terrestre").hide();
        $(".ferroviaire").show();
    }

}
