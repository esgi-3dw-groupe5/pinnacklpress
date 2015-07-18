function activate() {
    if(document.getElementById('smtp_authentification_true').checked) {
        document.getElementById('smtp_username').disabled=false;
        document.getElementById('smtp_username').required=true;
        document.getElementById('smtp_password').disabled=false;
        document.getElementById('smtp_password').required=true;
        document.getElementById('smtp_port').disabled=false;
        document.getElementById('smtp_port').required=true;
    }else if(document.getElementById('smtp_authentification_false').checked) {
        document.getElementById('smtp_username').disabled=true;
        document.getElementById('smtp_username').required=true;
        document.getElementById('smtp_username').value="";
        document.getElementById('smtp_password').disabled=true;
        document.getElementById('smtp_password').required=true;
        document.getElementById('smtp_password').value="";
        document.getElementById('smtp_port').disabled=true;
        document.getElementById('smtp_port').required=true;
        document.getElementById('smtp_port').value="";  
    }
}