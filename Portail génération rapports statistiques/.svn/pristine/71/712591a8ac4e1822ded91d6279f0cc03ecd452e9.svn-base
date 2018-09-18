<body onload="js_rapport_disponible()" style="margin:0;">

    <div id="spinLoader"></div>

    <?php echo bouton_rapport_annuler(base_url('rapports')) ?>   

    <div id="resultat_ajax">
    </div>

    <div style="display:none;" id="messageTraitement" class="animate-bottom">
        <h2>Votre rapport est disponible</h2>
        <p>Traitement terminé pour : <b><?php echo $rapport->ra_libelle ?></b></p>
        <?php echo bouton_rapport_disponible(base_url('rapports')) ?>        
    </div>


    <script>

        /*$(document).ready(function () {
         js_rapport_disponible();
         });*/


        var myVar;
        //var iter = 0;
        function js_rapport_disponible() {
            myVar = setTimeout(showPage, 3000);
            console.log("Début de l'attente");
            var url = "<?php echo base_url('Web_Commande_Controller/afficher_etat_commande/' . $cmd_guid); ?>";
            var posting = $.post(url);
            posting.done(function (data) {
                var content = $(data);
                console.log(content);
            });
            console.log("Avant showPage");
            
            //var commande_traitee = false;
            //if (commande_traitee == false) {
            //do {
            //var cmd_guid;            

            //sleep(10000);
            //$(this).dialog("close");

            /*var res_ajax = $.ajax({
             type: "POST",
             url: url
             }).done(function (data) {
             console.log("done !" + data.html);
             });
             
             console.log("retour : " + $('#resultat_ajax').contents().html());
             //myVar = setTimeout(2000);
             sleep(1000);
             iter++;
             /*if (iter > 5) {
             commande_traitee = true;
             console.log("Commande traitée");
             }
             } while (commande_traitee == false && iter < 3);
             } else {
             myVar = setTimeout(showPage);
             }*/
        }

        function showPage() {
            console.log("début showPage");
            var url = "<?php echo base_url('Rapport_Controller/afficher_rapport_genere/' . $cmd_guid); ?>";
            var posting = $.post(url);
            posting.done(function (data) {
                var content = $(data);
                console.log(content);
                console.log("Fin showPage");
            });
        }

        /*function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds) {
                    break;
                }
            }
        }*/

        /*function js_rapport_disponible() {
         myVar = setTimeout(showPage, 3000);
         }
         
         function showPage() {
         document.getElementById("spinLoader").style.display = "none";
         document.getElementById("annulerRapport").style.display = "none";
         document.getElementById("messageTraitement").style.display = "block";
         }*/

    </script>

</body>