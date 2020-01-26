/**
 *  Expozart
 *  form script: gére le fonctionnement des formulaires, et les actions associées
 *  Code:   yitzakD
 */




$(document).ready(function() {

    /** shPassword:   afficher ou cacher le mot de passe  */
    function shPassword() {

        var x = document.getElementById("ex-pass");
        
        if (x.type === "password") {

            x.type = "text";

        } else {

            x.type = "password";

        }

    }
    $(".toggle-password"). click(function() {

        $(".ex-field-icon").toggleClass("fa-eye fa-eye-slash");

        shPassword();

        $("#ex-pass").focus();

    });




    /** pStrebgth:  affiche la solidité du mot de passe  */
    function pStrebgth(password) {

        var desc = [{'width':'0px'}, {'width':'20%'}, {'width':'40%'}, {'width':'60%'}, {'width':'80%'}, {'width':'100%'}];
        
        var descClass = ['', ' bg-danger', ' bg-warning', ' bg-warning', ' bg-info', ' bg-success'];

        var score = 0;

        var minlength = 3;

        var upperCase = new RegExp('[A-Z]');

        var numbers = new RegExp('[0-9]');

        var specialchars = new RegExp('([!,%,&,@,#,$,^,*,?,_,~])');

        var maxlength = 11;


        if(password.length > minlength) {score++;}

        if(password.match(upperCase)) {score++;}

        if (password.match(numbers)) {score++;}

        if(password.match(specialchars)) {score++;}

        if(password.length > maxlength) {score++;}

        
        $("#ex-pass-strenght").removeClass(descClass[score-1]).addClass(descClass[score]).css(desc[score]);
    
    }
    $("#ex-pass").keyup(function() {

        $(".ex-progress").show().animate();

        pStrebgth($(this).val());

    });




    /** loader:  Faire aparaitre un loader quand on appuie sur un bouton  */
    $("#ex-subbmit-btn").click(function() {

        $(this).html("<i class='fas fa-spinner fa-lg fa-spin ml-4 mr-4'></i>")

    });




    /** Alert:  Faire disparaitre l'alert automatiquement après 10s  */
    $("#js-ex-alert").delay(6500).fadeOut(500);

    $(".ex-alert-close").click(function() {

        ex_alert = $(this).parent("#js-ex-alert");

        ex_alert.css("top", "-1rem").fadeOut(450);

        return false;

    });




    /** search box:  Faire apparaître & disparaitre le shadow au focus  */
    $(".ex-search-box-form-control").focus(function() {

        $(this).parent().css("box-shadow", "0 0 0 0.2rem rgba(108, 63, 152, .45)");

    });
    $(".ex-search-box-form-control").blur(function() {

        $(this).parent().css("box-shadow", "none");

    });

    /** show serach box: Faire apparaître et la search bar cacché */
    $("#show-search-box").click(function(e) {

        e.preventDefault();

        ipg =   '<div class="search-box-contenor">' + 
                    '<div class="input-group">' +
                        '<div class="input-group-prepend">' + 
                            '<div class="input-group-text" id="search-box"><i class="fas fa-sm fa-search"></i></div>' + 
                        '</div>' + 
                        '<input type="text" class="form-control ex-search-box-form-control" placeholder="Rechercher" aria-label="search" aria-describedby="search-box">' + 
                    '</div>' + 
                '</div>';


        if($(this).hasClass("ex-show")) {
            
            $(this).removeClass("ex-show");

            $("#hidden-search-bar-box").css("top", "-60px").animate();

            $("#hidden-search-bar-box").html("");

            $(this).css({"color": "rgba(147, 149, 151, .85)", "background-color": "transparent"});

        } else {
            
            $(this).addClass("ex-show");

            $("#hidden-search-bar-box").html(ipg);

            $("#hidden-search-bar-box").css("top", "60px").animate();

            $(this).css({"color": "rgba(108, 63, 152, .85)", "background-color": "rgba(224, 226, 228, .85)"});

        }

    });


    /** post artwork:  gestionnaire des postes  */

    /** Liens vers le dossiers des vues  */
    ajaxlink = "http://localhost:8000/resources/views/";

    rootlink = "http://localhost:8000/";


    var dff = $("#dropFileForm");

    rooterlink = dff.attr("action");

    var awlabel = $("#artworkLabel");

    var awfile = $("#artworkFile");

    var awhidden = $("#hashparam");

    var awupload = $("#uploadArtwork");

    var droppedFiles;



    function overRideDef(e) {

        e.preventDefault();

        e.stopPropagation();

    }
    function fileHover() {

        $(awlabel).addClass("ex-ddf-hover");

    }
    function fileHoverEnd() {

        $(awlabel).removeClass("ex-ddf-hover");

    }
    function addFiles(e) {

        droppedFiles = e.target.files || e.originalEvent.dataTransfer.files;

        countFiles(droppedFiles);

    }
    function countFiles(files) {

       if(files.length > 1) {

            $("#showtext").text(files.length + " fichiers sélectionnés");

       } else {

            $("#showtext").text(files[0].name);

       }

    }
    function uploadFiles(e) {

        e.preventDefault();

        changeStatus("Redirection dans 10s ...");

        var saveformdata = new FormData();

        for(var i = 0, file; (file = droppedFiles[i]); i++) {
        /*for(afile of droppedFiles) {*/
            
            saveformdata.append("aFile[]", file);

        }

        saveformdata.append("arthash", awhidden.val());

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function(data) {
            
            if(xhr.response !== "nfy") {

                changeStatus("Chargement en cours...");

                setTimeout(rechangeStatus, 2000);

                setTimeout(refreshtonext, 10000);

            }

        };

        xhr.open("post", ajaxlink + 'Post/parts/artwork-media-post.ajax.php');

        xhr.send(saveformdata);

    }
    function changeStatus(text) {$("#upstatus").text(text);}
    function refreshtonext() {

        window.location.replace(rooterlink);        

    }
    function rechangeStatus() {

        changeStatus("Vueillez patienter quelques instants s'il vous plait ...");        

    }


    awlabel.on('dragover', function(evnt) { 

        overRideDef(evnt);

        fileHover();

    });
    awlabel.on('dragenter', function(evnt) { 

        overRideDef(evnt);

        fileHover();

    });
    awlabel.on('dragleave', function(evnt) {

        overRideDef(evnt);

        fileHoverEnd();

    });
    awlabel.on('drop', function(evnt) {

        overRideDef(evnt);

        fileHoverEnd();

        addFiles(evnt);

    });
    awfile.on('change', function(evnt) {

        addFiles(evnt);

    });
    dff.on('submit', function(evnt) {

        evnt.preventDefault();

        uploadFiles(evnt);

    });



    /** Ajout de texte au status */
    var artworkpublisher = $("#json-artwork-publisher");

    var pMaxlength = 512;

    $(".json-remaining").text(pMaxlength);

    $("#json-post-content").keyup(function(evnt) {

        limitChars($(this));                

    });

    
    artworkpublisher.click(function() {

        artworkpost = $("#json-post-content").val();

        artworkpost = $.trim(artworkpost);

        
        jsontopic = $("#json-post-topic").val();

        jsonhash = $("#json-arthash-param").val();


        if(artworkpost !== "") {

            $.post(ajaxlink + 'Post/parts/artwork-content-post.ajax.php', {msg:artworkpost,artworkhash:jsonhash,topic:jsontopic}, function(postsenderData) {
                                            
                if(postsenderData !== "post-not-send") {

                    $("#json-post-content").val("");

                    window.location.replace(rootlink);

                }

            });
            
        } else {

            $("#json-post-content").text("De quoi s'agit-il").class("text-danger");

        }

    });

    function limitChars(description) {

        if(description.val().length > pMaxlength) {

            description.val(description.val().substring(0, pMaxlength));

        } else {

            var nRemaining = pMaxlength - description.val().length;

            $(".json-remaining").text(nRemaining);

        }

    }



    /** post avatar:  gestionnaire de l'image de profil  */
    /** 
        ipf = image profil form
        arl = avatar root link
        aif = avatar input file 
    */

    var ipf = $("#upAvatarFileForm");

    arl = ipf.attr("action");

    var aif = $("#avatarFile");

    
    function uploadAvatarFile(e) {

        e.preventDefault();

        changeStatus("Vueillez patienter quelques instants s'il vous plait ...");

        var sfd = new FormData();

        for(var i = 0, file; (file = droppedFiles[i]); i++) {

            sfd.append("avf[]", file);

        }

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function(data) {
            
            if(xhr.response !== "nfy") {

                changeStatus("Chargement en cours ...");

                setTimeout(rechangeStatus, 2000);

                setTimeout(rtn, 5000);

            }

        };

        xhr.open("post", ajaxlink + 'Account/parts/avatar-media-post.ajax.php');

        xhr.send(sfd);

    }
    function rtn() {

        window.location.replace(arl);        

    }
    aif.on('change', function(evnt) {

        addFiles(evnt);

    });

    ipf.on('submit', function(evnt) {

        evnt.preventDefault();

        uploadAvatarFile(evnt);

    });

});