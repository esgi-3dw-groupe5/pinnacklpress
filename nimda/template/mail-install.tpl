<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Bienvenue <?php echo $pseudo;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            /* Fonts and Content */
            body, td { font-family: 'Helvetica Neue', Arial, Helvetica, Geneva, sans-serif; font-size:14px; }
            body { background-color: #2A374E; margin: 0; padding: 0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none; }
            h2{ padding-top:12px; /* ne fonctionnera pas sous Outlook 2007+ */color:#0E7693; font-size:22px; }

            @media only screen and (max-width: 480px) { 

                table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
                table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }  
                table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
                table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
                img{ height:auto;}
                /*illisible, on passe donc sur 3 lignes */
                table[class=w180], td[class=w180], img[class=w180] { 
                    width:280px !important; 
                    display:block;
                }    
                td[class=w20]{ display:none; }    
            }
        </style>

    </head>
    <body style="margin:0px; padding:0px; -webkit-text-size-adjust:none;">

        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:rgb(42, 55, 78)" >
            <tbody>
                <tr>
                    <td align="center" bgcolor="#2A374E">
                        <table  cellpadding="0" cellspacing="0" border="0">
                            <tbody>                            
                                <tr>
                                    <td class="w640"  width="640" height="60"></td>
                                </tr>
                                <!-- entete -->
                                <tr class="pagetoplogo">
                                    <td class="w640"  width="640">
                                        <table  class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#7c7c7c">
                                            <tbody>
                                                <tr>
                                                    <td class="w30"  width="30"></td>
                                                    <td  class="w580"  width="580" valign="middle" align="left">
                                                        <div class="pagetoplogo-content">
                                                            <h1 style="font-size:xx-large;">Pinnackl.com</h1>
                                                        </div>
                                                    </td> 
                                                    <td class="w30"  width="30"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <!-- separateur horizontal -->
                                <tr>
                                    <td  class="w640"  width="640" height="1" bgcolor="#d7d6d6"></td>
                                </tr>

                                <!-- contenu -->
                                <tr class="content">
                                    <td class="w640" class="w640"  width="640" bgcolor="#ffffff">
                                        <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td  class="w30"  width="30"></td>
                                                    <td  class="w580"  width="580">
                                                        <!-- une zone de contenu -->
                                                        <table class="w580"  width="580" cellpadding="0" cellspacing="0" border="0">
                                                            <tbody>                                                            
                                                                <tr>
                                                                    <td class="w580"  width="580">
                                                                        <h2 style="color:#0E7693; font-size:22px; padding-top:12px;">
                                                                            Bonjour <?php echo $pseudo;?> </h2>

                                                                        <div align="left" class="article-content">
                                                                            <p> Bienvenue sur votre site</p>
                                                                            <p>
                                                                                Vous confirmons la bonne configuration de celui-ci. Il est disponible à cette adresse :
                                                                            </p>
                                                                            <p>
                                                                                <?php echo $siteUrl;?>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- fin zone -->                                                   

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <!--  separateur horizontal de 15px de haut -->
                                <tr>
                                    <td class="w640"  width="640" height="15" bgcolor="#ffffff"></td>
                                </tr>

                                <!-- pied de page -->
                                <tr class="pagebottom">
                                    <td class="w640"  width="640">
                                        <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#7c7c7c">
                                            <tbody>
                                                <tr>
                                                    <td colspan="5" height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td class="w30"  width="30"></td>
                                                    <td class="w580"  width="580" valign="top">
                                                        <p align="right" class="pagebottom-content-left">
                                                            <a style="color:#255D5C;" href="http://www.pinnackl.com"><span style="color:#255D5C;">Pinnackl.com</span></a>
                                                        </p>
                                                    </td>

                                                    <td class="w30"  width="30"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" height="10"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w640"  width="640" height="60"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>