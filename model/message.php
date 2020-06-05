<?php
/*
 * Messages for success and error messages on the website
 *
 */

function wrongUsernameOrPasswordMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Fel användarnamn eller lösenord
            </div>";
}

function usernameNotEnteredMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Användarnamn saknas!
            </div>";
}

function passwordNotEnteredMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Inget lösenord har angetts!
            </div>";
}

function usernameAndPasswordMissingMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Du måste fylla i användarnamnet och lösenordet!
            </div>";
}

function regInfoIsMissingMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Du måste fylla i information om bloggen.
            </div>";
}

function regUserAlreadyExistMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                En användare med det namnet finns redan
            </div>";
}

function wrongCharactersMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Använd inte några konstiga tecken i ditt användarnamn.
            </div>";
}

function renameImageFileMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Det finns redan en fil med det namnet, var vänlig och döp om filen och ladda upp den igen.
            </div>";
}

function errorTitleMissingMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Det saknas en rubrik till ditt inlägg
            </div>";
}
function successUploadedPostMsg(){
    return "<div class=\"alert alert-success\" role=\"alert\">
                Inlägget ligger nu uppe!
            </div>";

}
function errorBlogTextMissingMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Du har inte skrivit något inlägg.
            </div>";
}

function uploadSuccessfulMsg(){
    return "<div class=\"alert alert-success\" role=\"alert\">
                Uppladdningen lyckades!
            </div>";
}

function uploadFailedMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Uppladdningen misslyckades
            </div>";
}

function changeProfileImageSuccessfulMsg(){
    return "<div class=\"alert alert-success\" role=\"alert\">
                Byte av profilbild lyckades!
            </div>";
}

function changeProfileImageFailedMsg(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Byte av profilbild misslyckades
            </div>";
}

function registerUserSuccess(){
    return "<div class=\"alert alert-success\" role=\"alert\">
                Ett konto är nu skapat!
            </div>";
}

function registerUserFail(){
    return "<div class=\"alert alert-danger\" role=\"alert\">
                Registreringen misslyckades!
            </div>";
}

function deletePostMsg(){
    return "<div class=\"alert alert-success\" role=\"alert\">
                Inlägget raderades utan problem
            </div>";
}

function editPostSuccessMsg(){
    return "<div class=\"alert alert-success\" role=\"alert\">
                Inlägget uppdaterades utan problem
            </div>";
}
?>