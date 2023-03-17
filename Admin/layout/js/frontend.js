

/*
**
** fucnton confirm  v1.0
** it's box confirmation befor Delete Formation
**  retturn 
**      1-> ok
**      0-> non
**
*/
function conf(id_formation) {
    if (confirm("Are You Sure?!"))
        deleteFormation(id_formation);
}

/*
**
** fucnton deleteFormation  v1.0
** send request to BackEnd For Delete The Formation SNCRH
**  retturn 
**  args
**      id_formation 
**
*/
function deleteFormation(id_formation) {
    $.ajax({
        url: "synchro.php",
        type: "post",
        data: {
            synchronisation: "",
            do: 'Delete',
            id_formation: id_formation
        },
        success: function (data, status) {
            displayFormation(0, 10);
            $("#displayMsgSynchro").html(
                "<div><i class='fa-regular fa-circle-xmark'></i></div><p>The formation is <strong>removed</strong></p></br>"
            ).toggleClass("show");
            setTimeout(function () { $("#displayMsgSynchro").toggleClass("show") }, 5000);
        }

    });
}
/*
**
** fucnton displayFormation  v2.0
** get Data from Database between start and fin
** and display it in table
**  retturn 
**  args
**      start   -> starting line in DB
**      fin     -> end line in DB
**
*/
var paglink;
function displayFormation(start, fin) {
    $.ajax({
        url: "synchro.php",
        type: "post",
        data: {
            synchronisation: "",
            do: "selectBetween",
            start: start,
            fin: fin
        },
        success: function (data, status) {
            $("#table_body").html(data);
            pagelink = "page_link"+ ((start/10)+1);
            $(".page-link").removeClass("active");
            $("#"+pagelink).addClass("active");
            localStorage.setItem("page_link",((start/10)+1));
        }
    });
}
/*
**
** fucnton detailsFomrmation  v1.0
** get Data from Database about The Formation
** and display it in Modal
**  retturn 
**  args
**      id_formation    -> id the formation wich want to see her details 
**
*/

function detailsFomrmation(id_formation){
    let x;
    $.ajax({
        url: "synchro.php",
        type: "post",
        async: false,
        data: {
            synchronisation: "",
            do: "getById",
            id_formation: id_formation
        },
        success: function (data, status) {
            x =JSON.parse(data);
        }
    });
    return x;
}

function showFormationEdit(id_formation){
    var formation = detailsFomrmation(id_formation);
    console.log(formation);
    $("#idFormaiton").val(formation['id_formation']);
    $("#formationName").val(formation['nom_formation']);
    $("#formationCat").val(formation['categorie_formation']);
    $("#objectif").val(formation['objectif']);
    $("#proposedBy").val(formation['service_propose']);
    $("#numberHoures").val(formation['hours_formation']);
    $("#trainerName").val(formation['nom_formateur']);
    $("#trainerNumber").val(formation['num_formateur']);
    $("#trainerEmail").val(formation['email_formateur']);
    $("#traininigSite").val(formation['lieu_formation']);
    $("#nbParticepants").val(formation['NumberParticipe']);
    $("#mySelect").val(formation['responsable'])
    $("#dateStart").val(formation['date_debut']);
    $("#dateFin").val(formation['date_fin']);
    
    if(formation['formation_EX_IN'] == 'Externe'){
        $("#formationE").attr('selected', 'true'); 
    }else{
        $("#formationI").attr('selected', 'true'); 
    }

    $(document).ready(function() {
        $('#mySelect').select2();
      });
}

function saveEdit(){
    // alert($("#mySelect").val());
    $.ajax({
        url: "synchro.php",
        type: "post",
        data: {
            synchronisation: "",
            do: "Update",
            id_formaiton    : $("#idFormaiton").val(),
            formationName   : $("#formationName").val(),
            formationCat    : $("#formationCat").val(),
            proposedBy      : $("#proposedBy").val(),
            numberHoures    : $("#numberHoures").val(),
            trainerName     : $("#trainerName").val(),
            trainerNumber   : $("#trainerNumber").val(),
            trainerEmail    : $("#trainerEmail").val(),
            traininigSite   : $("#traininigSite").val(),
            nbParticepants  : $("#nbParticepants").val(),
            dateStart       : $("#dateStart").val(),
            dateFin         : $("#dateFin").val(),
            formationEI     : $("#formationEI").val(), 
            objectif        : $("#objectif").val(),
            responsable     : $("#mySelect").val()

        },
        success: function (data, status) {
            console.log(data);
            displayFormation(0, 10);
        },
        error: function (data, status) {
            console.log(data);
        }
    });
}

function showFormationDetails(id_formation){
    var formation = detailsFomrmation(id_formation);
    console.log(formation);
    $("#DidFormaiton").val(formation['id_formation']);
    $("#DformationName").val(formation['nom_formation']);
    $("#DformationCat").val(formation['categorie_formation']);
    $("#Dobjectif").val(formation['objectif']);
    $("#DproposedBy").val(formation['service_propose']);
    $("#DnumberHoures").val(formation['hours_formation']);
    $("#DtrainerName").val(formation['nom_formateur']);
    $("#DtrainerNumber").val(formation['num_formateur']);
    $("#DtrainerEmail").val(formation['email_formateur']);
    $("#DtraininigSite").val(formation['lieu_formation']);
    $("#Dres").val(formation['Nom'] + " " + formation['Prenom']);
    $("#DdateStart").val(formation['date_debut']);
    $("#DdateFin").val(formation['date_fin']);
    $("#DCreatedBy").val(formation['created_by']);
    $("#DCreatedAt").val(formation['created_at']);
    $("#DUpdatedBy").val(formation['updated_by']);
    $("#DUpdatedAt").val(formation['updated_at']);

    if(formation[5] == 'Externe'){
        $("#DformationE").attr('selected', 'true'); 
    }else{
        $("#DformationI").attr('selected', 'true'); 
    }


}

function getByFilter(){
    let from    = $("#from").val();
    let to      = $("#to").val();
    // let GLthan  = $("#GLthan").val();
    // let option  = $("#option").val();

    let x;
    $.ajax({
        url: "synchro.php",
        type: "post",
        async: false,
        data: {
            synchronisation: "",
            do: "getByFilter",
            date_debut: from,
            date_fin: to,
            
        },
        success: function (data, status) {
            $("#welcome").html(data);
        }
    });
    
}

window.onload = function(){
    var pl=1;
    if(localStorage.getItem('page_link') != null){
        pl=Number(localStorage.getItem('page_link'));
    }
    // localStorage.setItem("page_link", pl); 
    $(".page-link").removeClass("active");
    $("#page_link"+pl).addClass("active");
    displayFormation(parseInt((pl-1)*10), 10);
}
