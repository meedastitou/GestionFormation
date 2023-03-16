

// /*
// **
// ** fucnton confirm  v1.0
// ** it's box confirmation befor Delete Formation
// **  retturn 
// **      1-> ok
// **      0-> non
// **
// */
// function conf(id_formation) {
//     if (confirm("Are You Sure?!"))
//         deleteFormation(id_formation);
// }

// /*
// **
// ** fucnton deleteFormation  v1.0
// ** send request to BackEnd For Delete The Formation SNCRH
// **  retturn 
// **  args
// **      id_formation 
// **
// */
// function deleteFormation(id_formation) {
//     $.ajax({
//         url: "synchro.php",
//         type: "post",
//         data: {
//             synchronisation: "",
//             do: 'Delete',
//             id_formation: id_formation
//         },
//         success: function (data, status) {
//             displayFormation(1, 10);
//             $("#displayMsgSynchro").html(
//                 "<div><i class='fa-regular fa-circle-xmark'></i></div><p>The formation is <strong>removed</strong></p></br>"
//             ).toggleClass("show");
//             setTimeout(function () { $("#displayMsgSynchro").toggleClass("show") }, 5000);
//         }

//     });
// }
// /*
// **
// ** fucnton displayFormation  v2.0
// ** get Data from Database between start and fin
// ** and display it in table
// **  retturn 
// **  args
// **      start   -> starting line in DB
// **      fin     -> end line in DB
// **
// */
// var paglink;
// function displayFormation(start, fin) {
//     $.ajax({
//         url: "synchro.php",
//         type: "post",
//         data: {
//             synchronisation: "",
//             do: "selectBetween",
//             start: start,
//             fin: fin
//         },
//         success: function (data, status) {
//             $("#table_body").html(data);
//             pagelink = "page_link"+ ((start/10)+1);
//             $(".page-link").removeClass("active");
//             $("#"+pagelink).addClass("active");
//             localStorage.setItem("page_link",((start/10)+1));
//         }
//     });
// }
// /*
// **
// ** fucnton detailsFomrmation  v1.0
// ** get Data from Database about The Formation
// ** and display it in Modal
// **  retturn 
// **  args
// **      id_formation    -> id the formation wich want to see her details 
// **
// */

// function detailsFomrmation(id_formation){
//     let x;
//     $.ajax({
//         url: "synchro.php",
//         type: "post",
//         async: false,
//         data: {
//             synchronisation: "",
//             do: "getById",
//             id_formation: id_formation
//         },
//         success: function (data, status) {
//             x =JSON.parse(data);
//         }
//     });
//     return x;
// }

// function showFormationEdit(id_formation){
//     var formation = detailsFomrmation(id_formation);
//     console.log(formation);
//     $("#idFormaiton").val(formation[0]);
//     $("#formationName").val(formation[1]);
//     $("#formationCat").val(formation[2]);
//     $("#proposedBy").val(formation[7]);
//     $("#numberHoures").val(formation[6]);
//     $("#trainerName").val(formation[8]);
//     $("#trainerNumber").val(formation[9]);
//     $("#trainerEmail").val(formation[10]);
//     $("#traininigSite").val(formation[11]);
//     $("#nbParticepants").val(formation[12]);
//     $("#dateStart").val(formation[3]);
//     $("#dateFin").val(formation[4]);

//     if(formation[5] == 'Externe'){
//         $("#formationE").attr('selected', 'true'); 
//     }else{
//         $("#formationI").attr('selected', 'true'); 
//     }
// }

// function saveEdit(){
//     $.ajax({
//         url: "synchro.php",
//         type: "post",
//         data: {
//             synchronisation: "",
//             do: "Update",
//             id_formaiton    : $("#idFormaiton").val(),
//             formationName   : $("#formationName").val(),
//             formationCat    : $("#formationCat").val(),
//             proposedBy      : $("#proposedBy").val(),
//             numberHoures    : $("#numberHoures").val(),
//             trainerName     : $("#trainerName").val(),
//             trainerNumber   : $("#trainerNumber").val(),
//             trainerEmail    : $("#trainerEmail").val(),
//             traininigSite   : $("#traininigSite").val(),
//             nbParticepants  : $("#nbParticepants").val(),
//             dateStart       : $("#dateStart").val(),
//             dateFin         : $("#dateFin").val(),
//             formationEI     : $("#formationEI").val()

//         },
//         success: function (data, status) {
//             displayFormation(0, 10);
//         },
//         error: function (data, status) {
//             console.log(data);
//         }
//     });
// }

// function showFormationDetails(id_formation){
//     var formation = detailsFomrmation(id_formation);
//     console.log(formation);
//     $("#DidFormaiton").val(formation[0]);
//     $("#DformationName").val(formation[1]);
//     $("#DformationCat").val(formation[2]);
//     $("#DproposedBy").val(formation[7]);
//     $("#DnumberHoures").val(formation[6]);
//     $("#DtrainerName").val(formation[8]);
//     $("#DtrainerNumber").val(formation[9]);
//     $("#DtrainerEmail").val(formation[10]);
//     $("#DtraininigSite").val(formation[11]);
//     $("#DdateStart").val(formation[3]);
//     $("#DdateFin").val(formation[4]);
//     $("#DCreatedBy").val(formation[12]);
//     $("#DCreatedAt").val(formation[13]);
//     $("#DUpdatedBy").val(formation[14]);
//     $("#DUpdatedAt").val(formation[15]);

//     if(formation[5] == 'Externe'){
//         $("#DformationE").attr('selected', 'true'); 
//     }else{
//         $("#DformationI").attr('selected', 'true'); 
//     }


// }

// window.onload = function(){
//     var pl=1;
//     if(localStorage.getItem('page_link') != null){
//         pl=Number(localStorage.getItem('page_link'));
//     }
//     // localStorage.setItem("page_link", pl); 
//     $(".page-link").removeClass("active");
//     $("#page_link"+pl).addClass("active");
//     displayFormation(parseInt((pl-1)*10), 10);
// }
function addgroup() {
    // let number = $("#cerr").val();
    // if(number>5){
    //     alert("You Can't Add More The 5 Groups");
    //     return 0;
    // }
    // alert($("#date").val() + " " +  $("#heureStart").val() + " " + $("#heureFin").val() );
    if($("#date").val() != "" && $("#heureStart").val() != ""  && $("#heureFin").val() != ""){
        // alert("daaba ah");
    $.ajax({
        url: "synchroFront.php",
        type: "post",
        async: false,
        data: {
            synchronisation : "",
            do              : "AddGroup",
            id_formation    : $("#id_formation").val(), 
            date          : $("#date").val(),
            timeStart : $("#heureStart").val(),
            timeFin : $("#heureFin").val()
        },
        success: function (data, status) {
            // displayFormation(0, 10);
            
            $("#listGroup").html(data);
            // $("#cerr").val(Number($("#cerr").val())+1);

        },
        error: function (data, status) {
            console.log(data);
        }
    });
    $('#mySelect').select2({
        maximumSelectionLength: 100,
        minimumResultsForSearch: 1,
        placeholder: "Add participants"
    });
}
}
