<?php 
unset($_POST['x'],$_POST['y'],$_POST['send_x'],$_POST['send_y']);
####################### SAIBAL GENERAL FORM 1.0 ####################
#                                                                  #
# Creato da saibal - http://www.lorenzone.it - saibal@lorenzone.it #
# Roma - Aprile 2003                                               #
#                                                                  #
#          Scriptino piccolino piccolino da leccarsi i gomiti      #
#                                                                  #
#  Dedicato al mio Taricone... il gatto che non deve chiedere mai! #
#                                                                  #
# Baci ai pupi                                                     #
# Saibal alias Lorenzo                                             #
####################################################################

#######################################
#    IMPOSTAZIONI DI CONFIGURAZIONE   #
#######################################

//email del destinatario del modulo
$destinatario = "segreteria@compagniafitzcarraldo.it";

//nome mittente per la corretta intestazione del modulo
$nome_mittente = "Sito Fitzcarraldo";

//email mittente per per la corretta intestazione del modulo
$email_mittente = "segreteria@compagniafitzcarraldo.it";

//oggetto dell'email
$oggetto_email = "Modulo dal sito Fitzcarraldo Cup";

//se si vogliono rendere tutti i campi NON OBBLIGATORI impostare su "y". valori possibili: "y" e "n"
$all_free = "y";

//se invece avete messo "n" inserire tra virgolette, separati da virgola, i nomi dei campi da rendere OBBLIGATORI
//Esempio: $campi_req = array("telefono","via");
$campi_req = array("Telefono");

//controllo del campo email? valori possibili: "y" e "n"
$obbligo_email = "y";

//obbligare l'utente ad accettare le condizioni? valori possibili: "y" e "n"
$accetta_condizioni = "n";

//url della pagina di ringraziamento
$pagina_grazie = "inviook.htm";

//url della pagina errore campi vuoti
$pagina_error_empty = "campi_vuoti.html";

//url della pagina errore email
$pagina_error_email = "inviono.htm";

//url della pagina errore condizioni non accettate
$pagina_error_condizioni = "http://www.sito.it/errore_condizioni.htm";

//url della pagina errore invio non autorizzato (mancanza di referer)
$pagina_error_referer = "inviook.html";

//orario e data
$ora = date ("H:i:s"); 
$data = date ("d/m/Y");

//intestazione dell'email (arriva al destinatario)
$corpo = "
Modulo inviato il $data alle ore $ora\n
Riepilogo dati:\n
 ____________________________________________________________\n";

//======================= NON TOCCARE NULLA... SE NON VUOI INCASINARE QUALCOSA =======================\


########### CODICE VARIO ###########

//variabili per rendere lo script compatibile anche con PHP 4.2 - copyright di Chris
if(!isset($_SERVER) OR !$_SERVER OR !is_array($_SERVER) OR count(array_diff($_SERVER, $HTTP_SERVER_VARS))){  
$_POST = &$HTTP_POST_VARS; 
}

//prendo il numero IP
if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	
	if ($_SERVER["HTTP_X_FORWARDED_FOR"] == "") {

$ipnumb = getenv("REMOTE_ADDR");

		}else {

$ipnumb = getenv("HTTP_X_FORWARDED_FOR");

			}

		} else {

$ipnumb = getenv("REMOTE_ADDR");
		}
###################################



########### CONTROLLO DEI CAMPI ###########
$control_campi = 0;

if($all_free != "y"){

    foreach($_POST as $key => $valore){

        if(in_array($key,$campi_req)){

            if(trim($valore) == ""){

            $control_campi++;
            
                                    } 

                                }

                            }

                        } else {

            $control_campi = 0;    

                                }                    

########### CONTROLLO EMAIL ###########
$control_email = 0;

if($obbligo_email == "y"){

    if(isset($_POST['email'])){

        //espressione regolare a cura dell'esimio dottore - http://www.myphp.it
        if(!eregi("^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9_-])+.)+[a-z]{2,6}$", $_POST['email'])){

        $control_email++;

                            }

                        } else {

        $control_email = 0;

                            }

                        }

########### CONTROLLO CONDIZIONI ###########
$control_condizioni = 0;

if($accetta_condizioni == "y"){

    if(isset($_POST['trattamento_dati']) && $_POST['trattamento_dati'] == "accetto"){

        $control_condizioni = 0;

            } else {

        $control_condizioni ++;

            }

        }

########### VAI CON L'INVIO DELL'EMAIL ###########
if($control_campi == 0){

        if($control_email == 0){

            if($control_condizioni == 0){

foreach($_POST as $key => $valore){

$key = ucfirst(stripslashes(trim($key)));
$valore = stripslashes(trim($valore));
$key = str_replace("_"," ",$key);

            if(trim($valore) == "") $valore = "Non compilato";
            
                $corpo .= $key .": ". $valore ."\n";//tolto un \n

            }
			
				$corpo .= "Numero IP: $ipnumb"."\n";//tolto un \n

$corpo .= "
 ____________________________________________________________ \n\n

Modulo comunicazioni del sito internet www.fitzcarraldocup.org";

    
//inizio l'invio dell'email
mail("$destinatario","$oggetto_email","$corpo", "From: $nome_mittente <$email_mittente>");

                header ("Location: $pagina_grazie");

                                } else {

                header ("Location: $pagina_error_condizioni");

                            }

                        } else {

                header ("Location: $pagina_error_email");

                        }

                    } else {

                    
                header ("Location: $pagina_error_empty");

                    }

?>
