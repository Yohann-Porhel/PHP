<h4>Développement</h4>

<script type="text/javascript">
function executer() {
    $.get("<?php echo base_url('rapport/genere_rapport') ?>");
    return false;
}
</script>

<a href="#" onclick="executer();">Lancer la génération du rapport (javascript)</a></p>
<a href="<?php echo base_url('logs/infos') ?>">Logs d'information</a></p>
<a href="<?php echo base_url('logs/erreurs') ?>">Logs d'erreur</a></p>
<a href="<?php echo base_url('rapport/genere_rapport') ?>">Lancer la génération du rapport (normal)</a></p>
<a href="<?php echo base_url('apobi_databases_controller') ?>">Test multi_bases</a></p>
<a href="<?php echo base_url('developpement/test_wait') ?>">Test attente fin de traitement JQuery</a></p>

<?php echo bouton_redirection_accueil();